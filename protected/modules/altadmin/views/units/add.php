<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Ингридиенты' => '/altadmin/ingredients',
    'Добавление ингридиента',
);
?>
<h1>Добавить ингридиент</h1>
<?php $this->renderPartial('/ingredients/_form', array('model' => $model)); ?>