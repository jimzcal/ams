<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'Update NCA No. '.$model->fund_cluster;
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="nca-update">
	<div class="form-wrapper">
	    <div class="title"><?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/nca/index'], ['class' => 'close']) ?>
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
