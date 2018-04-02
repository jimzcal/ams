<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MfoPap */

$this->title = 'Create Mfo Pap';
$this->params['breadcrumbs'][] = ['label' => 'Mfo Paps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mfo-pap-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
