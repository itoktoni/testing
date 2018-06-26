
<?php
use yii\helpers\VarDumper;
use yii\helpers\Html;
?>

<?php echo $data{'firstname'};?>
<? VarDumper::dump( $data, $depth = 10, $highlight = true) ?>