<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\base\Model;
use yii\web\View;

$image = Yii::$app->params['base_url'].Yii::$app->params['frontend'].'/';
$pro = Yii::$app->params['base_url'] . 'files/product/';
$video = Yii::$app->params['base_url'] . 'files/video/';

?>

<link href="https://vjs.zencdn.net/7.0.3/video-js.css" rel="stylesheet">

<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                   
                    <div class="">
                        
                    <video id="my-video" class="video-js embed-responsive embed-responsive-4by3" height="300" controls preload="auto" poster="<?php echo $pro.$detail->product_image; ?>" data-setup="{}">
                        <source src="<?php echo $video;?>small.mp4" type='video/mp4'>
                        <source src="<?php echo $video;?>small.mp4" type='video/mp4'>
                        <p class="vjs-no-js">
                          To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                    </video>
                    </div>

                </div>
                <div class="card-body text-center">

                    <div class="btn-group" role="group" aria-label="Basic example">
                     <button id="like" value="<?php echo $detail->product_like;?>" class="btn btn-<?php echo $detail->product_like == 0 ? 'secondary' : 'danger'?>">
                        Product <i class="fa fa-heart"></i>
                    </button>
                    <button id="favorite" value="<?php ?>" class="btn btn-info">
                        Favorite <i class="fa fa-star"></i>
                    </button>
                    </div>
                </div>

            

             <script src="https://vjs.zencdn.net/7.0.3/video.js"></script>

            </div>
            
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                    <?php echo $detail->product_name; ?>
                    </h4>
                    <span class="mtext-106 cl2">
                        $<?php echo number_format($detail->product_price); ?>
                    </span>

                    <blockquote class="blockquote">
                      <p class="mb-0"><?php echo $detail->product_description; ?></p>
                      <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>

                    <div id="share">
                        
                    </div>
                   
                    
                    <!--  -->
                    <div class="p-t-33">
                        <?php
                        $form = ActiveForm::begin([
                        'id' => '', 'options' => [
                        'class' => 'form-group'
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
                        'placeholder' => 'Input Qty',
                        'class' => 'form-control col-lg-3',
                        'type' => 'text',
                        ]])->label(false)
                        ?>
                        
                        <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                        Add to cart
                        </button>


                        <?php ActiveForm::end(); ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
              <div class="card-body">
                <strong> Category : </strong> 
                <?php foreach ($category as $cat): ?>
            <a class="<?php echo $cat->category_id == $detail->product_id_category ? 'badge badge-primary' : 'badge badge-dark'; ?>" href="<?= Url::to(['home/category', 'id' => $cat->category_url]); ?>">
                <?= $cat->category_name; ?>
            </a>
            <?php endforeach; ?>
              </div>
            </div>
            
        </div>  
    </div>
</section>