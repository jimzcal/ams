<?php

namespace backend\controllers;

use Yii;
use backend\models\Far101;
use backend\models\Far101Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'new'],
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

            //  $pdf = new Pdf([
            //     'mode' => Pdf::MODE_CORE, // leaner size using standard fonts
            //     'format' => Pdf::FORMAT_FOLIO,
            //     'orientation' => Pdf::ORIENT_LANDSCAPE,
            //     'destination' => Pdf::DEST_BROWSER,
            //     'content' => $this->renderPartial('\view', ['model' => $model, 'far' => $far]),
            //     'options' => [
            //         'title' => 'Far-101',
            //         'filename' => 'Far-101 ',
            //         'marginTop' => .25
            //     ]
            // ]);

            // return $pdf->render();
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

    public function actionPrint($id)
    {
        $model = $this->findModel($id);

        $far = Far101::find()->where(['fund_cluster' => $model->fund_cluster])
            ->andWhere(['fiscal_year' => $model->fiscal_year])
            ->andWhere(['parent_id' => 0])
            ->all();        

         $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'format' => Pdf::FORMAT_FOLIO,
                'orientation' => Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('/far101/pdf', ['model' => $model, 'far' => $far]),
                'options' => [
                    'title' => 'Far-101',
                    'filename' => 'Far-101',
                    'marginTop' => .25
                ]
            ]);

         return $pdf->render();
        //  return $this->render('view', [
        //     'model' => $model,
        //     'far' => $far,
        // ]);
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

        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['id']))
            {
                $id = $_POST['id'];
                $particulars = $_POST['particulars'];
                $uacs_code = $_POST['uacs_code'];
                $disbursement_q_1 = $_POST['disbursement_q_1'];
                $disbursement_q_2 = $_POST['disbursement_q_2'];
                $disbursement_q_3 = $_POST['disbursement_q_3'];
                $disbursement_q_4 = $_POST['disbursement_q_4'];
                $total_disbursement = $_POST['total_disbursement'];

                for($i=0; $i<sizeof($id); $i++)
                {
                    $model1 = Far101::find()->where(['id' => $id[$i]])->one();

                    $model1->fiscal_year = $model->fiscal_year;
                    $model1->date_updated = date('M. d, Y');
                    $model1->fund_cluster = $model->fund_cluster;
                    $model1->particulars = $particulars[$i];
                    $model1->uacs_code = $uacs_code[$i];
                    $model1->disbursement_q_1 = $disbursement_q_1[$i];
                    $model1->disbursement_q_2 = $disbursement_q_2[$i];
                    $model1->disbursement_q_3 = $disbursement_q_3[$i];
                    $model1->disbursement_q_4 = $disbursement_q_4[$i];
                    $model1->total_disbursement = $total_disbursement[$i];

                    $model1->save(false);
                }
            }

            if(isset($_POST['idb']))
            {
                $idb = $_POST['idb'];
                $particularsb = $_POST['particularsb'];
                $uacs_codeb = $_POST['uacs_codeb'];
                $disbursement_q_1b = $_POST['disbursement_q_1b'];
                $disbursement_q_2b = $_POST['disbursement_q_2b'];
                $disbursement_q_3b = $_POST['disbursement_q_3b'];
                $disbursement_q_4b = $_POST['disbursement_q_4b'];
                $total_disbursementb = $_POST['total_disbursementb'];

                for($i=0; $i<sizeof($idb); $i++)
                {
                    $model2 = Far101::find()->where(['id' => $idb[$i]])->one();

                    $model2->fiscal_year = $model->fiscal_year;
                    $model2->date_updated = date('M. d, Y');
                    $model2->fund_cluster = $model->fund_cluster;
                    $model2->particulars = $particularsb[$i];
                    $model2->uacs_code = $uacs_codeb[$i];
                    $model2->disbursement_q_1 = $disbursement_q_1b[$i];
                    $model2->disbursement_q_2 = $disbursement_q_2b[$i];
                    $model2->disbursement_q_3 = $disbursement_q_3b[$i];
                    $model2->disbursement_q_4 = $disbursement_q_4b[$i];
                    $model2->total_disbursement = $total_disbursementb[$i];

                    $model2->save(false);
                }
            }

            if(isset($_POST['idc']))
            {
                $idc = $_POST['idc'];
                $particularsc = $_POST['particularsc'];
                $uacs_codec = $_POST['uacs_codec'];
                $disbursement_q_1c = $_POST['disbursement_q_1c'];
                $disbursement_q_2c = $_POST['disbursement_q_2c'];
                $disbursement_q_3c = $_POST['disbursement_q_3c'];
                $disbursement_q_4c = $_POST['disbursement_q_4c'];
                $total_disbursementc = $_POST['total_disbursementc'];

                for($i=0; $i<sizeof($idc); $i++)
                {
                    $model3 = Far101::find()->where(['id' => $idc[$i]])->one();

                    $model3->fiscal_year = $model->fiscal_year;
                    $model3->date_updated = date('M. d, Y');
                    $model3->fund_cluster = $model->fund_cluster;
                    $model3->particulars = $particularsc[$i];
                    $model3->uacs_code = $uacs_codec[$i];
                    $model3->disbursement_q_1 = $disbursement_q_1c[$i];
                    $model3->disbursement_q_2 = $disbursement_q_2c[$i];
                    $model3->disbursement_q_3 = $disbursement_q_3c[$i];
                    $model3->disbursement_q_4 = $disbursement_q_4c[$i];
                    $model3->total_disbursement = $total_disbursementc[$i];

                    $model3->save(false);
                }
            }

            if(isset($_POST['idd']))
            {
                $idd = $_POST['idd'];
                $particularsd = $_POST['particularsd'];
                $uacs_coded = $_POST['uacs_coded'];
                $disbursement_q_1d = $_POST['disbursement_q_1d'];
                $disbursement_q_2d = $_POST['disbursement_q_2d'];
                $disbursement_q_3d = $_POST['disbursement_q_3d'];
                $disbursement_q_4d = $_POST['disbursement_q_4d'];
                $total_disbursementd = $_POST['total_disbursementd'];

                for($i=0; $i<sizeof($idd); $i++)
                {
                    $model4 = Far101::find()->where(['id' => $idd[$i]])->one();

                    $model4->fiscal_year = $model->fiscal_year;
                    $model4->date_updated = date('M. d, Y');
                    $model4->fund_cluster = $model->fund_cluster;
                    $model4->particulars = $particularsd[$i];
                    $model4->uacs_code = $uacs_coded[$i];
                    $model4->disbursement_q_1 = $disbursement_q_1d[$i];
                    $model4->disbursement_q_2 = $disbursement_q_2d[$i];
                    $model4->disbursement_q_3 = $disbursement_q_3d[$i];
                    $model4->disbursement_q_4 = $disbursement_q_4d[$i];
                    $model4->total_disbursement = $total_disbursementd[$i];

                    $model4->save(false);
                }
            }

            if(isset($_POST['ide']))
            {
                $ide = $_POST['ide'];
                $particularse = $_POST['particularse'];
                $uacs_codee = $_POST['uacs_codee'];
                $disbursement_q_1e = $_POST['disbursement_q_1e'];
                $disbursement_q_2e = $_POST['disbursement_q_2e'];
                $disbursement_q_3e = $_POST['disbursement_q_3e'];
                $disbursement_q_4e = $_POST['disbursement_q_4e'];
                $total_disbursemente = $_POST['total_disbursemente'];

                for($i=0; $i<sizeof($ide); $i++)
                {
                    $model5 = Far101::find()->where(['id' => $ide[$i]])->one();

                    $model5->fiscal_year = $model->fiscal_year;
                    $model5->date_updated = date('M. d, Y');
                    $model5->fund_cluster = $model->fund_cluster;
                    $model5->particulars = $particularse[$i];
                    $model5->uacs_code = $uacs_codee[$i];
                    $model5->disbursement_q_1 = $disbursement_q_1e[$i];
                    $model5->disbursement_q_2 = $disbursement_q_2e[$i];
                    $model5->disbursement_q_3 = $disbursement_q_3e[$i];
                    $model5->disbursement_q_4 = $disbursement_q_4e[$i];
                    $model5->total_disbursement = $total_disbursemente[$i];

                    $model5->save(false);
                }
            }

            // var_dump($particulars);
            // var_dump($id);
            // var_dump($idb);
            // var_dump($idc);
            // var_dump($idd);
            // var_dump($ide);
            // exit();

            return $this->redirect(['view', 'id' => $model->id]);
         }

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
        $model = Far101::find()->where(['id' => $id])->one();

        Far101::deleteAll(['fund_cluster' => $model->fund_cluster, 'fiscal_year' => $model->fiscal_year]);
        //$this->findModel($id)->delete();

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
