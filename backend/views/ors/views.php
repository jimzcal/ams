<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Ors;
use backend\models\OrsRegistry;
/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = 'Obligation Status';
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-view">

   <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Registry of Obligations
    </div>

   

    <?php foreach ($ors_ids as $key => $value) : ?>

    <div class="view-index">
        <div class="mini-header">
            <i class="fa fa-line-chart"></i> Obligation Status <?= '(' .($key+1).')' ?>
        </div>

    <table class="table table-condensed table-striped table-bordered">
        <tr>
            <th>ORS No.</th>
            <th>Particulars</th>
            <th>MFO/PAP</th>
            <th>Res. Center</th>
            <th>Obligation</th>
            <th>Payable</th>
            <th>Payment</th>
        </tr>
        <?php $ors = Ors::find()->where(['id' => $value])->one(); ?>
            <?php $ors_reg = OrsRegistry::find()->where(['ors_id' => $ors->id])->all(); ?>
            <?php foreach ($ors_reg as $val) : ?>
                <tr>
                    <td>
                        <?= $val->ors_class.'-'.$val->funding_source.'-'.$val->ors_year.'-'.$val->ors_month.'-'.$val->ors_serial ?>
                    </td>
                    <td><?= $ors->particular ?></td>
                    <td><?=  $val->mfo_pap ?></td>
                    <td><?=  $val->responsibility_center ?></td>
                    <td><?=  $val->obligation ?></td>
                    <td><?=  $val->payable ?></td>
                    <td><?=  $val->payment ?></td>
                </tr>
            <?php endforeach ?>
    </table>
    </div>
    <?php endforeach ?>
</div>

