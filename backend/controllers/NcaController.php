<?php

namespace backend\controllers;

use Yii;
use backend\models\Nca;
use backend\models\NcaEarmarked;
use backend\models\NcaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\FundingSource;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;


/**
 * NcaController implements the CRUD actions for Nca model.
 */
class NcaController extends Controller
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
     * Lists all Nca models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NcaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        $searchModel = new NcaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCashStatus($nca_no, $funding_source)
    {
        $nca_model = Nca::find()->where(['nca_no' => $nca_no, 'funding_source' => $funding_source])->one();
        $dataProvider = NcaEarmarked::find()->where(['nca_no' => $nca_no, 'funding_source' => $funding_source])->all();

        return $this->render('cash-status', [
            'dataProvider' => $dataProvider,
            'nca_model' => $nca_model
        ]);
    }

    /**
     * Displays a single Nca model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $nca_no = Nca::find(['nca_no'])->where(['id' => $id])->one();
        $nca = Nca::find(['nca_no'])->where(['nca_no' => $nca_no->nca_no])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'nca' => $nca,
        ]);
    }

    /**
     * Creates a new Nca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nca();
        $data = FundingSource::find()->all();

        if ($model->load(Yii::$app->request->post()))
        {
            // if(isset($_POST['mds_sub_acc_no']) && isset($_POST['gsb_branch']))
            // {
                $funding_sources = $_POST['funding_source'];
                $mds_sub_acc_nos = $_POST['mds_sub_acc_no'];
                $gsb_branches = $_POST['gsb_branch'];
                $januarys = $_POST['january'];
                $februarys = $_POST['february'];
                $marches = $_POST['march'];
                $aprils = $_POST['april'];
                $mays = $_POST['may'];
                $junes = $_POST['june'];
                $julys = $_POST['july'];
                $augusts = $_POST['august'];
                $septembers = $_POST['september'];
                $octobers = $_POST['october'];
                $novembers = $_POST['november'];
                $decembers = $_POST['december'];
                $first_quarters = $_POST['first_quarter'];
                $second_quarters = $_POST['second_quarter'];
                $third_quarters = $_POST['third_quarter'];
                $forth_quarters = $_POST['forth_quarter'];

                for($i=0; $i < sizeof($funding_sources); $i++)
                {
                    if(!empty($funding_sources[$i]) && !empty($mds_sub_acc_nos[$i]) && !empty($gsb_branches[$i]))
                    {
                        $model2 = new Nca();

                        $model2->fund_cluster = $model->fund_cluster;
                        $model2->fiscal_year = $model->fiscal_year;
                        $model2->nca_no = $model->nca_no;
                        $model2->nca_type = $model->nca_type;
                        $model2->date_received = $model->date_received;
                        $model2->purpose = $model->purpose;
                        $model2->total_amount = $model->total_amount;
                        $model2->funding_source = $funding_sources[$i];
                        $model2->mds_sub_acc_no = $mds_sub_acc_nos[$i];
                        $model2->gsb_branch = $gsb_branches[$i];
                        $model2->january = $januarys[$i];
                        $model2->february = $februarys[$i];
                        $model2->march = $marches[$i];
                        $model2->april = $aprils[$i];
                        $model2->may = $mays[$i];
                        $model2->june = $junes[$i];
                        $model2->july = $julys[$i];
                        $model2->august = $augusts[$i];
                        $model2->september = $septembers[$i];
                        $model2->october = $octobers[$i];
                        $model2->november = $novembers[$i];
                        $model2->december = $decembers[$i];
                        $model2->first_quarter = $first_quarters[$i];
                        $model2->second_quarter = $second_quarters[$i];
                        $model2->third_quarter = $third_quarters[$i];
                        $model2->forth_quarter = $forth_quarters[$i];
                        $model2->sub_total = ($first_quarters[$i] + $second_quarters[$i] + $third_quarters[$i] + $forth_quarters[$i]);

                        $validitys = $_POST['validity_'.$i];
                        $validitys = implode(',', $validitys);

                        $model2->validity = $validitys;

                        $model2->save(false);
                    }
                }
            //}
            
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing Nca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $annexes = Nca::find()->where(['nca_no' => $model->nca_no])->all();

        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['funding_source']) && isset($_POST['mds_sub_acc_no']) && isset($_POST['gsb_branch']))
            {
                $ids = $_POST['id'];
                $funding_sources = $_POST['funding_source'];
                $mds_sub_acc_nos = $_POST['mds_sub_acc_no'];
                $gsb_branches = $_POST['gsb_branch'];
                $januarys = $_POST['january'];
                $februarys = $_POST['february'];
                $marches = $_POST['march'];
                $aprils = $_POST['april'];
                $mays = $_POST['may'];
                $junes = $_POST['june'];
                $julys = $_POST['july'];
                $augusts = $_POST['august'];
                $septembers = $_POST['september'];
                $octobers = $_POST['october'];
                $novembers = $_POST['november'];
                $decembers = $_POST['december'];
                $first_quarters = $_POST['first_quarter'];
                $second_quarters = $_POST['second_quarter'];
                $third_quarters = $_POST['third_quarter'];
                $forth_quarters = $_POST['forth_quarter'];


                for($i=0; $i < sizeof($funding_sources); $i++)
                {
                    $model2 = $this->findModel($ids[$i]);

                    $model2->fund_cluster = $model->fund_cluster;
                    $model2->fiscal_year = $model->fiscal_year;
                    $model2->nca_no = $model->nca_no;
                    $model2->nca_type = $model->nca_type;
                    $model2->date_received = $model->date_received;
                    $model2->purpose = $model->purpose;
                    $model2->total_amount = $model->total_amount;
                    $model2->funding_source = $funding_sources[$i];
                    $model2->mds_sub_acc_no = $mds_sub_acc_nos[$i];
                    $model2->gsb_branch = $gsb_branches[$i];
                    $model2->january = $januarys[$i];
                    $model2->february = $februarys[$i];
                    $model2->march = $marches[$i];
                    $model2->april = $aprils[$i];
                    $model2->may = $mays[$i];
                    $model2->june = $junes[$i];
                    $model2->july = $julys[$i];
                    $model2->august = $augusts[$i];
                    $model2->september = $septembers[$i];
                    $model2->october = $octobers[$i];
                    $model2->november = $novembers[$i];
                    $model2->december = $decembers[$i];
                    $model2->first_quarter = $first_quarters[$i];
                    $model2->second_quarter = $second_quarters[$i];
                    $model2->third_quarter = $third_quarters[$i];
                    $model2->forth_quarter = $forth_quarters[$i];
                    $model2->sub_total = ($first_quarters[$i] + $second_quarters[$i] + $third_quarters[$i] + $forth_quarters[$i]);

                    $validitys = $_POST['validity_'.$i];
                    $validitys = implode(',', $validitys);

                    $model2->validity = $validitys;

                    // var_dump($validitys);
                    // exit();

                    $model2->save(false);
                }
            }
            
            Yii::$app->getSession()->setFlash('success', 'Success! Record has been updated.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'annexes' => $annexes,
        ]);
    }

    /**
     * Deletes an existing Nca model.
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
     * Finds the Nca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nca::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
            echo "<option value=''>Select Funding Source</option>";

            foreach($sources as $source)
            {
                 echo "<option value='".$source->funding_source."'>".$source->funding_source."</option>";
            }
        }
        else
            {
                echo "<option> - </option>";
            }

        // ArrayHelper::map(Nca::find()->where(['nca_no' => $nca_no])->all(),'funding_source', 'funding_source');
    }

    public function actionAllocations($funding_source)
    {
       $allocation = array_sum(ArrayHelper::getColumn(Nca::find()
                            ->where(['funding_source' => $funding_source])
                            ->andWhere(['fiscal_year' => date('Y')])
                            ->andWhere(['like', 'validity', date('F')])
                            ->all(), 'total_amount'));
    
       echo number_format($allocation, 2);
       
    }
}
