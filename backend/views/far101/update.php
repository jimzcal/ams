<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */

$this->title = 'Update FAR 1';
// $this->params['breadcrumbs'][] = ['label' => 'Far101s', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="far101-update">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->
   <div class="view-form">
	    <?= $this->render('updateForm', [
	        'model' => $model,
	        'far' => $far,
	        'fund_cluster' => $fund_cluster,
	        'fiscal_year' => $fiscal_year,
	    ]) ?>
	</div>
</div>
