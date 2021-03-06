<?php

namespace backend\controllers;

use Yii;
use backend\models\AccountingEntry;
use yii\helpers\ArrayHelper;
use backend\models\AccountingEntrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Disbursement;
use yii\filters\AccessControl;

/**
 * AccountingEntryController implements the CRUD actions for AccountingEntry model.
 */
class AccountingEntryController extends Controller
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
     * Lists all AccountingEntry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountingEntrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccountingEntry model.
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
     * Creates a new AccountingEntry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $net, $gross)
    {
        $model = new AccountingEntry();
        $dv_no = $dv_id = Disbursement::find(['id'])->where(['id'=>$id])->one();

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->vat === '0')
            {
                if($model->credit_amount === $net)
                {
                    $model->credit_amount = $net;
                }

                if($model->credit_amount !== $net)
                {
                    $model->credit_amount = (($model->credit_amount/100) * ($model->debit));
                }

                if(AccountingEntry::find(['debit'])->where(['dv_no' => $model->dv_no])->andWhere(['debit' => $model->debit])->one() !== null)
                {
                     $model->debit = 0;
                }
            }
            if($model->vat === '1')
            {
                if($model->credit_amount === $net)
                {
                    $model->credit_amount = $net;
                }

                if($model->credit_amount !== $net)
                {
                    $model->credit_amount = (($model->debit/1.12) * ($model->credit_amount/100));
                }

                if(AccountingEntry::find(['debit'])->where(['dv_no' => $model->dv_no])->andWhere(['debit' => $model->debit])->one() !== null)
                {
                    $model->debit = 0;
                }
            }
            if($model->credit_to === null)
            {
                $model->credit_to = '';
            }
            
            $model->save();

            $entry = AccountingEntry::find()->where(['dv_no' => $model->dv_no])->all();
            $debit = array_sum(ArrayHelper::getColumn(AccountingEntry::find(['debit'])
                                        ->where(['dv_no'=>$model->dv_no])
                                        ->all(), 'debit'));
            $net = $debit - array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])
                                        ->where(['dv_no'=>$model->dv_no])
                                        ->andWhere(['credit_to' => 'BIR'])
                                        ->all(), 'credit_amount'));

            //return $this->redirect(['/disbursement/processor', 'id' => $id]);
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
                'dv_no' => $dv_no->dv_no,
                'net' => $net,
                'gross' => $gross,
                'entry' => $entry,
            ]);
        }

        $entry = AccountingEntry::find()->where(['dv_no' => $dv_no->dv_no])->all();

        return $this->render('create', [
            'model' => $model,
            'id' => $id,
            'dv_no' => $dv_no->dv_no,
            'net' => $net,
            'gross' => $gross,
            'entry' => $entry,
        ]);
    }

    /**
     * Updates an existing AccountingEntry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $dv_id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $dv_no = AccountingEntry::find(['dv_no'])->where(['id'=>$id])->one();
            $dv_id = Disbursement::find(['id'])->where(['dv_no'=>$dv_no->dv_no])->one();
            return $this->redirect(['/disbursement/processor', 'id' => $dv_id->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'dv_id' => $dv_id,
        ]);
    }

    /**
     * Deletes an existing AccountingEntry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $dv_no = AccountingEntry::find(['dv_no'])->where(['id' => $id])->one();
        $dv_id = Disbursement::find(['id'])->where(['dv_no'=>$dv_no])->one();
        $this->findModel($id)->delete();

        // var_dump($dv_id);
        // exit();
         return $this->redirect(['/disbursement/processor', 'id' => $dv_id->id]);
    }

    /**
     * Finds the AccountingEntry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccountingEntry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccountingEntry::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
