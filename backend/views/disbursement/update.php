<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = 'EDIT DV NO.: ' . $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="disbursement-update">
	<div class="form-wrapper">
    	<div class="title">
    		<?= Html::encode($this->title) ?>
    	</div>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
	</div>
</div>
