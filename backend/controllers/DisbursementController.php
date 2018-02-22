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
                'only' => ['index', 'view', 'create', 'update', 'delete', 'processor'],
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
        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();
        // var_dump($transaction->receiving);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        return $this->render('view', [
            'model' => $this->findModel($id), 
            'transaction1'=>$transaction1, 
            'transaction2'=>$transaction2,
            'transaction3'=>$transaction3, 
            'transaction4'=>$transaction4,
            'transaction5'=>$transaction5, 
            'transaction6'=>$transaction6,
        ]);
    }

    public function actionProcessor($id)
    {
        $model = $this->findModel($id);
        $model2 = new AccountingEntry();

        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();

        $entries = AccountingEntry::find()->where(['dv_no'=>$dv_no])->all();
        
        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['requirements']))
            {
                $model->attachments = implode(',', $_POST['requirements']);
            }

            if(isset($_POST['requirements']) === null )
            {
                $model->attachments = '';
            }

            $model->net_amount = (AccountingEntry::find()->where(['vat' => 1])->andWhere(['dv_no' => $model->dv_no])->one() === null ? ($model->gross_amount - $model->less_amount) : ($model->gross_amount/1.12) - $model->less_amount);
            $model->save();
            Yii::$app->db->createCommand()->update('disbursement', ['attachments' => $model->attachments], ['dv_no' => $dv_no])->execute();

            Yii::$app->getSession()->setFlash('success', 'Successfully Saved');
            return $this->render('viewPr', [
                'model' => $this->findModel($id),
                'entries' => $entries,
                'model2' => $model2,
            ]);
            
        }

        return $this->render('viewP', [
            'model' => $model,
            'entries' => $entries,
            'model2' => $model2,
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

            if ($model->load(Yii::$app->request->post())) {

                $model->dv_no = $dv_no;
                $model->save(false);

                $model3 = new TransactionStatus();
                $model3->dv_no = $model->dv_no;
                $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                $model3->receiving = $detail;
                $model3->save(false);

                return $this->redirect(['view', 'id' => $model->id]);

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
                
                if($model->status === 'Cancelled')
                {
                   $model->obligated = 'no';
                }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
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
            return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to delete Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionCash()
    {
        $results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('advanceView', [
                'results' => $results,
            ]);
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
        $disbursements = Disbursement::find()->where(['nca'=>$model->nca])->andWhere(['obligated' => 'yes'])->all();
        $checker = Disbursement::find()->where(['id'=>$id])->andWhere(['obligated' => 'yes'])->one();
        $model3 = Nca::find()->where(['nca_no'=>$model->nca])->one();

        if ($model->load(Yii::$app->request->post()))
        {
           if($model->status === 'Cancelled')
           {
                Yii::$app->getSession()->setFlash('warning', 'Oops!, This DV No. '.$model2->dv_no.' has been cancelled. Therefore, it cannot be saved.');
                return $this->render('cash-status/_form', [
                    'model' => $model,
                    'model3' => $model3,
                    ]);
           }
           else
           {
                $model->obligated = 'yes';
                $model->save(false);

                $checker2 = DisbursedDv::find()->where(['dv_no' => $model->dv_no])->one();

                if($checker2 === null)
                {
                    $model2 = new DisbursedDv();

                    $model2->dv_no = $model->dv_no;
                    $model2->date_paid = $model->date_paid;
                    $model2->lddap_check_no = $model->lddap_check_no;
                    $model2->save(false);
                }

                else
                {
                    $model2 = DisbursedDv::find()->where(['dv_no' => $model->dv_no])->one();
                    $model2->dv_no = $model->dv_no;
                    $model2->date_paid = $model->date_paid;
                    $model2->lddap_check_no = $model->lddap_check_no;
                    $model2->save(false);
                }


                Yii::$app->getSession()->setFlash('success', 'Successfully Saved');
                // Yii::$app->db->createCommand()->update('disbursement', ['remarks' => $model->remarks, 'status' => $model->status, 'obligated' => 'yes'], ['dv_no' => $model->dv_no])->execute();
                return $this->render('cash-status/_form', [
                'model' => $model,
                'model3' => $model3,
                'disbursements' => $disbursements,
                ]);
           }
        }

        if($checker !== null)
        {
            Yii::$app->getSession()->setFlash('warning', 'Reminder, this Disbursement Voucher has already been obligated');
        }
        return $this->render('cash-status/_form', [
        'model' => $model,
        'model3' => $model3,
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
                        ->joinWith('disbursement')
                        ->all();
        if ($model->load(Yii::$app->request->post()))
        {
            $dvs = $_POST['dvs'];
            $num_recs = LddapAda::find()->groupBy(['lddap_no'])->all();
            $series = strlen((string) sizeof($num_recs)) === 1 ? '00' : '0';
            $lddap_no = '101'.'-'.date('m').'-'.$series.(sizeof($num_recs)+1).'-'.date('Y');
            return $this->render('/disbursement/lddap/lddap_form', ['dvs' => $dvs, 'lddap_no' => $lddap_no,'model2' => $model2]);
        }

        if ($model2->load(Yii::$app->request->post()))
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
            }

            //Yii::$app->getSession()->setFlash('success', 'Successfully Saved!');
            $dvs = LddapAda::find()
                    ->where(['lddap_no' => $model2->lddap_no])
                    ->joinWith('dv')
                    ->all();
            //return $this->render('/disbursement/lddap/lddap_view', ['dvs' => $dvs]);

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

    protected function findModel($id)
    {
        if (($model = Disbursement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
