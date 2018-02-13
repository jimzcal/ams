<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DisbursedDv */

$this->title = 'Create Disbursed Dv';
$this->params['breadcrumbs'][] = ['label' => 'Disbursed Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disbursed-dv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
