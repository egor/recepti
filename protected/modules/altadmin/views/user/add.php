<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Пользователи' => '/altadmin/user',
    'Добавление пользователя',
);
?>
<h1>Добавить пользователя</h1>

<div class="form">

</div>
<?php $this->renderPartial('/user/_form', array('model' => $model)); ?>