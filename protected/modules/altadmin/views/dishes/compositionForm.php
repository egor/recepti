<?php
/* @var $this DishesController */
/** @var BootActiveForm $form */
if (isset($edit) && $edit == 1) {
    echo '<h3>Редактирование ингредиента</h3>';
} else {
    echo '<h3>Добавление ингредиента</h3>';
}
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->dropDownListRow($model, 'ingredients_id', CHtml::listData(Ingredients::model()->findAll(array('order' => 'name')), 'ingredients_id', 'name'), array('class' => 'span12'));
echo $form->dropDownListRow($model, 'units_id', CHtml::listData(Units::model()->findAll(array('order' => 'name')), 'units_id', 'name'), array('class' => 'span12'));
echo $form->textFieldRow($model, 'info', array('class' => 'span12'));
echo $form->textFieldRow($model, 'count', array('class' => 'span12'));
echo $form->checkBoxRow($model, 'required', array('checked' => 'checked'));
?>
<div class="form-actions" style="text-align: right;">
<?php 
if (isset($edit) && $edit == 1) {
    ?>    
    <a href="#" class="btn btn-primary" onclick="compositionAddSave(<?php echo $id; ?>,1, <?php echo $iId; ?>); return false;" rel="tooltip" title="Сохранить">Сохранить</a>&nbsp;
    <?php
} else {
    ?>
    <a href="#" class="btn btn-primary" onclick="compositionAddSave(<?php echo $id; ?>, 0, 0); return false;" rel="tooltip" title="Сохранить">Сохранить</a>&nbsp;
    <?php
}
?>
<a href="#" class="btn" rel="tooltip" onclick="compositionCancelSave(); return false;" title="Отмена">Отмена</a>
</div>
<?php
$this->endWidget();