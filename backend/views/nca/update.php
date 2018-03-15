<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'Update NCA';
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="nca-update">
	<div class="form-wrapper">
	    <div class="form-title">
	    	<?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/nca/index'], ['class' => 'close-button']) ?>
	    </div>

	    <?= $this->render('_updateForm', [
	        'model' => $model,
	        'annexes' => $annexes,
	    ]) ?>
	</div>
</div>
