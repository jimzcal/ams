<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrsRegistry */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ors Registries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ors-registry-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'ors_class',
            'funding_source',
            'ors_year',
            'ors_month',
            'ors_serial',
            'mfo_pap',
            'responsibility_center',
            'gross_amount',
            'less_amount',
            'net_amount',
        ],
    ]) ?>

</div>
