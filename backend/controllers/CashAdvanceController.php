<?php

namespace backend\controllers;

use Yii;
use backend\models\CashAdvance;
use backend\models\CashAdvanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use backend\models\LddapAda;

/**
 * CashAdvanceController implements the CRUD actions for CashAdvance model.
 */
class CashAdvanceController extends Controller
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
     * Lists all CashAdvance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CashAdvanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // if(isset($_GET['status']))
        // {

        // }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CashAdvance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('notice', [
            'model' => $this->findModel($id),
        ]);

        // $pdf = new Pdf([
        //         'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
        //         'format' => Pdf::FORMAT_FOLIO,
        //         'destination' => Pdf::DEST_BROWSER,
        //         'content' => $this->renderPartial('/cash-advance/view', ['model' => $this->findModel($id)]),
        //         'options' => [
        //             'title' => $id,
        //             'filename' => $id,
        //             'marginTop' => .25
        //         ]
        //     ]);
        //     return $pdf->render();
    }

    /**
     * Creates a new CashAdvance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CashAdvance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CashAdvance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CashAdvance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionNotice($id)
    {
        $model = $this->findModel($id);

            $pdf = new Pdf([
                'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
                'format' => Pdf::FORMAT_LETTER,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('/cash-advance/notice', ['model' => $model]),
                'options' => [
                    'title' => 'LDDAP-ADA - ',
                    'filename' => 'LDDAP-ADA - ',
                    'marginTop' => .25
                ]
            ]);
            return $pdf->render();

        // return $this->render('notice', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Finds the CashAdvance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CashAdvance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CashAdvance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
