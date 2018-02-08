<?php

use yii\helpers\Html;
?>
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md">
				<?= Html::img('@mFrontEnd/images/logo/ppei-logo.png', [
					'width' => '110',
					'height' => '70',
					'alt' => 'PPEI Logo'
				]); ?>
				<h4>Philippine Poverty-Environment Initiative</h4>
				<div class="divider">
					<h4>PPEI Project Management Office</h4>
					<h5>Bureau of Local Government Development</h5>
					<h6>Department of the Interior and Local Government</h6>
					<h6>25th Floor, DILG-NAPOLCOM Center, EDSA cor. <br> Quezon Avenue, Quezon City, PH</h6>
					<h6>Telefax: +632 929 92 35; +632 927 78 52</h6>
					<h6>Email Address: <a href="mailto:ppei_dilg@yahoo.com">ppei_dilg@yahoo.com</a></h6>
				</div>
				<ul id="list-lower" class="list-group">
					<li><a href="/about#who-we-are">About Us</a></li>
					<li><a href="#">Terms and Conditions</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
				<p class="copyright">&copy; 2013 - <?= date('Y') ?></p>
			</div>
		</div>
	</div>
</footer>
