<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Far101 */

$this->title = 'New FAR-1';
// $this->params['breadcrumbs'][] = ['label' => 'Far101s', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="far101-create">

   <!--  <h3><i class="fa fa-line-chart" aria-hidden="true"></i> Financial Accountability Report (FAR 1)</h3><br> -->

    <?= $this->render('_form', [
        'model' => $model,
        'fiscal_year' => $fiscal_year,
        'fund_cluster' => $fund_cluster,
        'far' => $far
    ]) ?>

</div>
