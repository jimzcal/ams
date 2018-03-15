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
        <?= Html::a('New NCA', ['create'], ['class' => 'btn btn-success btn-right']) ?>
    </div>

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> Notice of Cash Allocation (NCA)
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="view-index">
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'date_received',
               // 'fund_cluster',
                [
                    'attribute' => 'fund_cluster',
                    'value' => function($data){
                        $val = $data->fund_cluster.' - '.$data->fundCluster->description;
                        return $val;
                    }
                ],
                //'fundCluster.description',
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
                //'total_amount',
                [
                    'attribute' => 'total_amount',
                    'value' => function($data){
                        return number_format($data->total_amount, 2);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
