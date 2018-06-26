<?php

//dump(yii::$app->session->getId());
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php
$form = ActiveForm::begin([
            'method' => 'post',
            'options' => ['class' => 'form-inline'],
        ]);
?>
<section class="header_text sub">
    <h4><span>Shopping Cart</span></h4>
</section>
<section class="main-content">				
    <div class="row">
        <div class="span12">					
            <h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Remove</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <?php for ($i = 0; $i < count($_SESSION['cart']); $i++): ?>
                            <?php $total = $total + $_SESSION['cart'][$i]['product_price'] * $_SESSION['cart'][$i]['qty']; ?>
                            <tr>
                                <td><input type="checkbox" name="id[]" value="<?php echo $_SESSION['cart'][$i]['product_id']; ?>"></td>
                                <td>
                                    <a href="<?php echo Url::to(['home/detail', 'id' => $_SESSION['cart'][$i]['product_url']]); ?>">
                                        <img alt="" src="<?php echo $_SESSION['cart'][$i]['product_image']; ?>">
                                    </a>
                                </td>
                                <td><?php echo $_SESSION['cart'][$i]['product_name']; ?></td>
                                <td>
                                    <input type="text" name="qty[]" value="<?php echo $_SESSION['cart'][$i]['qty']; ?>" placeholder="1" class="input-mini">
                                    <input type="hidden" name="product_id[]" value="<?php echo $_SESSION['cart'][$i]['product_id']; ?>"/>
                                </td>
                                <td>$<?php echo number_format($_SESSION['cart'][$i]['product_price']); ?></td>
                                <td>$<?php echo number_format($_SESSION['cart'][$i]['product_price'] * $_SESSION['cart'][$i]['qty']); ?></td>
                            </tr>			  
                        <?php endfor; ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>$<?php echo number_format($total); ?></strong></td>
                        </tr>		  
                    <?php endif; ?>
                </tbody>
            </table>
            <h4>What would you like to do next?</h4>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            <label class="radio">

                <input id="search" name="voucher" placeholder="Voucher Code" class="input-small" type="text">
                <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                <?php echo Html::submitButton('Validate', ['class' => 'btn btn-primary', 'name' => 'validate', 'value' => 'validate']); ?>

            </label>
            <hr>

            <div class="cart-total" style="margin-bottom: 50px;height: 30px;">
                <table class="right" align="right">
                    <tr>
                        <td><strong>Sub-Total</strong></td>
                        <td>:</td>
                        <td>$<?php echo number_format($total); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Voucher <?php echo $_SESSION['voucher']['name']; ?></strong></td>
                        <td>:</td>
                        <td>$<?php echo number_format($_SESSION['voucher']['value']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>:</td>
                        <td><strong>$<?php echo number_format($total - $_SESSION['voucher']['value']); ?></strong></td>
                    </tr>
                </table>
            </div>

            <hr style="clear: both;padding-top: 20px;"/>
            <p class="buttons center">				
                <button class="btn btn-danger" name="delete" value="delete" type="submit">Delete</button>
                <button class="btn btn-success" name="update" value="update" type="submit">Update</button>
                <a class="btn btn-inverse" href="<?php echo Url::to(['home/checkout']); ?>">Checkout</a>
                <button class="btn btn-primary" name="checkout" value="checkout" type="submit">Email</button>
            </p>					
        </div>

    </div>
</section>
<?php ActiveForm::end(); ?>