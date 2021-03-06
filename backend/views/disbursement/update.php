<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'UPDATE DV NO.: ' . $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="disbursement-update">
	<!-- <div class="form-wrapper">
    	<div class="form-title">
    		<?= Html::encode($this->title) ?>
    		<?= Html::a('&times;', ['/disbursement/index'], ['class' => 'close-button']) ?>
    	</div>

	    <?= $this->render('_updateForm', [
	        'model' => $model,
	    ]) ?>
	</div> -->

		<div class="new-title">
	        <i class="fa fa-id-card" aria-hidden="true"></i> New Disbursement Voucher
	    </div>

	    <?= $this->render('_updateForm', [
	        'model' => $model,
	        //'dv_no' => $dv_no,
	    ]) ?>
</div>
