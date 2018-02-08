<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CASH ADVANCES';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-advance-index">

    <div class="title">
        <?= Html::encode($this->title) ?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Cash Advance', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'date',
                'format' => 'Html',
                'contentOptions'=>['style'=>'max-width: 100px;'],
                'value' => 'date',
            ],
            [
                'attribute' => 'dv_no',
                'format' => 'Html',
                'contentOptions'=>['style'=>'max-width: 100px;'],
                'value' => 'dv_no',
            ],
            [
                'label' => 'Payee',
                'value' => function($data){
                    $name = Disbursement::find(['payee'])->where(['dv_no'=> $data->dv_no])->one();
                    return $name->payee;
                }
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['cash-advance/view']) . "&id=' + id;
    });
"); ?>
