<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\User;
use backend\models\Disbursement;
use yii\data\ActiveDataProvider;
use backend\models\TransactionStatus;
use backend\models\AccountingEntry;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(isset($_POST['dv_no']))
        {
            $dv_no = $_POST['dv_no'];
            $id = Disbursement::find(['id'])->where(['dv_no'=>$dv_no])->one();
            //$result = Disbursement::find()->where(['dv_no'=>$dv_no])->one();
            if($id != null)
            {
                if (\Yii::$app->user->can('receive'))
                {
                    return $this->redirect(['/disbursement/view', 'id' => $id->id]);
                }
                if (\Yii::$app->user->can('process'))
                {
                    $status = TransactionStatus::find(['processing'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->processing))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['processing' => $detail], ['dv_no' => $dv_no])->execute();

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }
                if (\Yii::$app->user->can('verify'))
                {
                    $status = TransactionStatus::find(['verification'])->where(['dv_no'=>$dv_no])->one();
                    if(empty($status->verification))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['verification' => $detail], ['dv_no' => $dv_no])->execute();

                        return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }
                    else
                    {
                         return $this->redirect(['/disbursement/processor', 'id' => $id->id]);
                    }   
                }
                if (\Yii::$app->user->can('NCA_Control'))
                {
                    $status = TransactionStatus::find(['nca_control'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = Disbursement::find()->where(['dv_no' => $dv_no])->one();
                    if(empty($status->nca_control))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['nca_control' => $detail], ['dv_no' => $dv_no])->execute();

                        return $this->redirect(['/disbursement/cashstatus', 'id' => $disbursement->id]);
                    }
                    else
                    {
                         return $this->redirect(['/disbursement/cashstatus', 'id' => $id->id]);
                    }   
                }

                if (\Yii::$app->user->can('lddap_ada'))
                {
                    $status = TransactionStatus::find(['lddap_ada'])->where(['dv_no'=>$dv_no])->one();
                    $disbursement = AccountingEntry::find()->all();
                    if(empty($status->lddap_ada))
                    {
                        $detail = Yii::$app->user->identity->fullname.','.date('m/d/Y h:i');
                        Yii::$app->db->createCommand()->update('transaction_status', ['lddap_ada' => $detail], ['dv_no' => $dv_no])->execute();

                        Yii::$app->getSession()->setFlash('success', 'DV No. '.$dv_no.' has been received');
                        return $this->render('/disbursement/lddapIndex', ['disbursement' => $disbursement]);
                    }
                    else
                    {
                         return $this->render('/disbursement/lddapIndex', ['disbursement' => $disbursement]);
                    }   
                }
            }
            else
            {
                Yii::$app->getSession()->setFlash('info', 'No Results Found');
                return $this->render('index');
            }
        }

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    // public function actionView()
    // {
    //     $id = yii::$app->user->identity->id;
    //     $model = new User();
    //     return $this->render('view', [
    //         'id' => $id, 'model' => $model->id,
    //         //'id' => $id, 'model' => $model->findModel($id),
    //     ]);
    //     // var_dump($id);
    // }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSearch()
    {
        
        return $this->render('search');
    }
}
