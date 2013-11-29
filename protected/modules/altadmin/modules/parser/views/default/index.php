<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Парсинг',
);
$this->widget('GetFlashesWidget');
?>
<h1>Парсинг</h1>
<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->textFieldRow($model, 'site', array('class' => 'span12'));
?>
<small>Пример: namnamra.ru</small><br /><br />
<?php
echo $form->textFieldRow($model, 'url', array('class' => 'span12'));
?>
<small>Пример: http://namnamra.ru/recipes/category/4-course</small><br /><br />
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Парсить')); ?>&nbsp;   
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();