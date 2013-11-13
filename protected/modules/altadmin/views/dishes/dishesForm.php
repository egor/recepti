<?php 
/* @var $this IngredientsController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/editor/tiny_mce/tiny_mce.js');
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/includeEditor.js');
Yii::app()->getClientScript()->registerCssFile('/css/altadmin/bootstrap-datepicker/datepicker.css');
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/edit.js');
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/composition.js');
$this->breadcrumbs = array(
    'Категории' => '/altadmin/dishes',
    $this->breadcrumbsTitle
);
$this->widget('GetFlashesWidget');
?>
<h1><?php echo $this->pageHeader; ?></h1>
<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->dropDownListRow($model, 'category_id', CHtml::listData(Category::model()->findAll(array('order' => 'position')), 'category_id', 'menu_name'), array('class' => 'span12'));
echo $form->textFieldRow($model, 'url', array('class' => 'span12'));
echo $form->textFieldRow($model, 'menu_name', array('class' => 'span12'));
echo $form->textFieldRow($model, 'header', array('class' => 'span12'));
echo $form->checkBoxRow($model, 'visibility', array('checked' => 'checked'));
echo $form->checkBoxRow($model, 'in_menu', array('checked' => 'checked'));
if (isset($edit)) {
    echo $form->textFieldRow($model, 'date', array('class' => 'span12', 'id' => 'dp'));
} else {
    echo $form->textFieldRow($model, 'date', array('class' => 'span12', 'id' => 'dp', 'value' => date('d.m.Y')));
}
echo $form->textFieldRow($model, 'meta_title', array('class' => 'span12'));
echo $form->textFieldRow($model, 'meta_keywords', array('class' => 'span12'));
echo $form->textAreaRow($model, 'meta_description', array('class' => 'span12', 'rows' => 3));
echo $form->textAreaRow($model, 'short_text', array('class' => 'span12', 'rows' => 7, 'id' => 'editor-desc'));
echo $form->textAreaRow($model, 'text', array('class' => 'span12', 'rows' => 7, 'id' => 'editor-text'));

echo $form->textFieldRow($model, 'cooking_time', array('class' => 'span12'));
echo $form->dropDownListRow($model, 'complexity_id', CHtml::listData(Complexity::model()->findAll(array('order' => 'position')), 'complexity_id', 'name'), array('class' => 'span12'));

echo $form->textFieldRow($model, 'servings', array('class' => 'span12'));
echo $form->textFieldRow($model, 'tags', array('class' => 'span12'));
echo $form->textFieldRow($model, 'category_add', array('class' => 'span12'));
if (isset($edit)) {
    ?>
    <table class="i-img">
        <tr>
            <td>
                <?php
                echo $form->fileFieldRow($model, 'img', array('class' => 'span12', 'rows' => 7));
                echo $form->textFieldRow($model, 'img_alt', array('class' => 'span12', 'rows' => 7));
                echo $form->textFieldRow($model, 'img_title', array('class' => 'span12', 'rows' => 7));
                ?>
            </td>
            <td class="pre-img">
                <?php
                if (!empty($model->img)) {
                    echo '<div id="main-img"><img src="/images/dishes/' . $model->img . '" width="200px" /><br /><a href="#" onclick="dishesDeleteMainPic(' . $model->dishes_id . '); return false;" rel="tooltip" title="удалить картинку" class="i-remove"><i class="icon-remove"></i></a></div>';
                } else {
                    echo '<div id="main-img"><div class="main-img">нет фото</div></div>';
                }
                ?>
            </td>
        </tr>
    </table>
    <?php
} else {
    echo $form->fileFieldRow($model, 'img', array('class' => 'span12', 'rows' => 7));
    echo $form->textFieldRow($model, 'img_alt', array('class' => 'span12', 'rows' => 7));
    echo $form->textFieldRow($model, 'img_title', array('class' => 'span12', 'rows' => 7));
}
?>

<div class="form-actions" style="text-align: right;">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => 'Сохранить')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'info', 'label' => 'Сохранить и выйти')); ?>&nbsp;
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Отмена')); ?>
</div>

<?php
$this->endWidget();
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/bootstrap-datepicker/bootstrap-datepicker.js');
?>
<script>
    $(function() {
        window.prettyPrint && prettyPrint();
        $('#dp').datepicker({
            format: 'dd.mm.yyyy'
        });
    });
</script>
<?php if (isset($edit)) { ?>
<div class="ingridients_list"></div>
<div class="ingridients_add">
    <a class="btn btn-primary" href="#" onclick="compositionAdd(<?php echo $model->dishes_id; ?>); return false;" id="ingridients_add" rel="tooltip" title="Добавить ингридиент">Добавить ингридиент</a>    
    <a style="float:right;" class="btn btn-info" href="/recipes/<?php echo $modelCategory->url; ?>/<?php echo $model->url; ?>" target="_blank">Посмотреть на сайте <small>(/recipes/<?php echo $modelCategory->url; ?>/<?php echo $model->url; ?>)</small></a>
</div>
<div class="ingridients_form"></div>
<script>
$(document).ready(function() {
    compositionShowList(<?php echo $model->dishes_id; ?>);
});
</script>
<?php }