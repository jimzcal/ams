<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ORS Entry';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-index">

    <div class="right-top-button">
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> New ORS', ['create'], ['class' => 'right-button-text']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Registry of Obligations
    </div>

    <?php Pjax::begin(); ?>
    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="view-index">

        <table class="table table-striped" style="border: solid 1px #d9d9d9;">
        <?php foreach ($dataProvider->getModels() as $key => $value)  : ?>

                <tr data-id = <?= $value->id ?>>
                    <td>
                        <table class="ors-index" style="width: 100%;">
                            <tr data-id = <?= $value->id ?>>
                                <td style="width: 150px; text-align: right; font-style: italic; color: #999999;">ORS NO : </td>
                                <td style="width: 350px; border-right-width: 2px; border-right-style: dotted; border-color: #d9d9d9; border-bottom: 1px dotted;">
                                    <?= $value->ors_class.'-'.$value->funding_source.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial ?>
                                </td>
                                <td style="border-right-width: 2px; border-right-style: dotted;  border-color: #d9d9d9;" rowspan="5">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="4" style="text-align: center;">Obligation Status</td>
                                        </tr>
                                        <tr style="font-size: 12px; font-weight: bold; text-align: center;">
                                            <td>Starting Obligation</td>
                                            <td>Disbursement</td>
                                            <td>Balance</td>
                                            <td>As of</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right; font-weight: bold; color: #558000;">
                                                <?= number_format($value->obligation, 2) ?>
                                            </td>
                                            <td style="text-align: right; font-weight: bold; color: #558000;">
                                                <?= number_format($value->getDisbursement($value->id), 2) == 0.00 ? '-' : number_format($value->getDisbursement($value->id), 2); ?>
                                            </td>
                                            <td style="text-align: right; font-weight: bold; color: #558000;">
                                                <?= number_format(($value->obligation - $value->getDisbursement($value->id)), 2) == 0.00 ? '-' : number_format(($value->obligation - $value->getDisbursement($value->id)), 2) ?>
                                            </td>
                                            <td style="text-align: right; font-weight: bold;">
                                                <?= $value->getDate($value->id) ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <table style="margin-right: auto; margin-left: auto;">
                                        <tr>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 60px;">
                                                <?= Html::a('<i class="glyphicon glyphicon-eye-open button"></i> View ', ["ors/view", 'id' => $value->id], ['style' => 'color: #000000; font-weight: bold']) ?>
                                            </td>
                                            <td style="width: 80px;">
                                                <?= Html::a('<i class="glyphicon glyphicon-pencil button" ></i> Update', ["ors/update", 'id' => $value->id], ['style' => 'color: #000000; font-weight: bold']) ?>
                                            </td>
                                            <td style="width: 80px;">
                                                <?= Html::a('<i class="glyphicon glyphicon-trash button"></i> Delete', ["ors/delete", 'id' => $value->id], ['style' => 'color: #000000; font-weight: bold', 
                                                    'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                    ],
                                                    ]) ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px; text-align: right; font-style: italic; color: #999999">Particulars : </td>
                                <td style="width: 350px; border-right-width: 2px; border-right-style: dotted;  border-color: #d9d9d9; border-bottom: 1px dotted;">
                                    <?= $value->particular ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px; text-align: right; font-style: italic; color: #999999">MFO/PAP : </td>
                                <td style="width: 350px; border-right-width: 2px; border-right-style: dotted;  border-color: #d9d9d9; border-bottom: 1px dotted;">
                                    <?= $value->mfo_pap ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px; text-align: right; font-style: italic; color: #999999">Responsibility Center : </td>
                                <td style="width: 350px; border-right-width: 2px; border-right-style: dotted;  border-color: #d9d9d9; border-bottom: 1px dotted;">
                                    <?= $value->responsibility_center ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px; text-align: right; font-style: italic; color: #999999">Total Obligation : </td>
                                <td style="width: 350px; border-right-width: 2px; border-right-style: dotted;  border-color: #d9d9d9; border-bottom: 1px dotted;">
                                    <?= number_format($value->obligation, 2) ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
        <?php endforeach ?>
        </table>
         <?php //  GridView::widget([
        //     'dataProvider' => $dataProvider,
        //     //'filterModel' => $searchModel,
        //     'rowOptions'   => function ($model, $key, $index, $grid) {
        //                             return ['data-id' => $model->id];
        //                         },
        //     'columns' => [
        //         ['class' => 'yii\grid\SerialColumn'],

        //         //'id',
        //         [
        //             'label' => 'ORS No',
        //             'format' => 'Html',
        //             'contentOptions' => ['style' => 'width: 250px;'], 
        //             'value' => function($data){

        //                 $ors_no = $data->ors_class.'-'.$data->funding_source.'-'.$data->ors_year.'-'.$data->ors_month.'-'.$data->ors_serial;
        //                 return $ors_no;
        //             }
        //         ],
        //         [
        //             'attribute' => 'particular',
        //             'format' => 'Html',
        //             'contentOptions' => ['style' => 'width: 300px; white-space: normal; font-size: 11px;'],
        //             'value' => 'particular'
        //         ],
        //         //'particular',
        //         //'ors_class',
        //         //'funding_source',
        //         //'ors_year',
        //         //'ors_month',
        //         //'ors_serial',
        //         'mfo_pap',
        //         'responsibility_center',
        //         [
        //             'label' => 'Obligation',
        //             'attribute' => 'obligation',
        //             'format' => 'Html',
        //             'contentOptions' => ['style' => 'font-weight: bold; text-align: right; font-style: italic'],
        //             'value' => function($data){
        //                 return number_format($data->obligation,2) ;
        //             }
        //         ],

        //         ['class' => 'yii\grid\ActionColumn'],
        //     ],
        // ]); ?>
         <?php //Pjax::end(); ?>
    </div>
</div>

<?php
$this->registerJs("
     $('tbody td').css('cursor', 'pointer');
     $('tbody th').css('background-color', '#f5f5f0');
     $('tbody td').click(function (e) {
         var id = $(this).closest('tr').data('id');
         if (e.target == this)
             location.href = '" . Url::to(['ors/view']) . "?id=' + id;
     });
 ");
?>
