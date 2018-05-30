<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\accountingEntry;
use backend\models\FundCluster;
use backend\models\Nca;
use backend\models\Ors;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'DISBURSEMENT VOUCHER';
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
                    <table class="table table-condensed">
                        <tr>
                            <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                                <?= isset($dv_no) ? $dv_no : $model->dv_no ?></td>
                            <td style="font-size: 18px; text-align: right; font-weight: bold;" colspan="3">
                                <?= $model->date===null ? date('M. d, Y') : $model->date ?>
                                <?= $form->field($model, 'date')->hiddenInput(['value' => $model->date===null ? date('M. d, Y') : $model->date, 'readonly' =>true])->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Payee :</td>
                            <td colspan="3">
                                <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'id'=>'four'])->label(false) ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">cash Advance :</td>
                            <td>
                                <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes', 'liquidated'=>'Liquidated'])->label(false)?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Transaction Type :</td>
                            <td colspan="3">
                                <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type'])->label(false) ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">Mode of payment :</td>
                            <td>
                                <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA'])->label(false) ?>
                            </td>
                        </tr>


                        <tr>
                            <td style="text-align: right; font-weight: bold;">Fund Cluster :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                                 [
                                    'onchange'=>'
                                         $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                            $("select#disbursement-nca").html(data);
                                        });'
                                ])->label(false); ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">Gross Amount :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'id'=>'nine'])->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">NCA No. :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no'))->label(false) ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">Less :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'less_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value'=> array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount'))])->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right; font-weight: bold;">Funding Source :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'funding_source')->dropDownList(ArrayHelper::map(Nca::find()->all(),'funding_source', 'funding_source'),
                                    [
                                      'prompt'=>'Select Funding Source',
                                    ])->label(false);
                                 ?>
                            </td>
                            <td style="text-align: right; font-weight: bold;">Net Amount :</td>
                            <td colspan="2">
                                <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value' => ($net_amount = $model->gross_amount - array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount')))])->label(false) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="background-color: #f5f5f0; font-weight: bold;">Details From Obligartion Request and Status (ORS)</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table class="table table-condensed table-bordered">
                                        <tr>
                                            <th style="text-align: center">Particulars</th>
                                            <th style="text-align: center">ORS No</th>
                                            <th style="text-align: center">MFO/PAP</th>
                                            <th style="text-align: center">Responsibility Center</th>
                                            <th style="text-align: center">Amount</th>
                                        </tr>
                                        <?php 
                                              $i = 0;
                                              $ors = explode(',', $model->ors);
                                              for($x=0; $x<sizeof($ors); $x++) : 
                                        ?>
                                        <?php $ors_details = Ors::find()->where(['id' => $ors[$x]])->one(); ?>
                                            <tr>
                                                <td>
                                                  <?= $form->field($model, 'particular[$i]')->textInput(['value' => $ors_details->particular, 'class' => 'myfield'])->label(false) ?>
                                                    <?= $form->field($model, 'ors_id[$i]')->hiddenInput(['value' => $ors_details->id])->label(false) ?>
                                                </td>
                                                <td>
                                                    <?= $form->field($model, 'ors_no[$i]')->textInput([
                                                        'value' => $ors_details->ors_class.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial, 'class' => 'myfield'])->label(false) 
                                                    ?>
                                                </td>
                                                <td>
                                                    <?= $form->field($model, 'mfo_pap[$i]')->textInput(['value' => $ors_details->mfo_pap, 'class' => 'myfield'])->label(false) ?>
                                                </td>
                                                <td style="width: 100px;">
                                                    <?= $form->field($model, 'responsibility_center[$i]')->textInput(['value' => $ors_details->responsibility_center, 'class' => 'myfield'])->label(false) ?>
                                                </td>
                                                <td>
                                                    <?= $form->field($model, 'amount[$i]')->textInput(['value' => $ors_details->amount, 'class' => 'myfield'])->label(false) ?>
                                                </td>
                                            </tr>
                                          <?php $i++; ?>
                                        <?php endfor ?>
                                    </table>
                            </td>
                        </tr>
                
                        <tr>
                            <td colspan="6" style="background-color: #f5f5f0; font-weight: bold;">Accounting Entry</td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="text-align: center">ACCOUNT TITLE</th>
                                        <th style="text-align: center">UACS CODE</th>
                                        <th style="text-align: center">DEBIT</th>
                                        <th style="text-align: center">CREDIT AMOUNT</th>
                                        <th style="text-align: center">CREDIT TO</th>
                                        <th>ACTION</th>
                                    </tr>
                                    <?php foreach ($entries as $entry) : ?>
                                    <tr>
                                        <td><?= $entry->account_title ?></td>
                                        <td><?= $entry->uacs_code ?></td>
                                        <td width="75"><?= number_format($entry->debit, 2) ?></td>
                                        <td width="100"><?= number_format($entry->credit_amount, 2) ?></td>
                                        <td width="80"><?= $entry->credit_to ?></td>
                                        <td width="75">
                                            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ["/accounting-entry/update", 'id' => $entry->id, 'dv_id' => $model->id]) ?>
                                            <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ["/accounting-entry/delete", 'id' => $entry->id], [
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                    <tr>
                                        <td colspan="2" style="font-size: 18px;"><strong>TOTAL</strong></td>
                                        <td>
                                            <?php $totalDebit = AccountingEntry::find(['debit'])->where(['dv_no'=>$model->dv_no])->all();
                                                   echo number_format(array_sum(ArrayHelper::getColumn($totalDebit, 'debit')), 2); ?>
                                        </td>
                                        <td>
                                            <strong>
                                                <?php $total = AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->all();
                                                   echo number_format(array_sum(ArrayHelper::getColumn($total, 'credit_amount')), 2);
                                                ?>
                                            </strong> 
                                         </td>
                                        <td width="80"></td>
                                        <td width="75"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?= $form->field($model, 'remarks')->textarea(['rows' => 3]) ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-3" style="padding-top: 10px;">
                    <div class="title">
                        <span class="glyphicon glyphicon-paperclip"></span>
                        <?= Html::encode('ATTACHMENTS') ?>
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
        <div class="form-group" style="padding-left: 10px;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Accountig Entry', ['/accounting-entry/create', 'id'=>$model->id, 'net' => $net_amount, 'gross' => $model->gross_amount], ['class' => 'btn btn-primary'])
             ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>



