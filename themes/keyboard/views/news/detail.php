<?php
/* @var $this NewsController */
$this->breadcrumbs = array(
    'Новости'=>'/news',
    $model->menu_name
);
?>
<h1 class="title"><?php echo $model->header; ?></h1>
<?php echo $model->text; ?>