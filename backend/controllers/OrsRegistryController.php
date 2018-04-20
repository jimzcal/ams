<?php

namespace backend\controllers;

use Yii;
use backend\models\OrsRegistry;
use backend\models\OrsRegistrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Ors;
use backend\models\Disbursement;
use backend\models\LddapAda;
use backend\models\DisbursedDv;

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

        $model_registry = Ors::find()->where(['dv_no' => $dv_no])->all();
        $dv = Disbursement::find()->where(['dv_no' => $dv_no])->one();

        if ($model->load(Yii::$app->request->post()))
        {
            for($i=0; $i<sizeof($model->ors_no); $i++)
            {
                $ors_no = explode('-', $model->ors_no[$i]);

                $new_model_entry = new OrsRegistry();

                $new_model_entry->date = date('M. d, Y'); 
                $new_model_entry->dv_no = $dv_no;
                $new_model_entry->ors_class = $ors_no[0];
                $new_model_entry->funding_source = $ors_no[1];
                $new_model_entry->ors_year = $ors_no[2];
                $new_model_entry->ors_month = $ors_no[3];
                $new_model_entry->ors_serial = $ors_no[4];
                $new_model_entry->mfo_pap = $model->mfo_pap[$i];
                $new_model_entry->responsibility_center = $model->responsibility_center[$i];
                $new_model_entry->gross_amount = $model->gross_amount[$i];
                $new_model_entry->less_amount = number_format($model->less_amount[$i], 2);

                $new_model_entry->net_amount = $model->net_amount[$i];

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

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'model_registry' => $model_registry,
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
        $model = new OrsRegistry();
        $model_registry = OrsRegistry::find()->where(['dv_no' => $dv_no])->all();
        $dv = Disbursement::find()->where(['dv_no' => $dv_no])->one();

        if ($model->load(Yii::$app->request->post()))
        {
            // var_dump($model->id);
            // exit();

            for($i=0; $i<sizeof($model->id); $i++)
            {
                $ors_no = explode('-', $model->ors_no[$i]);

                $new_model_entry = $this->findModel($model->id[$i]);

                $new_model_entry->date = date('M. d, Y');
                $new_model_entry->dv_no = $dv_no;
                $new_model_entry->ors_class = $ors_no[0];
                $new_model_entry->funding_source = $ors_no[1];
                $new_model_entry->ors_year = $ors_no[2];
                $new_model_entry->ors_month = $ors_no[3];
                $new_model_entry->ors_serial = $ors_no[4];
                $new_model_entry->mfo_pap = $model->mfo_pap[$i];
                $new_model_entry->responsibility_center = $model->responsibility_center[$i];
                $new_model_entry->gross_amount = $model->gross_amount[$i];
                $new_model_entry->less_amount = number_format($model->less_amount[$i], 2);
                $new_model_entry->net_amount = $model->net_amount[$i];

                $new_model_entry->save(false);
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'model_registry' => $model_registry,
            'dv' => $dv,
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
