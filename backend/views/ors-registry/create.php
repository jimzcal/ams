<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */

$this->title = 'New Obligation Entry';
// $this->params['breadcrumbs'][] = ['label' => 'Ors Registries', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-registry-create">

    <div class="new-title">
        <i class="fa fa-sticky-note" aria-hidden="true"></i> <?= Html::encode($this->title) ?>
    </div>

	<div class="view-index">
    	<div class="mini-header">
    		<i class="fa fa-id-card"></i> Disbursement Details
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

    <?= $this->render('_form', [
    	'ors_ids' => $ors_ids,
        'model' => $model,
        'dv' => $dv,
    ]) ?>

</div>
