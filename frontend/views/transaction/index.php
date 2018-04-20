<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Transaction;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <div class="new-title">
        <i class="fa fa-tasks" aria-hidden="true"></i> Common Government Transactions
        <p style="text-indent: 30px; font-size: 14px;">List of Minimum Documentary Requirements for each Transaction in compliance to COA Circular No. 2012-001 of the Commission On Audit (COA) issued on June 14, 2012 as amended.</p>
    </div>

    <?php $form = ActiveForm::begin(); ?>
        <div style=" padding: 0; width: 88%; margin-left: auto; margin-right: auto; display: block;">
            <table class="search-table">
                <tr>
                    <td valign="top" align="right">
                        <i class="fa fa-search" style="color: green; font-size: 30px;"></i>
                    </td>
                    <td>
                        <?= $form->field($model, 'name')->dropDownList(['all' => 'All', ArrayHelper::map(transaction::find()->all(),'name', 'name')])->label(false) ?>
                    </td>
                    <td>
                        <div class="form-group">
                            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    <?php ActiveForm::end(); ?>

    <?php foreach ($dataProvider as $value) : ?>
        <div class="view-index" id="view-indexx" data-id = <?= $value->id ?>>
           <div class="mini-header">
                <?= $value->name ?>
           </div>
           <?php $requirements = explode(',', $value->requirements) ?>
               <?php foreach ($requirements as $id => $req)  : ?>
                   <div style="width: 320px; display: inline-block; margin: 5px; vertical-align: text-top;">
                       <?= ($id+1).'. '.$req ?>
                   </div>
               <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>

<?php
$this->registerJs("
    $('.view-index').css('cursor', 'pointer');
    $('.view-index').click(function (e) {
        var id = $(this).closest('.view-index').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['transaction/view']) . "?id=' + id;
    });
");
?>