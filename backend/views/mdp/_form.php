<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Mdp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdp-form">

    <?php $form = ActiveForm::begin(); ?>

    <table style="width: 100%;">
        <tr>
            <td>
                <?= $form->field($model, 'fiscal_year')->textInput(['maxlength' => true]) ?>
            </td>
            <td>
                <?= $form->field($model, 'version')->textInput(['maxlength' => true]) ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                    'options' => ['multiple' => false, 'accept' => 'file/*'],
                    'pluginOptions' => ['previewFileType' => 'file', 'showUpload' => false, 'uploadUrl' => Url::to(['/mdp'])]
                ]); ?>
            </td>
        </tr>
    </table>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
