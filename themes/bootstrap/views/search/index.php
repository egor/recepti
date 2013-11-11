<?php
/* @var $this RecipesController */

$this->breadcrumbs=array(
	'Поиск',
    //$modelCategory->menu_name
);
?>
<h1>Поиск</h1>
<?php
if (isset($error)) {
    echo $error;
} else {
    echo '<p>По запросу: <b>'.$query.'</b><br /></p>';
    echo '<p>Найдено: <b>'.$searchCount.'</b><br /></p>';
    $this->widget('DishesListWidget', array('modelList' =>$modelList, 'paginator'=>$paginator)); 
}
?>
