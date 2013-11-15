<?php
/* @var $this RecipesController */

$this->breadcrumbs=array(
	'Рецепты' => '/recipes',
    $modelCategory->menu_name
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php $this->widget('DishesListWidget', array('modelList' =>$modelList, 'paginator'=>$paginator)); ?>