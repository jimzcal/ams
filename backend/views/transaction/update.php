<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'Update ' . $model->name;
// $this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">
	<div class="form-wrapper">
	    <div class="form-title">
	    	<?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/transaction/index'], ['class' => 'close-button']) ?>
	    </div>
		    <?= $this->render('_updateForm', [
		        'model' => $model,
		        'requirements' => $requirements,
		        'all' => $all,
		        'data' => $data,
		    ]) ?>
	</div>
</div>
