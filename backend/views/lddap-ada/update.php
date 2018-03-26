<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LddapAda */

$this->title = 'Update Lddap Ada: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lddap Adas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lddap-ada-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
