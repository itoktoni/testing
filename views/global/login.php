<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\assets\NotyAsset;

$asset = NotyAsset::register($this);
?>
<?php require('header.php');?>
<?php $form = ActiveForm::begin(['id' => 'login-form',]); ?>
<div class="container">
    <h1>Login</h1>
    <p>Please fill in this form to login an account.</p>
    <hr>
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

    <button type="submit" class="registerbtn">Login</button>
</div>

<div class="container signin">
    <p>Don't have an account? <a href="<?php echo Url::to(['global/register']); ?>">Register</a>.</p>
</div>

<?php include('footer.php');?>
