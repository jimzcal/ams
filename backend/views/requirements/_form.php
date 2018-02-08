<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Requirements */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requirements-form">
	
	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'requirement')->textInput(['inputOptions' => ['maxlength' => true, 'autofocus' => 'autofocus']]) ?>

	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>
</div>

