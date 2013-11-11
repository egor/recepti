<script type="text/javascript" src="/js/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>
<?php
/* @var $this UserController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/ingredients/edit.js');
$this->breadcrumbs = array(
    'Ингридиенты' => '/altadmin/ingredients',
    'Редактирование ингридиента ('.$model->name.')',
);
?>
<h1>Редактирование ингридиента</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<?php $this->renderPartial('/ingredients/_form', array('model' => $model, 'edit' => 1)); ?>