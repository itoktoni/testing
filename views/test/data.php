<?php
use yii\helpers\Html;
use yii\helpers\VarDumper;
?>
<p>You have entered the following information:</p>

<ul>
    <?php 
    echo $model['name'];
//    VarDumper::dump( $model, $depth = 10, $highlight = true);
    ?>
    <li><label>Name</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Email</label>: <?= Html::encode($model->email) ?></li>
</ul>