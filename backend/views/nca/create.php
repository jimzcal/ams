<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Nca */

$this->title = 'Notice of Cash Allocation';
// $this->params['breadcrumbs'][] = ['label' => 'Ncas', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="nca-create">
	<div class="form-wrapper">
	    <div class="title">
	    	<?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/nca/index'], ['class' => 'close']) ?>
	    </div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
