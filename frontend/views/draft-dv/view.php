<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Draft Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   <!--  <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reference_no',
            'date',
            'payee',
            'tin',
            'fund_cluster',
            'transaction_type',
            'particulars:ntext',
            'gross_amount',
            'created_by',
            'status',
        ],
    ]) ?> -->
    <div style="width: 77%; margin-right: auto; margin-left: auto; padding: 10px; background-color: #ffffff">
        <table style="margin-right: auto; margin-left: auto; border: solid 1px #000000;">
            <tr>
                <td style="width: 140px;">
                    <?= Html::img('@web/images/da-ams-logo.png', ['alt'=>'DA-AMS Logo', 'style' => 'width: 140px; display: block; margin: 10px 10px 0px 10px;']); ?>
                </td>
                <td colspan="4">
                    <p style="text-align: center; margin-top: 5px;">
                        <span style="font-size: 20px; font-weight: bold;">Department of Agriculture</span>
                        <br style="font-size: 15px;">Elliptical Road, Diliman, Quezon City
                    </p>
                    <h3 style="text-align: center;">DISBURSEMENT VOUCHER</h3>
                </td>
                <td style="width: 190px; border-left: solid 1px #000000; vertical-align: top; padding-top: 3px;">
                    <span style="font-weight: bold;">Fund Cluster:</span><br>
                    <span style="text-decoration: underline;"><?= $model->cluster->description ?></span><br>
                    <span style="font-weight: bold;">Date: </span>
                    <span style="text-decoration: underline;"> <?= $model->date ?></span><br>
                    <span style="font-weight: bold;">DV No: </span><br>
                    <span style="text-decoration: underline;">____________________</span>
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right; height: 40px;">
                    Mode of Payment:
                </td>
                <td colspan="5"></td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right;">
                    Payee:
                </td>
                <td colspan="3" style="border-right: solid 1px #000000; width: 390px;">
                    <?= $model->payee ?>
                </td>
                <td style="border-right: solid 1px #000000; height: 50px; vertical-align: top;">
                    <strong>TIN No./Employee No.</strong><br>
                    <?= $model->tin ?>
                </td>
                <td style="border-right: solid 1px #000000; height: 50px; vertical-align: top;">
                    <strong>ORS/BURS No.</strong>
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: right; height: 30px;">
                    Address:
                </td>
                <td colspan="5"></td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td colspan="3" style="border-right: solid 1px #000000; text-align: center; font-weight: bold;">
                    Particulars
                </td>
                <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold;">
                    Responsibility Center
                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">MFO/PAP</td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">Amount</td>
            </tr>
            <tr style="border-top: solid 1px #000000; min-height: 240px; height: auto;">
                <td colspan="3" style="border-right: solid 1px #000000; vertical-align: top; padding: 10px;">
                    <?= $model->particulars ?>
                </td>
                <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold;">
                    
                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">

                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">

                </td>
            </tr>
            <tr style="border-top: solid 1px #000000; height: 100px;">
                <td colspan="6" style="border-right: solid 1px #000000; vertical-align: top; font-size: 12px; height: 30px; line-height: 10px; padding: 5px;">
                    <i>A. Certified Expenses/Cash Advance Necessary, lawful and incured under my direct supervision.</i><br><br><br><br><br>
                    <center>___________________________________________________________</center><br>
                    <center>Printed Name, Designation and Signature of Supervisor</center>
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td colspan="6" style="border-right: solid 1px #000000; vertical-align: top; font-size: 12px; height: 20px; line-height: 10px; padding: 5px;">
                    B. Accountig Entry
                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td colspan="3" style="border-right: solid 1px #000000; text-align: center; font-weight: bold;">
                    Account Title
                </td>
                <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold; text-align: center;">
                    UACS Code
                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">Debit</td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">Credit</td>
            </tr>
            <tr style="border-top: solid 1px #000000; min-height: 100px;">
                <td colspan="3" style="border-right: solid 1px #000000; vertical-align: top; padding: 10px;">
                </td>
                <td style="border-right: solid 1px #000000; width: 170px; font-weight: bold;">
                    
                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">

                </td>
                <td style="border-right: solid 1px #000000; font-weight: bold; text-align: center;">

                </td>
            </tr>
            <tr style="border-top: solid 1px #000000">
                <td>x</td>
                <td>v</td>
                <td>h</td>
                <td>j</td>
                <td>l</td>
                <td>i</td>
            </tr>
        </table>
    </div>
</div>
