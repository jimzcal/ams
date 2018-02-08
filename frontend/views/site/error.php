<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

  <div class="card">
    <div class="card-body">
      <?= Html::img('@web/images/logo/ppei-logo.png', [
          'height' => '70',
          'width' => '110',
          'alt' => 'PPEI Logo'
        ]); ?>
      <h4>Philippine Poverty-Environment Initiative</h4>
      <p class="card-text lead text-danger"><?= nl2br(Html::encode($message)) ?></p>
      <a href="/" class="mHover hvr-icon-back">Go back</a>
    </div>
    <div class="card-footer text-muted">
      <h6>The above error occurred while the Web server was processing your request.</h6>
      <h6>Please contact us if you think this is a server error. Thank you.</h6>
    </div>
  </div>

</div>
