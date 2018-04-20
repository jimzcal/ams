<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CASH ADVANCES';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-advance-index">

    <div class="new-title">
        <i class="fa fa-money" aria-hidden="true"></i> Cash Advances
    </div>

    <?php $form = ActiveForm::begin(); ?> 
    
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
                            ['class' => 'yii\grid\SerialColumn'],
                                //'id',
                                [
                                    'attribute' => 'date',
                                    'format' => 'Html',
                                    'contentOptions'=>['style'=>'max-width: 75px;'],
                                    'value' => 'date',
                                ],
                                [
                                    'attribute' => 'Payee',
                                    'value' => 'dvNo.payee'
                                ],
                                [
                                    'attribute' => 'dv_no',
                                    'format' => 'Html',
                                    'contentOptions'=>['style'=>'max-width: 100px;'],
                                    'value' => 'dv_no',
                                ],
                                [
                                    'attribute' => 'Particulars',
                                    'value' => 'dvNo.particulars'
                                ],
                                'status',
                                'date_liquidated',
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
                //'filterModel' => $searchModel,
                'rowOptions'   => function ($model, $key, $index, $grid) {
                    return ['data-id' => $model->dvNo->id];
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    [
                        'attribute' => 'date',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 120px;'],
                        'value' => 'date',
                    ],
                    [
                        'attribute' => 'due_date',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 120px;'],
                        'value' => 'due_date',
                    ],
                    [
                        'attribute' => 'Payee',
                        'value' => 'dvNo.payee'
                    ],
                    [
                        'attribute' => 'dv_no',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 100px;'],
                        'value' => 'dv_no',
                    ],
                    [
                        'attribute' => 'Particulars',
                        'contentOptions'=>['style'=>'width: 250px; white-space: normal;'],
                        'value' => 'dvNo.particulars'
                    ],
                    'status',
                    //  [
                    //     'attribute' => 'status',
                    //     'format' => 'Html',
                    //     'value' => function($data){
                    //         return 
                    //             Html::dropDownList('status', null, [$data->status => $data->status, 'Liquidated' => 'Liquidated', 'Unliquidated' => 'Unliquidated'], ['class' => 'form-control']);
                    //     }
                    // ],
                    'date_liquidated',
                    [
                        'label' => 'Actions',
                        'format' => 'Html',
                        'value' => function($data){
                                if(($data->status == 'Unliquidated') || ($data->status == 'unliquidated'))
                                {
                                    $val = Html::a('Notify ', ['/cash-advance/notice', 'id' => $data->id]);
                                    //.' | '.Html::submitButton('Update', ['id' => 'update', 'data-toggle' => 'modal', 'data-target' => '#myModal']); 
                                }

                                else 
                                {
                                    $val = '';
                                }

                                return $val;
                        }
                    ],
                    //['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
    <?php ActiveForm::end(); ?>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
             <h4 class="modal-title">New Requirement</h4>
          </div>
          <div class="modal-body">
              
          </div>
        </div>
      </div>
    </div>

</div>

<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['disbursement/view']) . "?id=' + id;
    });
"); ?>

<script type="text/javascript">

// window.onload = function()
// {
//     $(document).on("change", "select[id='update']", function () { 
//         // alert($(this).val())
//         var value = 0;
//         $modal = $('#myModal');
//         if($(this).val() != null && $(this).val() > 0) 
//         {
//             value = this.value;
//             $("#fperiod").val(value);
//         }
//     });
// }

</script>

