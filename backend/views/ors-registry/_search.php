<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ors-registry-search">

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
            <td>
                <?= $form->field($model, 'date')->textInput(['placeholder' => 'Date'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'ors_class')->textInput(['placeholder' => 'Allotment Class'])->label(false) ?>
            </td>
            <td>
                <?php echo $form->field($model, 'funding_source')->textInput(['placeholder' => 'Funding Source'])->label(false) ?>
            </td>
            <td>
                <?php echo $form->field($model, 'ors_year')->textInput(['placeholder' => 'Fiscal Year'])->label(false) ?>
            </td>
            <td>
                <?php echo $form->field($model, 'mfo_pap')->textInput(['placeholder' => 'MFO/PAP'])->label(false) ?>
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
