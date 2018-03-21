<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountingEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ACCOUNTING ENTRIES';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-entry-index">

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Accounting Entries
    </div>

    
    <?php Pjax::begin(); ?>
    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

        <div class="view-index">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    'dv_no',
                    'account_title',
                    'uacs_code',
                    [
                        'attribute' => 'debit',
                        'value' => function($value){

                            return number_format($value->debit, 2);
                        }
                    ],
                    [
                        'attribute' => 'credit_amount',
                        'value' => function($val){

                            return number_format($val->credit_amount, 2);
                        }
                    ],
                    [
                        'attribute' => 'credit_to',
                        'value' => function($data){

                            return $data->credit_to == 'payee' ? $data->disbursement->payee : $data->credit_to;
                        }
                    ],
                ],
            ]); ?>
         </div>
    <?php Pjax::end(); ?>
</div>
