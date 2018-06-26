<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\CozaAsset;
use app\assets\NotyAsset;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

CozaAsset::register($this);
NotyAsset::register($this);
$image = Yii::$app->params['base_url'] . Yii::$app->params['frontend'] . '/';
$pro = Yii::$app->params['base_url'] . 'files/product/';
?>
<?php $this->
beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php echo Yii::$app->
            params['name'];?>
        </title>
        <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1" name="viewport">
                <?= Html::csrfMetaTags() ?>
                <?php $this->head() ?>
            </meta>
        </meta>

       <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        <script>
          var OneSignal = window.OneSignal || [];
          OneSignal.push(function() {
            OneSignal.init({
              appId: "be69ab55-690b-475c-aca2-c49616ce38c8",
            });
          });
        </script>

        <script src="https://js.pusher.com/4.0/pusher.min.js"></script>
          <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('b07270a223c7b4f48843', {
              cluster: 'ap1',
              encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {

              new Noty({
                text: data.message,
                theme: 'metroui',
                layout: 'topRight',
                closeWith: ['button'],
                type: 'info',
            }).show();

            });
          </script>


    </head>
    <body class="animsition">
        <!-- Header -->
        <header class="header-v3">


            <!-- Header desktop -->
            <div class="container-menu-desktop trans-03">
                <div class="wrap-menu-desktop">
                    <nav class="limiter-menu-desktop p-l-45">
                        <!-- Logo desktop -->
                        <a class="logo" href="<?php Url::to(['/']);?>">
                            <img alt="IMG-LOGO" src="<?php echo $image; ?>images/icons/logo-02.png">
                            </img>
                        </a>
                        <!-- Menu desktop -->
                        <div class="menu-desktop">
                            <ul class="main-menu">
                                <li>
                                    <a href="<?= Url::to(['home/homepage']); ?>">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['home/product']); ?>">
                                        Product
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['home/about']); ?>">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['home/contact']); ?>">
                                        Contact
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Icon header -->
                        <div class="wrap-icon-header flex-w flex-r-m h-full">
                            <?php if(isset($_SESSION['login'])):?>
                            <div class="flex-c-m h-full p-r-25 bor6">
                                <a href="<?php echo Url::to(['global/logout']);?>">
                                    <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                        <i class="zmdi zmdi-power-off">
                                        </i>
                                    </div>
                                </a>
                            </div>
                            <?php else:?>
                            <div class="flex-c-m h-full p-r-25 bor6">
                                <a href="<?php echo Url::to(['global/login']);?>">
                                    <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                        <i class="zmdi zmdi-key">
                                        </i>
                                    </div>
                                </a>
                            </div>
                            <?php endif?>
                            <div class="flex-c-m h-full p-r-25 bor6" style="margin-left: 15px;">
                                <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="<?= $this->params['count'] ?>">
                                    <i class="zmdi zmdi-shopping-cart">
                                    </i>
                                </div>
                            </div>
                            <div class="flex-c-m h-full p-lr-19">
                                <div class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                                    <i class="zmdi zmdi-menu">
                                    </i>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->
                <div class="logo-mobile">
                    <a href="index.html">
                        <img alt="IMG-LOGO" src="<?php echo $image; ?>images/icons/logo-01.png"/>
                    </a>
                </div>
                <!-- Icon header -->
                <?php if(isset($_SESSION['login'])):?>
                <div class="flex-c-m h-full p-r-25 bor6">
                    <a href="<?php echo Url::to(['global/logout']);?>">
                        <div style="color: black;margin-right: -20px;" class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                            <i class="zmdi zmdi-power-off">
                            </i>
                        </div>
                    </a>
                </div>
                <?php else:?>
                <div class="flex-c-m h-full p-r-25 bor6">
                    <a href="<?php echo Url::to(['global/login']);?>">
                        <div style="color: black;margin-right: -20px;" class="icon-header-item cl0 hov-cl1 trans-04 p-lr-11 js-show-sidebar">
                            <i class="zmdi zmdi-key">
                            </i>
                        </div>
                    </a>
                </div>
                <?php endif?>
                <div class="wrap-icon-header flex-w flex-r-m h-full m-r-15">
                    <div class="flex-c-m h-full p-r-5">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                            <i class="zmdi zmdi-shopping-cart">
                            </i>
                        </div>
                    </div>
                </div>
                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner">
                        </span>
                    </span>
                </div>
            </div>
            <!-- Menu Mobile -->
            <div class="menu-mobile">
                <ul class="main-menu-m">
                    <li>
                        <a href="<?= Url::to(['home/homepage']); ?>">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['home/product']); ?>">
                            Product
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['home/about']); ?>">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['home/contact']); ?>">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Modal Search -->
            <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
                <button class="flex-c-m btn-hide-modal-search trans-04">
                    <i class="zmdi zmdi-close">
                    </i>
                </button>
                <form class="container-search-header">
                    <div class="wrap-search-header">
                        <input class="plh0" name="search" placeholder="Search..." type="text">
                            <button class="flex-c-m trans-04">
                                <i class="zmdi zmdi-search">
                                </i>
                            </button>
                        </input>
                    </div>
                </form>

            </div>
        </header>
        <!-- Sidebar -->
        <aside class="wrap-sidebar js-sidebar">
            <div class="s-full js-hide-sidebar">
            </div>
            <div class="sidebar flex-col-l p-t-22 p-b-25">
                <div class="flex-r w-full p-b-30 p-r-27">
                    <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
                        <i class="zmdi zmdi-close">
                        </i>
                    </div>
                </div>
                <div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
                    <ul class="sidebar-link w-full">
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="index.html">
                                Home
                            </a>
                        </li>
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="#">
                                My Wishlist
                            </a>
                        </li>
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="#">
                                My Account
                            </a>
                        </li>
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="#">
                                Track Oder
                            </a>
                        </li>
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="#">
                                Refunds
                            </a>
                        </li>
                        <li class="p-b-13">
                            <a class="stext-102 cl2 hov-cl1 trans-04" href="<?php echo Url::to(['global/logout']); ?>">
                                Logout
                            </a>
                        </li>
                    </ul>
                    <div class="sidebar-gallery w-full p-tb-30">
                        <span class="mtext-101 cl5">
                            @ CozaStore
                        </span>
                        <div class="flex-w flex-sb p-t-36 gallery-lb">
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-01.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-01.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-02.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-02.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-03.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-03.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-04.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-04.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-05.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-05.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-06.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-06.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-07.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-07.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-08.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-08.jpg');">
                                </a>
                            </div>
                            <!-- item gallery sidebar -->
                            <div class="wrap-item-gallery m-b-10">
                                <a class="item-gallery bg-img1" data-lightbox="gallery" href="<?php echo $image; ?>images/gallery-09.jpg" style="background-image: url('<?php echo $image; ?>images/gallery-09.jpg');">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-gallery w-full">
                        <span class="mtext-101 cl5">
                            About Us
                        </span>
                        <p class="stext-108 cl6 p-t-27">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus vulputate hendrerit. Praesent faucibus erat vitae rutrum gravida. Vestibulum tempus mi enim, in molestie sem fermentum quis.
                        </p>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Cart -->
        <div class="wrap-header-cart js-panel-cart">
            <div class="s-full js-hide-cart">
            </div>
            <div class="header-cart flex-col-l p-l-65 p-r-25">
                <div class="header-cart-title flex-w flex-sb-m p-b-8">
                    <span class="mtext-103 cl2">
                        Your Cart
                    </span>
                    <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                        <i class="zmdi zmdi-close">
                        </i>
                    </div>
                </div>
                <div class="header-cart-content flex-w js-pscroll">
                    <ul class="header-cart-wrapitem w-full">
                        <?php $total = 0; ?>
                        <?php if (!empty($_SESSION['cart'])): ?>
                        <?php for ($i = 0; $i < count($_SESSION['cart']); $i++): ?>
                        <?php $total = $total + $_SESSION['cart'][$i]['product_price'] * $_SESSION['cart'][$i]['qty']; ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img alt="IMG" src="<?php echo $pro.$_SESSION['cart'][$i]['product_image']; ?>">
                                </img>
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a class="header-cart-item-name m-b-18 hov-cl1 trans-04" href="<?php echo Url::to(['home/detail', 'id' => $_SESSION['cart'][$i]['product_url']]); ?>">
                                    <?php echo $_SESSION['cart'][$i]['product_name']; ?>
                                </a>
                                <span class="header-cart-item-info">
                                    <?php echo $_SESSION['cart'][$i]['qty']; ?>
                                    x $
                                    <?php echo number_format($_SESSION['cart'][$i]['product_price']); ?>
                                </span>
                            </div>
                        </li>
                        <?php endfor; ?>
                        <?php endif; ?>
                    </ul>
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: $
                            <?php echo number_format($total); ?>
                        </div>
                        <div class="header-cart-buttons flex-w w-full">
                            <a class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10" href="<?php echo Url::to(['home/cart']); ?>">
                                View Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider -->
        <section class="section-slide" style="background-color: #2b2453;height: 73px;">
        </section>

        <!-- <form type="GET" action="<?php echo Url::to(['home/product']);?>"> -->
        <div class="panel-search w-full p-t-10 p-b-15">
            <div class="bor8 dis-flex p-l-15">
                <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" id="aa-search-input" name="search" placeholder="Search"  style="margin-bottom: -70px !important;">
            </div>
        </div>
        <!-- </form> -->

        

        <?= $content ?>
        <!-- Footer -->
        <footer class="bg3 p-t-75 p-b-32">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3 p-b-50">
                        <h4 class="stext-301 cl0 p-b-30">
                            Categories
                        </h4>
                        <ul>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Women
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Men
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Shoes
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Watches
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-3 p-b-50">
                        <h4 class="stext-301 cl0 p-b-30">
                            Help
                        </h4>
                        <ul>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Track Order
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Returns
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    Shipping
                                </a>
                            </li>
                            <li class="p-b-10">
                                <a class="stext-107 cl7 hov-cl1 trans-04" href="#">
                                    FAQs
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-3 p-b-50">
                        <h4 class="stext-301 cl0 p-b-30">
                            GET IN TOUCH
                        </h4>
                        <p class="stext-107 cl7 size-201">
                            Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
                        </p>
                        <div class="p-t-27">
                            <a class="fs-18 cl7 hov-cl1 trans-04 m-r-16" href="#">
                                <i class="fa fa-facebook">
                                </i>
                            </a>
                            <a class="fs-18 cl7 hov-cl1 trans-04 m-r-16" href="#">
                                <i class="fa fa-instagram">
                                </i>
                            </a>
                            <a class="fs-18 cl7 hov-cl1 trans-04 m-r-16" href="#">
                                <i class="fa fa-pinterest-p">
                                </i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 p-b-50">
                        <h4 class="stext-301 cl0 p-b-30">
                            Newsletter
                        </h4>
                        <form method="POST" action="<?php echo Url::to(['/']);?>">
                            <div class="wrap-input1 w-full p-b-4">
                                <input class="input1 bg-none plh1 stext-107 cl7" name="email" placeholder="email@example.com" type="text">
                                    <div class="focus-input1 trans-04">
                                    </div>
                                </input>
                            </div>
                            <div class="p-t-18">
                                <button type="submit" class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="p-t-40">
                    <div class="flex-c-m flex-w p-b-18">
                        <a class="m-all-1" href="#">
                            <img alt="ICON-PAY" src="<?php echo $image; ?>images/icons/icon-pay-01.png">
                            </img>
                        </a>
                        <a class="m-all-1" href="#">
                            <img alt="ICON-PAY" src="<?php echo $image; ?>images/icons/icon-pay-02.png">
                            </img>
                        </a>
                        <a class="m-all-1" href="#">
                            <img alt="ICON-PAY" src="<?php echo $image; ?>images/icons/icon-pay-03.png">
                            </img>
                        </a>
                        <a class="m-all-1" href="#">
                            <img alt="ICON-PAY" src="<?php echo $image; ?>images/icons/icon-pay-04.png">
                            </img>
                        </a>
                        <a class="m-all-1" href="#">
                            <img alt="ICON-PAY" src="<?php echo $image; ?>images/icons/icon-pay-05.png">
                            </img>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Back to top -->
        <div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up">
                </i>
            </span>
        </div>
        <!-- Modal1 -->
        <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
            <div class="overlay-modal1 js-hide-modal1">
            </div>
            <div class="container">
                <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                    <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                        <img alt="CLOSE" src="<?php echo $image; ?>images/icons/icon-close.png">
                        </img>
                    </button>
                    <div class="row">
                        <div class="col-md-6 col-lg-7 p-b-30">
                            <div class="p-l-25 p-r-30 p-lr-0-lg">
                                <div class="wrap-slick3 flex-sb flex-w">
                                    <div class="wrap-slick3-dots">
                                    </div>
                                    <div class="wrap-slick3-arrows flex-sb-m flex-w">
                                    </div>
                                    <div class="slick3 gallery-lb">
                                        <div class="item-slick3" data-thumb="<?php echo $image; ?>images/product-detail-01.jpg">
                                            <div class="wrap-pic-w pos-relative">
                                                <img alt="IMG-PRODUCT" src="<?php echo $image; ?>images/product-detail-01.jpg">
                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $image; ?>images/product-detail-01.jpg">
                                                        <i class="fa fa-expand">
                                                        </i>
                                                    </a>
                                                </img>
                                            </div>
                                        </div>
                                        <div class="item-slick3" data-thumb="<?php echo $image; ?>images/product-detail-02.jpg">
                                            <div class="wrap-pic-w pos-relative">
                                                <img alt="IMG-PRODUCT" src="<?php echo $image; ?>images/product-detail-02.jpg">
                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $image; ?>images/product-detail-02.jpg">
                                                        <i class="fa fa-expand">
                                                        </i>
                                                    </a>
                                                </img>
                                            </div>
                                        </div>
                                        <div class="item-slick3" data-thumb="<?php echo $image; ?>images/product-detail-03.jpg">
                                            <div class="wrap-pic-w pos-relative">
                                                <img alt="IMG-PRODUCT" src="<?php echo $image; ?>images/product-detail-03.jpg">
                                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $image; ?>images/product-detail-03.jpg">
                                                        <i class="fa fa-expand">
                                                        </i>
                                                    </a>
                                                </img>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-5 p-b-30">
                            <div class="p-r-50 p-t-5 p-lr-0-lg">
                                <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                    Lightweight Jacket
                                </h4>
                                <span class="mtext-106 cl2">
                                    $58.79
                                </span>
                                <p class="stext-102 cl3 p-t-23">
                                    Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
                                </p>
                                <!-- -->
                                <div class="p-t-33">
                                    <div class="flex-w flex-r-m p-b-10">
                                        <div class="size-203 flex-c-m respon6">
                                            Size
                                        </div>
                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select class="js-select2" name="time">
                                                    <option>
                                                        Choose an option
                                                    </option>
                                                    <option>
                                                        Size S
                                                    </option>
                                                    <option>
                                                        Size M
                                                    </option>
                                                    <option>
                                                        Size L
                                                    </option>
                                                    <option>
                                                        Size XL
                                                    </option>
                                                </select>
                                                <div class="dropDownSelect2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-w flex-r-m p-b-10">
                                        <div class="size-203 flex-c-m respon6">
                                            Color
                                        </div>
                                        <div class="size-204 respon6-next">
                                            <div class="rs1-select2 bor8 bg0">
                                                <select class="js-select2" name="time">
                                                    <option>
                                                        Choose an option
                                                    </option>
                                                    <option>
                                                        Red
                                                    </option>
                                                    <option>
                                                        Blue
                                                    </option>
                                                    <option>
                                                        White
                                                    </option>
                                                    <option>
                                                        Grey
                                                    </option>
                                                </select>
                                                <div class="dropDownSelect2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-w flex-r-m p-b-10">
                                        <div class="size-204 flex-w flex-m respon6-next">
                                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                    <i class="fs-16 zmdi zmdi-minus">
                                                    </i>
                                                </div>
                                                <input class="mtext-104 cl3 txt-center num-product" name="num-product" type="number" value="1">
                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus">
                                                        </i>
                                                    </div>
                                                </input>
                                            </div>
                                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- -->
                                <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                    <div class="flex-m bor9 p-r-10 m-r-11">
                                        <a class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist" href="#">
                                            <i class="zmdi zmdi-favorite">
                                            </i>
                                        </a>
                                    </div>
                                    <a class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook" href="#">
                                        <i class="fa fa-facebook">
                                        </i>
                                    </a>
                                    <a class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter" href="#">
                                        <i class="fa fa-twitter">
                                        </i>
                                    </a>
                                    <a class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus" href="#">
                                        <i class="fa fa-google-plus">
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php $this->
    endBody() ?>
    <?php if ($_SESSION['alert']): ?>
    <script type="text/javascript">
        new Noty({
                text: '<?php echo $_SESSION['alert']['data']; ?>',
                theme: 'metroui',
                layout: 'topRight',
                timeout: 3000,
                closeWith: ['button'],
                type: '<?php echo $_SESSION['alert']['type']; ?>',
            }).show();
    </script>
    <?php endif; ?>
    <?php unset($_SESSION['alert']); ?>
</html>
<?php $this->
endPage() ?>
