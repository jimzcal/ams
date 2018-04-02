<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DisbursementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FINANCIAL REPORTS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursement-index">

    <div class="new-title">
        <i class="fa fa-cogs"></i> Control Panel
    </div>

    <div class="financial-reports-panel">

        <?= Html::a('<span class="fa fa-tasks" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Common Transactions', ["/transaction/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-users" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Manage Users', ["/user/admin/update", 'id'=>Yii::$app->user->identity->id], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-list" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Transaction Requirements', ["/requirements/create"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-file-photo-o" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Frontend Gallery', ["/images/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-database" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Funding Source Code', ["/funding-source/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-object-group" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Fund Cluster Code', ["/fund-cluster/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-language" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            MFO/PAP Code', ["/mfo-pap/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-institution" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Responsibilty Center', ["/responsibility-center/index"], ['class' => 'financial-report-icon']) 
        ?>

        <?= Html::a('<span class="fa fa-qrcode" aria-hidden="true" style="font-size: 55px; text-shadow: 2px 2px 5px grey"></span><br>
            Object Code', ["/object-code/index"], ['class' => 'financial-report-icon']) 
        ?>

    </div>
</div>
