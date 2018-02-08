<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 *  
 */

class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'bundle/css/vendor.min.css',
		'css/app.min.css'
	];
	public $js = [
		'bundle/js/vendor.min.js',
		'js/app.min.js'
	];
	public $depends = [
		
	];
}
