<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$image = Yii::$app->params['base_url'] . Yii::$app->params['frontend'] . '/';
$pro = Yii::$app->params['base_url'] . 'files/product/';

$this->registerJsFile(
        '@web/js/main.js', 
        ['depends' => [app\assets\CozaAsset::className()]]);
?>

 <script src="https://js.stripe.com/v2/"></script>
 <script type="text/javascript">
     Stripe.setPublishableKey("<?php echo Yii::$app->params['stripe_publish'];?>");
 </script>
<form id="payment" method="POST" class="bg0 p-t-75 p-b-85">

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">ID</th>
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
                            <?php $total = 0;?>
                            <?php $kg = 0;?>
                            <?php if (!empty($_SESSION['cart'])): ?>
                                <?php for ($i = 0; $i < count($_SESSION['cart']); $i++): ?>
                                    <?php 
                                    $total = $total + $_SESSION['cart'][$i]['product_price'] * $_SESSION['cart'][$i]['qty']; 
                                    $kg = $kg + $_SESSION['cart'][$i]['product_weight']; 
                                    ?>

                                    <input type="hidden" name="product_id[]" value="<?php echo $_SESSION['cart'][$i]['product_id']; ?>" />
                                    <input type="hidden" name="product_name[]" value="<?php echo $_SESSION['cart'][$i]['product_name']; ?>" />
                                    <input type="hidden" name="product_url[]" value="<?php echo $_SESSION['cart'][$i]['product_url']; ?>" />
                                    <input type="hidden" name="product_image[]" value="<?php echo $_SESSION['cart'][$i]['product_image']; ?>" />
                                    <input type="hidden" name="product_price[]" value="<?php echo $_SESSION['cart'][$i]['product_price']; ?>" />
                                    <input type="hidden" name="product_weight[]" value="<?php echo $_SESSION['cart'][$i]['product_weight']; ?>" />

                                    <tr class="table_row">
                                        <td class="column-1"><input type="checkbox" name="id[]" value="<?php echo $_SESSION['cart'][$i]['product_id']; ?>"></td>
                                        <td class="column-1">
                                            <div class="how-itemcart1">
                                                <img src="<?php echo $pro.$_SESSION['cart'][$i]['product_image']; ?>" alt="IMG">
                                            </div>
                                        </td>
                                        <td class="column-2"><?php echo $_SESSION['cart'][$i]['product_name']; ?></td>
                                        <td class="column-3">$<?php echo number_format($_SESSION['cart'][$i]['product_price']); ?></td>
                                        <td class="column-4">
                                            <input class="form-control col-lg-10 pull-right" type="number" name="qty[]" value="<?php echo $_SESSION['cart'][$i]['qty']; ?>">
                                        </td>
                                        <td class="column-5">$<?php echo number_format($_SESSION['cart'][$i]['product_price'] * $_SESSION['cart'][$i]['qty']); ?></td>
                                    </tr>

                                <?php endfor; ?>
                            <?php endif; ?>

                        </table>
                    </div>
                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="flex-w flex-m m-r-20 m-tb-5">
                            <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 col-lg-4 col-xs-12 col-sm-12" type="text" name="voucher" placeholder="Coupon Code">
                            <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                            
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <Button value="validate" name="validate" type="submit" class="btn btn-primary">
                                    Apply Voucher
                                </Button>

                                <Button value="delete" name="delete" type="submit" class="btn btn-danger">
                                    Delete Item
                                </Button>
                                <Button value="update" name="update" type="submit" class="btn btn-success">
                                    Update Cart
                                </Button>
                            </div>
                        </div>

                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <div class="col-lg-12">
                          <div class="row">
                              <div class="col-6 col-sm-6">
                                 <div class="form-group">
                                    <input type="text"  placeholder="Input Name" name="name" class="form-control form-control-sm">
                                  </div>
                                  <div class="form-group">
                                    <input type="email"  placeholder="Input Email" name="email" class="form-control form-control-sm">
                                  </div>
                                  <div class="form-group">
                                    <input type="text" name="phone" placeholder="Input Phone" class="form-control form-control-sm">
                                  </div>
                              </div>
                              <div class="col-6 col-sm-6">
                                <label for="">Input Your Address</label>
                                <textarea name="address"  class="form-control form-control-sm" id="" rows="5"></textarea>
                              </div>
                            </div>
                             <div class="row">
                                <div class="col-12 col-sm-12">
                                     <label for="">Input Your Notes</label>
                                    <textarea name="notes" class="form-control" id="" rows="3"></textarea>
                                </div>
                              </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals 
                        <input type="hidden" id="weight" value="<?php echo $kg;?>" name="weight">
                    </h4>
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                SubTotal :
                            </span>
                        </div>
                        <div class="size-209 text-right">
                            <span class="mtext-110 cl2">
                                $<?php echo number_format($total); ?>
                            </span>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['voucher'])): ?>
                        <div style="margin-top: 10px;" class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Voucher :
                                </span>
                            </div>
                            <div class="size-209 text-right">
                                <span style="color: #717fe0;font-size: 12px;"><?php echo $_SESSION['voucher']['code']; ?> -  </span>
                                <span class="mtext-110 cl2">
                                    $<?php echo number_format(ceil($_SESSION['voucher']['value'])); ?>
                                </span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Shipping :
                            </span>
                        </div>
                        <div class="size-209 text-right">
                                <span class="mtext-110 cl2">
                                    [ <?php echo $kg;?> Kg ]
                                </span>
                            </div>
                        <div style="margin-top: 10px;">
                                <select  id="province" class="select form-control-sm col-lg-12" name="province">
                                    <option value="">Select Province</option>
                                    <?php foreach ($province as $p): ?>
                                        <option value="<?php echo $p->province_id; ?>">
                                            <?php echo $p->province; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <select  name="city" class="select form-control-sm col-lg-12" id="city">
                                 <option value="">Select City</option>
                                </select>

                                <select  id="courier" class="select form-control-sm col-lg-12" name="courier">
                                    <option>Select Courier...</option>
                                    <option value="jne">JNE</option>
                                    <option value="tiki">TIKI</option>
                                    <option value="pos">POS Indonesia</option>
                                </select>

                                <select  name="service" class="select form-control-sm col-lg-12" id="service">
                                <option value="">Select Service..</option>
                                </select>

                                <input type="hidden" name="voucher_code" value="<?php echo $_SESSION['voucher']['code']; ?>"/>
                                <input type="hidden" name="voucher_name" value="<?php echo $_SESSION['voucher']['name']; ?>"/>
                                <input type="hidden" name="voucher_value" value="<?php echo ceil($_SESSION['voucher']['value']); ?>"/>

                           <!--  <div class="p-t-15">
                               
                                <div class="bor8 bg0 m-b-12">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
                                </div>
                                <div class="bor8 bg0 m-b-22">
                                    <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
                                </div>
                            </div> -->

                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div style="margin-top: 10px;margin-bottom: 10px;" class="col-lg-12">
                            <input type="text"  name="cardnumber" data-stripe="number" id="card" placeholder="Input Valid Card Number" class="form-control form-control-sm">
                        </div>

                        <div class="size-209" style="width: 100%;">
                            <div class="input-group">
                              <input name="month" data-stripe="exp_month" size="2" maxlength="2"  type="text" id="month" placeholder="Expired Month" class="form-control form-control-sm">
                              <input name="year"  maxlength="2" type="text" size="2" data-stripe="exp_year" id="year" placeholder="Expired Year" class="form-control form-control-sm">
                              <input name="cvc"  type="text" maxlength="4" id="cvc" size="4" data-stripe="cvc" placeholder="Code CVC" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>


                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total :
                            </span>
                        </div>
                        <div class="size-209 p-t-1 text-right">
                            <span class="mtext-110 cl2">
                                <input type="hidden" name="price" id="price">
                                <span id="total"><?php echo $total-ceil($_SESSION['voucher']['value']);?></span>
                            </span>
                        </div>
                    </div>

                    <button name="checkout" id="checkout" value="checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
