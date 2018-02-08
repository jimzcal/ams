<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaction Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Transaction Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dv_no',
            'receiving:ntext',
            'processing:ntext',
            'nca_control:ntext',
            //'verification:ntext',
            //'lddap_ada:ntext',
            //'releasing:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
