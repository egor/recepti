<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
    <div class="modal" style="position: relative;">
    <div class="modal-header">
    <a href="/" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
    <h3>Авторизация</h3>
    </div>
    <div class="modal-body">
    <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',    
    'htmlOptions'=>array('class'=>''),
)); ?>
 
<?php echo $form->textFieldRow($model, 'username', array('class'=>'span12')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span12')); ?>        
    <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
    </div>
    <div class="modal-footer">
        <a href="/altadmin/restore" id="restore" style="float: left;">Забыл пароль?</a>
    <a href="/" class="btn">Отмена</a>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Вход')); ?>
    </div>
    </div>
<?php $this->endWidget(); ?>
<br clear="all" />
