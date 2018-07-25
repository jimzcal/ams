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
<div class="btn-group btn-group-vertical" style="float: left; left: 0; z-index: 300; position: fixed;" id="noprint">
    <?= Html::a('<i class="glyphicon glyphicon-pencil" style= "font-size: 16px;"></i>', ['processor', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    <?= Html::a('<i class="fa fa-pie-chart" style= "font-size: 16px;"></i>', ["/ors/index"], ['class' => 'btn btn-default']) ?>
    <?= Html::a('<i class="fa fa-id-card" style= "font-size: 16px;"></i>', ["index"], ['class' => 'btn btn-default']) ?>
</div>

    <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> Disbursement Vouchers (DV)
    </div>

    <div class="view-index">
        <div class="form-wrapper-content">
            <div class="row">
                <div class="col-md-9">
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
                                <table class="table table-striped table-condensed" style="border: solid 1px #d9d9d9; border-radius: 15px;">
                                    <tr>
                                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 120px; color: #666666; font-size: 13px;">Payee</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; bold; width: 5px;">:</td>
                                        <td style="vertical-align: middle;"> 
                                            <?= $model->payee ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; font-style: italic; vertical-align: middle; width: 140px; color: #666666; font-size: 13px;">Fund Cluster</td>
                                        <td style="color: green; font-weight: bold; vertical-align: middle; width: 5px;">:</td>
                                        <td style="vertical-align: middle;">
                                            <?= $model->fund_cluster ?>
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
                                </table>
                            </td>
                        </tr>

                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;">
                                <i class="fa fa-calculator" style="color: #cc9900" aria-hidden="true"></i> Accounting Entry
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
                                    <?php foreach ($acounting_model as $key => $val) : ?>
                                            <tr>
                                                <td style="width: 40px; vertical-align: middle;">
                                                    <?php if($key == 0) : ?>
                                                    <input type="checkbox" name="vatable" value = "1" <?= $val->vatable == 1 ? 'checked' : '' ?> >
                                                    <?php endif ?>
                                                </td>
                                                <td style="width: 300px">
                                                    <?= $val->account_title ?>
                                                </td>
                                                <td>
                                                    <?= $val->uacs_code ?>
                                                </td>
                                                <td style="width: 100px">
                                                    <?= $val->debit ?>
                                                </td>
                                                <td style="width: 100px">
                                                    <?= $val->credit_amount ?>
                                                </td>
                                                <td>
                                                    <?= $val->credit_to ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                </table>
                            </td>
                        </tr>
                        
                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-pie-chart" style="color: #cc9900"></i> Obligation Request and Status (ORS)</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="height: 10px;"></td>
                        </tr>
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
                                        <?php $ors_details = OrsRegistry::find()->where(['ors_id' => $ors[$x]])->one(); ?>
                                            <tr>
                                                <td style="width: 200px;">
                                                  <?= $ors_details->particular ?>
                                                </td>
                                                <td>
                                                    <?= $ors_details->ors_class.'-'.$ors_details->funding_source.'-'.$ors_details->ors_year.'-'.$ors_details->ors_month.'-'.$ors_details->ors_serial ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= $ors_details->obligation ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= number_format($ors_details->obligation - $ors_details->getBalance($ors[$x]), 2) ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= number_format($ors_details->payable, 2) ?>
                                                </td>
                                                <td style="width: 90px; text-align: right; font-weight: bold;">
                                                    <?= number_format($ors_details->payment, 2) ?>
                                                </td>
                                            </tr>
                                        <?php endfor ?>
                                    </table>
                            </td>
                        </tr>
                
                        <tr style="border-top-style: dashed; border-color: #e0e0d1;">
                            <td colspan="6" style="color:  #2a2b43; font-size: 16px;"><i class="fa fa-comments" style="color: #cc9900"></i>  Remarks : </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <?php foreach ($model->remarkss as $key => $value) : ?>
                                    <h6>
                                        <strong style="font-style: italic;">
                                            - <?= $value->user->fullname ?>
                                            <i class="text-muted">(<?= $value->date ?>)</i>
                                        </strong>
                                        <p style="text-indent: 5px;"><?= $value->remarks ?></p>
                                    </h6>
                                <?php endforeach ?>
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
    </div>
</div>



