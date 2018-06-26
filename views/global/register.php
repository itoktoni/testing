<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\NotyAsset;

$asset = NotyAsset::register($this);
?>
<?php require('header.php'); ?>
<?php $form = ActiveForm::begin(); ?>


<div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <?=
    $form->field($model, 'first_name', ['inputOptions' => [
            'placeholder' => 'Input First Name',
            'class' => 'form-control col-lg-3',
            'type' => 'text',
            'required'
    ]])->label(false)
    ?>

    <?=
    $form->field($model, 'last_name', ['inputOptions' => [
            'placeholder' => 'Input Last Name',
            'class' => 'form-control col-lg-3',
            'type' => 'text',
            'required'
    ]])->label(false)
    ?>

    <?=
    $form->field($model, 'email', ['inputOptions' => [
            'placeholder' => 'Input Email',
            'class' => 'form-control col-lg-3',
            'type' => 'text',
            'required'
    ]])->label(false)
    ?>

    <?=
    $form->field($model, 'password', ['inputOptions' => [
            'placeholder' => 'Input Password',
            'class' => 'form-control col-lg-3',
            'type' => 'password',
            'required'
    ]])->label(false)
    ?>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
</div>

<div class="container signin">
    <p>Already have an account? <a href="<?php echo Url::to(['global/login']); ?>">Sign in</a>.</p>
</div>

<?php include('footer.php');?>