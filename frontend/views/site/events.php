<?php

use yii\widgets\LinkPager;

$this->title = 'News & Events';
?>
<?= Yii::$app->view->renderFile('@app/views/layouts/navbar.php') ?>

<div class="site-events">

	<section id="events" class="container">
		<?= Yii::$app->view->renderFile('@app/views/components/articles.php', [
			'feature' => $feature,
			'slug' => $slug,
			'contents' => $contents
		]) ?>

		<?= LinkPager::widget([
			'pagination' => $pagination,
			'prevPageCssClass' => 'page-item',
			'pageCssClass' => 'page-item',
			'nextPageCssClass' => 'page-item',
			'activePageCssClass' => 'active',
			'disabledPageCssClass' => 'disabled',
			'linkOptions' => [
				'class' => 'page-link'
			]
		]) ?>
	</section>
	
</div>

<?= Yii::$app->view->renderFile('@app/views/layouts/footer.php') ?>
