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

    <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Registry of Obligations
    </div>

    <?php Pjax::begin(); ?>
    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="view-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'rowOptions'   => function ($model, $key, $index, $grid) {
                                    return ['data-id' => $model->id];
                                },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'label' => 'ORS No',
                    'format' => 'Html',
                    'contentOptions' => ['style' => 'width: 250px;'], 
                    'value' => function($data){

                        $ors_no = $data->ors_class.'-'.$data->funding_source.'-'.$data->ors_year.'-'.$data->ors_month.'-'.$data->ors_serial;
                        return $ors_no;
                    }
                ],
                [
                    'attribute' => 'particular',
                    'format' => 'Html',
                    'contentOptions' => ['style' => 'width: 300px; white-space: normal;'],
                    'value' => 'particular'
                ],
                //'particular',
                //'ors_class',
                //'funding_source',
                //'ors_year',
                //'ors_month',
                //'ors_serial',
                'mfo_pap',
                'responsibility_center',
                //'amount',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
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
