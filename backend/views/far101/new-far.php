<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'FAR Template';
?>

<div class="far101-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="view-index">
        <?= Html::a('&times;', ['/far101/index'], ['class' => 'close-x']) ?>
        <div class="mini-header">
            Financial Accountability Report Template
        </div>
        <table style="width: 100%;">

            <tr>
                <td colspan="4" style="height: 50px;">
                    
                </td>
            </tr>
            <tr style="height: 30px;">
                <td style="width: 160px;">Operating Unit</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold; width: 300px;">Central Office</td>
                <td></td>
            </tr>
            <tr style="height: 30px;">
                <td style="width: 160px;">Organization Code</td>
                <td style="width: 30px;">:</td>
                <td style="font-weight: bold;">050010100000</td>
                <td></td>
            </tr>
            <tr style="height: 30px;">
                <td style="width: 160px;">Fiscal Year</td>
                <td style="width: 30px;">:</td>
                <td>
                    <?= $form->field($model, 'fiscal_year', ['options' => ['tag' =>false]])->dropDownList(['2018'=>'2018', '2019'=>'2019', '2020' => '2020', '2021' => '2021'], ['class' => 'textfield'])->label(false)?>
                </td>
                <td></td>
            </tr>
            <tr style="height: 30px;">
                <td style="width: 160px;">Funding Source Code</td>
                <td style="width: 30px;">:</td>
                <td>
                    <?= $form->field($model, 'fund_cluster', ['options' => ['tag' =>false]])->dropDownList(['01'=>'01 - Regular Agency Fund', '02'=>'02 - Foreign Assisted Projects Fund', '03'=>'03 - Special Account - Locally Funded/Domestic Grants Fund', '04' => '04 - Special Account - Foreign Assisted/Foreign Grants Fund', '05' => '05 - Internally Generated Funds', '06' =>  '06 - Business Related Funds', '07' => '07 - Trust Receipts'], ['class' => 'textfield'])->label(false)?>
                </td>
                <td></td>
            </tr>
        </table>

        <div class="form-group">
            <?= Html::submitButton('Ok', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
