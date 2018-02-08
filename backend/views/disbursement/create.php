<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'NEW DISBURSEMENT VOUCHER';
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-create">
    <div class="form-wrapper">
    	<div class="title">
    		<?= Html::encode($this->title) ?>
    		<?= Html::a('&times;', ['/disbursement/index'], ['class' => 'close']) ?>
    	</div>

	    <?= $this->render('_form', [
	        'model' => $model,
	        'dv_no' => $dv_no,
	    ]) ?>
	</div>
</div>
