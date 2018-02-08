<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\CashStatus;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CASH STATUS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-status-index">
    <div class="title"><?= Html::encode($this->title) ?></div>
    <div class="cash-status">
        <table class="table">
            <tr>
                <td width="50" style="font-weight: bold">NCA No.</td><td><?= ': '.$nca->nca_no ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Amount</td><td><?= ': '.number_format($nca->amount, 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Total Amount Obligated</td><td><?= ': '.number_format(array_sum(ArrayHelper::getColumn(CashStatus::find(['disbursement_amount'])->where(['nca_no'=>$nca->nca_no])->all(), 'disbursement_amount')), 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Current Balance</td><td><?= ': '.number_format($nca->amount - array_sum(ArrayHelper::getColumn(CashStatus::find(['disbursement_amount'])->where(['nca_no'=>$nca->nca_no])->all(), 'disbursement_amount')), 2) ?></td>
            </tr>
        </table>
    </div>
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'nca_no',
                'dv_no',
                [
                    'attribute' => 'disbursement_amount',
                    'value' => function($data){
                        return (number_format($data->disbursement_amount, 2));
                    }
                ],
                // [
                //     'attribute' => 'current_balance',
                //     'value' => function($data2){
                //         return (number_format($data2->current_balance, 2));
                //     }
                // ],

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>


        

</div>
<?php
$this->registerJs("
    $('tbody td').css('text-align', 'left'); ");
?>
