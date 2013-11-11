<?php
/*
 * Component AdminLeftMenuWidget
 */

function activeMenu($url){
    $cUrl = Yii::app()->request->url;
    if ($cUrl == $url) {
        return true;
    } else {
        return false;
    }
}

$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'list',
    'items' => $menuList
    /*array(
        array('label' => 'Рецепты'),
        $menuList
    ),*/
));
?>