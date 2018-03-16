<?php

namespace backend\controllers;

use Yii;
use backend\models\CashStatus;
use backend\models\CashStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Disbursement;
use backend\models\TransactionStatus;
use backend\models\Nca;

/**
 * CashStatusController implements the CRUD actions for CashStatus model.
 */
class CashStatusController extends Controller
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
     * Lists all CashStatus models.
     * @return mixed
     */
    public function actionIndex($nca_no)
    {
        $searchModel = new CashStatusSearch();
        $dataProvider = $searchModel->search(empty(Yii::$app->request->queryParams) ? $nca_no : Yii::$app->request->queryParams);

        $nca = Nca::find()->where(['nca_no' => $nca_no])->one();
        $disbursements = Disbursement::find()->where(['nca' => $nca_no])->andWhere(['obligated' => 'yes'])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'nca' => $nca,
            'disbursements' => $disbursements,
        ]);
    }

    public function actionIndex2()
    {
        $ncas = Nca::find()->all();

        //$ncas->groupBy(['nca_no']);

        return $this->render('index2', [
            'ncas' => $ncas,
        ]);
    }

    /**
     * Displays a single CashStatus model.
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
     * Creates a new CashStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model2 = Disbursement::find(['id'])->where(['id'=>$id])->one();
        $model3 = Nca::find()->where(['nca_no'=>$model2->nca])->one();
        $check_record = CashStatus::find(['dv_no'])->where(['dv_no' => $model2->dv_no])->one();

        if($check_record === null)
        {
            $model = new CashStatus();
            if ($model->load(Yii::$app->request->post()))
            {
               if($model->status === 'Cancelled')
               {
                    Yii::$app->getSession()->setFlash('warning', 'Oops!, This DV No. '.$model2->dv_no.' has been cancelled. Therefore, it cannot be saved.');
                    return $this->render('create', [
                        'model' => $model,
                        'model2' => $model2,
                        'model3' => $model3,
                        ]);
               }
               else
               {
                    $model->save();
                    Yii::$app->db->createCommand()->update('disbursement', ['remarks' => $model->remarks, 'status' => $model->status], ['dv_no' => $model->dv_no])->execute();
                    return $this->redirect(['index', 'nca_no' => $model->nca_no]);
               }
            }

            return $this->render('create', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            ]);
        }

        if($check_record !== null)
        {
            $model = $this->findModel($check_record->id);
            if ($model->load(Yii::$app->request->post()))
            {
                if($model->status === 'Cancelled')
                {
                    $this->findModel($model->id)->delete();
                    Yii::$app->getSession()->setFlash('success', 'Reminder, This DV No. '.$model2->dv_no.' has already been cancelled and thus omitted from this record');
                    return $this->redirect(['index' , 'nca_no' => $model->nca_no]);
                }
                // else
                {
                    $model->save();
                    Yii::$app->db->createCommand()->update('disbursement', ['remarks' => $model->remarks, 'status' => $model->status], ['dv_no' => $model->dv_no])->execute();
                    return $this->redirect(['index' , 'nca_no' => $model->nca_no]);
                }
            }

             Yii::$app->getSession()->setFlash('success', 'Reminder, This DV No. '.$model2->dv_no.' has already been saved');
             //return $this->redirect(['index' , 'nca_no' => $model->nca_no]);
             return $this->render('update', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            ]);
        }
    }

    /**
     * Updates an existing CashStatus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CashStatus model.
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
     * Finds the CashStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CashStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CashStatus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
