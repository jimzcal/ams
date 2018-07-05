<?php

namespace backend\controllers;

use Yii;
use backend\models\Mdp;
use backend\models\MdpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
/**
 * MdpController implements the CRUD actions for Mdp model.
 */
class MdpController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Mdp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MdpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new Mdp();

        if ($model->load(Yii::$app->request->post())) 
        {
            if($model->getValidating($model->fiscal_year, $model->version) == null)
            {
                $uploadFile = UploadedFile::getInstance($model, 'file');
                $name_extension = date('Y-m-d');
                $uploadFile->saveAs('mdp/'.$name_extension.'-'.$uploadFile);
                $no_row = 0;

                $file_name = $name_extension.'-'.$uploadFile;
                $reader = ReaderFactory::create(Type::XLSX); // for XLSX files
                //$reader = ReaderFactory::create(Type::CSV); // for CSV files
                //$reader = ReaderFactory::create(Type::ODS); // for ODS files

                $reader->open('mdp/'.$file_name);

                foreach ($reader->getSheetIterator() as $sheet) 
                {
                    foreach ($sheet->getRowIterator() as $row) 
                    {
                        if($no_row > 12)
                        {
                           $mdp_model = new Mdp();

                           $mdp_model->fiscal_year = $model->fiscal_year;
                           $mdp_model->version = $model->version;
                           $mdp_model->particulars = $row[0] == null ? 0.00 : $row[0];
                           $mdp_model->uacs_code = $row[1] == null ? 0.00 : $row[1];
                           $mdp_model->parent_uacs = $row[2] == null ? 0.00 : $row[2];
                           $mdp_model->total_program = $row[3] == null ? 0.00 : $row[3];
                           $mdp_model->tra = $row[4] == null ? 0.00 : $row[4];
                           $mdp_model->net_program = $row[5] == null ? 0.00 : $row[5];
                           $mdp_model->january = $row[6] == null ? 0.00 : $row[6];
                           $mdp_model->february = $row[7] == null ? 0.00 : $row[7];
                           $mdp_model->march = $row[8] == null ? 0.00 : $row[8];
                           $mdp_model->first_total = $row[9] == null ? 0.00 : $row[9];
                           $mdp_model->april = $row[10] == null ? 0.00 : $row[10];
                           $mdp_model->may = $row[11] == null ? 0.00 : $row[11];
                           $mdp_model->june = $row[12] == null ? 0.00 : $row[12];
                           $mdp_model->second_total = $row[13] == null ? 0.00 : $row[13];
                           $mdp_model->july = $row[14] == null ? 0.00 : $row[14];
                           $mdp_model->august = $row[15] == null ? 0.00 : $row[15];
                           $mdp_model->september = $row[16] == null ? 0.00 : $row[16];
                           $mdp_model->third_total = $row[17] == null ? 0.00 : $row[17];
                           $mdp_model->october = $row[18] == null ? 0.00 : $row[18];
                           $mdp_model->november = $row[19] == null ? 0.00 : $row[19];
                           $mdp_model->december = $row[20] == null ? 0.00 : $row[20];
                           $mdp_model->forth_total = $row[21] == null ? 0.00 : $row[21];
                           $mdp_model->full_year_total = $row[22] == null ? 0.00 : $row[22];

                           $mdp_model->save(false);
                        }

                        $no_row++;
                    }
                }

                $reader->close();

                return $this->redirect(['view', 'fiscal_year' => $model->fiscal_year, 'version'=> $model->version]);
            
            }

            else
            {
                Yii::$app->getSession()->setFlash('warning', 'MDP File is already existing. To change it, delete first the current MDP and upload the latest MDP file.');

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
     * Displays a single Mdp model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fiscal_year, $version)
    {
        
        $model = Mdp::find()->where(['fiscal_year' => $fiscal_year])
                    ->andWhere(['version' => $version])
                    ->andWhere(['parent_uacs' => '0'])
                    ->all();

        return $this->render('view', [
            'model' => $model,
            'fiscal_year' => $fiscal_year,
        ]);
    }

    /**
     * Creates a new Mdp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mdp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mdp model.
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
     * Deletes an existing Mdp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = Mdp::find()->where(['id' => $id])->one();

        Mdp::deleteAll(['fiscal_year' => $model->fiscal_year, 'version' => $model->version]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mdp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mdp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mdp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
