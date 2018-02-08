<?php

use common\models\Feature;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use frontend\helpers\Transform;

$features = ArrayHelper::getColumn(Feature::find()->asArray()->all(), 'name');

$slugged = array_map(
	[Transform::class, 'lowered'], 
		array_map([Transform::class, 'wordify'],
			array_map([Transform::class, 'hyphenated'], $features))
);

$links = array_map([Transform::class, 'build'], $features, $slugged);
?>
<nav id="nav" class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
		<a class="navbar-brand" href="/">
			<div class="logo-container">
				<?= Html::img('@mFrontEnd/images/logo/ppei-logo.png', [
					'width' => '70',
					'height' => '50',
					'alt' => 'PPEI Logo'
				]); ?>
				<h1 class="abbr">PPEI</h1>
			</div>
			<h6 class="tagline">Working Towards Building a<br>Green Economy and Sustainable Local Communities</h6>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<?php foreach($links as $link) :?>
					<?php switch($link['name']) :
						case 'News & Events' :?>
							<li id="<?= $link['slug'] ?>" class="nav-item">
								<a class="nav-link hvr-icon-bob" href="/<?= $link['slug'] ?>"><?= $link['name'] ?></a>
							</li>
						<?php break; ?>
						<?php case 'Stories of Change' :?>
							<li id="<?= $link['slug'] ?>" class="nav-item">
								<a class="nav-link hvr-icon-buzz-out" href="/<?= $link['slug'] ?>"><?= $link['name'] ?></a>
							</li>
						<?php break; ?>
						<?php case 'Knowledge Hub' :?>
							<li id="<?= $link['slug'] ?>" class="nav-item">
								<a class="nav-link hvr-icon-bounce" href="/<?= $link['slug'] ?>"><?= $link['name'] ?></a>
							</li>
						<?php break; ?>
						<?php case 'About Us' :?>
							<li id="<?= $link['slug'] ?>" class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="/<?= $link['slug'] ?>" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $link['name'] ?></a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									<a class="dropdown-item" href="/<?= $link['slug'] ?>#who-we-are">Who We Are</a>
									<a class="dropdown-item" href="/<?= $link['slug'] ?>#what-we-do">What We Do</a>
									<a class="dropdown-item" href="/<?= $link['slug'] ?>#stories-of-change">Stories of Change</a>
									<a class="dropdown-item" href="/<?= $link['slug'] ?>#partners">Partners</a>
								</div>
							</li>
						<?php break; ?>
						<?php case 'Gallery' :?>
							<li id="<?= $link['slug'] ?>" class="nav-item">
								<a class="nav-link hvr-icon-grow" href="/<?= $link['slug'] ?>"><?= $link['name'] ?></a>
							</li>
						<?php break; ?>
						<?php case 'Contact Us':?>
							<li id="<?= $link['slug'] ?>" class="nav-item">
								<a class="nav-link hvr-icon-float-away" href="/<?= $link['slug'] ?>"><?= $link['name'] ?></a>
							</li>
						<?php break; ?>
					<?php endswitch ?>
				<?php endforeach ?>
			</ul>
		</div>
  </div>
</nav>