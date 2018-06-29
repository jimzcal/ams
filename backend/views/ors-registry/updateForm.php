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

<!--     <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Vouchers (DV)
    </div> -->

    <div class="view-index">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-wrapper-content">
            <div class="row">
                <table class="mytable">
                    <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
                        <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                            <?= $model->dv_no ?></td>
                        <td style="font-size: 18px; text-align: right; font-weight: bold;" colspan="3">
                            <?= $model->date ?>
                        </td>
                    </tr>
                    <tr style="height: 10px;">
                        
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table class="table table-striped table-condensed">
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
                                        <?= $form->field($model, 'gross_amount', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'id'=>'nine', 'class' => 'textfield'])->label(false) ?>
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
                            </table>
                        </td>
                    </tr>
                    
                    <tr style="border-bottom-style: dashed; border-color: #f5f5f0; border-top-style: dashed; border-color: #f5f5f0;">
                        <td colspan="6" style="font-weight: bold; font-style: italic;">Obligation Request and Status (ORS)</td>
                    <tr>
                    <tr>
                        <td colspan="6" style="height: 10px;"></td>
                    </tr>
                        <td colspan="6">
                            <table class="table table-condensed table-bordered" style="font-size: 12px;">
                                    <tr>
                                        <th style="text-align: center">Date</th>
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
                                        $ors_registry = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->all();
                                        $ors_new_registry = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->andWhere(['dv_no' => $model->dv_no])->one();
                                        foreach ($ors_registry as $key => $ors_details) :
                                    ?>
                                    <?php if($ors_details->dv_no != $ors_new_registry->dv_no) : ?>
                                        <tr style="background-color: #f5f5f0;">
                                            <td style="width: 100px;">
                                              <?= $ors_details->date ?>
                                            </td>
                                            <td style="width: 400px;">
                                              <?= $ors_details->particular ?>
                                            </td>
                                            <td>
                                                <?= $ors_details->ors_class.'-'.$ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial;
                                                ?>
                                            </td>
                                            <td style="width: 90px; text-align:">
                                                <?= $ors_details->obligation ?>
                                            </td>
                                            <td style="width: 90px; text-align: left;">
                                                
                                            </td>
                                            <td>
                                                <?= number_format($ors_details->payable, 2) ?>
                                            </td>
                                            <td style="width: 90px; text-align: left;">
                                                <?= number_format($ors_details->payment, 2) ?>
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                        <?php endforeach ?>
                                          <tr style="font-weight: bold;">
                                            <td style="width: 100px;">
                                              <?= $form->field($model, 'date_registry[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_new_registry->date, 'class' => 'textfield'])->label(false) ?>
                                              <?= $form->field($model, 'ors_id[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors_new_registry->ors_id, 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td style="width: 400px;">
                                              <?= $form->field($model, 'particular[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_new_registry->particular, 'class' => 'textfield'])->label(false) ?>
                                            </td>
                                            <td>
                                                <?= $form->field($model, 'ors_no[]', ['options' => ['tag' => false]])->textInput([
                                                    'value' => $ors_new_registry->ors_class.'-'.$ors_new_registry->funding_source.'-'.$ors_new_registry->ors_year.'-'.$ors_new_registry->ors_month.'-'.$ors_new_registry->ors_serial, 'class' => 'textfield'])->label(false) 
                                                ?>
                                            </td>
                                            <td style="width: 90px; text-align: right; font-weight: bold; color: blue;">
                                                <?= $form->field($model, 'obligation[]', ['options' => ['tag' => false]])->textInput(['value' => $ors_new_registry->obligation, 'class' => 'textfield', 'style' => 'text-align: right;'])->label(false) ?>
                                                <?= $form->field($model, 'mfo_pap[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors_new_registry->mfo_pap, 'class' => 'textfield'])->label(false) 
                                                ?>
                                                <?= $form->field($model, 'responsibility_center[]', ['options' => ['tag' => false]])->hiddenInput(['value' => $ors_new_registry->responsibility_center, 'class' => 'textfield'])->label(false) 
                                                ?>
                                            </td>
                                            <td style="width: 90px; text-align: right; font-weight: bold; vertical-align: middle; color: green;">
                                                <?= number_format(($ors_new_registry->obligation - $model->getObligationbalance($ors_new_registry->ors_id)), 2); ?>
                                            </td>
                                            <td style="width: 90px; text-align: right; font-weight: bold;">
                                                <?= $form->field($model, 'payable[]', ['options' => ['tag' => false]])->textInput(['value' => number_format($ors_new_registry->payable, 2), 'class' => 'textfield', 'style' => 'text-align: right;'])->label(false) ?>
                                            </td>
                                            <td style="width: 90px; text-align: right; font-weight: bold;">
                                                <?= $form->field($model, 'payment[]', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'style' => 'text-align: right;', 'value' =>number_format($ors_new_registry->payment, 2)])->label(false) ?>
                                            </td>
                                        </tr>

                                        <tr style="height: 20px; border-right: 0px; border-left: 0px;">
                                            <td colspan="7"></td>
                                        </tr>
                                    <?php endfor ?>
                                </table>
                        </td>
                    </tr>
            
                    <tr style="border-top-style: dashed; border-color: #f5f5f0;">
                        <td colspan="6" style="color:  #666666"><i class="fa fa-comments"></i>  Remarks : </td>
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
        </div>
        <div class="form-group" style="padding-left: 10px;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?php // Html::a('Accountig Entry', ['/accounting-entry/create', 'id'=>$model->id, 'net' => $net_amount, 'gross' => $model->gross_amount], ['class' => 'btn btn-primary'])
             ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>



