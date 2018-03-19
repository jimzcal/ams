<?php

//use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\CashStatus;
use yii\helpers\ArrayHelper;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// creates a URL to a route with parameters: /index.php?r=post%2Fview&id=100
// echo Url::to(['cash/index', 'nca_no' => $nca->nca_no]);

$this->title = 'CASH STATUS';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cash-status-index">
    
    <div class="view-index">
        <div class="mini-header">
            <i class="fa fa-bar-chart-o" aria-hidden="true"></i> Cash Status
        </div>
        <table class="table table-condensed table-bordered">
            <tr>
                <th>NCA No.</th>
                <th>Fund Cluster</th>
                <th>Total Amount</th>
                <th>Amount Obligated</th>
                <th>Current Balance</th>
            </tr>
            <tr>
                <td><?= $nca->nca_no ?></td>
                <td><?= $nca->fund_cluster ?></td>
                <td><?= number_format($nca->total_amount, 2) ?></td>
                <td>
                    <?= number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['disbursement_amount'])->where(['nca'=>$nca->nca_no])->andWhere(['obligated' => 'yes'])->all(), 'net_amount')), 2) ?>
                </td>
                <td style="font-weight: bold; font-size: 18px; text-align: right">
                    <?= number_format($nca->total_amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['disbursement_amount'])->where(['nca'=>$nca->nca_no])->andWhere(['obligated' => 'yes'])->all(), 'net_amount')), 2) ?>
                </td>
            </tr>
        </table>
    </div>
    <div style="padding: 3px; border-radius: 8px; background-color: #FFFFFF">
        <table class="table table-condensed table-bordered" style="font-size: 11px;">
            <tr>
                <th align="center" rowspan="2">DATE</th>
                <th rowspan="2">PAYEE/CREDITOR</th>
                <th rowspan="2">MFO/PAP</th>
                <th rowspan="2">ORS NO.</th>
                <th rowspan="2">DV NO.</th>
                <th rowspan="2">GROSS AMOUNT</th>
                <th colspan="4">CURRENT YEAR ALLOTMENT</th>
                <th colspan="4">PRIOR YEAR'S ALLOTMENT</th>
                <th rowspan="2">STATUS</th>
            </tr>
            <tr>
                <th>PS</th><th>MOOE</th><th>FinEx</th><th>CO</th><th>PS</th><th>MOOE</th><th>FinEx</th><th>CO</th>
            </tr>
            <?php foreach ($disbursements as $value) : ?>
            <tr>
                <td>
                    <?= $value->date ?>
                </td>
                <td>
                    <?= $value->payee ?>
                </td>
                <td>
                    <?= $value->ors->mfo_pap ?>
                </td>
                <td>
                    <?= $value->ors->ors_class.'-'.$value->ors->ors_year.'-'.$value->ors->ors_month.'-'.$value->ors->ors_serial ?>
                </td>
                <td><?= $value->dv_no ?></td>
                <td style="text-align: right;"><?= number_format($value->gross_amount, 2) ?></td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '02' && $value->ors->ors_year === date('Y')) ? number_format(
                        $value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '03' && $value->ors->ors_year === date('Y')) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '06' && $value->ors->ors_year === date('Y')) ? number_format($value->net_amount, 2) : '' ?>
                </td>

                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1 ) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td style="text-align: right;">
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? number_format($value->net_amount, 2) : '' ?>
                </td>
                <td><?= $value->status ?></td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<?php
$this->registerJs("
    
    $('tbody th').css('background-color', '#f5f5f0'); ");

?>

