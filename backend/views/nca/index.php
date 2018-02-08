<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'NOTICE OF CASH ALLOCATION';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-index">
    <?= Yii::$app->session->getFlash('error'); ?>
    <div class="title">
        <?= Html::encode($this->title) ?>
        <?= Html::a('New', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nca_no',
            'date',
            //'fund_cluster',
            //'mds_sub_acc_no',
            //'gsb_branch',
            'purpose',
            'period',
            'amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
