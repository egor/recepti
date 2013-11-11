<?php 
foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-'.$key.'">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  '.$message.'
</div>';
}    
?>
<small>Все поля обязательны для заполнения</small>
<?php /** @var BootActiveForm $form */
$formt = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php echo $formt->textFieldRow($model, 'name', array('class'=>'span3')); ?>
<?php echo $formt->textFieldRow($model, 'email', array('class'=>'span3')); ?>
<?php
if (isset($edit)) {
    echo $formt->passwordFieldRow($model, 'password', array('class'=>'span3', 'value'=>'')); 
    echo '<p><small>если не хотите менять пароль, оставте поле пустым</small></p>';
} else {
    echo $formt->passwordFieldRow($model, 'password', array('class'=>'span3')); 
}
?>
<div class="form-actions" style="text-align: right;">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'info', 'label'=>'Сохранить и выйти')); ?>&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Отмена')); ?>
</div>
<?php $this->endWidget(); ?>
<?php echo $form; ?>