<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
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
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="col-md-4">
                <div style="float: right;">
                    <?= ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            'dv_no',
                            'date',
                            'payee',
                             [
                                'attribute' => 'gross_amount',
                                'value' => function($data){
                                    return (number_format($data->gross_amount, 2));
                                }
                             ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="view-index">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'date',
                    [
                        'attribute' => 'date',
                        'contentOptions' => ['style' => 'width: 100px;'], 
                        'value' => 'date'
                    ],
                    // 'dv_no',
                    [
                        'attribute' => 'dv_no',
                        'contentOptions' => ['style' => 'width: 130px;'], 
                        'value' => 'dv_no'
                    ],
                    [
                        'attribute' => 'Particular',
                        'format' =>'html',
                        'contentOptions' => ['style' => 'width: 300px; white-space: normal;'], 
                        'value' => function($data){

                            return Html::tag('p', $data->ors->particular);
                        }
                    ],
                    //'payee',
                    [
                        'attribute' => 'payee',
                        'contentOptions' => ['style' => 'width: 170px;'], 
                        'value' => 'payee'
                     ],

                     [
                        'attribute' => 'gross_amount',
                        'contentOptions' => ['style' => 'width: 130px;'], 
                        'value' => function($data){
                            return (number_format($data->gross_amount, 2));
                        }
                     ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
