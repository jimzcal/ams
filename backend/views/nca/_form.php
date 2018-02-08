<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nca-form">

    <?php $form = ActiveForm::begin(); ?>
        <table class="table table-bordered">
            <tr>
                <td colspan="4">
                    <?= $form->field($model, 'nca_no')->textInput(['maxlength' => true]) ?>
                </td>
                <td width="200"><?= $form->field($model, 'period')->dropDownList(['first_quarter' => '1st Quarter', 'second_quarter' => '2nd Quarter', 'third_quarter' => '3rd Quarter', 'forth_quarter' => '4th Quarter']) ?>
                </td>
                <td width="200"><?= $form->field($model, 'date')->textInput(['maxlength' => true, 'value'=>date('M. d, Y')]) ?></td>
            </tr>
            <tr>
                <td colspan="4"><?= $form->field($model, 'purpose')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'mds_sub_acc_no')->textInput(['maxlength' => true]) ?></td>
            </tr>
            <tr>
                <td colspan="5"><?= $form->field($model, 'gsb_branch')->textInput(['maxlength' => true]) ?></td>
                <td><?= $form->field($model, 'fund_cluster')->textInput(['maxlength' => true]) ?></td>
            </tr>
        </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
