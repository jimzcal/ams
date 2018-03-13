<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use yii\widgets\ActiveForm;
use backend\models\Ors;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LDDAP-ADA FORM';
?>
<div class="cash-advance-index">
    <?php $form = ActiveForm::begin(); ?>
        <div class="title">
            <!-- <?= Html::encode($this->title) ?> -->
            <?= Yii::$app->session->getFlash('error'); ?>
            <!-- <?= Html::submitButton('Print', ['class' => 'btn btn-primary btn-right']) ?> -->
        </div>
        <div class="ada_form">
            <table style="border: 0;  margin-right: auto; margin-left: auto; width: 100%;">
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold; padding: 10px;">LIST OF DUE AND DEMANDABLE ACCOUNTS PAYABLE - ADVICE TO DEBIT ACCOUNT</td>
                </tr>
                <tr>
                    <td width="150" style="padding-left: 5px; padding-right: 5px; font-size: 11px;">Department</td>
                    <td style="font-size: 11px;">: DEPARTMENT OF AGRICULTURE</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="padding-left: 5px; padding-right: 5px; font-size: 11px;">Agency</td>
                    <td style="font-size: 11px;">: OFFICE OF THE SECRETARY</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="padding-left: 5px; padding-right: 5px; font-size: 11px;">Fund Code</td>
                    <td style="font-size: 11px;">: 101</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 3px; font-size: 9px;">
                        LANDBANK OF THE PHILIPPINES (LBP) - ELLIPTICAL ROAD BRANCH - MDS SUB-ACCOUNT NO. 2321-9002-60
                    </td>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    <td colspan="8" style="background-color: #ebebe0; font-weight: bold; text-align: center; font-size: 11px">
                        I. LIST OF DUE AND DENANDABLE ACCOUNTS PAYABLE (LDDAP)
                    </td>
                </tr>
                <tr style="font-size: 10px">
                    <td colspan="4"></td>
                    <td colspan="3" style="text-align: center"> IN PESOS</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-size: 9px; text-align: center">NAME</td>
                    <td style="font-size: 9px; text-align: center">
                        PREFERED SERVICING BANK/ SAVINGS/ CURRENT ACC. NO</td>
                    <td style="font-size: 9px; text-align: center">OBLIGATION SLIP NO.</td>
                    <td style="font-size: 9px; text-align: center; width: 140px">ALLOT. CLASS (per UACS)</td>
                    <td style="font-size: 9px; text-align: center">GROSS AMOUNT</td>
                    <td style="font-size: 9px; text-align: center">WITH HOLDING TAX</td>
                    <td style="font-size: 9px; text-align: center">NET AMOUNT</td>
                    <td style="font-size: 9px; text-align: center">REMARKS (For MDS-GSB use Only)</td>
                </tr>
                <tr>
                    <td style="width: 200px; font-size: 10px; height: 270px; vertical-align: top; padding: 5px;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->dv->payee.'<br>';
                            }
                        ?>
                    </td>
                    <td style="font-size: 10px; vertical-align: top; padding: 5px;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->current_account.'<br>';
                            }
                        ?>
                    </td>
                    <td style="width: 120px; font-size: 10px; vertical-align: top; padding: 5px;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              $dv = Ors::find()
                              ->where(['dv_no' => $value])
                              ->all();
                              foreach ($dv as $ors_value) 
                              {
                                 echo $ors_value->ors_class.'-'.$ors_value->ors_year.'-'.$ors_value->ors_month.'-'.$ors_value->ors_serial.'<br>';
                              }
                            }
                        ?>
                    </td>
                    <td style="font-size: 10px; vertical-align: top; padding: 5px;">
                       <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->uacs_code.'<br>';
                            }
                        ?>
                    </td>
                    <td style="font-size: 10px; vertical-align: top; padding: 5px;">
                        <?php
                            $gross_amount = 0;
                            foreach ($dvs as $value)
                            {
                              echo number_format($value->dv->gross_amount, 2).'<br>';
                              $gross_amount = $gross_amount + $value->dv->gross_amount;
                            }
                        ?>
                    </td>
                    <td style="font-size: 10px; vertical-align: top; padding: 5px;">
                       <?php
                            $less_amount = 0;
                            foreach ($dvs as $value)
                            {
                              echo number_format($value->dv->less_amount, 2).'<br>';
                              $less_amount = $less_amount + $value->dv->less_amount;
                            }
                        ?>
                    </td>
                    <td style="font-size: 10px; vertical-align: top; padding: 5px;">
                       <?php
                        $net = 0;
                            foreach ($dvs as $value)
                            {
                                echo number_format($value->net_amount, 2).'<br>';
                                $net = $net + $value->net_amount;
                            }
                        ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 5px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; font-size: 10px;">TOTAL:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold; font-size: 12px;"><?= number_format($gross_amount, 2); ?></td>
                    <td style="font-weight: bold; font-size: 12px;"><?= number_format($less_amount, 2); ?></td>
                    <td style="font-weight: bold; font-size: 12px;"><?= number_format($net, 2); ?></td>
                    <td></td>
                </tr>
            </table>
            <table style="border: 0;  margin-right: auto; margin-left: auto; width: 100%;">
                <tr>
                    <td colspan="3" style="font-size: 11px; text-align: left; width: 40%x; vertical-align: top;">
                        I hereby warranr that the above list of due and demandable
                        A/Ps was prepared in accordance with existing accounting and 
                        auditing rules and regulations. <br><br><br>
                        Certified Correct: <br><br>
                    </td>
                    <td colspan="2" style="width: 20%;"></td>
                    <td colspan="3" style="font-size: 11px; text-align: left; width: 40%; vertical-align: top;">
                        I hereby assume full responsibility for the veracity and accuracy of the lisetd claims, and the authencity of the supporting documents as submitted mby the claimants.<br><br><br>
                        Approved:<br><br>
                    </td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: center; font-size: 11px;">
                        ____________________________________<br>
                        <strong>CHARIE SARAH D. SAQUING</strong><br>
                        Dept. Chief Accountant
                    </td>
                    <td colspan="2"></td>
                    <td colspan="3" style="text-align: center; font-size: 11px;">
                        ____________________________________<br>
                        <strong>MIRIAM C. CORNELIO</strong><br>
                        Director, FMS
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="height: 20px;"></td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align: center; font-weight: bold; background-color: #ebebe0; font-size: 12px;">
                        II. ADVICE TO DEBIT ACCOUNT
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="font-size: 11px">
                        To: Landbank of the Philippines (LBP) - Elliptical Road Branch<br>
                        Please debit MDS Sub-account Number 2321-9002-60 (NCA-BMB-E-0000728 dated January 8, 2018)<br>
                        Please credit the account of the above listed creditors to cover the payment of Accounts Payable (A/Ps). 
                    </td>
                </tr>
                <tr>
                    <td colspan="8" height="20"></td>
                </tr>
                <tr style="font-size: 10px;">
                    <td colspan="2" style="font-weight: bold;"><p>TOTAL AMOUNT :</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td width="140" style="font-weight: bold;">
                        <p style="text-decoration: underline;">P 
                            <?= number_format($net, 2) ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align: center">
                        <p>
                            Agency Authorized Signatories
                        </p><br>
                    </td>
                </tr>
                <tr>
                    <td style="height: 20px"></td>
                </tr>
            </table>

            <table>
                <tr >
                    <td colspan="3" style="font-size: 11px; text-align: center;">
                            1. ______________________________________________<br>
                               <strong>SUSAN L. DEL ROSARIO </strong><br>
                               Chief, Cash and Disbursement Section
                    </td>
                    <td colspan="2" style="width: 50px;"></td>
                    <td colspan="3" style="font-size: 11px; text-align: center;">
                            2. ______________________________________________<br>
                               <strong>MIRIAM C. CORNELIO </strong><br>
                               Director, FMS
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="font-size: 10px; text-align: center">
                        (Erasure will invalidate this document)
                    </td>
                </tr>
            </table>

            <table style="border: solid 1px black; font-size: 10px; width: 100%">
                <tr>
                    <td colspan="8" height="50" valign="top" style="border-bottom: solid 1px black">
                        FOR MDS-GSB USE ONLY:
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="padding: 5px; text-align: justify;">
                        Instructions: <br>
                        1. Agency shall arrange the creditors on a "first in, first out" basis, that is according to the date of receipt of supplier's/creditors billing, duly supported with completes.<br>
                        2. MDS-GSB branch concerned shall indicate under "Remarks" column, non-payments made to concerned creditors due to inconsistency in information (creditor account name, number) between LDAAP-ADA and bank records.
                    </td>
                </tr>
            </table>

            <table style="width: 100%;">
                <tr>
                    <td colspan="8" style="font-size: 10px;">NOTES:</td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 9px;">The LDDAP-ADA is an accountable form.</td>
                    <td></td>
                    <td style="font-size: 10px">LDDAP-ADA No.</td>
                    <td colspan="3" style="text-align: left; font-size: 12px; width: 250px; text-decoration: underline; font-weight: bold;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo ': '.$value->lddap_no;
                              break;
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 10px;">* Indicate the description/name and UACS code</td>
                    <td></td>
                    <td style="font-size: 10px;">Date of Issue</td>
                    <td colspan="3" style="text-align: left; font-size: 12px; text-decoration: underline; font-weight: bold;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo ': '.$value->date;
                              break;
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php ActiveForm::end(); ?>
</div>
