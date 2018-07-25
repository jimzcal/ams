<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NcaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'NOTICE OF CASH ALLOCATIONS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-index">
<?= Yii::$app->session->getFlash('error'); ?>

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> Notice of Cash Allocations (NCA List)
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <div class="row">
            <div class="col-md-8">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>

    <div class="view-index">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'fund_cluster',
                    'value' => function($data){
                        $val = $data->fund_cluster.' - '.$data->fundCluster->description;
                        return $val;
                    }
                ],        
                'nca_no',
                'funding_source',
                'fiscal_year',
                [
                    'attribute' => 'total_amount',
                    'value' => function($data){
                        return number_format($data->sub_total, 2);
                    }
                ],
                [
                    'label' => 'Action',
                    'format' => 'html',
                    'value' => function($data)
                    {
                        return  Html::a('<i class="glyphicon glyphicon-eye-open"></i><br>', ['cash-status', 'nca_no' => $data->nca_no, 'funding_source' => $data->funding_source], ['style' => 'color: green;']);
                    }
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
