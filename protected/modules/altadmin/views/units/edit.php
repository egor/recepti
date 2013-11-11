<?php
/* @var $this UserController */
Yii::app()->getClientScript()->registerScriptFile('/js/altadmin/units/edit.js');
$this->breadcrumbs = array(
    'Ингридиенты' => '/altadmin/units',
    'Редактирование еденицы измерения ('.$model->name.')',
);
?>
<h1>Редактирование еденицы измерения</h1>
<h2>(<?php echo $model->name; ?>)</h2>
<?php $this->renderPartial('/units/_form', array('model' => $model, 'edit' => 1)); ?>