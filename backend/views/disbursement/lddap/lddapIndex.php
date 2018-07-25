<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use yii\widgets\ActiveForm;
use backend\models\LddapAda;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LDDAP-ADA';
?>
<div class="cash-advance-index">
    <?= Yii::$app->session->getFlash('error'); ?>
    <?php $form = ActiveForm::begin(); ?>
    
        <div class="right-top-button">
            <?= Html::submitButton('<i class="glyphicon glyphicon-file"></i> Generate LDDAP', ['class' => 'right-button-text']) ?>
        </div>

        <div class="new-title">
           <i class="glyphicon glyphicon-list-alt"></i> List of Due and Demandable Accounts Payable - Advice to Debit Account (LDDAP-ADA)
        </div>

        <div class="view-index">
            <table class="table table-hover table-bordered">
                <tr>
                    <th></th>
                    <th>DV NO.</th>
                    <th>Credited To</th>
                    <th>ACCOUNT TITLE</th>
                    <th>UACS CODE</th>
                    <th>GROSS AMOUNT</th>
                    <th>WITH-HOLDING TAX</th>
                    <th>NET AMOUNT</th>
                </tr>
                <?php foreach ($disbursement as $result) : ?>
                    <?php if(LddapAda::find()->where(['dv_no' => $result->dv_no])->one() === null) : ?>
                    <tr <?php if($result->dv_no === $dv_no) : ?> style="background-color: #d8ffcc" <?php endif ?> >
                        <td><input type="checkbox" name="dvs[<?= $result->dv_no ?>]" value = "<?= $result->dv_no ?>"></td>
                        <td><?= $result->dv_no ?></td>
                        <td><?= $result->credit_to === 'payee' ? $result->disbursement->payee : $result->credit_to;  ?>
                        </td>
                        <td><?= $result->account_title ?></td>
                        <td><?= $result->uacs_code ?></td>
                        <td><?= number_format($result->disbursement->gross_amount, 2) ?></td>
                        <td>
                            <?= 
                                number_format(array_sum(ArrayHelper::getColumn(
                                    AccountingEntry::find(['credit_amount'])
                                    ->where(['dv_no'=>$result->dv_no])
                                    ->andWhere(['credit_to' => 'BIR'])
                                    ->all(), 'credit_amount')), 2)
                            ?>
                        </td>
                        <td><?= number_format($result->credit_amount, 2) ?></td>
                    </tr>
                <?php endif ?>
                <?php endforeach ?>
                <?= $form->field($model, 'dvs')->hiddenInput()->label(false) ?>
            </table>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
// $this->registerJs("
//     $('tbody td').css('cursor', 'pointer');
//     $('tbody th').css('background-color', '#f5f5f0');
//     $('tbody td').click(function (e) {
//         var id = $(this).closest('tr').data('id');
//         if (e.target == this)
//             location.href = '" . Url::to(['disbursement/view']) . "&id=' + id;
//     });
// ");
?>