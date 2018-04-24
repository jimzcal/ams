<?php

namespace backend\controllers;

use Yii;
use backend\models\Far101;
use backend\models\Far101Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Far101Controller implements the CRUD actions for Far101 model.
 */
class Far101Controller extends Controller
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
     * Lists all Far101 models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Far101Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Far101 model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $model = $this->findModel($id);

        $far = Far101::find()->where(['fund_cluster' => $model->fund_cluster])
            ->andWhere(['fiscal_year' => $model->fiscal_year])
            ->andWhere(['parent_id' => 0])
            ->all();        

        return $this->render('view', [
            'model' => $model,
            'far' => $far,
        ]);
    }

    /**
     * Creates a new Far101 model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($fund_cluster, $fiscal_year)
    {
        $model = new Far101();

        $far = Far101::find()->where(['fund_cluster' => $fund_cluster])
            ->andWhere(['fiscal_year' => $fiscal_year])
            ->andWhere(['parent_id' => 0])
            ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) 
        {
            // var_dump(expression)
            return $this->render('create', [
                'model' => $model,
                'fiscal_year' => $fiscal_year,
                'fund_cluster' => $fund_cluster,
                'far' => $far,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
            'fiscal_year' => $fiscal_year,
            'fund_cluster' => $fund_cluster,
            'far' => $far,
        ]);
    }

    public function actionNew()
    {
        $model = new Far101();

        if ($model->load(Yii::$app->request->post()))
        {
            
            return $this->redirect(['create', 'fund_cluster' => $model->fund_cluster, 'fiscal_year' => $model->fiscal_year]);
        }

        return $this->render('new-far', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Far101 model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $far = Far101::find()->where(['fund_cluster' => $model->fund_cluster])
            ->andWhere(['fiscal_year' => $model->fiscal_year])
            ->andWhere(['parent_id' => 0])
            ->all();

        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        return $this->render('update', [
            'model' => $model,
            'far' => $far,
            'fund_cluster' => $model->fund_cluster,
            'fiscal_year' => $model->fiscal_year,
        ]);
    }

    /**
     * Deletes an existing Far101 model.
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
     * Finds the Far101 model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Far101 the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Far101::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
