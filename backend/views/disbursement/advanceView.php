<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CASH ADVANCES';
?>
<div class="cash-advance-index">

    <div class="new-title">
        <i class="fa fa-money" aria-hidden="true"></i> Cash Advances
    </div>

    <div class="view-index">
        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th >DATE</th><th>DV NO.</th><th>PAYEE</th><th>AMOUNT</th><th>Action</th>
            </tr>
            <?php foreach ($results as $result) : ?>
                <tr data-id = <?= $result->id ?>>
                    <td><?= $result->date ?></td>
                    <td><?= $result->dv_no ?></td>
                    <td><?= $result->payee ?></td>
                    <td><?= number_format($result->gross_amount, 2) ?></td>
                    <td><?= Html::a('Notify', ['/cashAdvance/notice', 'id' => $result->id]) ?></td>
                </tr>
            <?php endforeach ?>
            <?php if($results == null) : ?>
                <tr>
                    <td style="font-style: italic;" colspan="4">No Records for Cash Advances..</td>
                </tr>
            <?php endif ?>
        </table>
    </div>
</div>
<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody th').css('background-color', '#f5f5f0');
    $('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['disbursement/view']) . "?id=' + id;
    });
");
?>