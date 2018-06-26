<?php

namespace backend\controllers;

use Yii;
use backend\models\Disbursement;
use backend\models\DisbursementSearch;
use backend\models\CashAdvance;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TransactionStatus;
use backend\models\Transaction;
use backend\models\AccountingEntry;
use yii\filters\AccessControl;
use backend\models\DisbursedDv;
use backend\models\Nca;
use kartik\mpdf\Pdf;
use backend\models\LddapAda;
use backend\models\Ors;
use backend\models\ActivityLog;
use backend\models\DvLog;
use backend\models\DvRemarks;
use backend\models\OrsRegistry;
use backend\models\NcaEarmarked;

/**
 * DisbursementController implements the CRUD actions for Disbursement model.
 */
class DisbursementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'processor', 'cash', 'reports', 'nca', 'ada', 'disbursement', 'mDisbursement', 'cashStatus'],
                'rules' => [
                  [
                    'allow' => true,
                    'roles' => ['@']
                  ]
                            
              ],
          ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Disbursement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisbursementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disbursement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dv_no = Disbursement::find()->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no' => $dv_no->dv_no])->one();
        $dv_log = DvLog::find()->where(['dv_no' => $dv_no->dv_no])->all();

        $dvlog_model = new DvLog();
        // var_dump($dv_no);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        $transaction7 = explode(',', $transaction->indexing);
        $transaction8 = explode(',', $transaction->approval);

        if ($dvlog_model->load(Yii::$app->request->post()))
        {
            $dvlog_model->transaction = "Out from Accounting and Received by: ";
            $dvlog_model->save(false);

            return $this->render('_loader', ['id' => $id]);
        }

        return $this->render('view', [
            'model' => $this->findModel($id), 
            'transaction1'=>$transaction1, 
            'transaction2'=>$transaction2,
            'transaction3'=>$transaction3, 
            'transaction4'=>$transaction4,
            'transaction5'=>$transaction5, 
            'transaction6'=>$transaction6,
            'transaction7'=>$transaction7,
            'transaction8'=>$transaction8,
            'dv_log' => $dv_log,
            'dvlog_model' => $dvlog_model,
        ]);
    }

    public function actionProcessor($id)
    {
        $model = $this->findModel($id);
        $model2 = new OrsRegistry();

        //$ors_model = Ors::find()->where(['dv_no' => $model->dv_no])->all();

        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();

        //$ors_checker = OrsRegistry::find()->where(['dv_no'=>$dv_no])->all();
        
        if ($model->load(Yii::$app->request->post()))
        {

            if (\Yii::$app->user->can('Verifier') && (($model->action == null) || ($model->action == '')))
            {
                Yii::$app->getSession()->setFlash('warning', 'Please select action');

                return $this->render('viewP', [
                    'model' => $model]);
            }

            if(isset($_POST['requirements']))
            {
                $model->attachments = implode(',', $_POST['requirements']);
            }

            if(isset($_POST['requirements']) === null )
            {
                $model->attachments = '';
            }

            $model->net_amount = $model->gross_amount - $model->less_amount;

            //Start of Ativity Log --------------------------------

            $log = new ActivityLog();
            $log->particular = "Made changes on DV No. ".$model->dv_no.' with the following short details: Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
            $log->date_time = date('m/d/Y h:i');
            $log->user = Yii::$app->user->identity->fullname;
            $log->save(false);

            //End of Ativity Log --------------------------------

            for($i=0; $i<sizeof($model->ors_id); $i++)
            {
                $ors = explode('-', $model->ors_no[$i]);

                if(sizeof($ors) != 5)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Wrong ORS FormaT. Please check the ORS Number');

                    return $this->render('viewP', [
                        'model' => $model,
                        //'ors_model' => $ors_model,
                    ]);
                }

                $ors_registry_model = OrsRegistry::find()->where(['dv_no' => $model->dv_no])->andWhere(['ors_id' => $model->ors_id[$i]])->all();

                if($ors_registry_model == null)
                {

                    $new_ors_registry_model = new OrsRegistry();

                    $new_ors_registry_model->date = date('Y-m-d');
                    $new_ors_registry_model->ors_id = $model->ors_id[$i];
                    $new_ors_registry_model->particular = $model->particular[$i];
                    $new_ors_registry_model->dv_no = $model->dv_no;
                    $new_ors_registry_model->disbursement_date = $model->date;
                    $new_ors_registry_model->fund_cluster = $model->fund_cluster;
                    $new_ors_registry_model->ors_class = $ors[0];
                    $new_ors_registry_model->funding_source = $ors[1];
                    $new_ors_registry_model->ors_year = $ors[2];
                    $new_ors_registry_model->ors_month = $ors[3];
                    $new_ors_registry_model->ors_serial = $ors[4];
                    $new_ors_registry_model->mfo_pap = $model->mfo_pap[$i];
                    $new_ors_registry_model->responsibility_center = $model->responsibility_center[$i];
                    $new_ors_registry_model->obligation = str_replace(',', '', $model->obligation[$i]);
                    $new_ors_registry_model->payable = str_replace(',', '', $model->payable[$i]);
                    $new_ors_registry_model->payment = str_replace(',', '', $model->payment[$i]);

                     $new_ors_registry_model->save(false);
                }

                if($ors_registry_model != null)
                {

                    $new_ors_registry_model = OrsRegistry::find()->where(['dv_no' => $model->dv_no])->andWhere(['ors_id' => $model->ors_id[$i]])->one();

                    $new_ors_registry_model->date = date('Y-m-d');
                    $new_ors_registry_model->ors_id = $model->ors_id[$i];
                    $new_ors_registry_model->particular = $model->particular[$i];
                    $new_ors_registry_model->dv_no = $model->dv_no;
                    $new_ors_registry_model->disbursement_date = $model->date;
                    $new_ors_registry_model->fund_cluster = $model->fund_cluster;
                    $new_ors_registry_model->ors_class = $ors[0];
                    $new_ors_registry_model->funding_source = $ors[1];
                    $new_ors_registry_model->ors_year = $ors[2];
                    $new_ors_registry_model->ors_month = $ors[3];
                    $new_ors_registry_model->ors_serial = $ors[4];
                    $new_ors_registry_model->mfo_pap = $model->mfo_pap[$i];
                    $new_ors_registry_model->responsibility_center = $model->responsibility_center[$i];
                    $new_ors_registry_model->obligation = str_replace(',', '', $model->obligation[$i]);
                    $new_ors_registry_model->payable = str_replace(',', '', $model->payable[$i]);
                    $new_ors_registry_model->payment = str_replace(',', '', $model->payment[$i]);

                     $new_ors_registry_model->save(false);
                }
            }

            $model->status = \Yii::$app->user->can('processor') ? "Processed" : $model->action;
            $model->save(false);

            //New Remarks ------------------------------------------
                $model_remarks = DvRemarks::find()
                        ->where(['dv_no' => $model->dv_no])
                        ->andWhere(['user_id' => Yii::$app->user->identity->id])
                        ->one();

                if($model_remarks == null)
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks = new DvRemarks();
                        $model_remarks->dv_no = $model->dv_no;
                        $model_remarks->remarks = $model->remarks;
                        $model_remarks->user_id = Yii::$app->user->identity->id;
                        $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                }

                else
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks->remarks = $model->remarks;
                        $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                    else
                    {
                        $model_remarks->delete();
                    }
                }
            //End Remarks ------------------------------------------

            Yii::$app->getSession()->setFlash('success', 'Successfully Saved');
            return $this->render('viewPr', [
                'model' => $this->findModel($id),
            ]);
            
        }

        return $this->render('viewP', [
            'model' => $model,
        ]);

    }

    public function actionCreate()
    {
        if(\Yii::$app->user->can('createDisbursementVoucher'))
        {
            $model = new Disbursement();
            $values = Disbursement::find()->all();
            $serial = strlen((string) sizeof($values)) === 1 ? '000' : '00';
            $dv_no = date('Y').'-'.date('m').'-'.$serial.(sizeof($values)+1);

            if ($model->load(Yii::$app->request->post()))
            {
                $model->gross_amount = str_replace(',', '', $model->gross_amount);
                $model->dv_no = $dv_no;
                $model->status = 'Received & Encoded';
                $model->ors = implode(',', $model->ors);

                $model->save(false);
      
                
                //Start recording transactions ------------------------------------------

                $model3 = new TransactionStatus();
                $model3->dv_no = $model->dv_no;
                $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                $model3->receiving = $detail;
                $model3->save(false);

                //End Recordinf transactions ------------------------------------------


                //Start of Ativity Log --------------------------------

                $log = new ActivityLog();
                $log->particular = 'Adding new Disbursement Voucher with the following short details: DV No. - '.$model->dv_no.' Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
                $log->date_time = date('m/d/Y h:i');
                $log->user = Yii::$app->user->identity->fullname;
                $log->save(false);

                //End of Ativity Log --------------------------------

                if(($model->period != null) && ($model->period != 0))
                {
                    $advance_model = new CashAdvance();

                    $advance_model->dv_no = $model->dv_no;
                    $advance_model->date = date('Y-m-d ');
                    $date = $advance_model->date;
                    $advance_model->status = 'Unliquidated';
                    $advance_model->due_date = date('Y-m-d', strtotime($date. '+'. $model->period. 'days'));

                    $advance_model->save(false);
                }

                if($model->employee_id != null)
                {
                    $dvlog_model = new DvLog();
                    $dvlog_model->date = date('Y-m-d g:i a');
                    $dvlog_model->dv_no = $model->dv_no;
                    $dvlog_model->transaction = 'Forward DV to accounting by: ';
                    $dvlog_model->employee_id = $model->employee_id;

                    $dvlog_model->save(false);
                }

                // print_r('Successfully Saved');
                // exit();
                return $this->redirect(['index']);

            } 
            else
            {
                return $this->render('create', [
                    'model' => $model,
                    'dv_no' => $dv_no,
                ]);
            }
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to Create Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(\Yii::$app->user->can('updateDisbursementVoucher'))
        {

            if ($model->load(Yii::$app->request->post())) 
            {   
                
                if($model->status == 'Cancelled')
                {
                   $model->obligated = 'no';
                }

                if($model->cash_advance == 'no')
                {
                   //CashAdvance::delete(['dv_no' => $model->dv_no]);
                    \Yii::$app
                    ->db
                    ->createCommand()
                    ->delete('cash_advance', ['dv_no' => $model->dv_no])
                    ->execute();
                }
                
                if (\Yii::$app->user->can('processor'))
                {
                    $model->status = 'Processed';
                }

                if (\Yii::$app->user->can('Verifier'))
                {
                    $model->status = 'Verified';
                }

                $model->gross_amount = str_replace(',', '', $model->gross_amount);
                $ors = implode(',', $model->ors);
                $model->ors = $ors;

                // var_dump($model->ors);
                // exit();

                $model->save(false);

                if(($model->period != null) && ($model->period != 0))
                {
                    $advance_model = new CashAdvance();

                    $advance_model->dv_no = $model->dv_no;
                    $advance_model->date = date('Y-m-d');
                    $date = $advance_model->date;
                    $advance_model->status = 'Unliquidated';
                    $advance_model->due_date = date('Y-m-d', strtotime($date. '+'. $model->period. 'days'));

                    $advance_model->save(false);
                }

                //Start of Ativity Log --------------------------------

                $log = new ActivityLog();
                $log->particular = "Made changes on DV No. ".$model->dv_no.' with the following short details: Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
                $log->date_time = date('m/d/Y h:i');
                $log->user = Yii::$app->user->identity->fullname;
                $log->save(false);

                //End of Ativity Log --------------------------------

                if($model->employee_id != null)
                {
                    $dvlog_model = new DvLog();
                    $dvlog_model->date = date('Y-m-d g:i a');
                    $dvlog_model->dv_no = $model->dv_no;
                    $dvlog_model->transaction = 'Forward DV to accounting by: ';
                    $dvlog_model->employee_id = $model->employee_id;

                    $dvlog_model->save(false);
                }

                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
            
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to make changes in Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('deleteDisbursementVoucher'))
        {   
            $this->findModel($id)->delete();
            $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
            CashAdvance::delete(['dv_no' => $dv_no->dv_no]);

            //Start of Ativity Log --------------------------------

            $log = new ActivityLog();
            $log->particular = "Delete DV No. ".$dv_no->dv_no.' with the following short details: Gross Amount - '.$dv_no->gross_amount.', Net Amount - '.$dv_no->net_amount;
            $log->date_time = date('m/d/Y h:i');
            $log->user = Yii::$app->user->identity->fullname;
            $log->save(false);

            //End of Ativity Log --------------------------------

            return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to delete Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionMain($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) 
        {
            if(($model->action == null) || ($model->action == ''))
            {
                Yii::$app->getSession()->setFlash('warning', 'Please select action');

                return $this->render('mainForm', ['model' => $model]);
            }

            if(isset($_POST['requirements']))
            {
                $model->attachments = implode(',', $_POST['requirements']);
            }

            if(isset($_POST['requirements']) === null )
            {
                $model->attachments = '';
            }

            $model->net_amount = str_replace(',', '', $model->gross_amount) - str_replace(',', '', $model->less_amount);

            //Start of Ativity Log --------------------------------

            $log = new ActivityLog();
            $log->particular = "Open DV No. ".$model->dv_no." and ".$model->action. " Short details are: Gross Amount - ".$model->gross_amount.", Net Amount - ".$model->net_amount;
            $log->date_time = date('m/d/Y h:i');
            $log->user = Yii::$app->user->identity->fullname;
            $log->save(false);

            //End of Ativity Log --------------------------------

            for($i=0; $i<sizeof($model->ors_id); $i++)
            {
                $ors = explode('-', $model->ors_no[$i]);

                if(sizeof($ors) != 5)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Wrong ORS FormaT. Please check the ORS Number');

                    return $this->render('mainForm', [
                        'model' => $model,
                        //'ors_model' => $ors_model,
                    ]);
                }

                $ors_registry_model = OrsRegistry::find()->where(['dv_no' => $model->dv_no])->andWhere(['ors_id' => $model->ors_id[$i]])->all();

                if($ors_registry_model == null)
                {

                    $new_ors_registry_model = new OrsRegistry();

                    $new_ors_registry_model->date = date('Y-m-d');
                    $new_ors_registry_model->ors_id = $model->ors_id[$i];
                    $new_ors_registry_model->particular = $model->particular[$i];
                    $new_ors_registry_model->dv_no = $model->dv_no;
                    $new_ors_registry_model->disbursement_date = $model->date;
                    $new_ors_registry_model->fund_cluster = $model->fund_cluster;
                    $new_ors_registry_model->ors_class = $ors[0];
                    $new_ors_registry_model->funding_source = $ors[1];
                    $new_ors_registry_model->ors_year = $ors[2];
                    $new_ors_registry_model->ors_month = $ors[3];
                    $new_ors_registry_model->ors_serial = $ors[4];
                    $new_ors_registry_model->mfo_pap = $model->mfo_pap[$i];
                    $new_ors_registry_model->responsibility_center = $model->responsibility_center[$i];
                    $new_ors_registry_model->obligation = str_replace(',', '', $model->obligation[$i]);
                    $new_ors_registry_model->payable = str_replace(',', '', $model->payable[$i]);
                    $new_ors_registry_model->payment = str_replace(',', '', $model->payment[$i]);

                     $new_ors_registry_model->save(false);
                }

                if($ors_registry_model != null)
                {

                    $new_ors_registry_model = OrsRegistry::find()->where(['dv_no' => $model->dv_no])->andWhere(['ors_id' => $model->ors_id[$i]])->one();

                    $new_ors_registry_model->date = date('Y-m-d');
                    $new_ors_registry_model->ors_id = $model->ors_id[$i];
                    $new_ors_registry_model->particular = $model->particular[$i];
                    $new_ors_registry_model->dv_no = $model->dv_no;
                    $new_ors_registry_model->disbursement_date = $model->date;
                    $new_ors_registry_model->fund_cluster = $model->fund_cluster;
                    $new_ors_registry_model->ors_class = $ors[0];
                    $new_ors_registry_model->funding_source = $ors[1];
                    $new_ors_registry_model->ors_year = $ors[2];
                    $new_ors_registry_model->ors_month = $ors[3];
                    $new_ors_registry_model->ors_serial = $ors[4];
                    $new_ors_registry_model->mfo_pap = $model->mfo_pap[$i];
                    $new_ors_registry_model->responsibility_center = $model->responsibility_center[$i];
                    $new_ors_registry_model->obligation = str_replace(',', '', $model->obligation[$i]);
                    $new_ors_registry_model->payable = str_replace(',', '', $model->payable[$i]);
                    $new_ors_registry_model->payment = str_replace(',', '', $model->payment[$i]);

                     $new_ors_registry_model->save(false);
                }
            }

            //New Remarks ------------------------------------------
                $model_remarks = DvRemarks::find()
                        ->where(['dv_no' => $model->dv_no])
                        ->andWhere(['user_id' => Yii::$app->user->identity->id])
                        ->one();

                if($model_remarks == null)
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks = new DvRemarks();
                        $model_remarks->dv_no = $model->dv_no;
                        $model_remarks->remarks = $model->remarks;
                        $model_remarks->user_id = Yii::$app->user->identity->id;
                        $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                }

                else
                {
                    if(!empty($model->remarks))
                    {
                        $model_remarks->remarks = $model->remarks;
                        $model_remarks->date = date('Y-m-d g:i a');

                        $model_remarks->save(false);
                    }
                    else
                    {
                        $model_remarks->delete();
                    }
                }
            //End Remarks ------------------------------------------

             $model->status = $model->action;
             $model->save(false);

             return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('mainForm', ['model' => $model]);
    }

    public function actionCash()
    {
        $results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('advanceView', [
                'results' => $results,
            ]);
    }

    public function actionPrint($id)
    {
        $dv_no = Disbursement::find()->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no' => $dv_no->dv_no])->one();
        // var_dump($dv_no);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        $transaction7 = explode(',', $transaction->indexing);

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_FOLIO,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('view', [
                    'model' => $this->findModel($id), 
                    'transaction1'=>$transaction1, 
                    'transaction2'=>$transaction2,
                    'transaction3'=>$transaction3, 
                    'transaction4'=>$transaction4,
                    'transaction5'=>$transaction5, 
                    'transaction6'=>$transaction6,
                    'transaction7'=>$transaction7
                ]),
                'options' => [
                    'title' => 'View',
                    'filename' => $id,
                    'marginTop' => .25
                ]
            ]);

            return $pdf->render();   
    }

    public function actionReports()
    {
        //$results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('indexReport');
    }

    public function actionNca()
    {
        $ncas = Nca::find()->all();

        return $this->render('nca_list', ['ncas' => $ncas]);

    }

    public function actionCashstatus($id)
    {
        $model = $this->findModel($id);
        $nca_model = Nca::find()->where(['fiscal_year' => date('Y')])->all();
        $nca_earmarked = NcaEarmarked::find(['nca_no'])->where(['dv_no' => $model->dv_no])->all();

        if($model->load(Yii::$app->request->post())) 
        {
            if(isset($_POST['nca_id']))
            {
                $nca_id = $_POST['nca_id'];
                $x =0;
                $sum = 0;

                foreach ($nca_id as $value) 
                {
                    if(($model->payment[$value] !== 0.00) && (!empty($model->payment[$value]) && ($model->payment[$value] != '0.00')) && ($model->payment[$value] != null))
                    {
                        $x++;

                        $payment = str_replace(',', '', $model->payment[$value]);
                        $sum += (float)$payment;
                    }
                }

                if(($sum>((float)$model->net_amount)) == true)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Earmarked amount cannot be exceeded to the DV Payable Amount');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }

                if(($sum<((float)$model->net_amount)) == true)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Total Earmarked amount cannot be less that the DV Payable Amount');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }

                if($x == sizeof($nca_id))
                {
                    foreach ($nca_id as $index) 
                    {
                        $model_earmarked = NcaEarmarked::find()
                                ->where(['dv_no' => $model->dv_no])
                                ->andWhere(['nca_no' => $model->nca_no[$index]])
                                ->one();

                        if($model_earmarked == null)
                        {
                            $model_earmarked = new NcaEarmarked();

                            $model_earmarked->date = date('Y-m-d');
                            $model_earmarked->dv_no = $model->dv_no;
                            $model_earmarked->nca_no = $model->nca_no[$index];
                            $model_earmarked->funding_source = $model->funding_source[$index];
                            $model_earmarked->amount = str_replace(',', '', $model->payment[$index]);

                            $model_earmarked->save(false);
                        }
                        else
                        {
                            $model_earmarked->date = date('Y-m-d');
                            $model_earmarked->dv_no = $model->dv_no;
                            $model_earmarked->nca_no = $model->nca_no[$index];
                            $model_earmarked->funding_source = $model->funding_source[$index];
                            $model_earmarked->amount = str_replace(',', '', $model->payment[$index]);

                            $model_earmarked->save(false);
                        }
                    }
                    $model->obligated = 'Yes';
                    $model->status = 'Earmarked';
                    $model->save(false);

                    //New Remarks ------------------------------------------
                        $model_remarks = DvRemarks::find()
                                ->where(['dv_no' => $model->dv_no])
                                ->andWhere(['user_id' => Yii::$app->user->identity->id])
                                ->one();

                        if($model_remarks == null)
                        {
                            if(!empty($model->remarks))
                            {
                                $model_remarks = new DvRemarks();
                                $model_remarks->dv_no = $model->dv_no;
                                $model_remarks->remarks = $model->remarks;
                                $model_remarks->user_id = Yii::$app->user->identity->id;
                                $model_remarks->date = date('Y-m-d g:i a');

                                $model_remarks->save(false);
                            }
                        }

                        else
                        {
                            if(!empty($model->remarks))
                            {
                                $model_remarks->remarks = $model->remarks;
                                $model_remarks->date = date('Y-m-d g:i a');

                                $model_remarks->save(false);
                            }
                            else
                            {
                                $model_remarks->delete();
                            }
                        }
                    //End Remarks ------------------------------------------
                }
                else
                {
                    Yii::$app->getSession()->setFlash('warning', 'Selected NCA cannot be Zero');

                    return $this->render('cash-status/_form', [
                    'model' => $model,
                    'nca_model' => $nca_model,
                    ]);
                }   
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'Please Select NCA');

                return $this->render('cash-status/_form', [
                'model' => $model,
                'nca_model' => $nca_model,
                ]);
            }

            return $this->render('cash-status/view', [
                'model' => $model,
                'nca_model' => $nca_model,
                'nca_earmarked' => $nca_earmarked,
                ]); 
            
        }

        return $this->render('cash-status/_form', [
            'model' => $model,
            'nca_model' => $nca_model,
            ]);

    }

    public function actionDisbursements($id)
    {
        $model = $this->findModel($id);
        $disbursements = Disbursement::find()->where(['nca'=>$model->nca])->andWhere(['obligated' => 'yes'])->all();
        $model3 = Nca::find()->where(['nca_no'=>$model->nca])->one();

        return $this->render('cash-status/obligated', [
                'model' => $model,
                'model3' => $model3,
                'disbursements' => $disbursements,
                ]);
    }

    public function actionMdisbursement()
    {
        $disbursements = Disbursement::find()->all();
    }

    public function actionAda($dv_no)
    {
        $model = new Disbursement();
        $model2 = new LddapAda();
        $disbursement = AccountingEntry::find()->where(['credit_to' => 'payee'])
                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                        ->joinWith('disbursement')
                        ->all();
        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['dvs']) != null)
            {
                $dvs = $_POST['dvs'];
                $num_recs = LddapAda::find()->groupBy(['lddap_no'])->all();
                $series = strlen((string) sizeof($num_recs)) === 1 ? '00' : '0';
                $lddap_no = '101'.'-'.date('m').'-'.$series.(sizeof($num_recs)+1).'-'.date('Y');
                return $this->render('/disbursement/lddap/lddap_form', ['dvs' => $dvs, 'lddap_no' => $lddap_no, 'model2' => $model2]);
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'Please Select Disbursement Voucher (DV)');
                return $this->render('/disbursement/lddap/lddapIndex', ['disbursement' => $disbursement, 'dv_no' => $dv_no, 'model' => $model]);
            }
            
        }

        if ($model2->load(Yii::$app->request->post()))
        {
            if(LddapAda::find()->where(['lddap_no' => $model2->lddap_no])->one() === null)
            {
                for($i=0; $i<sizeof($model2->dv_no); $i++)
                {
                    $model3 = new LddapAda();

                    $model3->date = $model2->date;
                    $model3->dv_no = $model2->dv_no[$i];
                    $model3->current_account = $model2->current_account[$i];
                    $model3->uacs_code = $model2->uacs_code[$i];
                    $model3->net_amount = $model2->net_amount[$i];
                    $model3->lddap_no = $model2->lddap_no;

                    $model3->save(false);

                    //Start of Ativity Log --------------------------------

                    $log = new ActivityLog();
                    $log->particular = "Generated a LDDAP/ADA Form for DV No. ".$model3->dv_no.', LDDAP/ADA No. '.$model3->lddap_no.', with net amount of '.$model3->net_amount;
                    $log->date_time = date('m/d/Y h:i');
                    $log->user = Yii::$app->user->identity->fullname;
                    $log->save(false);

                    //End of Ativity Log --------------------------------
                }
            }

            $dvs = LddapAda::find()
                    ->where(['lddap_no' => $model2->lddap_no])
                    ->joinWith('dv')
                    ->all();


            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_FOLIO,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('/disbursement/lddap/lddap_view', ['dvs' => $dvs]),
                'options' => [
                    'title' => $model2->lddap_no,
                    'filename' => $model2->lddap_no,
                    'marginTop' => .25
                ]
            ]);
            return $pdf->render();
            
        }
        return $this->render('/disbursement/lddap/lddapIndex', ['disbursement' => $disbursement, 'dv_no' => $dv_no, 'model' => $model]);
    }

    public function actionIndexpayment($dv_no)
    {
        $name = Disbursement::find(['payee'])->where(['dv_no' => $dv_no])->one();
        $searchModel = new DisbursementSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andWhere(['payee'=>$name->payee]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Disbursement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionClusters($fund_cluster)
    {
        $countClusters = Nca::find()
            ->where(['fund_cluster'=>$fund_cluster])
            ->count();

        $clusters = Nca::find()
            ->where(['fund_cluster'=>$fund_cluster])
            ->all();

        if($countClusters>0)
        {
            foreach($clusters as $cluster)
            {
                 echo "<option value='".$cluster->nca_no."'>".$cluster->nca_no."</option>";
            }
        }
        else
            {
                echo "<option> - </option>";
            }
    }

    public function actionSources($nca_no)
    {
        $countSources  = Nca::find()
            ->where(['nca_no'=>$nca_no])
            ->count();

        $sources = Nca::find()
            ->where(['nca_no'=>$nca_no])
            ->all();

        if($countSources >0)
        {
            foreach($sources as $source)
            {
                 echo "<option value='".$source->funding_source."'>".$source->funding_source."</option>";
            }
        }
        else
            {
                echo "<option> - </option>";
            }
    }
}
?>