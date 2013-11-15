<?php
/* @var $this RecipesController */

$this->breadcrumbs = array(
    'Рецепты'
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php
echo '<hr />';
foreach ($modelCategory as $value) {
    echo '<h2>'.$value->menu_name.'</h2>';
    $this->widget('DishesListWidget', array('modelList' =>$bestDishes[$value->category_id]));
    echo '<a href="/recipes/'.$value->url.'" class="btn" style="float:right;">Посмотреть все...</a>';
    echo '<br clear="all" />';
    echo '<hr />';
}