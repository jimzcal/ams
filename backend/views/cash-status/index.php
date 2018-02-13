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
                <td width="50" style="font-weight: bold">NCA No.</td><td><?= ': '.$nca->nca_no ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Amount</td><td><?= ': '.number_format($nca->amount, 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Total Amount Obligated</td><td><?= ': '.number_format(array_sum(ArrayHelper::getColumn(CashStatus::find(['disbursement_amount'])->where(['nca_no'=>$nca->nca_no])->all(), 'disbursement_amount')), 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Current Balance</td><td><?= ': '.number_format($nca->amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['disbursement_amount'])->where(['nca'=>$nca->nca_no])->all(), 'net_amount')), 2) ?></td>
            </tr>
             <tr>
                <td style="font-weight: bold">Fund</td><td><?= ': '.$nca->fund_cluster ?></td>
            </tr>
        </table>
    </div>
        <table class="table table-condensed table-bordered" style="font-size: 11px;">
            <tr>
                <th align="center" rowspan="2">DATE</th><th rowspan="2">PAYEE/CREDITOR</th><th rowspan="2">MFO/PAP</th><th rowspan="2">ORS NO.</th><th rowspan="2">DV NO.</th><th rowspan="2">GROSS AMOUNT</th><th colspan="4">CURRENT YEAR ALLOTMENT</th><th colspan="4">PRIOR YEAR'S ALLOTMENT</th><th rowspan="2">STATUS</th>
            </tr>
            <tr>
                <th>PS</th><th>MOOE</th><th>FinEx</th><th>CO</th><th>PS</th><th>MOOE</th><th>FinEx</th><th>CO</th>
            </tr>
            <?php foreach ($disbursements as $value) : ?>
            <tr>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one(); echo $data->date ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one(); echo $data->payee ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one(); echo $data->mfo_pap ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one(); echo $data->ors_no ?></td>
                <td><?= $value->dv_no ?></td>
                <td><?= number_format($value->disbursement_amount, 2) ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '01') && ($ors[1] === $nca->year))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '02') && ($ors[1] === $nca->year))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '03') && ($ors[1] === $nca->year))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '06') && ($ors[1] === $nca->year))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>

                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '01') && ($ors[1] === strval($nca->year-1)))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '02') && ($ors[1] === strval($nca->year-1)))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '03') && ($ors[1] === strval($nca->year-1)))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one();
                    $ors = explode('-',$data->ors_no);
                    if(($ors[0] === '06') && ($ors[1] === strval($nca->year-1)))
                    {
                        echo number_format($data->net_amount, 2);
                    }
                 ?></td>
                <td><?php $data = Disbursement::find()->where(['dv_no' => $value->dv_no])->one(); echo $data->status ?></td>
            </tr>
            <?php endforeach ?>
        </table>
</div>
<?php
$this->registerJs("
    $('tbody th').css('text-align', 'center');
    $('tbody th').css('background-color', '#f5f5f0'); ");

?>

