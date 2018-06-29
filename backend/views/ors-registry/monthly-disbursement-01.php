<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Disbursement;
use backend\models\OrsRegistry;
use backend\models\FundCluster;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly Disbursement';
?>
<div class="cash-advance-index">
	<br><br>
	<?php $form = ActiveForm::begin(); ?>
	<div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
		<div class="row">
			<div class="col-lg-8">
				<table>
					<tr>
						<td valign="top" align="right">
			                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
			            </td>
						<td>
							<?= $form->field($model, 'fiscal_year')->textInput(['placeholder' => 'Fiscal Year', 'value' => $year])->label(false) ?>
						</td>
						<td>
							<?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
			                      [
			                          'prompt'=>'Select Fund Cluster',
			                      ])->label(false); 
			                  ?>
						</td>
						<td>
							<div class="form-group">
			                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			                </div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>

	<div class="view-form">
		<table style="width: 100%">
			<tr>
				<td colspan="9" style="text-align: center; font-weight: bold; font-size: 18px;">
					<?= Html::a('<i class="glyphicon glyphicon-arrow-left"></i>', ["/ors-registry/disbursementyear"], ['style' => 'float: left']) ?>
					MONTHLY DISBURSEMENT
					<?= Html::a('<i class="glyphicon glyphicon-print"></i>', ["/ors-registry/print?year=2018"], ['style' => 'float: right']) ?>
				</td>
			</tr>
			<tr>
				<td colspan="9" style="text-align: center; font-weight: bold; font-size: 14px;">
					For Fiscal Year <?= $year ?>
				</td>
			</tr>
			<tr>
				<td colspan="9" style="text-align: center; font-weight: bold;">
					For Fund Cluster: <?= $fund_cluster ?>
				</td>
			</tr>
			<tr>
				<td colspan="9" style="text-align: center; font-weight: bold;">As of this date</td>
			</tr>
			<tr>
				<td colspan="9"></td>
			</tr>
		</table>

		<br><br>

		<table class="table table-bordered table-condensed">
			<tr>
				<th>Month</th>
				<th>PS</th>
				<th>MOOE</th>
				<th>FinEx</th>
				<th>CO</th>
				<th>Total</th>
				<th>MDS Check Issued</th>
				<th>Advice to debit Account</th>
				<th>Total</th>
			</tr>
			<tr>
				<td style="width: 200px">January</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'January'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'January'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'January'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'January'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'January'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'January'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'January'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'January'); ?>
				</td>
			</tr>
			<tr>
				<td>February</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'February'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'February'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'February'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'February'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'February'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'February'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'February'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'February'); ?>
				</td>
			</tr>
			<tr>
				<td>March</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'March'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'March'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'March'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'March'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'March'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'March'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'March'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'March'); ?>
				</td>
			</tr>
			<tr>
				<td>April</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'April'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'April'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'April'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'April'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'April'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'April'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'April'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'April'); ?>
				</td>
			</tr>
			<tr>
				<td>May</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'May'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'May'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'May'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'May'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'May'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'May'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'May'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'May'); ?>
				</td>
			</tr>
			<tr>
				<td>June</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'June'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'June'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'June'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'June'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'June'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'June'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'June'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'June'); ?>
				</td>
			</tr>
			<tr>
				<td>July</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'July'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'July'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'July'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'July'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'July'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'July'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'July'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'July'); ?>
				</td>
			</tr>
			<tr>
				<td>August</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'August'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'August'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'August'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'August'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'August'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'August'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'August'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'August'); ?>
				</td>
			</tr>
			<tr>
				<td>September</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'September'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'September'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'September'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'September'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'September'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'September'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'September'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'September'); ?>
				</td>
			</tr>
			<tr>
				<td>October</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'October'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'October'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'October'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'October'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'October'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'October'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'October'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'October'); ?>
				</td>
			</tr>
			<tr>
				<td>November</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'November'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'November'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'November'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'November'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'November'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'November'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'November'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'November'); ?>
				</td>
				</td>
			</tr>
			<tr>
				<td>December</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '01', 'December'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '02', 'December'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '03', 'December'); ?>
				</td>
				<td style="width: 85px; text-align: right;">
					<?= $model->getRegistry($year, $fund_cluster, '04', 'December'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJantotal($year, $fund_cluster, 'December'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJancheck($year, $fund_cluster, 'December'); ?>
				</td>
				<td style="text-align: right;">
					<?= $model->getJanlddap($year, $fund_cluster, 'December'); ?>
				</td>
				<td style="width: 120px; text-align: right; font-weight: bold;">
					<?= $model->getJandisbursement($year, $fund_cluster, 'December'); ?>
				</td>
			</tr>
		</table>
	</div>
</div>


<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
");
?>