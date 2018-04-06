<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('FMIS '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <!--top-banner -->
        <div class= "top-banner" >
            <div class="row">
            <?= Html::img('@web/images/new-banner.png', ['alt'=>'FMIS Banner', 'class' => 'top-ban-image']);?>
              <div class="row" style="padding-right: 25px;">
                        <div class="hum-wrapper">
                            <i class="fa fa-bars humburger"></i> 
                        </div>          
                        
                        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Search DV">
                            <?= Html::a('<i class="fa fa-search icon-font" aria-hidden="true"></i>', ["/disbursement/search"]) ?>
                        </div>
                        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Requirements">
                            <?= Html::a('<i class="fa fa-tasks icon-font" aria-hidden="true"></i>', ["/transaction/index"]) ?>
                        </div>

                        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Gallery">
                            <?= Html::a('<i class="fa fa-file-photo-o icon-font" aria-hidden="true"></i>', ["/images/index"]) ?>
                        </div>

                        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Go to home page">
                            <?= Html::a('<i class="fa fa-home icon-font" aria-hidden="true"></i>', ["/site/index"]) ?>
                        </div>
                </div>
            </div>
        </div>
<!--body-->
    <div class="content-wrapper">
            <?= Alert::widget() ?>
            <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
