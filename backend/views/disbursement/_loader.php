<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Disbursement */
/* @var $form yii\widgets\ActiveForm */
$baseUrl = Yii::getAlias('@web');
?>
<META HTTP-EQUIV="refresh" CONTENT=".5; URL= <?= $baseUrl ?>/disbursement/view?id=<?= $id ?>">

<div style="margin-left: auto; margin-right: auto; margin-top: 100px; text-align: center; height: 100%; vertical-align: middle;">
  <?php Yii::$app->getSession()->setFlash('success', 'DV was recorded as released.'); ?>
  <i class="fa fa-refresh fa-spin" style="font-size: 75px;"></i>

</div>





