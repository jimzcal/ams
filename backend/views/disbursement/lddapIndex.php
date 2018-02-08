<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'LDDAP-ADA';
?>
<div class="cash-advance-index">

    <div class="title">
        <?= Html::encode($this->title) ?>
    </div>
    <table class="table table-hover">
        <tr>
            <th >DV NO.</th><th>ACCOUNT TITLE</th><th>UACS CODE</th><th>DEBIT AMOUNT</th><th>CREDIT AMOUNT</th><th>Credited To</th>
        </tr>
        <?php foreach ($disbursement as $result) : ?>
            <tr data-id = <?= $result->id ?>>
                <td><?= $result->dv_no ?></td><td><?= $result->account_title ?></td><td><?= $result->uacs_code ?></td><td><?= number_format($result->debit, 2) ?></td>
                <td><?= number_format($result->credit_amount, 2) ?></td>
                <td><?= $result->credit_to ?></td>
            </tr>
        <?php endforeach ?>
    </table>
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