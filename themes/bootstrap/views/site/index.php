
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<!--
<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Лучшие рецепты с фото',
)); ?>
<p></p>
<p>Коллекция кулинарных рецептов с фотографиями и советами по приготовлению.</p>
<?php $this->endWidget(); ?>
    
<h1><?php echo $this->pageHeader; ?></h1>
-->
<h2>Последние рецепы</h2>

<?php $this->widget('DishesListWidget', array('modelList' =>$modelList)); ?>
<?php $this->widget('NewsMainListWidget'); ?>