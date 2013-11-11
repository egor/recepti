<script type="text/javascript" src="/js/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>
<?php
/* @var $this UserController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/edit.js');
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/dishes/composition.js');
$this->breadcrumbs = array(
    'Категории' => '/altadmin/dishes',
    'Редактирование рецепта ('.$model->menu_name.')',
);
?>
<h1>Редактирование рецепта</h1>
<h2>(<?php echo $model->menu_name; ?>)</h2>
<div class="form">

</div>
<?php $this->renderPartial('/dishes/_form', array('model' => $model, 'edit' => 1)); ?>
<div class="ingridients_list"></div>
<div class="ingridients_add"><a href="#" onclick="compositionAdd(<?php echo $model->dishes_id; ?>); return false;" id="ingridients_add" rel="tooltip" title="Добавить ингридиент">Добавить ингридиент</a></div>
<div class="ingridients_form"></div>
<script>
    $(document).ready(function() {
compositionShowList(<?php echo $model->dishes_id; ?>);
});
    </script>