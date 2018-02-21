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
                <td width="50" style="font-weight: bold">NCA No.</td><td><?= ': '.$model3->nca_no ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Amount</td><td><?= ': '.number_format($model3->total_amount, 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Total Amount Obligated</td>
                <td><?= ': '.number_format(array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])->where(['nca'=>$model->nca])->andWhere(['obligated'=>'yes'])->all(), 'net_amount')), 2) ?></td>
            </tr>
            <tr>
                <td style="font-weight: bold">Current Balance</td>
                <td><?= ': '. number_format($model3->total_amount - array_sum(ArrayHelper::getColumn(Disbursement::find(['net_amount'])->where(['nca'=>$model->nca])->andWhere(['obligated'=>'yes'])->all(), 'net_amount')), 2) ?></td>
            </tr>
             <tr>
                <td style="font-weight: bold">Fund</td><td><?= ': '.$model3->fund_cluster ?></td>
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
            <tr <?php if($value->id === $model->id) : ?> style="background-color: #d8ffcc" <?php endif ?> >
                <td><?= $value->date ?></td>
                <td><?= $value->payee ?></td>
                <td><?= $value->mfo_pap ?></td>
                <td><?= $value->ors_class.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial?></td>
                <td><?= $value->dv_no ?></td>
                <td><?= number_format($value->gross_amount, 2) ?></td>
                <td><?php
                    if(($value->ors_class === '01') && ($value->ors_year === $model3->fiscal_year))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '02') && ($value->ors_year === $model3->fiscal_year))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '03') && ($value->ors_year === $model3->fiscal_year))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '06') && ($value->ors_year === $model3->fiscal_year))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>

                <td><?php
                    if(($value->ors_class === '01') && ($value->ors_year === strval($model3->fiscal_year-1)))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '02') && ($value->ors_year === strval($model3->fiscal_year-1)))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '03') && ($value->ors_year === strval($model3->fiscal_year-1)))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                 ?></td>
                <td><?php
                    if(($value->ors_class === '06') && ($value->ors_year === strval($model3->fiscal_year-1)))
                    {
                        echo number_format($value->net_amount, 2);
                    }
                    ?>
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

