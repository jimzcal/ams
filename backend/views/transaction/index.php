<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TRANSACTIONS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <div class="title">
        <?= Html::a('Requirement', ['/requirements/create'], ['class' => 'btn btn-success btn-right']) ?>
        <?= Html::a('New Transaction', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> List of Transactions
    </div>

    <div class="view-index">
        <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    [
                        'attribute' => 'name',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 200px;'],
                    ],
                    //'name',
                    [
                        'attribute' => 'requirements',
                        'format' => 'Html',
                        'contentOptions'=>['style'=>'max-width: 700px;'],
                        'value' => function($data){
                            $values = explode(', ', $data->requirements);
                            foreach ($values as $value)
                            {
                                return mb_strimwidth($value, 0, 100, ' ...');
                            }
                            
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
