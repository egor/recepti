<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->dropDownListRow($model, 'ingredients_id', CHtml::listData(Ingredients::model()->findAll(array('order' => 'position')), 'ingredients_id', 'name'), array('class' => 'span12'));
echo $form->dropDownListRow($model, 'units_id', CHtml::listData(Units::model()->findAll(array('order' => 'position')), 'units_id', 'name'), array('class' => 'span12'));
echo $form->textFieldRow($model, 'info', array('class' => 'span12'));
echo $form->checkBoxRow($model, 'required', array('checked' => 'checked'));
?>

<div class="form-actions" style="text-align: right;">
<a href="#" class="btn btn-primary" onclick="compositionAddSave(<?php echo $id; ?>); return false;" rel="tooltip" title="Сохранить">Сохранить</a>&nbsp;
<a href="#" class="btn" rel="tooltip" title="Сохранить">Отмена</a>
</div>

<?php
$this->endWidget();
?>