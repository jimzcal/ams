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
use dektrium\rbac\models\Role;

AppAsset::register($this);
//rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '@mBackend/images/ams.png']) ?>
    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('AMS - '.$this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div id="noprint">
    <!--top-banner -->
        <div class= <?= !Yii::$app->user->isGuest ? "top-banner" : "top-ban"?> >
            <div class="row">
               <!--  <div class="col-lg-5"> -->
                    <?= Html::img('@web/images/new-banner.png', ['alt'=>'FMIS Banner', 'class' => 'top-ban-image']);?>
                <!-- </div>
                <div class="col-lg-7"> -->
                    <!-- <div class="row">
                        <i class="date">
                            <?= date('l').' - '; ?> <?= date('M. d, Y').' | '; ?>
                            <?php if(!Yii::$app->user->isGuest)
                                { 
                                    echo 'Logged: '.Yii::$app->user->identity->fullname; 
                                } 
                            ?>
                        </i>
                    </div>
 -->                    <div class="row" style="padding-right: 25px;">
                        <?php if (!Yii::$app->user->isGuest) : ?> 
                            <div class="hum-wrapper">
                                <div class="dropdown">
                                <i class="fa fa-bars humburger dropdown-toggle" data-toggle="dropdown"></i>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <?= Html::a('<i class="fa fa-home" aria-hidden="true"></i> Home', ["/site/index"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-id-card" aria-hidden="true"></i> Disbursements', ["/disbursement/index"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-sticky-note" aria-hidden="true"></i> NCA', ["/nca/index"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-list" aria-hidden="true"></i> Activity Logs', ["/activity-log/index"]) ?>
                                        </li>

                                        <?php if (Yii::$app->user->can('manageUsers')) : ?>
                                        <li>
                                            <?= Html::a('<i class="fa fa-user-o" aria-hidden="true"></i> User Management', ["/user/admin/index"]) ?>
                                        </li>
                                        <?php endif ?>

                                        <?php if (!Yii::$app->user->can('manageUsers')) : ?>
                                        <li>
                                            <?= Html::a('<i class="fa fa-user-o" aria-hidden="true"></i> Manage Users', ['/user/admin/update','id'=>Yii::$app->user->identity->id]) ?>
                                        </li>
                                        <?php endif ?>
                                        <li>
                                            <?= Html::a('<i class="fa fa-group" aria-hidden="true"></i> Employees', ["/employees/index"]) ?>                                            
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-cogs" aria-hidden="true"></i> Control Panel', ["/site/control"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-money" aria-hidden="true"></i> Cash Advances', ["/cash-advance/index"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-book" aria-hidden="true"></i> Financial Records', ["/disbursement/reports"]) ?>
                                        </li>
                                        <li>
                                            <?= Html::a('<i class="fa fa-pie-chart" aria-hidden="true"></i> ORS', ["/ors/index"]) ?>
                                        </li>
                                    </ul> 
                                </div>   
                            </div>       
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
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Employees">
                                <?= Html::a('<i class="fa fa-group icon-font" aria-hidden="true"></i>', ["/employees/index"]) ?>
                            </div>
                            <!-- <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Search DV">
                                <?= Html::a('<i class="fa fa-search icon-font" aria-hidden="true"></i>', ["/site/index"]) ?>
                            </div> -->
                            <!-- <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Go to transactions">
                                <?= Html::a('<i class="fa fa-tasks icon-font" aria-hidden="true"></i>', ["/transaction/index"]) ?>
                            </div> -->
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Control Panel">
                                <?= Html::a('<i class="fa fa-cogs icon-font" aria-hidden="true"></i>', ["/site/control"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Cash Advances">
                                 <i class="notification"><?= sizeof($notifications) == '0' ? '' :  sizeof($notifications) ?></i>
                                <?= Html::a('<i class="fa fa-money icon-font" aria-hidden="true"></i>', ["/cash-advance/index"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Financial Records">
                                <?= Html::a('<i class="fa fa-book icon-font" aria-hidden="true"></i>', ["/disbursement/reports"]) ?>
                            </div>
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="ORS">
                                <?= Html::a('<i class="fa fa-pie-chart icon-font" aria-hidden="true"></i>', ["/ors/index"]) ?>
                            </div>
                            <!-- <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Accounting Entries">
                                <?= Html::a('<i class="fa fa-calculator icon-font" aria-hidden="true"></i>', ["/accounting-entry/index"]) ?>
                            </div> -->
                            <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Activity Log">
                                <?= Html::a('<i class="fa fa-list icon-font" aria-hidden="true"></i>', ["/activity-log/index"]) ?>
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
               <!--  </div> -->
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
            <?php // date("Y-M-d") ?>
            <?php //$diff = date_diff(date_create(date("Y-M-d", $notifications->due_date)), date_create(date("Y-M-d"))); ?>
            <?php //$diff->format('%d') ?>
            <?= $content ?>
    </div>
    <div class="footer">
        <p>
            <?= date('l').' - '; ?> <?= date('M. d, Y').' | '; ?>
            <?php if(!Yii::$app->user->isGuest)
                { 
                    echo 'Logged: '.Yii::$app->user->identity->fullname; 
                } 
            ?>
        </p>

    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>