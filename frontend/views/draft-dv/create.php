<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DraftDv */

$this->title = 'Create Draft Dv';
$this->params['breadcrumbs'][] = ['label' => 'Draft Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="draft-dv-create">

    <div class="new-title">
        <i class="fa fa-id-card" aria-hidden="true"></i> New Disbursement Voucher (Draft)
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
