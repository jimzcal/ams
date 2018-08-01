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
use backend\models\OrsRegistry;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'DISBURSEMENT VOUCHER';
?>

<div class="disbursement-form">
    <?= Yii::$app->session->getFlash('error'); ?>

   <!--  <div class="form-title">
        <?= Html::encode($this->title) ?>
        <?= Html::a('&times;', ['/site/index'], ['class' => 'close-button']) ?>
    </div> -->

    <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Vouchers (DV)
    </div>

    <div class="view-index">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-wrapper-content">
            <div class="row">
                <div class="col-md-9">
                    <table class="mytable">
                        <tr style="border-bottom-style: dashed; border-color: #e0e0d1;">
                            <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                                <?= isset($dv_no) ? $dv_no : $model->dv_no ?></td>
                            <td style="font-size: 18px; text-align: right; font-weight: bold;" colspan="3">
                                <?= $model->date===null ? date('M. d, Y') : $model->date ?>
                                <?= $form->field($model, 'date')->hiddenInput(['value' => $model->date===null ? date('M. d, Y') : $model->date, 'readonly' =>true])->label(false) ?>
                            </td>
                        </tr>
                        <tr style="height: 10px;">
                            
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table class="table table-striped table-condensed" style="border: solid 1px #d9d9d9; border-radius: 15px;">
                                    <tr>
                                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">Payee</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                                        <td> 
                                            <?= $form->field($model, 'payee', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'id'=>'four', 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 140px; color: #666666; font-size: 13px;">Fund Cluster</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'fund_cluster', ['options' => ['tag' => false]])->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'), ['class' => 'textfield'])->label(false); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Transaction Type</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'transaction_id', ['options' => ['tag' => false]])->dropDownList(ArrayHelper::map(transaction::find()->all(),'id', 'name'), ['prompt' => 'Select Transaction Type', 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Gross Amount</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'gross_amount', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Less Amount</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'less_amount', ['options' => ['tag' => false]])->textInput(['class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Net Amount</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'net_amount', ['options' => ['tag' => false]])->textInput(['class' => 'textfield'])->label(false) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Particulars</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td>
                                            <?= $form->field($model, 'particulars', ['options' => ['tag' => false]])->textArea(['class' => 'textfield', 'row' => 3])->label(false) ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;">
                                <i class="fa fa-calculator" style="color: #cc9900" aria-hidden="true"></i> Accounting Entry
                                <button style="font-size: 13px; margin: 5px;" class="btn btn-default btn-right" type="button" onClick="addInput('dynamicInput')" >
                                    <i class="glyphicon glyphicon-plus"></i> Add Field
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table class="table table-condensed table-bordered my" style="font-size: 12px;" id="dynamicInput">
                                    <tr>
                                        <th style="text-align: center">VAT?</th>
                                        <th style="text-align: center">Account Tilte</th>
                                        <th style="text-align: center">UACS Code</th>
                                        <th style="text-align: center">Debit</th>
                                        <th style="text-align: center">Credit</th>
                                        <th style="text-align: center">Credit to</th>
                                    </tr>
                                    <?php if($acounting_model == null) : ?>
                                        <tr>
                                            <td style="width: 40px; vertical-align: middle;">
                                                <input type="checkbox" name="vatable" value = "1">
                                            </td>
                                            <td style="width: 300px">
                                                <input type="text" name="account_title[0]" class="textfield">
                                            </td>
                                            <td>
                                                <input type="text" name="uacs_code[0]" class="textfield">
                                            </td>
                                            <td style="width: 100px">
                                                <input type="text" name="debit[0]" class="textfield">
                                            </td>
                                            <td style="width: 100px">
                                                <input type="text" name="credit_amount[0]" class="textfield">
                                            </td>
                                            <td>
                                                <select name="credit_to[0]" class="textfield">
                                                    <option value=" "></option>
                                                    <option value="payee">Payee</option>
                                                    <option value="BIR">BIR</option>
                                                </select> 
                                            </td>
                                        </tr>
                                    <?php elseif($acounting_model != null) : ?>
                                        <?php foreach ($acounting_model as $key => $value) : ?>
                                            <tr>
                                                <td style="width: 40px; vertical-align: middle;">
                                                    <?php if($key == 0) : ?>
                                                    <input type="checkbox" name="vatable" value = "1" <?= $value->vatable == 1 ? 'checked' : '' ?> >
                                                    <?php endif ?>
                                                </td>
                                                <td style="width: 300px">
                                                    <input type="hidden" name="id[<?= $key ?>]" class="textfield" value="<?= $value->id ?>">
                                                    <input type="text" name="account_title[<?= $key ?>]" class="textfield" value="<?= $value->account_title ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="uacs_code[<?= $key ?>]" class="textfield" value="<?= $value->uacs_code ?>">
                                                </td>
                                                <td style="width: 100px">
                                                    <input type="text" name="debit[<?= $key ?>]" class="textfield" value="<?= $value->debit ?>">
                                                </td>
                                                <td style="width: 100px">
                                                    <input type="text" name="credit_amount[<?= $key ?>]" class="textfield" value="<?= $value->credit_amount ?>">
                                                </td>
                                                <td>
                                                    <select name="credit_to[<?= $key ?>]" class="textfield">
                                                        <option value="<?= $value->credit_to ?>"><?= $value->credit_to ?></option>
                                                        <option value="payee">Payee</option>
                                                        <option value="BIR">BIR</option>
                                                    </select> 
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                <?php endif ?>
                                </table>
                            </td>
                        </tr>
                        
                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-pie-chart" style="color: #cc9900"></i> Obligation Request and Status (ORS)</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="height: 10px;"></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <table class="table table-condensed table-bordered" style="font-size: 12px;">
                                        <tr>
                                            <th style="text-align: center">Particulars</th>
                                            <th style="text-align: center">ORS No</th>
                                            <th style="text-align: center">Obligation</th>
                                            <th style="text-align: center; width: 40px;">Balance</th>
                                            <th style="text-align: center; width: 70px;">Payable</th>
                                            <th style="text-align: center; width: 70px;">Payment</th>
                                        </tr>
                                        <?php 
                                              $ors = explode(',', $model->ors);
                                              for($x=0; $x<sizeof($ors); $x++) : 
                                        ?>
                                        <?php 
                                            $ors_details = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->andWhere(['dv_no' => $model->dv_no])->one() != null ? OrsRegistry::find()->where(['ors_id' => $ors[$x]])->andWhere(['dv_no' => $model->dv_no])->one() : Ors::find()->where(['id' => $ors[$x]])->one();

                                            $ors_checker = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->andWhere(['dv_no' => $model->dv_no])->one() != null ? 'registry' : 'ors';
                                        ?>
                                            <tr>
                                                <td style="width: 200px;">
                                                  <?= $form->field($model, 'particular[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_details->particular, 'class' => 'textfield'])->label(false) ?>
                                                    <?= $form->field($model, 'ors_id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors[$x]])->label(false) ?>
                                                </td>
                                                <td>
                                                    <?= $form->field($model, 'ors_no[]', ['options' => ['tag' => false]])->textInput([
                                                        'value' => $ors_details->ors_class.'-'.$ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial, 'class' => 'textfield'])->label(false) 
                                                    ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= $form->field($model, 'obligation[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_details->obligation, 'class' => 'textfield', 'style' => 'text-align: right;'])->label(false) ?>
                                                    <?= $form->field($model, 'mfo_pap[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors_details->mfo_pap, 'class' => 'textfield'])->label(false) ?>
                                                    <?= $form->field($model, 'responsibility_center[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors_details->responsibility_center, 'class' => 'textfield'])->label(false) ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold; vertical-align: middle;">
                                                    <?= number_format($ors_details->obligation - $ors_details->getBalance($ors[$x]), 2) ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= $form->field($model, 'payable[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_checker == 'ors' ? number_format($model->gross_amount/sizeof($ors), 2) : number_format($ors_details->payable, 2), 'class' => 'textfield', 'style' => 'text-align: right;'])->label(false) ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= $form->field($model, 'payment[]', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'style' => 'text-align: right;', 'value' => $ors_checker == 'ors' ? number_format($model->gross_amount/sizeof($ors), 2) : number_format($ors_details->payment)])->label(false) ?>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
                                    </table>
                            </td>
                        </tr>
                        <?php if(\Yii::$app->user->can('Verifier')) : ?>
                        <tr style="border-top-style: dashed; border-color: #e0e0d1; ">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-comments" style="color: #cc9900">
                            </i> Action :</td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'action')->radioList(['Approved' => 'Approve ', 'For Approval' => 'For Approval ', ' Back to Payee ' => ' Back to payee'])->label(false); ?>
                            </td>
                            <td colspan="5"></td>
                        </tr>
                        <?php endif ?>

                        <?php if(\Yii::$app->user->can('processor')) : ?>
                        <tr style="border-top-style: dashed; border-color: #e0e0d1; ">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-comments" style="color: #cc9900">
                            </i> Action :</td>
                        </tr>
                        <tr>
                            <td>
                                <?= $form->field($model, 'action')->radioList(['Forward to Verifier' => 'Forward to Verifier ', 'Back to Payee' => ' Back to payee'])->label(false); ?>
                            </td>
                            <td colspan="5"></td>
                        </tr>
                        <?php endif ?>

                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-comments" style="color: #cc9900">
                            </i>  Remarks : </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php foreach ($model->remarkss as $key => $value) : ?>
                                    <blockquote class="blockquote">
                                    <h6>
                                        <strong style="font-style: italic;">
                                            - <?= $value->user->fullname ?>
                                            <i class="text-muted">(<?= $value->date ?>)</i>
                                        </strong>
                                        <p style="text-indent: 5px;"><?= $value->remarks ?></p>
                                    </h6>
                                    </blockquote>
                                <?php endforeach ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?= $form->field($model, 'remarks')
                                        ->textarea(
                                            ['rows' => 3,
                                                'value' => $model->remark
                                            ])
                                        ->label(false) 
                                ?>
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
                                        <label style="font-size: 10px;"><?= mb_strimwidth($attached, 0, 40, ' ...') ?></label><br>
                                    <?php endif ?>
                                <?php endforeach ?>

                                <?php foreach ($lacking as $lack) : ?>
                                    <input type="checkbox" name="requirements[<?= $lack ?>]" value="<?= $lack ?>">
                                    <label style="font-size: 10px;"><?= mb_strimwidth($lack, 0, 40, ' ...') ?></label><br>
                                <?php endforeach ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group" style="padding-left: 10px;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php // Html::a('Accountig Entry', ['/accounting-entry/create', 'id'=>$model->id, 'net' => $net_amount, 'gross' => $model->gross_amount], ['class' => 'btn btn-primary'])
             ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

var counter = 1;
var limit = 5;
function addInput(dynamicInput)
{
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = '<tr><td></td><td style="width: 300px;"><input type="text" name="account_title['+counter+']" class="textfield"></td><td><input type="text" name="uacs_code['+counter+']" class="textfield"></td><td style="width: 100px"><input type="text" name="debit['+counter+']" class="textfield"></td><td style="width: 100px"><input type="text" name="credit_amount['+counter+']" class="textfield"></td><td><select name="credit_to['+counter+']" class="textfield"><option value=" "></option><option value="payee">Payee</option><option value="BIR">BIR</option></select></td></tr>';

          document.getElementById("dynamicInput").appendChild(newdiv).className = "tr";
          counter++;
     }
}

window.onload = function()
{

    var gross_amount = $("#disbursement-gross_amount").val();
    var less_amount = $("#disbursement-less_amount").val();
    var net_amount = (gross_amount - less_amount);
    $("#disbursement-net_amount").val(net_amount);

  $("input[id='disbursement-less_amount']").change(function () { 

        var gross_amount = $("#disbursement-gross_amount").val();
        var net_amount = (gross_amount - $(this).val());
        $("#disbursement-net_amount").val(net_amount);

    });

}
</script>


