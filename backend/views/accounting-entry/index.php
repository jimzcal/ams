<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountingEntrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ACCOUNTING ENTRIES';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounting-entry-index">

    <div class="title">
        <?= Html::encode($this->title) ?>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!--   <p>
        <?= Html::a('Create Accounting Entry', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'dv_no',
            'account_title',
            'uacs_code',
            'debit',
            'credit_amount',
            'credit_to',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
