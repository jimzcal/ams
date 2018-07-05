<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MdpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mdps';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdp-index">

     <div class="new-title">
        <i class="fa fa-file-text" aria-hidden="true"></i> Monthly Disbursement Program (MDP)
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="right-top-button">
        <div class="right-button-text" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> New MDP</div>
    </div>

    <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
        <div class="row">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <div class="view-index">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'fiscal_year',
                [
                    'attribute' => 'total_program',
                    'value' => function($data){
                        return number_format($data->total_program, 2);
                    }
                ],
                
                //'particulars',
                //'uacs_code',
                //'parent_uacs',
                [
                    'attribute' => 'tra',
                    'value' => function($data){
                        return number_format($data->tra, 2);
                    }
                ],
                [
                    'attribute' => 'net_program',
                    'value' => function($data){
                        return number_format($data->net_program, 2);
                    }
                ],
                //'january',
                //'february',
                //'march',
                //'first_total',
                //'april',
                //'may',
                //'june',
                //'second_total',
                //'july',
                //'august',
                //'september',
                //'third_total',
                //'october',
                //'november',
                //'december',
                //'forth_total',
                [
                    'attribute' => 'full_year_total',
                    'value' => function($data){
                        return number_format($data->full_year_total, 2);
                    }
                ],

                [
                    'label' => 'Action',
                    'format' => 'Html',
                    'value' => function($data){
                        $view = Html::a('<i class="glyphicon glyphicon-eye-open"></i> View ', ['view', 'fiscal_year' => $data->fiscal_year, 'version' => $data->version]);

                        return $view;
                    }
                ]

                //['class' => 'yii\grid\ActionColumn'],
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
         <h4 class="modal-title"><i class="glyphicon glyphicon-cloud-upload" ></i> Upload MDP File</h4>
      </div>
      <div class="modal-body">
          <?= $this->render('_form', [
                'model' => $model,
           ]) ?>
      </div>
    </div>
  </div>
</div>
