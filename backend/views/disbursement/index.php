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

    <div class="right-top-button">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> New Disbursement', ['redirected'], ['class' => 'right-button-text']) ?>
    </div>

    <!-- <div class="btn-group btn-group-vertical" style="float: left; right: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i><br> New', ['create'], ['class' => 'btn btn-default']) ?>
    </div> -->

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
                        'fontAwesome' => true,
                        'target' => ExportMenu::TARGET_SELF,
                        'showConfirmAlert' => true,
                        'enableFormatter' => true,
                        'filename' => 'Disbursement List',
                        'columns' => [
                            'dv_no',
                            'date',
                            'payee',
                            'particulars',
                             [
                                'attribute' => 'gross_amount',
                                'value' => function($data){
                                    return (number_format($data->gross_amount, 2));
                                }
                             ],
                             [
                                'attribute' => 'less_amount',
                                'value' => function($data){
                                    return (number_format($data->less_amount, 2));
                                }
                             ],
                             [
                                'attribute' => 'net_amount',
                                'value' => function($data){
                                    return (number_format($data->net_amount, 2));
                                }
                             ],
                             'status',
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
                        'contentOptions' => ['style' => 'width: 100px;'], 
                        'value' => 'dv_no'
                    ],
                    [
                        'attribute' => 'payee',
                        'contentOptions' => ['style' => 'width: 170px;'], 
                        'value' => 'payee'
                    ],
                    [
                        'attribute' => 'particulars',
                        'format' =>'html',
                        'contentOptions' => ['style' => 'width: 270px;'], 
                        'value' => function($data){

                            return Html::tag('p', $data->particulars);
                        }
                    ],

                     [
                        'attribute' => 'gross_amount',
                        'contentOptions' => ['style' => 'width: 110px; text-align: right'], 
                        'value' => function($data){
                            return (number_format($data->gross_amount, 2));
                        }
                     ],

                     [
                        'attribute' => 'net_amount',
                        'contentOptions' => ['style' => 'width: 110px; text-align: right'], 
                        'value' => function($data){

                            return (number_format($data->net_amount, 2) == 0.00 ? '-' : number_format($data->net_amount, 2));
                        }
                     ],

                     [
                        'attribute' => 'status',
                        'format' =>'html',
                        'value' => 'status'
                     ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
