<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
use backend\models\AccountingEntry;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LDDAP-ADA';
?>
<div class="cash-advance-index">
    <?php $form = ActiveForm::begin(); ?>
        <div class="title">
            <?= Html::encode($this->title) ?>
            <?= Html::submitButton('LDDAP-ADA Form', ['class' => 'btn btn-primary btn-right']) ?>
        </div>
        <table class="table table-hover">
            <tr>
                <th></th><th>DV NO.</th><th>ACCOUNT TITLE</th><th>UACS CODE</th><th>GROSS AMOUNT</th><th>WITH-HOLDING TAX</th><th>NET AMOUNT</th><th>Credited To</th>
            </tr>
            <?php foreach ($disbursement as $result) : ?>
                <tr data-id = <?= $result->id; ?> <?php if($result->dv_no === $dv_no) : ?> style="background-color: #d8ffcc" <?php endif ?> >
                    <td></td>
                    <td><?= $result->dv_no ?></td>
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
                    <td><?= $result->credit_to === 'payee' ? $result->disbursement->payee : $result->credit_to;  ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody th').css('background-color', '#f5f5f0');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['disbursement/view']) . "&id=' + id;
    });
");
?>