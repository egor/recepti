<?php
$this->breadcrumbs = array(
    'Теги' => '/tags',
    'Рецепты по тегу "' . $modelTag->name.'"'
);
?>
<h1><?php echo $this->pageHeader; ?></h1>
<?php
$this->widget('DishesListWidget', array('modelList' =>$modelList, 'paginator'=>$paginator));
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

