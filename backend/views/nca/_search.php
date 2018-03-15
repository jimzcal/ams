<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\FundCluster;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\NcaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nca-search">

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
                <?= $form->field($model, 'fund_cluster')->dropDownList(ArrayHelper::map(FundCluster::find()->all(),'fund_cluster','fund_cluster'),
                    [
                        'prompt'=>'Fund Cluster',

                    ])->label(false); ?>
            </td>
            <td>
                <?php echo $form->field($model, 'fiscal_year')->textInput(['placeholder' => 'Fiscal Year'])->label(false) ?>
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
