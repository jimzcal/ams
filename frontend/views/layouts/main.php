<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

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
    <title><?= Html::encode($this->title) ?> | Philippine Poverty-Environment Initiative</title>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/favicon.ico']);?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

	<?= $content ?>
    <?= Yii::$app->view->renderFile('@app/views/components/fab.php') ?>
  
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
