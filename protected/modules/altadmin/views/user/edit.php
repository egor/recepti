<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Пользователи' => '/altadmin/user',
    'Редактирование пользователя ('.$model->name.')',
);
?>
<h1>Редактирование пользователя</h1>
<h2>(<?php echo $model->name; ?>)</h2>

<div class="form">

</div>
<?php $this->renderPartial('/user/_form', array('model' => $model, 'edit' => 1)); ?>