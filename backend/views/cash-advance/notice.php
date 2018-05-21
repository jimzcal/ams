<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CashAdvance */

$this->title = 'Notice';
// $this->params['breadcrumbs'][] = ['label' => 'Cash Advances', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-advance-view">
    <div class="row ada_form">
        <table style="width: 100%">
            <tr>
                <td width="110">
                    <?= Html::img('@web/images/DA_logo.png', ['alt'=>'DA-Philippines Logo', 'width' => 100]);?>
                </td>
                <td colspan="2">
                    <p style="line-height: 16px;">
                        Republic of the Philippines<br>
                        <span style="font-weight: bold">Department of Agriculture</span><br>
                        <span style="font-size: 18px; font-weight: bold">OFFICE OF THE SECRETARY</span><br>
                        Elliptical Road, Diliman <br>
                        Quezon City, 1100, Philippines
                    </p>
                </td>
            </tr>
        </table>

        <div style="padding-left: 40px; padding-right: 40px; margin-right: auto; margin-left: auto; width: 100%;">
            <table style="width: 100%;">
                <tr>
                    <td colspan="3" style="height: 30px;"></td>
                </tr>
                <tr>
                    <td style="width: 100px; font-size: 17px; font-weight: bold;">
                        DATE
                    </td>
                    <td style="width: 30px; font-weight: bold; font-size: 16px;">
                        :
                    </td>
                    <td style="font-size: 15px; font-weight: bold;">
                        <?= date('M d, Y') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 20px;"></td>
                </tr>
                <tr>
                    <td style="width: 100px; font-size: 17px; font-weight: bold; vertical-align: top;">
                        FOR
                    </td>
                    <td style="width: 30px; font-weight: bold; font-size: 16px;">
                        :
                    </td>
                    <td style="font-size: 15px; font-weight: bold;">
                        <?= $model->dvNo->payee; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 20px;"></td>
                </tr>
                <tr>
                    <td style="width: 100px; font-size: 17px; font-weight: bold;">
                        FROM
                    </td>
                    <td style="width: 30px; font-weight: bold; font-size: 16px;">
                        :
                    </td>
                    <td style="font-size: 15px; font-weight: bold;">
                        CHARIE SARAH D. SAQUING<br>
                        <span style="font-size: 14px;">Chief Accountant</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 20px;"></td>
                </tr>
                <tr>
                    <td style="width: 100px; font-size: 17px; font-weight: bold;">
                        SUBJECT
                    </td>
                    <td style="width: 30px; font-weight: bold; font-size: 16px;">
                        :
                    </td>
                    <td style="font-size: 15px; font-weight: bold;">
                        Unliquidated Cash Advance
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="height: 10px; border-bottom: solid 2px black;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-indent: 70px; text-align: justify;">
                        <br><br>
                            Please be informed that per acounting records of this Department as of <?= date('M. d, Y') ?>, you still have unliquidated/unsettled cash advance with details as follows;
                        <br><br>

                        <table style="width: 100%; padding: 10px; font-weight: bold;">
                            <tr>
                                <td>Date</td>
                                <td>:</td>
                                <td><?= $model->dvNo->date ?></td>
                            </tr>
                            <tr>
                                <td>DV No.</td>
                                <td>:</td>
                                <td><?= $model->dv_no; ?></td>
                            </tr>
                            <tr>
                                <td>Particulars</td>
                                <td>:</td>
                                <td><?= $model->dvNo->particulars ?></td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td>:</td><td>
                                    <?= number_format($model->dvNo->gross_amount - $model->dvNo->less_amount, 2) ?></td>
                            </tr>
                            <tr>
                                <td><?= $model->dvNo->mode_of_payment == 'lldap_ada' ? 'LDDAP-ADA No.' : 'Check No.' ?></td>
                                <td>:</td>
                                <td><?= isset($model->disbursed->lddap_check_no) == null ? 'N/A' : $model->disbursed->lddap_check_no ?></td>
                            </tr>
                            <?php if($model->payment_method != null) : ?>
                                <tr>
                                    <td>Partial Payment</td>
                                    <td>:</td>
                                    <td><?= number_format($model->amount_paid, 2) ?></td>
                                </tr>
                                 <tr>
                                    <td>Date of Partial Payment</td>
                                    <td>:</td>
                                    <td><?= $model->date_liquidated ?></td>
                                </tr>
                                <tr>
                                    <td>Balance</td>
                                    <td>:</td>
                                    <td><?= number_format($model->dvNo->net_amount - $model->amount_paid, 2) ?></td>
                                </tr>
                            <?php endif ?>
                        </table>

                        <br><br>
                            Pursuant to the provisions of Section 4.1.3 of Audit Circular No. 2009-002 of the Commission on Audit dated May 18, 2009 which states that <i>"A cash advance shall be liquidated/reported as soon as the purpose for which it was granted has been served."</i>
                        <br><br>
                            You are hereby requested to liquidate/settle this within 15 days upon receipt of this Memorandum for compliance.
                        <br><br>
                            Thank you.
                        <br><br><br>

                        <p style="font-style: italic; font-weight: bold;">
                            Cc:    Resident Auditor<br>
                                   Resident Umbudsman
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

