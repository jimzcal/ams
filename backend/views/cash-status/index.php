<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\CashStatus;
use yii\helpers\ArrayHelper;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CASH STATUS';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cash-status-index">
    <div class="title"><?= Html::encode($this->title) ?></div>
    <div class="cash-status">
        <table class="table table-condensed">
            <tr>
                <td width="50" style="font-weight: bold">NCA No.</td>
                <td><?= ': '.$nca->nca_no ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Amount</td>
                <td><?= ': '.number_format($nca->total_amount, 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Total Amount Obligated</td>
                <td><?= ': '.number_format(array_sum(ArrayHelper::getColumn(CashStatus::find(['disbursement_amount'])->where(['nca_no'=>$nca->nca_no])->all(), 'disbursement_amount')), 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Current Balance</td>
                <td><?= ': '.number_format($nca->total_amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['disbursement_amount'])->where(['nca'=>$nca->nca_no])->all(), 'net_amount')), 2) ?></td>
            </tr>
             <tr>
                <td style="font-weight: bold">Fund</td>
                <td><?= ': '.$nca->fund_cluster ?></td>
            </tr>
        </table>
    </div>
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
                <td><?= number_format($value->gross_amount, 2) ?></td>
                <td>
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '02' && $value->ors->ors_year === date('Y')) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '03' && $value->ors->ors_year === date('Y')) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '06' && $value->ors->ors_year === date('Y')) ? $value->net_amount : '' ?>
                </td>

                <td>
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1 ) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? $value->net_amount : '' ?>
                </td>
                <td>
                    <?= ($value->ors->ors_class === '01' && $value->ors->ors_year === date('Y')+1) ? $value->net_amount : '' ?>
                </td>
                <td><?= $value->status ?></td>
            </tr>
            <?php endforeach ?>
        </table>
</div>
<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
    $('tbody th').css('background-color', '#f5f5f0'); ");

?>

