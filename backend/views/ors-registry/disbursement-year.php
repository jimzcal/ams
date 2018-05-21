<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\models\Disbursement;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CashAdvanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FISCAL YEAR';
?>
<div class="cash-advance-index">

    <div class="new-title">
        <i class="fa fa-money" aria-hidden="true"></i> Monthly Disbursement
        <p style="text-indent: 28px; font-size: 14px; font-style: italic;">Select Fiscal Year</p>
    </div>

    <div style="width: 80%; margin-right: auto; margin-left: auto;">
        <?= Html::a('<i class="glyphicon glyphicon-arrow-right"></i> Fund Cluster 01 | FY. 2018', ["/ors-registry/mdisbursement?year=2018"]) ?>
        <br>
        <?= Html::a('<i class="glyphicon glyphicon-arrow-right"></i> Fund Cluster 02 | FY. 2018', ["/ors-registry/mdisbursement?year=2019"]) ?>
        <br>
        <?= Html::a('<i class="glyphicon glyphicon-arrow-right"></i> Fund Cluster 03 | FY. 2018', ["/ors-registry/mdisbursement?year=2020"]) ?>
        <br>
        <?= Html::a('<i class="glyphicon glyphicon-arrow-right"></i> Fund Cluster 04 | FY. 2018', ["/ors-registry/mdisbursement?year=2020"]) ?>
    </div>

</div>


<?php
// $this->registerJs("
//     $('tbody td').css('cursor', 'pointer');
//     $('tbody th').css('background-color', '#f5f5f0');
//     $('tbody td').click(function (e) {
//         var id = $(this).closest('tr').data('id');
//         if (e.target == this)
//             location.href = '" . Url::to(['disbursement/view']) . "?id=' + id;
//     });
// ");
?>