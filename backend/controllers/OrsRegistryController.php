<?php

namespace backend\controllers;

use Yii;
use backend\models\OrsRegistry;
use backend\models\OrsRegistrySearch;
use backend\models\ActivityLog;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Ors;
use backend\models\Disbursement;
use backend\models\LddapAda;
use backend\models\DisbursedDv;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use backend\models\DvRemarks;

/**
 * OrsRegistryController implements the CRUD actions for OrsRegistry model.
 */
class OrsRegistryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all OrsRegistry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrsRegistrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrsRegistry model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new OrsRegistry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($dv_no)
    {
        // var_dump('hey I have reached ors_controller_create');
        // exit();
        $model = new OrsRegistry();

        // $model_registry = Ors::find()->where(['dv_no' => $dv_no])->all();
        $dv = Disbursement::find()->where(['dv_no' => $dv_no])->one();

        $ors_ids = explode(',', $dv->ors);

        if ($model->load(Yii::$app->request->post()))
        {
            for($i=0; $i<sizeof($model->ors_id); $i++)
            {
                $ors_no = explode('-', $model->ors_no[$i]);

                $new_model_entry = new OrsRegistry();

                $new_model_entry->date = date('M. d, Y'); 
                $new_model_entry->dv_no = $dv_no;
                $new_model_entry->disbursement_date = $dv->date;
                $new_model_entry->particular = $model->particular[$i];
                $new_model_entry->fund_cluster = $dv->fund_cluster;
                $new_model_entry->ors_class = $ors_no[0];
                $new_model_entry->funding_source = $ors_no[1];
                $new_model_entry->ors_year = $ors_no[2];
                $new_model_entry->ors_month = $ors_no[3];
                $new_model_entry->ors_serial = $ors_no[4];
                $new_model_entry->mfo_pap = $model->mfo_pap[$i];
                $new_model_entry->ors_id = $model->ors_id[$i];
                $new_model_entry->responsibility_center = $model->responsibility_center[$i];
                $new_model_entry->obligation = str_replace(',', '', $model->obligation[$i]);
                $new_model_entry->payable = str_replace(',', '', $model->payable[$i]);
                $new_model_entry->payment = str_replace(',', '', $model->payment[$i]);

                $new_model_entry->save(false);
            }

            //============== Upadte Status of disbursement to Paid =============

            $model_dv = Disbursement::find()->where(['id' => $dv->id])->one();
            $model_dv->status = 'Paid';
            $model_dv->save(false);

            $model2 = new DisbursedDv();

            $model2->dv_no = $dv_no;
            $model2->date_paid = $model->date_paid;
            $model2->lddap_check_no = $model->lddap_check_no;
            $model2->save(false);

            //==================================================================

            return $this->redirect(['/ors/views', 'dv_no' => $dv_no]);
        }

        return $this->render('create', [
            'model' => $model,
            'ors_ids' => $ors_ids,
            'dv' => $dv,
        ]);
    }

    /**
     * Updates an existing OrsRegistry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($dv_no)
    {
        // $model = $this->findModel($id);
        //$model = new OrsRegistry();
        // $model_registry = OrsRegistry::find()->where(['dv_no' => $dv_no])->all();
        $model = Disbursement::find()->where(['dv_no' => $dv_no])->one();

       // $model_registry = explode(',', $dv->ors);

        if ($model->load(Yii::$app->request->post()))
        {
            for($i=0; $i<sizeof($model->ors_id); $i++)
            {
                $ors = explode('-', $model->ors_no[$i]);

                if(sizeof($ors) != 5)
                {
                    Yii::$app->getSession()->setFlash('warning', 'Wrong ORS FormaT. Please check the ORS Number');

                    return $this->render('update', [
                        'model' => $model,
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

                    $new_ors_registry_model->date = $model->date_registry[$i];
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

            $model->status = 'Paid';
            $model->save(false);

            //Start of Ativity Log --------------------------------

            $log = new ActivityLog();
            $log->particular = "Add Obligation Entry for disbursement of ".$model->dv_no.' with the following short details: Gross Amount - '.$model->gross_amount.', Net Amount - '.$model->net_amount;
            $log->date_time = date('m/d/Y h:i');
            $log->user = Yii::$app->user->identity->fullname;
            $log->save(false);

            //End of Ativity Log --------------------------------

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            // 'model_registry' => $model_registry,
            // 'dv' => $dv,
        ]);
    }

    /**
     * Deletes an existing OrsRegistry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDisbursementyear()
    {
        //$data = Disbursement::find()->all();

        return $this->render('disbursement-year');
    }

    public function actionMdisbursement($year)
    {
        $data = OrsRegistry::find()->where(['like', 'date', $year])->all();

        return $this->render('monthly-disbursement-01', [
            'data' => $data,
            'year' => $year,
        ]);
    }

    public function actionPrint($year)
    {
        //$data = OrsRegistry::find()->where(['like', 'date', $year])->all();

        // return $this->render('monthly-disbursement', [
        //     //'data' => $data,
        //     'year' => $year,
        // ]);
        $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_LETTER,
                'orientation' => Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('/ors-registry/monthly-disbursement-01', ['year' => $year]),
                'options' => [
                    'title' => 'Month Disbursement - ',
                    'filename' => 'Monthly Disbursement - ',
                    'marginTop' => .25
                ]
            ]);
        
        return $pdf->render();
    }

    /**
     * Finds the OrsRegistry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrsRegistry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrsRegistry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
