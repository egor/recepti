<?php
/* @var $this UserController */
$this->breadcrumbs = array(
    'Новости' => '/altadmin/news',
    'Добавление новости',
);
?>
<h1>Добавить новость</h1>

<div class="form">

</div>
<?php $this->renderPartial('/news/_form', array('model' => $model)); ?>