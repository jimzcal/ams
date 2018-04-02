<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'NOTICE OF CASH ALLOCATION';
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-create">
	<div class="form-wrapper">
	    <div class="form-title">
	    	<?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/nca/index'], ['class' => 'close-button']) ?>
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'data' => $data,
	    ]) ?>
	</div>
</div>
