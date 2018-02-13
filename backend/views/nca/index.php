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

    <div class="title">
        <?= Html::encode($this->title) ?>
        <?= Html::a('New NCA', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'date_received',
            'fund_cluster',
            'fundCluster.description',
            'nca_no',
            //'mds_sub_acc_no',
            //'gsb_branch',
            //'purpose',
            'fiscal_year',
            //'january',
            //'february',
            //'march',
            //'april',
            //'may',
            //'june',
            //'july',
            //'august',
            //'september',
            //'october',
            //'november',
            //'december',
            'total_amount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
