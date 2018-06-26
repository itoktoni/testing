<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/bootstrap/css/bootstrap.min.css',
        'frontend/bootstrap/css/bootstrap-responsive.min.css',
        'frontend/themes/css/bootstrappage.css',
        'frontend/themes/css/flexslider.css',
        'frontend/themes/css/main.css',
    ];
    public $js = [
//        'frontend/themes/js/jquery-1.7.2.min.js',
        'frontend/bootstrap/js/bootstrap.min.js',
        'frontend/themes/js/superfish.js',
        'frontend/themes/js/jquery.scrolltotop.js',
        'frontend/themes/js/common.js',
        'frontend/themes/js/jquery.flexslider-min.js',
        'frontend/themes/js/jquery.scrolltotop.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
    
}
