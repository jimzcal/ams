<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use dektrium\rbac\models\Role;

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
    <title><?= Html::encode('DA-AMS '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <!--top-banner -->
        <div class= "top-banner" id="noprint">
            <div class="row">
            <?= Html::img('@web/images/new-banner.png', ['alt'=>'FMIS Banner', 'class' => 'top-ban-image']);?>
              <div class="row" style="padding-right: 25px;">
                <?php if (!Yii::$app->user->isGuest) : ?> 
                    <?= Html::beginForm(['/site/logout'], 'post')
                              .Html::submitButton('<i class="fa fa-sign-out icon-font"></i>', ['class' => 'icon'])
                            .Html::endForm()
                        ?>
                    <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Search DV">
                        <?= Html::a('<i class="fa fa-search icon-font" aria-hidden="true"></i>', ["/disbursement/search"]) ?>
                    </div>
                <?php endif ?>
                        <div class="hum-wrapper">
                            <i class="fa fa-bars humburger"></i> 
                        </div> 
                        <?php if (Yii::$app->user->isGuest) : ?> 
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Login">
                                <?= Html::a('<i class="fa fa-sign-in icon-font" aria-hidden="true"></i>', ["/user/login"]) ?>
                            </div>
                        <?php endif ?>

                        <?php if (!Yii::$app->user->isGuest) : ?> 
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="New DV">
                                <?= Html::a('<i class="fa fa-id-card icon-font" aria-hidden="true"></i>', ["/draft-dv/create"]) ?>
                            </div>
                        <?php endif ?>     
                    
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
        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="right-top-button">
                <?php $fullname = Yii::$app->user->identity->fullname; ?>
                <?php if (Yii::$app->user->can('manageUsers')) : ?>       
                    <?= Html::a('<i class="glyphicon glyphicon-user" aria-hidden="true"></i> ' .$fullname, ["/user/admin/index", 'id'=>Yii::$app->user->identity->id], ['class' => 'right-button-text']) ?> 
 
                <?php endif ?>

                <?php if (!Yii::$app->user->can('manageUsers') && (!Yii::$app->user->isGuest)) : ?>

                        <?= Html::a('<i class="glyphicon glyphicon-user" aria-hidden="true"></i> ' .$fullname, ["/user/admin/update", 'id'=>Yii::$app->user->identity->id], ['class' => 'right-button-text']) ?>
                <?php endif ?>
            </div>
        <?php endif ?>
<!--body-->
    <div class="content-wrapper">
            <?= Alert::widget() ?>
            <?= $content ?>
    </div>
</div>
<div style="bottom: 0; background-color: #000000; height: 40px; width: 100%; color: #ffffff; font-size: 20px; position: fixed;" id="noprint">
    <marquee>Work in progress............. Work in progress...</marquee>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
