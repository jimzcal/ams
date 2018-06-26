<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Transaction;
use backend\models\Disbursement;
use backend\models\accountingEntry;
use backend\models\FundCluster;
use backend\models\Nca;
use backend\models\OrsRegistry;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Cash Status';
?>

<div class="disbursement-form">
    <?= Yii::$app->session->getFlash('error'); ?>

   <!--  <div class="form-title">
        <?= Html::encode($this->title) ?>
        <?= Html::a('&times;', ['/site/index'], ['class' => 'close-button']) ?>
    </div> -->

    <div class="new-title">
        <i class="fa fa-bar-chart-o" aria-hidden="true"></i> Cash Status
    </div>

    <div class="view-index">
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-wrapper-content">
            <div class="row">
                <div class="col-md-9">
                    <table class="mytable">
                        <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
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
                            <td colspan="6" style="font-weight: bold; font-style: italic;">Notice of Cash Allocation (NCA)</td>
                        <tr>
                        <tr>
                            <td colspan="6" style="height: 10px;"></td>
                        </tr>
                            <td colspan="6">
                                <table class="table table-condensed table-bordered" style="font-size: 12px;">
                                        <tr>
                                            <th style="text-align: center">ORS No</th>
                                            <th style="text-align: center">NCA No</th>
                                            <th style="text-align: center; width: 40px;">Funding Source</th>
                                            <th style="text-align: center">Allocation</th>
                                            <th style="text-align: center">Balance</th>
                                            <th style="text-align: center; width: 70px;">Payment</th>
                                        </tr>
                                        <script type="text/javascript">
                                            var n = 0, i=0;
                                        </script>
                                        <?php 
                                              $ors = explode(',', $model->ors);
                                              for($x=0; $x<sizeof($ors); $x++) : 
                                        ?>
                                        <?php $ors_details = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->andWhere(['dv_no' => $model->dv_no])->one(); ?>
                                            <tr>
                                                <td>
                                                    <?= $form->field($model, 'ors_no[]', ['options' => ['tag' => false]])->textInput([
                                                        'value' => $ors_details->ors_class.'-'.$ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial, 'class' => 'textfield'])->label(false) 
                                                    ?>
                                                </td>
                                                
                                                <td style="width: 200px; font-weight: bold;">
                                                    <?= $form->field($model, 'nca')->dropDownList(ArrayHelper::map(Nca::find()->all(),'nca_no', 'nca_no'),
                                                          [
                                                            'prompt'=>'Select NCA No.',
                                                            'class' => 'textfield',
                                                            'onchange'=>'
                                                               $.post("'.Yii::$app->urlManager->createUrl('nca/sources?nca_no=') . '"+$(this).val(),function(data){
                                                                    
                                                                  $("#funding_source_"+n).html(data);
                                                                  n++;

                                                              });'
                                                          ])->label(false);
                                                     ?>
                                                </td>
                                                <td style="width: 200px; font-weight: bold;">
                                                   <?= $form->field($model, 'funding_source')->dropDownList(ArrayHelper::map(Nca::find()->all(),'funding_source', 'funding_source'),
                                                        [
                                                            'id' => 'funding_source_'.$x,
                                                            'prompt'=>'-',
                                                            'class' => 'textfield',
                                                            'onchange'=>'
                                                               $.post("'.Yii::$app->urlManager->createUrl('nca/allocations?funding_source=') . '"+$(this).val(),function(value){
                                                                    
                                                                  $("#allo_"+i).text(value);
                                                                  i++;

                                                              });'

                                                        ])->label(false);
                                                     ?>
                                                </td>
                                                <td id="allo_<?= $x ?>" style="width: 80px; text-align: right; font-weight: bold;">
                                                    
                                                </td>
                                                <td style="width: 80px; text-align: right; font-weight: bold;">
                                                    
                                                </td>
                                                <td style="width: 80px; text-align: right; font-weight: bold;">
                                                    <?= $form->field($model, 'payment[]', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'style' => 'text-align: right;', 'value' => number_format($ors_details->payment)])->label(false) ?>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
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
            <?php // Html::a('Accountig Entry', ['/accounting-entry/create', 'id'=>$model->id, 'net' => $net_amount, 'gross' => $model->gross_amount], ['class' => 'btn btn-primary'])
             ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>



