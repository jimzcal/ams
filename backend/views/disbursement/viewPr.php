<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\accountingEntry;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Disbursement Voucher';
?>

<div class="disbursement-form">
    <?= Yii::$app->session->getFlash('error'); ?>
    <div class="form-wrapper">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="title">
                    <?= Html::encode($this->title) ?>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td><labe>DV NO.</labe></br><strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong></td>
                        <td colspan="1">
                            <label>Transaction-Type:</label></br>
                            <?php $trans = transaction::find()->where(['id'=>$model->transaction_id])->one(); echo $trans->name; ?>
                        </td>
                        <td width="160">
                            <label>Cash Advance?</label></br>
                            <?= $model->cash_advance ?>
                        </td>
                        <td><label>NCA No.</label></br><?= $model->nca ?></td>
                        <td><label>Date:</label></br><?= $model->date ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label>Payee:</label></br>
                            <?= $model->payee ?>
                        </td>
                        <td><label>Responsibility Center:</label></br><?= $model->responsibility_center ?></td>
                        <td><label>ORS No.</label></br><?= $model->ors_no ?></td>
                    </tr>
                    <tr>
                        <td colspan="3"><label>Particulars</label></br><?= $model->particulars ?>
                        </td>
                        <td width="120"><label>MFO/PAP:</label></br><?= $model->mfo_pap ?></br>
                            <label>Less Amount:</label></br>
                            <?= number_format($model->less_amount, 2) ?>
                        </td>
                        <td><label>Gross Amount:</label></br><?= number_format($model->gross_amount, 2) ?></br>
                            <label>Net Amount:</label></br><?= number_format($model->net_amount, 2) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <label>Accounting Entry</label>
                            <table class="table table-bordered">
                                <tr>
                                    <td align="center">ACCOUNT TITLE</td><td align="center">UACS CODE</td><td align="center">DEBIT</td><td align="center">CREDIT AMOUNT</td><td align="center">CREDIT TO</td>
                                </tr>
                                <?php foreach ($entries as $entry) : ?>
                                <tr>
                                    <td><?= $entry->account_title ?></td>
                                    <td><?= $entry->uacs_code ?></td>
                                    <td width="75"><?= number_format($entry->debit, 2) ?></td>
                                    <td width="100"><?= number_format($entry->credit_amount, 2) ?></td>
                                    <td width="80"><?= $entry->credit_to ?></td>
                                </tr>
                            <?php endforeach ?>
                                <tr>
                                    <td colspan="3" style="font-size: 18px;"><strong>TOTAL</strong></td>
                                    <td>
                                        <strong>
                                            <?php $total = AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->all();
                                               echo number_format(array_sum(ArrayHelper::getColumn($total, 'credit_amount')), 2);
                                            ?>
                                        </strong>
                                     </td>
                                    <td width="80"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><label>Remarks</label></br><?= $model->remarks ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <div class="title">
                    <?= Html::encode('Attachments') ?>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <?php
                                $attachments = Disbursement::find(['attachments'])->where(['id'=>$model->id])->one();
                                $attachments = explode(',', $attachments->attachments);
                                $req = Transaction::find(['requirements'])->where(['id'=>$model->transaction_id])->one();
                                $req = explode(',', $req->requirements);

                                $lacking = array_diff($req, $attachments);
                            ?>

                            <?php foreach ($attachments as $attached) : ?>
                                <input type="checkbox" class="checkbox" checked="true" name="requirements[<?= $attached ?>]" value="<?= $attached ?>">
                                <label><?= $attached ?></label></br>
                            <?php endforeach ?>

                            <?php foreach ($lacking as $lack) : ?>
                                <input type="checkbox" class="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                                <label><?= $lack ?></label></br>
                            <?php endforeach ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-group">
            <?= Html::a('Update', ['/disbursement/processor', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
