<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <table class="search-table-long">
        <tr>
            <td valign="top" align="right">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td width="170">
                <?= $form->field($model, 'date_time')->textInput(['placeholder' => 'Date & Time'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'particular')->textInput(['placeholder' => 'Particular'])->label(false) ?>
            </td>
            <td width="200">
                <?php echo $form->field($model, 'user')->textInput(['placeholder' => 'User'])->label(false) ?>
            </td>
            <td>
                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>
            </td>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>

</div>
