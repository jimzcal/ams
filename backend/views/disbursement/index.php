<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DISBURSEMENT VOUCHERS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-index">
    <div class="title">
        <?= Html::a('New', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Vouchers (DV)
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="view-index">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'dv_no',
                    'date',
                    // [
                    //     'attribute' => 'date',
                    //     'value' => function($date){
                    //         return date('Y',strtotime($date->date));
                    //     }
                    // ],
                    'payee',
                    //'particulars:ntext',
                    // 'mode_of_payment',
                    // 'responsibility_center',
                    // 'mfo_pap',
                     //'gross_amount',
                     [
                        'attribute' => 'gross_amount',
                        'value' => function($data){
                            return (number_format($data->gross_amount, 2));
                        }
                     ],
                    // 'less_amount',
                    // 'net_amount',
                    // 'fund_source',
                    // 'ors_no',
                    // 'transaction_type',
                    // 'attachments:ntext',
                    // 'status',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
