<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */

$this->title = 'Create Draft Dv';
$this->params['breadcrumbs'][] = ['label' => 'Draft Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-create">

    <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> New Disbursement Voucher (Draft)
    </div>

    <div class="row">
    	<div class="col-md-8">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
		<div class="col-md-4">
			<div style="width: 70%; height: 300px; border: solid 1px #e6e6e6; border-radius: 5px; margin: auto; background-color: #ffffff;">
				<div style="width: 100%; top: 0; height: 40px; background-color: #e6e6e6; border: 0px 5px 5px 0px;padding-left: 10px; padding-top: 10px; font-weight: bold;">
					<p style="display: inline-block;"><i class="glyphicon glyphicon-folder-close"></i> My Disbursement Vouchers </p>
					<p style="text-align: right; color: green; display: inline-block;"><?= sizeof($data) ?></p>
				</div>
				<div style="width: 100%; top: 0; padding: 10px;">
					<?php foreach ($data as $value) : ?>
						<div>
							<p><i class="glyphicon glyphicon-hand-right"></i> <?= Html::a(' '.$value->reference_no.' - '.$value->gross_amount, ["view", 'id'=> $value->id], ['style' => 'font-weight: bold; color: #000000']) ?></p>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>

</div>
