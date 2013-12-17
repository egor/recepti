<?php
/* @var $this RecipesController */
$this->breadcrumbs = array(
    'Рецепты' => '/recipes',
    $modelCategory->menu_name
);
if (isset($_GET['show']) && $_GET['show'] == 'table') {
    Yii::app()->session['show'] = 'dishesListTableWidget';
} else if (isset($_GET['show']) && $_GET['show'] == 'list') {
    Yii::app()->session['show'] = 'dishesListWidget';
}
if (empty(Yii::app()->session['show'])) {
    Yii::app()->session['show'] = 'dishesListTableWidget';
}
//echo Yii::app()->session['show']; die;
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php 
//$this->widget('ControlPanelWidget');
$this->widget('DishesListWidget', array('modelList' => $modelList, 'paginator' => $paginator, 'viewWitget' => Yii::app()->session['show'])); 
?>