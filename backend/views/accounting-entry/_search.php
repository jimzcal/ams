<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AccountingEntrySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accounting-entry-search">

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
                <?= $form->field($model, 'account_title')->textInput(['placeholder' => 'Account Title'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'uacs_code')->textInput(['placeholder' => 'UACS Code'])->label(false) ?>
            </td>
            <td>
                <?php echo $form->field($model, 'credit_amount')->textInput(['placeholder' => 'Credit Amount'])->label(false) ?>
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
