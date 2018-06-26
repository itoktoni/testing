<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\FrontendAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$asset = FrontendAsset::register($this);
//dump();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= Html::encode($this->title) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
        <!-- bootstrap -->
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

        <style type="text/css">
            #search{
                color: black;
            }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <!--[if lt IE 9]>			
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>		
        <div id="top-bar" class="container">
            <div class="row">
                <div class="span4">
                    <?php
                    $form = ActiveForm::begin([
//                                'action' => ['search'],
                                'method' => 'get',
                                'options' => ['class' => 'form-inline'],
                    ]);
                    ?>
                    <input id="search" name="search" placeholder="Search Here" class="input-large" required value="" type="text">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']); ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="span8">
                    <div class="account pull-right">
                        <ul class="user-menu">				
                            <li><a href="#">My Account</a> <i class="fa fa-user"></i> </li>
                            <li><a href="<?php echo Url::to(['home/cart']); ?>">Your Cart [<?= $this->params['count'] ?>]</a></li>
                            <li><a href="<?php echo Url::to(['home/checkout']);?>">Checkout</a></li>					
                            <li><a href="register.html">Login</a></li>		
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="wrapper" class="container">
            <section class="navbar main-menu">
                <div class="navbar-inner main-menu">				
                    <a style="color: #6200c0;" href="<?= Url::to(['home/homepage']); ?>" class="logo pull-left">

                        <h4>Mitrais Shopping Cart</h4>
                    </a>
                    <nav id="menu" class="pull-right">
                        <ul>
                            <li><a href="">Order By</a>					
                                <ul>
                                    <li><a href="./products.html">Newest</a></li>									
                                    <li><a href="./products.html">Price Low to High</a></li>									
                                    <li><a href="./products.html">Price High to Low</a></li>
                                    <li><a href="./products.html">Name A-Z</a></li>									
                                    <li><a href="./products.html">Name Z-A</a></li>									
                                </ul>
                            </li>																						
                            <li><a href="./products.html">Best Seller</a></li>
                            <li><a href="./products.html">Top Seller</a></li>
                        </ul>
                    </nav>
                </div>
            </section>

            <section class="header_text">
                Welcome To Mitrais Ecommerce Project
                <hr />
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
            </section>      



            <?= $content ?>

            <section id="footer-bar">
                <div class="row">
                    <div class="span3">
                        <h4>Navigation</h4>
                        <ul class="nav">
                            <li><a href="./index.html">Homepage</a></li>  
                            <li><a href="./about.html">About Us</a></li>							
                        </ul>					
                    </div>
                    <div class="span4">
                        <h4>My Account</h4>
                        <ul class="nav">
                            <li><a href="#">Wish List</a></li>
                            <li><a href="#">Newsletter</a></li>
                        </ul>
                    </div>
                    <div class="span5">
                        <p class="logo"><img src="<?= Yii::$app->request->baseUrl . '/frontend/themes/images/'; ?>logo.png" class="site_logo" alt=""></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the  Lorem Ipsum has been the industry's standard dummy text ever since the you.</p>
                        <br/>
                        <span class="social_icons">
                            <a class="facebook" href="#">Facebook</a>
                            <a class="twitter" href="#">Twitter</a>
                            <a class="skype" href="#">Skype</a>
                            <a class="vimeo" href="#">Vimeo</a>
                        </span>
                    </div>					
                </div>	
            </section>
            <section id="copyright">
                <span>Copyright 2013 bootstrappage template  All right reserved.</span>
            </section>
        </div>

    </body>
    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>