<?php
/* @var $this IngredientsController */
$this->breadcrumbs = array(
    'Ингредиенты' => '/altadmin/ingredients',
    $this->breadcrumbsTitle,
);
$this->widget('GetFlashesWidget');
?>
<script type="text/javascript" src="/js/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>
<small>Поля отмеченные <span class="required">*</span> обязательны  для заполнения</small>
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'verticalForm',
    'htmlOptions' => array('class' => 'well', 'enctype' => 'multipart/form-data'),
        )
);
echo $form->textFieldRow($model, 'url', array('class' => 'span12'));
echo $form->textFieldRow($model, 'name', array('class' => 'span12'));
echo $form->textFieldRow($model, 'header', array('class' => 'span12'));
if (isset($edit)) {
    echo $form->checkBoxRow($model, 'visibility');
} else {
    echo $form->checkBoxRow($model, 'visibility', array('checked' => 'checked'));
}
echo $form->textFieldRow($model, 'meta_title', array('class' => 'span12'));
echo $form->textFieldRow($model, 'meta_keywords', array('class' => 'span12'));
echo $form->textAreaRow($model, 'meta_description', array('class' => 'span12', 'rows' => 3));
echo $form->textAreaRow($model, 'short_text', array('class' => 'span12', 'rows' => 7, 'id' => 'editor-desc'));
echo $form->textAreaRow($model, 'text', array('class' => 'span12', 'rows' => 7, 'id' => 'editor-text'));
?>
<h4>Изображение</h4>
<?php
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
                    echo '<div id="image-preview"><img src="/images/ingredients/big/' . $model->img . '" width="200px" /><br /><a href="#" onclick="myModalDeleteImage(); return false;" rel="tooltip" title="удалить картинку" class="i-remove"><i class="icon-remove"></i></a></div>';
                } else {
                    echo '<div id="image-preview"><div class="image-preview-empty">нет фото</div></div>';
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
if (isset($edit)) {
    $this->widget('application.modules.altadmin.widgets.DeleteConfirmationWindow', array('method' => 'deleteImage', 'data'=>array('id'=>$model->ingredients_id, 'url'=>'/altadmin/ingredients/deleteImage', 'body'=>'<p>Вы уверены что хотите удалить изображение?</p>', 'pathToImage' => '/images/ingredients/small/'.$model->img)));
}