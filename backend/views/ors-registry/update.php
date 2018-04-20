<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */

$this->title = 'Update Obligation Entry';
//$this->params['breadcrumbs'][] = ['label' => 'Ors Registries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="ors-registry-update">

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
    </div>

    <div class="view-index">
    	<div class="mini-header">
    		Disbursement Details
    	</div>
    	<table class="table table-condensed table-striped table-bordered">
    		<tr>
    			<th>DV No</th>
    			<th>Particulars</th>
    			<th>Gross Amount</th>
    			<th>Less Amount</th>
    			<th>Net Amount</th>
    		</tr>
    		<tr>
    			<td><?= $dv->dv_no ?></td>
    			<td><?= $dv->particulars ?></td>
    			<td><?= $dv->gross_amount ?></td>
    			<td><?= $dv->less_amount ?></td>
    			<td><?= $dv->net_amount == 0 ? number_format($dv->gross_amount-$dv->less_amount, 2) : $dv->net_amount ?></td>
    		</tr>
    	</table>
    </div>

    <div class="view-index">
    	<div class="mini-header">
    		ORS Details
    	</div>
	    <?= $this->render('updateForm', [
	    	'model_registry' => $model_registry,
	        'model' => $model,
	        'dv' => $dv,
	    ]) ?>
	</div>

</div>
