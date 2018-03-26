<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\LddapAdaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LDDAP-ADA';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lddap-ada-index">
    <?php
           
    ?>
    <div class="new-title">
        <i class="fa fa-file-text-o"></i> 
            List of Due and Demandable Accounts and Payables - Advice to Debit Account
    </div>

    
    <?php Pjax::begin(); ?>

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
                                'date',
                                'lddap_no',
                                'dv_no',
                                'uacs_code',
                                [
                                    'attribute' => 'net_amount',
                                    'value' => function($data){

                                        return number_format($data->net_amount, 2);
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
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'rowOptions'   => function ($model, $key, $index, $grid) {
                                    return ['data-id' => $model->lddap_no];
                                },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'date',
                'lddap_no',
                'dv_no',
                //'current_account',
                'uacs_code',
                [
                    'attribute' => 'net_amount',
                    'value' => function($data){

                        return number_format($data->net_amount, 2);
                    }
                ],
            ],
        ]); ?>
        </div>
    <?php Pjax::end(); ?>
</div>

<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody th').css('background-color', '#f5f5f0');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['lddap-ada/view']) . "?lddap_no=' + id;
    });
");
?>
