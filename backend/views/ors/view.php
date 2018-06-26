<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ors */

$this->title = $model->id;
// $this->params['breadcrumbs'][] = ['label' => 'Ors', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-view">

   <div class="new-title">
        <i class="fa fa-calculator" aria-hidden="true"></i> Registry of Obligations
    </div>

   <!--  <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

<!--     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'particular',
            'ors_class',
            'funding_source',
            'ors_year',
            'ors_month',
            'ors_serial',
            'mfo_pap',
            'responsibility_center',
            'obligation',
        ],
    ]) ?> -->

    <div class="view-index">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Date</th>
                <th>ORS NO</th>
                <th>Particulars</th>
                <th>Responsibility Center</th>
                <th>Obligation</th>
                <th>Balance</th>
            </tr>
            <tr>
                <td><?= $model->date ?></td>
                <td style="width: 200px;">
                    <?= $model->ors_class.'-'.$model->funding_source.'-'.$model->ors_year.'-'.$model->ors_month.'-'.$model->ors_serial ?>
                </td>
                <td style="width: 300px;"><?= $model->particular ?></td>
                <td><?= $model->responsibility_center ?></td>
                <td><?= $model->obligation ?></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="view-index">

        <div class="mini-header">
            <i class="fa fa-line-chart"></i> Status of Obligation
        </div>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Date</th>
                <th>ORS NO</th>
                <th>Particulars</th>
                <th>Responsibility Center</th>
                <th>Obligation</th>
                <th>Payable</th>
                <th>Payment</th>
            </tr>
            <?php foreach ($model->obligationstatus as $value) : ?>
                <tr>
                    <td><?= $value->date ?></td>
                    <td><?= $value->ors_class.'-'.$value->funding_source.'-'.$value->ors_year.'-'.$value->ors_month.'-'.$value->ors_serial  ?></td>
                    <td style="width: 300px;"><?= $value->particular ?></td>
                    <td><?= $value->responsibility_center  ?></td>
                    <td><?= $value->obligation  ?></td>
                    <td><?= $value->payable  ?></td>
                    <td><?= $value->payment  ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>

<?php
$this->registerJs("
     $('tbody th').css('text-align', 'center');
 ");
?>
