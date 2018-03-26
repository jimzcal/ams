<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LddapAdaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lddap-ada-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <table class="search-table">
        <tr>
            <td valign="top" align="right">
                <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
            </td>
            <td>
                <?= $form->field($model, 'lddap_no')->textInput(['placeholder' => 'LDDAP No.'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'dv_no')->textInput(['placeholder' => 'DV No.'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'uacs_code')->textInput(['placeholder' => 'UACS Code'])->label(false) ?>
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
