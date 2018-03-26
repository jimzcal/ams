<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LddapAda */

$this->title = 'Create Lddap Ada';
$this->params['breadcrumbs'][] = ['label' => 'Lddap Adas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lddap-ada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
