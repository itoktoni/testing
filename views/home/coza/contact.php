<?php

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$image = Yii::$app->params['base_url'] . Yii::$app->params['frontend'] . '/';
?>

        <div class="p-b-10">
            <h3 class="ltext-103 cl5 text-center">
            Contact Us
            </h3>
        </div>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">

                <?php $form = ActiveForm::begin(); ?>

                <!--<form>-->
                <h4 class="mtext-105 cl2 txt-center p-b-30">
                    Send Us A Message
                </h4>

                
                    <?=
                    $form->field($model, 'email', ['inputOptions' => [
                            'placeholder' => 'Input Your Email Address',
                            'class' => 'form-control col-lg-12',
                            'type' => 'text',
                            'required'
                ]])->label(false)
                    ?>
               
                    <!--<br />-->
                    <?=
                    $form->field($model, 'message', ['inputOptions' => [
                            'placeholder' => 'How Can We Help?',
                            'class' => 'form-control',
                            'required'
                ]])->textarea(['rows' => 10])->label(false)
                    ?>
                    <!--<br />-->

                <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                    Submit
                </button>
<?php ActiveForm::end(); ?>
                <!--</form>-->
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Address
                        </span>

                        <p class="stext-115 cl6 size-213 p-t-18">
                            Jl. Berbah Sendang Tirto
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Lets Talk
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            +62 0813 1100 7076
                        </p>
                    </div>
                </div>

                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">
                            Sale Support
                        </span>

                        <p class="stext-115 cl1 size-213 p-t-18">
                            itok.toni@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	
