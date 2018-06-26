<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii;
use yii\web\View;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class NotyAsset extends AssetBundle {

    public $template;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/noty.css',
    ];
    public $js = [
        'js/noty.min.js',
    ];
    public $depends = [
//'yii\web\YiiAsset',
//'yii\bootstrap\BootstrapAsset',
    ];

}
