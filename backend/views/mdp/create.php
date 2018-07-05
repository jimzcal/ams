<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Mdp */

$this->title = 'Create Mdp';
$this->params['breadcrumbs'][] = ['label' => 'Mdps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
