<?php
/* @var $this SiteController */
?>
<h2>Последние рецепы</h2>
<?php 
$this->widget('DishesListWidget', array('modelList' =>$modelList));
$this->widget('NewsMainListWidget');