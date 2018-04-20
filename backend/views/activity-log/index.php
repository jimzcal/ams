<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActivityLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activity Logs';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-log-index">

    <div class="new-title">
        <i class="fa fa-list" aria-hidden="true"></i> Activity Log
    </div>
    <?php Pjax::begin(); ?>
    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <div class="row">
            <div class="col-md-9">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="col-md-3">
                <div style="float: right;">
                    <?= ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'date_time',
                            'particular',
                            'user',
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
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'date_time',
                [
                    'attribute' => 'particular',
                    'format' => 'html',
                    'contentOptions'=>['style'=>'width: 650px; white-space: normal;'],
                    'value' => 'particular'
                ],
                //'particular',
                'user',

                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
