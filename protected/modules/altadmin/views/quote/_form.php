<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
if (isset($edit)) {
    echo $form->checkBoxRow($model, 'visibility');
} else {
    echo $form->checkBoxRow($model, 'visibility', array('checked' => 'checked'));
}
echo $form->textAreaRow($model, 'text', array('class' => 'span12', 'rows' => 7));
echo $form->textFieldRow($model, 'author', array('class' => 'span12'));
?>
<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'info', 'label' => 'Сохранить и выйти')); ?>&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>
<?php
$this->endWidget();