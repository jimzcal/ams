<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'ADD NEW TRANSACTION';
// $this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">
	<?= Yii::$app->session->getFlash('error'); ?>
	<div class="form-wrapper">
	    <div class="title">
	    	<?= Html::encode($this->title) ?>
	    	<?= Html::a('&times;', ['/transaction/index'], ['class' => 'close']) ?>
	    </div>
	    <?= $this->render('_form', [
	        'model' => $model,
	        'requirements' => $requirements,
	    ]) ?>
	</div>
</div>
