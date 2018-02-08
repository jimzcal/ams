<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use barcode\barcode\BarcodeGenerator;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */

$this->title = $model->dv_no;
//$this->params['breadcrumbs'][] = ['label' => 'Disbursements', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-view">
    <div class="tracking-form">
        <div id="noprint">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                <!-- <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?> -->
            </p>
        </div>
        <table class="table table-bordered">
            <tr>
                <td colspan="7" class="tracking">
                    Department of Agriculture </br>
                    Financial Management Service - Accounting Division </br>
                    <strong>TRACKING FORM</strong>
                </td>
            </tr>
            <tr>
                <td width="45" rowspan="3" colspan="3" align="center">
                    <?php 
                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                        echo $generator->getBarcode($model->dv_no, $generator::TYPE_CODE_128, 2, 80);
                    ?>
                    <p><?= $model->dv_no ?></p>
                </td>
                <td width="100" align="right">Payee:</td><td colspan="3"><strong><?= $model->payee; ?></strong></td>
            </tr>
            <tr>
                <td width="100" align="right">Mode of Payment:</td><td><strong><?= $model->mode_of_payment; ?></strong></td><td width="100" align="right">Responsibility Center:</td><td><strong><?= $model->responsibility_center; ?></strong></td>
            </tr>
            <tr>
                <td align="right">MFO/PAP:</td><td colspan="3"><strong><?= $model->mfo_pap; ?></strong></td>
            </tr>
            <tr>
                <td align="right">Gross Amount:</td><td colspan="2" width="35"><strong><?= number_format($model->gross_amount, 2); ?></strong></td><td colspan="4" width="200">This transaction should have the following documentary requirements:</td>
            </tr>
            <tr>
                <td align="right">Fund Source:</td><td colspan="2" width="35"><strong><?= $model->fund_source; ?></strong></td><td colspan="4" width="200" rowspan="6">
                    <?php
                        $attachments = Disbursement::find(['attachments'])->where(['id'=>$model->id])->one();
                        $attachments = explode(',', $attachments->attachments);
                        $req = Transaction::find(['requirements'])->where(['id'=>$model->transaction_id])->one();
                        $req = explode(',', $req->requirements);

                        $lacking = array_diff($req, $attachments);
                    ?>
                    <?php foreach ($attachments as $attached) : ?>
                        <input type="checkbox" class="checkbox" checked="true" name="requirements[<?= $attached ?>]" value="<?= $attached ?>">
                        <label><?= $attached ?></label>
                    <?php endforeach ?>

                    <?php foreach ($lacking as $lack) : ?>
                        <input type="checkbox" class="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                        <label><?= $lack ?></label>
                    <?php endforeach ?>
                </td>
            </tr>
            <tr>
                <td align="right">ORS No.:</td><td colspan="2" width="35"><strong><?= $model->ors_no; ?></strong></td>
            </tr>
            <tr>
                <td align="right">Less Amount:</td><td colspan="2" width="35"><strong><?= number_format($model->less_amount, 2); ?></strong></td>
            </tr>
            <tr>
                <td align="right">Net Amount:</td><td colspan="2" width="35"><strong><?= number_format($model->net_amount, 2); ?></strong></td>
            </tr>
            <tr>
                <td align="center" colspan="3"><strong>TRANSACTION STATUS</strong></td>
            </tr>
            <tr>
                <td align="center"><strong>Transaction</strong></td><td align="center"><strong>Received By</strong></td><td align="center"><strong>Date/Time</strong></td>
            </tr>
            <tr>
                <td width="70">Receiving</td><td width="120"><?= $transaction1[0] ?></td><td width="120"><?= $transaction1[1] ?></td><td colspan="4" align="center"><strong>REMARKS</strong></td>
            </tr>
            <tr>
                <td width="70">Processing</td><td width="120"><?= isset($transaction2[0]) ? $transaction2[0] : '' ?></td><td width="120"><?= isset($transaction2[1]) ? $transaction2[1] : '' ?></td><td colspan="4" rowspan="5" style="font-size: 14px;"><?= $model->remarks ?></td>
            </tr>
            <tr>
                <td width="70">Verification</td><td width="120"><?= isset($transaction3[0]) ? $transaction3[0] : '' ?></td><td width="120"><?= isset($transaction3[1]) ? $transaction3[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">NCA Control</td><td width="120"><?= isset($transaction4[0]) ? $transaction4[0] : '' ?></td><td width="120"><?= isset($transaction4[1]) ? $transaction4[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">LDDAP/ADA</td><td width="120"><?= isset($transaction5[0]) ? $transaction5[0] : '' ?></td><td width="120"><?= isset($transaction5[1]) ? $transaction5[1] : '' ?></td>
            </tr>
            <tr>
                <td width="70">Releasing</td><td width="120"><?= isset($transaction6[0]) ? $transaction6[0] : '' ?></td><td width="120"><?= isset($transaction6[1]) ? $transaction6[1] : '' ?></td>
            </tr>
        </table>
    </div>
</div>
