<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use backend\models\OrsRegistry;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Far101Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAR 1 - 01';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="far101-index">

    <!-- <div class="title">
        <?= Html::a('FAR Template', ['new'], ['class' => 'btn btn-success btn-right']) ?>
    </div> -->

    <div class="right-top-button">
        <div class="right-button-text" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> New FAR</div>
    </div>

    <div class="new-title">
        <i class="fa fa-line-chart" aria-hidden="true"></i> Financial Accountability Report (FAR 1)
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

                    //'id',
                    'date_updated',
                    'fiscal_year',
                    'fund_cluster',
                    //'parent_id',
                    'particulars',
                    //'uacs_code',
                    //'obligation_q_1',
                    //'obligation_q_2',
                    //'obligation_q_3',
                    //'obligation_q_4',
                    //'total_obligation',
                    //'disbursement_q_1',
                    //'disbursement_q_2',
                    //'disbursement_q_3',
                    //'disbursement_q_4',
                    [
                        'attribute' => 'total_disbursement',
                        'value' => function($data){

                            $sum = array_sum(ArrayHelper::getColumn(OrsRegistry::find(['payment'])
                                        ->where(['ors_year'=>$data->fiscal_year])
                                        ->andWhere(['fund_cluster' => $data->fund_cluster])
                                        ->all(), 'payment'));

                            return number_format($sum, 2);
                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title"><i class="glyphicon glyphicon-cloud-upload" ></i> Upload FAR Template</h4>
      </div>
      <div class="modal-body">
          <?= $this->render('_form', [
                'model' => $model,
           ]) ?>
      </div>
    </div>
  </div>
</div>