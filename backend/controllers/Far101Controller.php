<?php

namespace backend\controllers;

use Yii;
use backend\models\Far101;
use backend\models\Far101Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

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

        $model = new Far101();

        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->getValidating($model->fiscal_year, $model->fund_cluster) == null)
            {
                $uploadFile = UploadedFile::getInstance($model, 'file');
                $name_extension = 'Far 1 -'.date('Y-m-d');
                $uploadFile->saveAs('far/'.$name_extension.'-'.$uploadFile);
                $no_row = 0;

                $file_name = $name_extension.'-'.$uploadFile;
                $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
                //$reader = ReaderFactory::create(Type::CSV); // for CSV files
                //$reader = ReaderFactory::create(Type::ODS); // for ODS files

                $reader->open('far/'.$file_name);

                foreach ($reader->getSheetIterator() as $sheet) 
                {
                    foreach ($sheet->getRowIterator() as $row) 
                    {
                        if($no_row > 11)
                        {
                           $far_model = new Far101();

                           $far_model->fiscal_year = $model->fiscal_year;
                           $far_model->date_updated = date('Y-m-d');
                           $far_model->fund_cluster = $model->fund_cluster;
                           $far_model->particulars = $row[0] == null ? '' : $row[0];
                           $far_model->uacs_code = $row[1] == null ? '' : $row[1];
                           $far_model->parent_uacs = $row[2] == null ? 0.00 : $row[2];
                           // $far_model->authorized_appropriation = $row[3] == null ? 0.00 : $row[3];
                           // $far_model->adjustment_appropriation = $row[4] == null ? 0.00 : $row[4];
                           // $far_model->adjusted_appropriation = $row[5] == null ? 0.00 : $row[5];
                           // $far_model->allotment_received = $row[6] == null ? 0.00 : $row[6];
                           // $far_model->allotment_adjustment = $row[7] == null ? 0.00 : $row[7];
                           // $far_model->transfer_to = $row[8] == null ? 0.00 : $row[8];
                           // $far_model->transfer_from = $row[9] == null ? 0.00 : $row[9];
                           // $far_model->obligation_q_1 = $row[10] == null ? 0.00 : $row[10];
                           // $far_model->obligation_q_2 = $row[11] == null ? 0.00 : $row[11];
                           // $far_model->obligation_q_3 = $row[12] == null ? 0.00 : $row[12];
                           // $far_model->obligation_q_4 = $row[13] == null ? 0.00 : $row[13];
                           // $far_model->total_obligation = $row[14] == null ? 0.00 : $row[14];
                           // $far_model->disbursement_q_1 = $row[15] == null ? 0.00 : $row[15];
                           // $far_model->disbursement_q_2 = $row[16] == null ? 0.00 : $row[16];
                           // $far_model->disbursement_q_3 = $row[17] == null ? 0.00 : $row[17];
                           // $far_model->disbursement_q_4 = $row[18] == null ? 0.00 : $row[18];
                           // $far_model->total_disbursement = $row[19] == null ? 0.00 : $row[19];
                           // $far_model->unreleased_balance = $row[20] == null ? 0.00 : $row[20];
                           // $far_model->unobligated_balance = $row[21] == null ? 0.00 : $row[21];
                           // $far_model->due_unpaid = $row[22] == null ? 0.00 : $row[22];
                           // $far_model->not_yet_due = $row[23] == null ? 0.00 : $row[23];

                           if(!empty($far_model->particulars) && !empty($far_model->uacs_code))
                           {
                             $far_model->save(false);
                           }
                          
                        }

                        $no_row++;
                    }
                }

                $reader->close();

                //return $this->redirect(['view', 'fiscal_year' => $model->fiscal_year, 'version'=> $model->version]);
            
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'FAR Template is already existing. To change it, delete first the current FAR and upload the latest FAR file.');

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
                ]);
            }
            
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
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
            ->andWhere(['parent_uacs' => 0])
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
            ->andWhere(['parent_uacs' => 0])
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
            ->andWhere(['parent_uacs' => 0])
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
            ->andWhere(['parent_uacs' => 0])
            ->all();

        // $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()))
        {   
            for($i=0; $i<sizeof($model->id); $i++) 
            {
                // if($model->id[$id] != null)
                // {
                    $far_model = Far101::find()->where(['id' => $model->id[$i]])->one();

                    $far_model->date_updated = date('Y-m-d');
                    $far_model->fiscal_year = $model->fiscal_year;
                    $far_model->fund_cluster = $model->fund_cluster;
                    $far_model->uacs_code = $model->uacs_code[$i];
                    $far_model->particulars = $model->particulars[$i];
                    $far_model->disbursement_q_1 = $model->disbursement_q_1[$i];
                    $far_model->disbursement_q_2 = $model->disbursement_q_2[$i];
                    $far_model->disbursement_q_3 = $model->disbursement_q_3[$i];
                    $far_model->disbursement_q_4 = $model->disbursement_q_4[$i];
                    $far_model->total_disbursement = $model->total_disbursement[$i];

                    $far_model->save(false);
                //}
            }

            return $this->redirect(['view', 'id' => $model->id[0]]);
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
