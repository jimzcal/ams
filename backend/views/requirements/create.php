<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\Requirements */

$this->title = 'Add New Requirement';
// $this->params['breadcrumbs'][] = ['label' => 'Requirements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="requirements-create">
  <?= Yii::$app->session->getFlash('error'); ?>
	<div class="title">REQUIREMENTS
    <div class="btn btn-success btn-right" data-toggle="modal" data-target="#myModal">New Requirement</div>
  </div>

	<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'requirement',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	<?php Pjax::end(); ?>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">New Requirement</h4>
      </div>
      <div class="modal-body">
		  <?= $this->render('_form', [
		        'model' => $model,
		   ]) ?>
      </div>
    </div>
  </div>
</div> 
