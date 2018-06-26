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
class CozaAsset extends AssetBundle {

    public $template;
    public $basePath = '@webroot';
    public $baseUrl = '@web/coza';
    public $css = [
        'vendor/bootstrap/css/bootstrap.min.css',
        'fonts/font-awesome-4.7.0/css/font-awesome.min.css',
        'fonts/iconic/css/material-design-iconic-font.min.css',
        'fonts/linearicons-v1.0.0/icon-font.min.css',
        'vendor/animate/animate.css',
        'vendor/css-hamburgers/hamburgers.min.css',
        'vendor/animsition/css/animsition.min.css',
        'vendor/select2/select2.min.css',
        'vendor/daterangepicker/daterangepicker.css',
        'vendor/slick/slick.css',
        'vendor/MagnificPopup/magnific-popup.css',
        'vendor/perfect-scrollbar/perfect-scrollbar.css',
        'css/jssocials.css',
        'css/instantsearch.min.css',
        'css/jssocials-theme-flat.css',
        'css/util.css',
        'css/main.css',
    ];
    public $js = [
        // 'vendor/jquery/jquery-3.2.1.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js',
        'https://cdn.socket.io/socket.io-1.3.5.js',
        'vendor/animsition/js/animsition.min.js',
        'vendor/bootstrap/js/popper.js',
        'vendor/bootstrap/js/bootstrap.min.js',
        'vendor/select2/select2.min.js',
        'vendor/daterangepicker/moment.min.js',
        'vendor/daterangepicker/daterangepicker.js',
        'vendor/slick/slick.min.js',
        'js/slick-custom.js',
        'vendor/parallax100/parallax100.js',
        'vendor/isotope/isotope.pkgd.min.js',
        'vendor/sweetalert/sweetalert.min.js',
        'vendor/perfect-scrollbar/perfect-scrollbar.min.js',
        'js/jssocials.min.js',
        'js/algoliasearch.min.js',
        'js/autocomplete.jquery.min.js',
        'js/detail.js',
        'js/main.js',
    ];
    public $depends = [
//'yii\web\YiiAsset',
//'yii\bootstrap\BootstrapAsset',
    ];

}
