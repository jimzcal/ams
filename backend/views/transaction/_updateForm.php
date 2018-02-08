<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Requirements;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= Yii::$app->session->getFlash('error'); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="checkbox-wrapper">
      <label>SELECT REQUIREMENTS</label></br>
      <?php foreach($requirements as $requirement) :?>
        <input type="checkbox" checked="true" name="requirements[<?= $requirement ?>]" value="<?= $requirement ?>">
        <label><?= $requirement ?></label>
        <?php endforeach ?>

        <?php foreach($data as $val) :?>
            <input type="checkbox" name="requirements[<?= $val ?>]" value="<?= $val ?>">
            <label><?= $val ?></label>
        <?php endforeach ?>
    </div>

    </br></br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
