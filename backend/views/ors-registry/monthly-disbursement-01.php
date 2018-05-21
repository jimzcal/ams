<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Disbursement;
use backend\models\OrsRegistry;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly Disbursement';
?>
<div class="cash-advance-index">

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
				<td colspan="9" style="text-align: center; font-weight: bold;">For Fiscal Year <?= $year ?></td>
			</tr>
			<tr>
				<td colspan="9" style="text-align: center; font-weight: bold;">For Fund Cluster: 01</td>
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
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'January'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'January'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'January'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'January'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'January'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'January'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'January'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lddap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'January'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>February</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'February'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'February'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'February'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['ors_month' => '02'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'February'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'February'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'February'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lddap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'February'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>March</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'March'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'March'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'March'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andwhere(['like', 'disbursement_date', 'March'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andwhere(['like', 'disbursement_date', 'March'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'March'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'March'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'date', 'March'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>April</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'April'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'April'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'April'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'April'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'April'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'April'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'April'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'April'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>May</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'May'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'May'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'May'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'May'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['like', 'disbursement_date', 'May'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'May'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'May'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'May'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>June</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'June'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'June'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'June'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'June'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['like', 'disbursement_date', 'June'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'June'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'June'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'June'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>July</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'July'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'July'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'July'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'July'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'July'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'July'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'July'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'July'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>August</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'August'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'August'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'August'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'August'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'August'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'August'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'August'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'August'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>September</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'September'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'September'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'September'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'September'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'September'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'September'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'September'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'September'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>October</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'October'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'October'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'October'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'October'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['like', 'disbursement_date', 'October'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'October'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'October'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'October'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>November</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'November'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'November'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'November'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'November'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'November'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'November'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'November'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'November'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
			</tr>
			<tr>
				<td>December</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'01'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'December'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'02'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'December'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'03'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'December'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 85px;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['ors_class'=>'04'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'December'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(OrsRegistry::find(['net_amount'])
                                        ->where(['like', 'disbursement_date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'disbursement_date', 'December'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['like', 'date', 'December'])
                                        ->andWhere(['mode_of_payment' => 'mds_check'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td>
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'December'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['mode_of_payment' => 'lldap_ada'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
				</td>
				<td style="width: 120px; font-weight: bold;">
					<?=
						number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])
                                        ->where(['like', 'date', $year])
                                        ->andWhere(['like', 'date', 'December'])
                                        ->andWhere(['fund_cluster'=>'01'])
                                        ->andWhere(['status' => 'Paid'])
                                        ->all(), 'net_amount')), 2);
					 ?>
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