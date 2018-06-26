<div class="sec-banner bg0 p-t-80 p-b-50">
    <div class="container">
        <div class="row">
            
            <?php if ($this->beginCache('category', ['duration' => 3600])) :?>    
            <?php $angka = 0; ?>
            <?php foreach (array_chunk($category, 3) as $c): ?>
                <?php foreach ($c as $cat): ?>
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="<?php echo $image;?>images/music.jpg" alt="IMG-BANNER">
                            <a href="<?=  \yii\helpers\Url::to(['home/category', 'id' => $cat->category_url]) ;?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span style="color:lightgrey;" class="block1-name ltext-102 trans-04 p-b-8">
                                        <?php echo $cat->category_gendre;?>
                                    </span>
                                    <span style="background-color: black;padding:10px;color: white;position: absolute;bottom: 0px;width: 80%;" class="block1-info stext-102 trans-04">
                                        <?= $cat->category_name; ?>
                                    </span>
                                </div>
                               
                            </a>
                        </div>
                    </div>
                    
                <?php endforeach; ?>
            <?php endforeach; ?>
           <?php 
             $this->endCache();
            endif;
            ?>
            
    </div>
</div>