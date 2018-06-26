<?php

use yii\helpers\Url;
?>

<section class="main-content">
    <div class="row">

        <div class="span12">

            <h4 class="title">
                <span class="pull-left"><span class="text"><span class="line">Sort By <strong>Category</strong></span></span></span>
                <span class="pull-right">
                    <a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
                </span>
            </h4>

            <ul class="thumbnails">
                <?php foreach ($product as $p): ?>
                    <li class="span3">
                        <div class="product-box">
                            <span class="sale_tag"></span>
                            <p>
                                <a href="<?php echo Url::to(['home/detail', 'id' => $p->product_url]); ?>">
                                    <img src="<?php echo $p->product_image; ?>" alt="" />
                                </a>
                            </p>
                            <a href="<?php echo Url::to(['home/detail', 'id' => $p->product_url]); ?>" class="title"><?php echo $p->product_name; ?></a><br/>
                            <a href="<?php echo Url::to(['home/detail', 'id' => $p->product_url]); ?>" class="category"><?php echo $p->product_generic; ?></a>
                            <p class="price">$<?php echo number_format($p->product_price); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="span12">
            <div class="row feature_box">						
                <div class="span4">
                    <div class="service">
                        <div class="responsive">	
                            <img src="themes/images/feature_img_2.png" alt="" />
                            <h4>MODERN <strong>DESIGN</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>									
                        </div>
                    </div>
                </div>
                <div class="span4">	
                    <div class="service">
                        <div class="customize">			
                            <img src="themes/images/feature_img_1.png" alt="" />
                            <h4>FREE <strong>SHIPPING</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="service">
                        <div class="support">	
                            <img src="themes/images/feature_img_3.png" alt="" />
                            <h4>24/7 LIVE <strong>SUPPORT</strong></h4>
                            <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
                        </div>
                    </div>
                </div>	
            </div>	
        </div>
    </div>
</section>