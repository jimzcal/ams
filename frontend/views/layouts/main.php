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
    <div class="top-line">
        
    </div>
    <div class="icon-wrapper">
        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Search DV">
            <?= Html::a('<i class="glyphicon glyphicon-search icon-font" aria-hidden="true"></i>', ["/user/admin/index"]) ?>
        </div>
        <div class="icon" data-toggle="tooltip" data-placement="bottom" title="Organization Structure">
            <?= Html::a('<i class="glyphicon glyphicon-list-alt icon-font" aria-hidden="true"></i>', ["/user/admin/index"]) ?>
        </div>
    </div>
    <div class="content-wrapper">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
