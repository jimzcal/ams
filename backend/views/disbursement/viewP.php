<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\accountingEntry;
use backend\models\FundCluster;
use backend\models\Nca;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'DISBURSEMENT VOUCHER';
?>

<div class="disbursement-form">
    <?= Html::a('&times;', ['/site/index'], ['class' => 'close']) ?>
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
                        <td>
                            DV NO.<br>
                            <strong><?= isset($dv_no) ? $dv_no : $model->dv_no ?></strong>
                        </td>
                        <td colspan="1">
                            <?= $form->field($model, 'transaction_id')->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type']) ?>
                        </td>
                        <td width="160">
                            <label>Cash Advance?</label></br>
                            <?= $form->field($model, 'cash_advance')->dropDownList(['no'=>'No', 'yes'=>'Yes', 'liquidated'=>'Liquidated', 'id' => 'two'])->label(false)?>
                        </td>
                        <td>
                            <?= $form->field($model, 'mode_of_payment')->dropDownList(['mds_check'=>'MDS Check', 'commercial_check'=>'Commercial Check', 'lldap_ada'=>'LLDAP-ADA']) ?>
                        </td>
                        <td width="120">
                            <?= $form->field($model, 'date')->textInput(['value' => $model->date===null ? date('M. d, Y') : $model->date, 'readonly' =>true]) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?= $form->field($model, 'payee')->textInput(['maxlength' => true, 'id'=>'four']) ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                             [
                                'onchange'=>'
                                     $.post("index.php?r=nca/clusters&fund_cluster='.'"+$(this).val(),function(data){
                                        $("select#disbursement-nca").html(data);
                                    });'
                            ]); ?>
                        </td>
                        <td>
                            <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no')) ?>
                        </td>
                    </tr>
                        <tr>
                            <td colspan="5">
                                <table class="table table-condensed">
                                    <tr>
                                        <th>Particulars</th>
                                        <th>ORS No</th>
                                        <th>MFO/PAP</th>
                                        <th>Responsibility Center</th>
                                        <th>Amount</th>
                                    </tr>
                                    <?php foreach ($ors_model as $value): ?>
                                        <?php $i=0; ?>
                                        <tr>
                                            <td style="width: 250px;">
                                                <?= $form->field($model, 'particular[]')->textInput(['value' => $value->particular])->label(false) ?>
                                                <?= $form->field($model, 'ors_id[]')->hiddenInput(['value' => $value->id])->label(false) ?>
                                            </td>
                                            <td style="width: 130px;">
                                                <?= $form->field($model, 'ors_no[]')->textInput([
                                                    'value' => $value->ors_class.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial ])->label(false) 
                                                ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'mfo_pap[]')->textInput(['value' => $value->mfo_pap])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'responsibility_center[]')->textInput(['value' => $value->responsibility_center])->label(false) ?>
                                            </td>
                                            <td style="width: 100px;">
                                                <?= $form->field($model, 'amount[]')->textInput(['value' => $value->amount])->label(false) ?>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach ?>
                                </table>
                            </td>
                        </tr>
                    <tr>
                        <td colspan="3">
                            <?= $form->field($model, 'gross_amount')->textInput(['maxlength' => true, 'id'=>'nine']) ?>
                        </td>
                        <td width="120">
                            
                            <?= $form->field($model, 'less_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value'=> array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount'))]) ?>
                        </td>
                        <td>
                            
                            <?= $form->field($model, 'net_amount')->textInput(['maxlength' => true, 'readonly'=>false, 'value' => ($net_amount = $model->gross_amount - array_sum(ArrayHelper::getColumn(AccountingEntry::find(['credit_amount'])->where(['dv_no'=>$model->dv_no])->andWhere(['credit_to' => 'BIR'])->all(), 'credit_amount')))]) ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <label>Accounting Entry</label>
                            <table class="table table-bordered">
                                <tr>
                                    <td align="center">ACCOUNT TITLE</td>
                                    <td align="center">UACS CODE</td>
                                    <td align="center">DEBIT</td>
                                    <td align="center">CREDIT AMOUNT</td>
                                    <td align="center">CREDIT TO</td>
                                    <td>ACTION</td>
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
                        <td colspan="5"><?= $form->field($model, 'remarks')->textarea(['rows' => 3]) ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-3">
                <div class="title">
                    <?= Html::encode('Attachments') ?>
                </div>
                <table class="table table-bordered" height="620">
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
                                    <label><?= $attached ?></label><br>
                                <?php endif ?>
                            <?php endforeach ?>

                            <?php foreach ($lacking as $lack) : ?>
                                <input type="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                                <label><?= $lack ?></label><br>
                            <?php endforeach ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Accountig Entry', ['/accounting-entry/create', 'id'=>$model->id, 'net' => $net_amount, 'gross' => $model->gross_amount], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

// var seven = document.getElementById("seven"),
//     nine = document.getElementById("nine");

// if (sessionStorage.getItem("seven") || sessionStorage.getItem("nine"))
// {
//     seven.value = sessionStorage.getItem("seven");
//     nine.value = sessionStorage.getItem("nine");
// }

// seven.addEventListener("change", function() {
//     sessionStorage.setItem("seven", seven.value);
// });

// nine.addEventListener("change", function() {
//     sessionStorage.setItem("nine", nine.value);
// });

</script>
