<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">
  <div class="form-wrapper-content">
      <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

      <div style="background-color: #f5f5f0; font-weight: bold; padding: 10px;">
        <label>Select Requirements</label>
      </div>

      <div style="height: 250px; padding: 10px;">
        <?php foreach ($requirements as $value) : ?>
          <div class="cbox">
            <?= $form->field($model, 'requirements[]')->checkbox(['label'=>$value->requirement, 'value'=>$value->requirement])->label(false); ?>
          </div>
        <?php endforeach ?>
      </div>

      <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>

      <?php ActiveForm::end(); ?>
    </div>

</div>
