<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Far101Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="far101-search">

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
                <?= $form->field($model, 'fiscal_year')->textInput(['placeholder' => 'Fiscal Year'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'fund_cluster')->textInput(['placeholder' => 'Fund Cluster'])->label(false) ?>
            </td>
            <td>
                <?= $form->field($model, 'particulars')->textInput(['placeholder' => 'Particulars'])->label(false) ?>
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
