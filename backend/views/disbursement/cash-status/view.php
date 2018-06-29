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
$this->title = 'Earmarked DV';
?>

<div class="disbursement-form">
    <?= Yii::$app->session->getFlash('error'); ?>

   <!--  <div class="form-title">
        <?= Html::encode($this->title) ?>
        <?= Html::a('&times;', ['/site/index'], ['class' => 'close-button']) ?>
    </div> -->

    <div class="new-title">
        <i class="fa fa-bar-chart-o" aria-hidden="true"></i> <?= 'Earmarked DV No. '. $model->dv_no ?>
    </div>

    <div class="btn-group btn-group-vertical" style="float: left; left: 0; z-index: 300; position: fixed;" id="noprint">
        <?= Html::a('<i class="glyphicon glyphicon-pencil" style= "font-size: 14px;"></i><br> Update', ['/disbursement/cashstatus', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </div>

    <div class="view-index">
        <div class="form-wrapper-content">
            <table class="mytable" style="width: 97%; margin-right: auto; margin-left: auto;">
                <tr style="border-bottom-style: dashed; border-color: #f5f5f0;">
                    <td style="font-weight: bold; font-size: 18px;" colspan="3">DV No.
                        <?= isset($dv_no) ? $dv_no : $model->dv_no ?></td>
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
                                <td style="color: green; font-weight: bold; vertical-align: middle; font-weight: bold; width: 5px;">:</td>
                                <td style="vertical-align: middle;"> 
                                    <?= $model->payee ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">Particulars</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; font-weight: bold; width: 5px;">:</td>
                                <td style="vertical-align: middle;"> 
                                    <?= $model->particulars ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; vertical-align: middle; width: 140px; color: #666666; font-size: 13px;">Fund Cluster</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?= $model->cluster->fund_cluster ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Transaction Type</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?= $model->transaction->name ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Gross Amount</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?= number_format($model->gross_amount, 2) ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Less Amount</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?= number_format($model->less_amount, 2) ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Net Amount</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?= number_format($model->net_amount, 2) ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Status</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle; color: green;">
                                    <?= $model->status ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Date Earmarked</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?php
                                        foreach($nca_earmarked as $Earmarked)
                                        {
                                            echo $Earmarked->date;
                                            echo (sizeof($nca_earmarked) > 1 ? ' / ' : '');
                                        }
                                     ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">NCA No.</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?php
                                        foreach($nca_earmarked as $Earmarked)
                                        {
                                            echo $Earmarked->nca_no;
                                            echo (sizeof($nca_earmarked) > 1 ? ' / ' : '');
                                        }
                                     ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right; font-style: italic; width: 140px; vertical-align: middle; color: #666666; height: 40px; font-size: 13px;">Funding Source</td>
                                <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                <td style="vertical-align: middle;">
                                    <?php
                                        foreach($nca_earmarked as $Earmarked)
                                        {
                                            echo $Earmarked->funding_source;
                                            echo (sizeof($nca_earmarked) > 1 ? ' / ' : '');
                                        }
                                     ?>
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
            </table>
        </div>
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