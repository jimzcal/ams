<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CashAdvance */

$this->title = 'Update Cash Advance: ' . $model->dv_no;
// $this->params['breadcrumbs'][] = ['label' => 'Cash Advances', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-advance-update">
	<div class="view-index">
		<div class="mini-header">
			Update Cash Advance
		</div>

		<div style="width: 80%; margin-right: auto; margin-left: auto; padding: 10px;">
			<?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
