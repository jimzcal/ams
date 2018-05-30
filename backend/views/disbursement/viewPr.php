<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\accountingEntry;
use backend\models\Ors;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Disbursement Voucher';
?>

<div class="disbursement-form">
    <?= Yii::$app->session->getFlash('error'); ?>
    <div class="form-wrapper">
        <div class="form-title">
            <?= Html::encode($this->title) ?>
            <?= Html::a('&times;', ['/site/index'], ['class' => 'close-button']) ?>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-wrapper-content">
            <div class="row">
                <div class="col-md-9">
                    <table class="table">
                        <tr>
                            <td>
                                DV NO.<br>
                                <strong style="font-size: 14px;"><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
                            </td>
                            <td colspan="1">
                                
                            </td>
                            <td width="160">
                                Transaction:<br>
                                <strong style="font-size: 14px;"><?= $model->cash_advance ==='yes' ? 'Cash Advance' : 'For Disbursement' ?></strong>
                            </td>
                            <td>
                                Mode of Payment:<br>
                                <strong style="font-size: 14px;"><?= $model->mode_of_payment ?></strong>
                            </td>
                            <td width="120">
                                Date:<br>
                                <strong style="font-size: 14px;"><?= $model->date ?></strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Payee:<br>
                                <strong style="font-size: 14px;"><?= $model->payee ?></strong>
                            </td>
                            <td>
                                Fund Cluster:<br>
                                <strong style="font-size: 14px;"><?= $model->fund_cluster ?></strong>
                            </td>
                            <td>
                                NCA No.:<br>
                                <strong style="font-size: 14px;"><?= $model->nca ?></strong>
                            </td>
                        </tr>
                            <tr>
                                <td colspan="5">
                                    <table class="table table-condensed table-strped">
                                        <tr>
                                            <th>Particulars</th>
                                            <th>ORS No</th>
                                            <th>MFO/PAP</th>
                                            <th>Responsibility Center</th>
                                            <th>Amount</th>
                                        </tr>
                                        <?php 
                                              $ors = explode(',', $model->ors);
                                              for($x=0; $x<sizeof($ors); $x++) : 
                                        ?>
                                        <?php $ors_details = Ors::find()->where(['id' => $ors[$x]])->one(); ?>
                                            <tr>
                                                <td>
                                                  <?= $ors_details->particular ?>
                                                </td>
                                                <td>
                                                    <?= $ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $ors_details->mfo_pap; ?>
                                                </td>
                                                <td style="width: 100px;">
                                                    <?= $ors_details->responsibility_center ?>
                                                </td>
                                                <td>
                                                    <?= $ors_details->amount ?>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
                                    </table>
                                </td>
                            </tr>
                        <tr>
                            <td colspan="3">
                                Gross Amount: <br>
                                <strong style="font-size: 16px;"><?= number_format($model->gross_amount, 2) ?></strong>
                            </td>
                            <td width="120">
                                Less Amount: <br>
                                <strong style="font-size: 16px;"><?= number_format($model->less_amount, 2) ?>
                            </td>
                            <td>
                                Net Amount: <br>
                                <strong style="font-size: 16px;"><?= number_format($model->net_amount, 2) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <label>Accounting Entry</label>
                                <table class="table table-bordered">
                                    <tr>
                                        <td align="center">ACCOUNT TITLE</td><td align="center">UACS CODE</td>
                                        <td align="center">DEBIT</td>
                                        <td align="center">CREDIT AMOUNT</td>
                                        <td align="center">CREDIT TO</td>
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
                                        <td colspan="2" style="font-size: 18px;"><strong>TOTAL</strong></td>
                                        <td>
                                            <strong>
                                                <?php $totalDebit = AccountingEntry::find(['debit'])->where(['dv_no'=>$model->dv_no])->all();

                                                   echo number_format(array_sum(ArrayHelper::getColumn($totalDebit, 'debit')), 2);
                                                ?>
                                            </strong>
                                        </td>
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
                            <td colspan="5">
                                <label>Remarks:</label><br>
                                <?= $model->remarks ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3" style="padding-top: 10px;">
                    <div class="title">
                        <span class="glyphicon glyphicon-paperclip"></span>
                        <?= Html::encode('Attachments') ?>
                    </div>
                    <table class="table">
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
                                    <?php if($attached !== '') : ?>
                                        <input type="checkbox" checked="true" name="requirements[<?= $attached ?>]" value="<?= $attached ?>">
                                        <label style="font-size: 10px;"><?= $attached ?></label><br>
                                    <?php endif ?>
                                <?php endforeach ?>

                                <?php foreach ($lacking as $lack) : ?>
                                    <input type="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                                    <label style="font-size: 10px;"><?= $lack ?></label><br>
                                <?php endforeach ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group" style="padding-left: 15px;">
            <?= Html::a('Update', ['/disbursement/processor', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>
