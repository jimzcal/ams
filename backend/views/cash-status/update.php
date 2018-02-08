<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CashStatus */

$this->title = 'Update Cash Status: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cash Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
