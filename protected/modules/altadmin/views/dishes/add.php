<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Рецепты' => '/altadmin/dishes',
    'Добавление рецепта',
);
?>
<h1>Добавить рецепт</h1>

<div class="form">

</div>
<?php $this->renderPartial('/dishes/_form', array('model' => $model)); ?>