<?php
/* @var $this RecipesController */

$this->breadcrumbs = array(
    'Рецепты' => '/recipes',
    $modelCategory->menu_name => '/recipes/'.$modelCategory->url,
    $model->menu_name => '/recipes/'.$modelCategory->url.'/'.$model->url,
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php
echo $model->text;
?>
