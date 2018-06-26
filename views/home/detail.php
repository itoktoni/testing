<?php

//dump($model);
//dump(Yii::$app->session->getId());

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\base\Model;

$this->registerCssFile('https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css', ['depends' => [app\assets\FrontendAsset::className()]]);
$this->registerCssFile('https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css', ['depends' => [app\assets\FrontendAsset::className()]]);
$this->registerJsFile('https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js', ['depends' => [app\assets\FrontendAsset::className()]]);
$this->registerJsFile('@web/frontend/themes/js/js/detail.js', ['position' => \yii\web\View::POS_HEAD]);
?>
<h4><span>Product Detail</span></h4>

<section class="main-content">				
    <div class="row">						
        <div class="span9">
            <div class="row">
                <div class="span4">
                    <a href="<?php echo $detail->product_image; ?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="<?php echo $detail->product_image; ?>"></a>												
                    <ul class="thumbnails small">								

                    </ul>
                </div>
                <div class="span5">
                    <address>
                        <h2><?php echo $detail->product_name; ?></h2>
                        <strong><?php echo $detail->product_generic; ?></strong><br>
                        <strong>Availability:</strong> <span><?php echo $detail->product_qty; ?></span><br>								
                    </address>									
                    <h4><strong>Price: $<?php echo number_format($detail->product_price); ?></strong></h4>
                </div>
                <div class="span5">

                    <?php
                    $form = ActiveForm::begin([
                                'id' => '', 'options' => [
                                    'class' => 'form-inline'
                    ]]);
                    ?>

                    <?= $form->field($model, 'product_id')->hiddenInput(['value' => $detail->product_id])->label(false); ?>
                    <?= $form->field($model, 'session')->hiddenInput(['value' => yii::$app->session->getId()])->label(false); ?>
                    <?= $form->field($model, 'product_name')->hiddenInput(['value' => $detail->product_name])->label(false); ?>
                    <?= $form->field($model, 'product_url')->hiddenInput(['value' => $detail->product_url])->label(false); ?>
                    <?= $form->field($model, 'product_image')->hiddenInput(['value' => $detail->product_image])->label(false); ?>
                    <?= $form->field($model, 'product_price')->hiddenInput(['value' => $detail->product_price])->label(false); ?>
                    <?= $form->field($model, 'product_weight')->hiddenInput(['value' => $detail->product_weight])->label(false); ?>
                    <?=
                    $form->field($model, 'qty', ['inputOptions' => [
                            'placeholder' => '1',
                            'class' => 'span2',
                            'type' => 'text',
                ]])->label(false)
                    ?>

                    

                    <div class="span5 pull-left">
                        <input type="submit" class="span2 btn btn-inverse">
                    </div>
                    <hr />
                    <?php ActiveForm::end(); ?>
                    <Button id="love" class="btn btn-default pull-right" value="<?php echo $detail->product_like; ?>"><i class="fa fa-heart"></i> </Button>

                </div>							
            </div>
            <div class="row">
                <div class="span9">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#home">Description</a></li>
                    </ul>							 
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <?= $detail->product_description; ?>
                        </div>
                    </div>
                    <div id="share"></div>
                </div>						
                <div class="span9">	
                    <br>
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
                        </span>
                    </h4>

                    <div id="myCarousel-1" class="carousel slide">
                        <div class="carousel-inner">

                            <?php
                            $loop = 0;
                            ?>
                            <?php foreach (array_chunk($product, 3) as $c): ?>
                                <?php
                                $loop++;
                                ?>
                                <div class="<?php echo ($loop == 1 ? 'active' : ''); ?> item">
                                    <ul class="thumbnails listing-products">
                                        <?php foreach ($c as $cat): ?>
                                            <li class="span3">
                                                <div class="product-box">
                                                    <p><a href="<?= Url::to(['home/detail', 'id' => $cat->product_url]); ?>"><img src="themes/images/ladies/5.jpg" alt="" /></a></p>
                                                    <a href="<?= Url::to(['home/detail', 'id' => $cat->product_url]); ?>" class="title"><?= $cat->product_name; ?></a><br/>
                                                    <p class="price">$<?php echo number_format($cat->product_price); ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>

                        </div>							
                    </div>
                </div>
            </div>
        </div>
        <div class="span3 col">
            <div class="block">	
                <ul class="nav nav-list">
                    <li class="nav-header">CATEGORIES</li>
                        <?php foreach ($category as $cat): ?>
                        <li <?php echo $cat->category_id == $detail->product_id_category ? 'class="active"' : ''; ?>>
                            <a href="<?= Url::to(['home/category', 'id' => $cat->category_url]); ?>">
                                <?= $cat->category_name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <br/>

            </div>

        </div>
    </div>
</section>