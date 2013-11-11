<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Категрии' => '/altadmin/category',
    'Добавление категории',
);
?>
<h1>Добавить новость</h1>

<div class="form">

</div>
<?php $this->renderPartial('/category/_form', array('model' => $model)); ?>