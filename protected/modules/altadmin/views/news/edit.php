<script type="text/javascript" src="/js/altadmin/editor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/js/altadmin/includeEditor.js"></script>
<?php
/* @var $this UserController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/news/edit.js');
$this->breadcrumbs = array(
    'Новости' => '/altadmin/news',
    'Редактирование новости ('.$model->menu_name.')',
);
?>
<h1>Редактирование новости</h1>
<h2>(<?php echo $model->menu_name; ?>)</h2>
<div class="form">

</div>
<?php $this->renderPartial('/news/_form', array('model' => $model, 'edit' => 1)); ?>