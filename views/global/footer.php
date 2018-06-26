<?php 
use yii\widgets\ActiveForm;
?>

<?php ActiveForm::end(); ?>
<?php $this->endBody() ?>
<?php if ($_SESSION['alert']): ?>

<script type="text/javascript">
    new Noty({
        text: '<?php echo $_SESSION['alert']['data'];?>',
        theme: 'metroui',
        layout: 'topRight',
        closeWith: ['button'],
        type: '<?php echo $_SESSION['alert']['type'];?>',
    }).show();
</script>
<?php endif; ?>
<?php unset($_SESSION['alert']);?>
<?php $this->endPage() ?>