<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SELECT NCA';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-status-index">

    <div class="title"><?= Html::encode($this->title) ?></div>
    <table class="table table-hover">
        <tr>
            <th>DATE</th><th>PERIOD</th><th>NCA NO.</th><th>AMOUNT</th>
        </tr>
        <?php foreach ($ncas as $value) : ?>
        <tr data-nca_no = <?= $value->nca_no ?> >
            <td><?= $value->date_received ?></td><td><?= $value->fiscal_year ?></td><td><?= $value->nca_no ?></td><td><?= number_format($value->total_amount, 2) ?></td>
        </tr>
    <?php endforeach ?>
    </table>
</div>

<?php
$this->registerJs("
    $('tbody td').css('cursor', 'pointer');
    $('tbody th').css('background-color', '#f5f5f0');
    $('tbody td').click(function (e) {
        var nca_no = $(this).closest('tr').data('nca_no');
        if (e.target == this)
            location.href = '" . Url::to(['disbursement/index']) . "&nca_no=' + nca_no;
    });
");
?>
