<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use yii\widgets\ActiveForm;
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
            <?= Html::submitButton('Print', ['class' => 'btn btn-primary btn-right']) ?>
        </div>
        <div class="ada_form">
            <table style="border: 0;  margin-right: auto; margin-left: auto; width: 100%;">
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold; padding: 10px;">LIST OF DUE AND DEMANDABLE ACCOUNTS PAYABLE - ADVICE TO DEBIT ACCOUNT</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td width="150" style="padding-left: 5px; padding-right: 5px;">Department</td><td>: DEPARTMENT OF AGRICULTURE</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="padding-left: 5px; padding-right: 5px;">Agency</td><td>: OFFICE OF THE SECRETARY</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="padding-left: 5px; padding-right: 5px;">Fund Code</td><td>: 101</td>
                </tr>
                <tr style="font-size: 9px;">
                    <td colspan="2" style="padding: 3px;">
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
                <tr align="center" style="font-size: 10px; font-weight: bold">
                    <td width="180">NAME</td>
                    <td width="100" style="font-size: 9px">PREFERED SERVICING BANK/ SAVINGS/ CURRENT ACC. NO</td>
                    <td>OBLIGATION SLIP NO.</td>
                    <td>ALLOT. CLASS (per UACS)</td>
                    <td>GROSS AMOUNT</td>
                    <td>WITH HOLDING TAX</td>
                    <td>NET AMOUNT</td>
                    <td width="100">REMARKS (For MDS-GSB use Only)</td>
                </tr>
                <tr style="font-size: 10px;">
                    <td width="290" style="min-height: 200px; height: auto;">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->dv->payee.'<br>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->current_account.'<br>';
                            }
                        ?>
                    </td>
                    <td width="240">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->dv->ors_class.'-'.$value->dv->ors_year.'-'.$value->dv->ors_month.'-'.$value->dv->ors_serial.'<br>';
                            }
                        ?>
                    </td>
                    <td>
                       <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->uacs_code.'<br>';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo number_format($value->dv->gross_amount, 2).'<br>';
                            }
                        ?>
                    </td>
                    <td>
                       <?php
                            foreach ($dvs as $value)
                            {
                              echo number_format($value->dv->less_amount, 2).'<br>';
                            }
                        ?>
                    </td>
                    <td>
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
                <tr style="font-size: 10px;">
                    <td style="font-weight: bold;">TOTAL:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-weight: bold;"></td>
                    <td style="font-weight: bold;"></td>
                    <td style="font-weight: bold;"></td>
                    <td></td>
                </tr>
            </table>
            <table style="border: 0;  margin-right: auto; margin-left: auto; width: 100%;">
                <tr>
                    <td colspan="3" width="900" style="font-size: 11px">
                        <p style="text-align: justify;">
                            I hereby warrant that the above list of Due and Demadable A/Ps was prepared in accordance with existing accounting rules and regulations.
                        </p>
                        <p style="font-weight: bold;">
                            Certified Correct:
                        </p>
                        <p style="text-align: center">
                            __________________________________________<br>
                            <strong>CHARIE SARAH D. SAQUING</strong><br>
                            Dept. Chief Accountant
                        </p>
                    </td>
                    <td width="50"></td>
                    <td colspan="4" style="font-size: 11px">
                        <p style="text-align: justify;">
                            I hereby assume full responsibility for the veracity and accuracy of the listed claims, and the authencity of the supporting documents as submitted by the claimants. 
                        </p>
                        <p style="font-weight: bold;">
                            Approved:
                        </p>
                        <p style="text-align: center">
                            __________________________________________<br>
                            <strong>MIRIAM C. CORNELIO</strong><br>
                            Director, FMS
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align: center; font-weight: bold; background-color: #ebebe0; font-size: 9px;">
                        II. ADVICE TO DEBIT ACCOUNT
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="font-size: 10px">
                        To: Landbank of the Philippines (LBP) - Elliptical Road Branch<br>
                        Please debit MDS Sub-account Number 2321-9002-60 (NCA-BMB-E-0000728 dated January 8, 2018)<br>
                        Please credit the account of the above listed creditors to cover the payment of Accounts Payable (A/Ps). 
                    </td>
                </tr>
                <tr>
                    <td colspan="8" height="20"></td>
                </tr>
                <tr style="font-size: 10px;">
                    <td style="font-weight: bold;"><p>TOTAL AMOUNT :</p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td width="140" style="font-weight: bold;">
                        <p style="font-style: underline;">P 
                            <?= number_format($net, 2) ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <p style="text-align: center">
                            Agency Authorized Signatories
                        </p>
                    </td>
                </tr>
                <tr style="font-size: 10px;">
                    <td colspan="4">
                        <p style="text-align: center">
                            1. __________________________________<br>
                               <strong>SUSAN L. DEL ROSARIO </strong><br>
                               Chief, Cash and Disbursement Section
                        </p>
                    </td>
                    <td colspan="4">
                        <p style="text-align: center">
                            2. __________________________________<br>
                               <strong>MIRIAM C. CORNELIO </strong><br>
                               Director, FMS
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" style="font-size: 9px; text-align: center">
                        (Erasure will invalidate this document)
                    </td>
                </tr>
            </table>

            <table style="border: solid 1px black; font-size: 9px; width: 100%">
                <tr style="border: solid 1px black">
                    <td colspan="8" height="50" valign="top">
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
                <tr style="font-size: 8px;">
                    <td colspan="3">The LDDAP-ADA is an accountable form.</td>
                    <td></td>
                    <td width="80">LDDAP-ADA No.:</td>
                    <td colspan="3" width="250" style="text-align: left">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->lddap_no;
                              break;
                            }
                        ?>
                    </td>
                </tr>
                <tr style="font-size: 8px;">
                    <td colspan="3">* Indicate the description/name and UACS code</td>
                    <td></td>
                    <td>Date of Issue :</td>
                    <td colspan="3" style="text-align: left">
                        <?php
                            foreach ($dvs as $value)
                            {
                              echo $value->date;
                              break;
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    <?php ActiveForm::end(); ?>
</div>