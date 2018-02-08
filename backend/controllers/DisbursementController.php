<?php

namespace backend\controllers;

use Yii;
use backend\models\Disbursement;
use backend\models\DisbursementSearch;
use backend\models\CashAdvance;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TransactionStatus;
use backend\models\Transaction;
use backend\models\AccountingEntry;
use yii\filters\AccessControl;

/**
 * DisbursementController implements the CRUD actions for Disbursement model.
 */
class DisbursementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'processor'],
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
     * Lists all Disbursement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DisbursementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Disbursement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();
        // var_dump($transaction->receiving);
        // exit();
        $transaction1 = explode(',', $transaction->receiving);
        $transaction2 = explode(',', $transaction->processing);
        $transaction3 = explode(',', $transaction->verification);
        $transaction4 = explode(',', $transaction->nca_control);
        $transaction5 = explode(',', $transaction->lddap_ada);
        $transaction6 = explode(',', $transaction->releasing);
        return $this->render('view', [
            'model' => $this->findModel($id), 
            'transaction1'=>$transaction1, 
            'transaction2'=>$transaction2,
            'transaction3'=>$transaction3, 
            'transaction4'=>$transaction4,
            'transaction5'=>$transaction5, 
            'transaction6'=>$transaction6,
        ]);
    }

    public function actionProcessor($id)
    {
        $model = $this->findModel($id);
        $model2 = new AccountingEntry();

        $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
        $transaction = TransactionStatus::find()->where(['dv_no'=>$dv_no->dv_no])->one();

        $entries = AccountingEntry::find()->where(['dv_no'=>$dv_no])->all();
        
        if ($model->load(Yii::$app->request->post()))
        {
            if(isset($_POST['requirements']))
            {
                $model->attachments = implode(',', $_POST['requirements']);
                $model->net_amount = ($model->gross_amount - $model->less_amount);
                $model->save(false);
                Yii::$app->db->createCommand()->update('disbursement', ['attachments' => $model->attachments], ['dv_no' => $dv_no])->execute();
            }

                Yii::$app->getSession()->setFlash('success', 'Successfully Saved');
                return $this->render('viewPr', [
                    'model' => $this->findModel($id),
                    'entries' => $entries,
                    'model2' => $model2,
                ]);
            
        }

        return $this->render('viewP', [
            'model' => $model,
            'entries' => $entries,
            'model2' => $model2,
        ]);

    }

    public function actionCreate()
    {
        if(\Yii::$app->user->can('createDisbursementVoucher'))
        {
            $model = new Disbursement();
            $values = Disbursement::find()->all();
            $dv_no = date('Y').'-'.date('m').'-'.'000'.(sizeof($values)+1);

            if ($model->load(Yii::$app->request->post())) {

                $model->dv_no = $dv_no;
                $model->save(false);

                $model3 = new TransactionStatus();
                $model3->dv_no = $model->dv_no;
                $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                $model3->receiving = $detail;
                $model3->save(false);
                
                //$requirements = Transaction::find(['requirements'])->where(['id'=>$transaction_id])->one();
               // $requirements = explode(',', $requirements->requirements);
                return $this->redirect(['view', 'id' => $model->id]);

            } 
            else
            {
                return $this->render('create', [
                    'model' => $model,
                    'dv_no' => $dv_no,
                ]);
            }
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to Create Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(\Yii::$app->user->can('updateDisbursementVoucher'))
        {

            if ($model->load(Yii::$app->request->post())) 
            {   
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to make changes in Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionDelete($id)
    {
        if(\Yii::$app->user->can('deleteDisbursementVoucher'))
        {   
            $this->findModel($id)->delete();
            $dv_no = Disbursement::find(['dv_no'])->where(['id'=>$id])->one();
            CashAdvance::delete(['dv_no' => $dv_no->dv_no]);
            return $this->redirect(['index']);
        }
        else
        {
            Yii::$app->getSession()->setFlash('warning', 'Sorry, you are not authorized to delete Disbursement Voucher. Please contact your system administrator.');
               return $this->redirect(['index']);
        }

    }

    public function actionCash()
    {
        $results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('advanceView', [
                'results' => $results,
            ]);
    }

    public function actionReports()
    {
        //$results = Disbursement::find()->where(['cash_advance'=>'yes'])->all();
        return $this->render('indexReport');
    }

    protected function findModel($id)
    {
        if (($model = Disbursement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
