<?php
$this->registerJsFile(
        '@web/frontend/themes/js/js/main.js', ['depends' => [app\assets\FrontendAsset::className()]]
);
?>
<form method="POST" action="">

    <?php $total = 0; ?>
    <?php foreach ($_SESSION['cart'] as $session): ?>
        <input type="hidden" name="product_id[]" value="<?php echo $session['product_id']; ?>" />
        <input type="hidden" name="product_name[]" value="<?php echo $session['product_name']; ?>" />
        <input type="hidden" name="product_url[]" value="<?php echo $session['product_url']; ?>" />
        <input type="hidden" name="product_image[]" value="<?php echo $session['product_image']; ?>" />
        <input type="hidden" name="product_price[]" value="<?php echo $session['product_price']; ?>" />
        <input type="hidden" name="product_weight[]" value="<?php echo $session['product_weight']; ?>" />
        <input type="hidden" name="qty[]" value="<?php echo $session['qty']; ?>" />
        <?php
        $total = $total + $session['product_weight'];
        ?>
    <?php endforeach; ?>

    <section class="main-content">
        <div class="row">
            <div class="span12">
                <div class="accordion" id="accordion2">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Delivery Address</a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Name</label>
                                                <div class="controls">
                                                    <input type="text" class="span12" name="name" id="name" />
                                                </div>
                                            </div>	
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Email</label>
                                                <div class="controls">
                                                    <input type="text" class="span12" name="email" id="email" />
                                                </div>
                                            </div>	
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Phone</label>
                                                <div class="controls">
                                                    <input type="text" class="span12" name="" id="phone" />
                                                </div>
                                            </div>	
                                        </div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Province</label>
                                                <div class="controls">
                                                    <select id="province" class="span12" name="province">
                                                        <option value=""></option>
                                                        <?php foreach ($province as $p): ?>
                                                            <option value="<?php echo $p->province_id; ?>"><?php echo $p->province; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">City</label>
                                                <div class="controls">
                                                    <select name="city" class="span12" id="city">

                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Postal Code</label>
                                                <div class="controls">
                                                    <!--<select name="sub" class="span12" id="sub"></select>-->
                                                    <input type="text" name="sub" id="" class="span12" value=""/>
                                                </div>
                                            </div>	
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label for="textarea" class="control-label">Address</label>
                                        <div class="controls">
                                            <textarea rows="3" name="address" id="address" class="span12"></textarea>
                                        </div>
                                    </div>									

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Courier Service</a>
                        </div>
                        <div id="collapseTwo" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="span6">
                                            <div class="control-group">

                                                <label for="textarea" class="control-label">Kg</label>
                                                <div class="controls">
                                                    <input type="text" class="span12" value="<?php echo $total; ?>" name="weight" id="weight" />
                                                </div>

                                            </div>	

                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Courier Service</label>
                                                <div class="controls">
                                                    <select id="courier" class="span12" name="courier">
                                                        <option value=""></option>
                                                        <option value="jne">JNE</option>
                                                        <option value="tiki">TIKI</option>
                                                        <option value="pos">POS INDONESIA</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Service</label>
                                                <div class="controls">
                                                    <select name="service" class="span12" id="service">
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="control-group">
                                                <label for="textarea" class="control-label">Price</label>
                                                <div class="controls">
                                                    <input type="text" readonly="" class="span12" name="price" id="price" />
                                                </div>
                                            </div>	
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Confirm Order</a>
                        </div>
                        <div id="collapseThree" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <div class="row-fluid">
                                    <div class="control-group">
                                        <label for="textarea" class="control-label">Comments</label>
                                        <div class="controls">
                                            <textarea rows="3" name="notes" id="textarea" class="span12"></textarea>
                                        </div>
                                    </div>									
                                </div>
                            </div>
                        </div>
                    </div>
                </div>				
            </div>

            <button class="btn btn-inverse pull-right">Confirm order</button>

        </div>
    </section>

</form>
