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
            <table class="mytable" style="width: 97%; margin-right: auto; margin-left: auto;">
                <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
                    <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                        <?= isset($dv_no) ? $dv_no : $model->dv_no ?></td>
                    <td style="font-size: 18px; text-align: right; font-weight: bold;" colspan="3">
                        <?= $model->date===null ? date('Y-F-d') : $model->date ?>
                        <?= $form->field($model, 'date')->hiddenInput(['value' => $model->date === null ? date('Y-F-d') : $model->date, 'readonly' =>true])->label(false) ?>
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
                                    <?= $form->field($model, 'ors_no', ['options' => ['tag' => false]])->hiddenInput(['maxlength' => true, 'class' => 'textfield'])->label(false) ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">Particulars</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                                <td> 
                                    <?= $form->field($model, 'particulars', ['options' => ['tag' => false]])->textarea(['rows' => 2, 'class' => 'textfield'])->label(false) ?>
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
                
                <tr style="border-top-style: dashed; border-color: #f5f5f0;">
                    <td colspan="6" style="color:  #666666"><i class="fa fa-pie-chart"></i> Obligation Request and Status (ORS)</td>
                <tr>
                <tr>
                    <td colspan="6" style="height: 10px;"></td>
                </tr>
                    <td colspan="6">
                        <table class="table table-condensed table-bordered" style="font-size: 12px;">
                            <tr>
                                <th style="text-align: center"></th>
                                <th style="text-align: center">Validity</th>
                                <th style="text-align: center">NCA No</th>
                                <th style="text-align: center">Fiscal Year</th>
                                <th style="text-align: center; width: 40px;">Funding Source</th>
                                <th style="text-align: center">Allocation</th>
                                <th style="text-align: center">Balance</th>
                                <th style="text-align: center; width: 70px;">Payment</th>
                            </tr>
                            <?php foreach ($nca_model as $key => $value) : ?>
                                <tr>
                                    <?php 
                                        $validity = explode(',', $value->validity);
                                        $date = explode('-', $model->date);
                                    ?>
                                    <td style="width: 40px; font-weight: bold;">
                                        <input id="selected" type="checkbox" name="nca_id[]" value=<?= $key ?> class= <?= in_array($date[1], $validity) ? "display" : "hide" ?> <?= $model->getCheck($value->nca_no, $value->funding_source) ?>>
                                    </td>

                                    <td style="width: 50px; font-weight: bold;">
                                        <?php

                                            if(in_array($date[1], $validity))
                                            {
                                                echo "<div style= 'color: green; font-size: 12px;'><i class = 'glyphicon glyphicon-ok'></i></div>";
                                            }
                                            else{
                                               echo "<div style= 'color: red; font-size: 12px;'><i class = 'glyphicon glyphicon-remove'></i></div>";
                                            }
                                        ?>
                                    </td>
                                    
                                    <td style="width: 220px; font-weight: bold; vertical-align: top;">
                                        <?= $form->field($model, 'nca_no[]', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'class' => 'textfield', 'value' => $value->nca_no])->label(false) ?>
                                    </td>

                                    <td style="width: 100px; font-weight: bold; vertical-align: middle;">
                                        <?= $value->fiscal_year ?>
                                    </td>

                                    <td style="width: 160px; font-weight: bold;">
                                        <?= $form->field($model, 'funding_source[]', ['options' => ['tag' => false]])->textInput(['maxlength' => true, 'class' => 'textfield', 'value' => $value->funding_source])->label(false) ?>
                                    </td>

                                    <td style="width: 100px; text-align: right; font-weight: bold; vertical-align: middle;">
                                        <?= number_format($value->sub_total, 2) ?>
                                    </td>
                                    <td style="width: 100px; text-align: right; font-weight: bold; vertical-align: middle;">
                                        <?= number_format($value->sub_total - $model->getEarmarked($value->nca_no, $value->funding_source), 2) ?>
                                    </td>
                                    <td style="width: 100px; text-align: right; font-weight: bold; vertical-align: middle;">
                                        <?= $form->field($model, 'payment[]', ['options' => ['tag' => false]])->textInput(['class' => 'textfield', 'style' => 'text-align: right;',
                                            'value' => $model->getEarmarkedamount($value->nca_no, $value->funding_source)
                                            ])->label(false) ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td colspan="8">
                                    <label>Legend:</label>
                                    <div style= 'color: green; font-size: 12px;'>
                                        <i class = 'glyphicon glyphicon-ok'></i> - Within the validity period of NCA
                                    </div>
                                    <div style= 'color: red; font-size: 12px;'>
                                        <i class = 'glyphicon glyphicon-remove'></i> - Not within the validity period of NCA
                                    </div>
                                </td>
                            </tr>
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
        <div class="form-group" style="padding-left: 10px;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div>

<script>

// window.onload = function()
// {
//     var selectControl2 = document.getElementById("selected");
//     selectControl2.onclick = function()
//     {
//         var value = false;
//         $("#pay").val(value);
//     }
// }

</script>