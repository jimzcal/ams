<?php
namespace frontend\views\site;

use Yii;
use yii\helpers\Html;

$this->title = 'Welcome to Philippine Poverty-Environment Initiative';
?>
<?= Yii::$app->view->renderFile('@app/views/layouts/navbar.php') ?>

<div class="site-index">

	<section id="banner">
		<div id="banner-slider" class="carousel slide container-fluid" data-ride="carousel">
			<div class="row">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<?= Html::img('@web/images/banner/image-1.jpg', [
							'class' => 'd-block w-100',
							'alt' => 'Banner Image'
						]); ?>
					</div>
					<div class="carousel-item">
						<?= Html::img('@web/images/banner/image-2.jpg', [
							'class' => 'd-block w-100',
							'alt' => 'Banner Image'
						]); ?>
					</div>
					<div class="carousel-item">
						<?= Html::img('@web/images/banner/image-3.jpg', [
							'class' => 'd-block w-100',
							'alt' => 'Banner Image'
						]); ?>
					</div>
				</div>
			</div>
		</div>
		<div id="banner-content" class="container-fluid">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<h1 class="display-4">Philippine Poverty-Environment Initiative</h1>
						<p class="lead">PPEI is a five-year (2011-2015) collaborative program of the Government of the Philippines and United Nations Development Programme-United Nations Environment Programme (UNDP-UNEP), through the Department of the Interior and Local Government (DILG).</p>
						<a class="btn btn-primary btn-lg" href="/about-us" role="button">Learn more</a>
					</div>
					<div class="col-md-5">
						<a href="http://dilg.gov.ph">
							<?= Html::img('@web/images/logo/dilg-logo.png', [
								'class' => 'hvr-grow',
								'alt' => 'DILG Logo'
							]); ?>
						</a>
						<a href="http://www.undp.org/content/undp/en/home.html">
							<?= Html::img('@web/images/logo/undp-logo.png', [
								'class' => 'hvr-grow',
								'alt' => 'UNDP Logo'
							]); ?>
						</a>
						<br>
						<a href="http://www.unenvironment.org">
							<?= Html::img('@web/images/logo/unep-logo.png', [
								'class' => 'hvr-grow',
								'alt' => 'UNEP Logo'
							]); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="headline" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<h2>Odit maxime quibusdam consectetur, velit.</h2>
				</div>
				<div class="col-md-4">
					<h6>Philippine Standard Time:</h6>
					<h6 class="time"></h6>
				</div>
			</div>
		</div>
	</section>

	<section id="content" class="container">
		<?= Yii::$app->view->renderFile('@app/views/components/articles.php', [
			'feature' => $feature,
			'slug' => $slug,
			'contents' => $contents
		]) ?>
		<?php if($contents) :?>
			<h4 class="events-link">Looking for more? Check out our <a href="/news-and-events">News & Events</a> section.</h4>
		<?php endif ?>
	</section>

	<section id="map" class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div id="geo-map"></div>
				</div>
				<div id="map-desc" class="col-md-6">
					<h1>Philippine Poverty-Environment Initiative</h1>
					<p>Operates at national and local levels, providing a better enabling environment for national and local governments to improve governance of natural wealth and benefit sharing from the revenues derived from them for a sustained and broad-based growth and ecological stability.</p>
					<p>At the local level, PPEI is currently working with the following local government units for piloting, capacity development, analytical studies, etc. Since 2011, the focus has been on mining and energy. PPEI aims to cover other natural resources (i.e. forestry, marine and coastal, water, etc.) beginning 2013.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="partners" class="container-fluid">
		<?= Yii::$app->view->renderFile('@app/views/components/partners.php') ?>
	</section>

</div>

<?= Yii::$app->view->renderFile('@app/views/layouts/footer.php') ?>