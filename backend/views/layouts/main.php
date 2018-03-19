<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\BootstrapAsset;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use backend\models\CashAdvance;
use common\widgets\Alert;

AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/images/logo.ico']) ?>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('FMIS - '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="noprint">
    <!--top-banner -->
        <div class="top-banner">
            <div class="row">
                <div class="col-lg-5">
                <?= Html::img('/web/images/banner.png', ['alt'=>'FMIS Banner']);?>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <i class="date"><?= date('l').' - '; ?></strong><?= date('M. d, Y').' | '; ?>
                        <?php if(!Yii::$app->user->isGuest)
                        { 
                            echo 'Logged: '.Yii::$app->user->identity->fullname; 
                        } ?>
                        </i>
                    </div>
                    <div class="row" style="padding-right: 25px;">
                        <?php if (!Yii::$app->user->isGuest) : ?>               
                            <?= Html::beginForm(['/site/logout'], 'post')
                                  .Html::submitButton('<i class="fa fa-sign-out icon-font"></i>', ['class' => 'icon'])
                                .Html::endForm()
                            ?>
                            <?php if (Yii::$app->user->can('manageUsers')) : ?>
                                <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Manage User's Account">
                                    <?= Html::a('<i class="fa fa-user-o icon-font" aria-hidden="true"></i>', ["/user/admin/index"]) ?>
                                </div>
                            <?php endif ?>
                            <?php if (!Yii::$app->user->can('manageUsers')) : ?>
                                <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Manage User's Account">
                                    <?= Html::a('<i class="fa fa-user-o icon-font" aria-hidden="true"></i>', ['/user/admin/update','id'=>Yii::$app->user->identity->id]) ?>
                                </div>
                            <?php endif ?>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Search DV">
                                <?= Html::a('<i class="fa fa-search icon-font" aria-hidden="true"></i>', ["/site/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Go to transactions">
                                <?= Html::a('<i class="fa fa-tasks icon-font" aria-hidden="true"></i>', ["/transaction/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Status of Cash Allocation">
                                <?= Html::a('<i class="fa fa-bar-chart-o icon-font" aria-hidden="true"></i>', ["/cash-status/index2"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Accounting Entries">
                                <?= Html::a('<i class="fa fa-calculator icon-font" aria-hidden="true"></i>', ["/accounting-entry/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Financial Reports">
                                <?= Html::a('<i class="fa fa-book icon-font" aria-hidden="true"></i>', ["/disbursement/reports"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Cash Advances">
                                <?= Html::a('<i class="fa fa-money icon-font" aria-hidden="true"></i>', ["/disbursement/cash"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="NCA">
                                <?= Html::a('<i class="fa fa-sticky-note icon-font" aria-hidden="true"></i>', ["/nca/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Disbursement Vouchers">
                                <?= Html::a('<i class="fa fa-id-card icon-font" aria-hidden="true"></i>', ["/disbursement/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Go to home page">
                                <?= Html::a('<i class="fa fa-home icon-font" aria-hidden="true"></i>', ["/site/index"]) ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--body-->
    <div class="content-wrapper">
            <?php 
                if (!Yii::$app->user->isGuest) {
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]);
                        }
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>