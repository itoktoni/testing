<section class="main-content">
    <div class="row">
        <div class="span12">													
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Category <strong>Products</strong></span></span></span>
                        <span class="pull-right">
                            <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel" class="myCarousel carousel slide">
                        <div class="carousel-inner">
                            <?php $angka = 0; ?>
                            <?php if ($this->beginCache('category', ['duration' => 3600])) :?>
                            <?php foreach (array_chunk($category, 4) as $c): ?>
                                <?php $angka++; ?>
                                <div class="<?php echo ($angka == 1 ? 'active' : '');?> item">
                                    <ul class="thumbnails">
                                        <?php foreach ($c as $cat): ?>
                                            <li class="span3">
                                                <div class="product-box">
                                                    <a href="<?=  \yii\helpers\Url::to(['home/category', 'id' => $cat->category_url]) ;?>" class="title"><?= $cat->category_name; ?></a><br/>
                                                    <hr />
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        <?php 
                         $this->endCache();
                        endif;
                        ?>
                        </div>							
                    </div>
                </div>						
            </div>
            <br/>
        </div>				
    </div>
</section>