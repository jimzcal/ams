<?php

use yii\helpers\Url;
use kartik\social\Disqus;

$mSlug = ucwords(preg_replace('/-/', ' ', $slug));
$this->title = $mSlug.' | News & Events';
?>
<?= Yii::$app->view->renderFile('@app/views/layouts/navbar.php') ?>

<div class="site-article">

	<section id="article" class="container">
		<div class="row">
			<div class="col-md-12">
				
				<div class="card">
					<img class="card-img" src="https://dummyimage.com/600x600/000/fff" alt="...">
					<div class="card-img-overlay">
						<div class="card-content">
							<h1 class="card-title"><?= $article['title'] ?></h1>
							<h6 class="card-details">
								By PPEIV2 &#8226; 
								<i class="fa fa-clock-o" aria-hidden="true"></i> 
								<span id="a-time"></span> &#8226;
									<?= $this->registerJs('var at = $("#a-time"); at.text("Published "+moment("'.$article['date_posted'].'").fromNow());'); ?>
								<i class="fa fa-facebook" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Share"></i>
								<i class="fa fa-twitter" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Tweet"></i>
							</h6>
						</div>
					</div>
				</div>

				<div class="article">
					<h4>Sample data:</h4>
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis quaerat sapiente minima natus? Ratione quasi quisquam quam repellendus, necessitatibus dolore corrupti quod? Est rem autem, expedita nihil voluptatem, recusandae eos quisquam voluptates nostrum voluptate at vel perspiciatis, ipsa unde omnis. Deserunt soluta harum ipsum ducimus totam, quidem tempore consectetur distinctio.</p>
					<p>Quos quasi iure fugit illo a molestiae ad iste praesentium nisi cumque, soluta earum nostrum ab, quis est sequi beatae temporibus, amet hic iusto nobis. Cupiditate nam exercitationem vel incidunt pariatur maxime odit temporibus, quidem deserunt, beatae, ducimus unde accusamus aspernatur error obcaecati deleniti nisi sunt reiciendis dicta voluptatum molestiae.</p>
					<p>Accusantium dolorem consequuntur beatae nihil soluta aut atque vel dolore. Magnam odit expedita ex a blanditiis explicabo pariatur alias vero nemo repellat rerum quidem, quas deserunt tempore optio consequuntur unde animi nostrum. Atque ipsam ex, ratione voluptates sequi, natus doloribus eligendi labore ad ipsa tempore voluptatibus? Magnam aut numquam vitae.</p>

					<b>From DB:</b><br/>
					<?= $article['content'] ?>
				</div>

			</div>
			<div class="col-md-12">
				<?= Disqus::widget([
					'settings' => [
						'url' => Url::canonical(),
						'identifier' => $mSlug
					]
				]) ?>
			</div>
		</div>
	</section>

</div>

<?= Yii::$app->view->renderFile('@app/views/layouts/footer.php') ?>
