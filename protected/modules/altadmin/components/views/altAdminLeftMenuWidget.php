<?php
function activeMenu($url) {
    $arryUrl = explode('/', $url);
    $arrayCount = count($arryUrl);
    if ($arryUrl[2] == '') {
        $arryUrl[2] = 'index';
    }
    if ($arrayCount) {
        if (Yii::app()->controller->module->id == $arryUrl[0] && Yii::app()->controller->id == $arryUrl[1] && Yii::app()->controller->action->id == $arryUrl[2]) {
            return true;
        }
    }
}
?>
<div style="padding: 8px 0;" class="well">
    <?php
    //echo Yii::app()->controller->module->id .'/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;
    $this->widget('bootstrap.widgets.TbMenu', array(
        'type' => 'list',
        'items' => array(
            array('label' => 'Каталог'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/category', 'active' => activeMenu('altadmin/category/index')),
            array('label' => 'Добаваить', 'icon' => 'plus', 'url' => '/altadmin/category/add', 'active' => activeMenu('altadmin/category/add')),
            array('label' => 'Рецепты'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/dishes', 'active' => activeMenu('altadmin/dishes/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/dishes/add', 'active' => activeMenu('altadmin/dishes/add')),
            array('label' => 'Ингридиенты'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/ingredients', 'active' => activeMenu('altadmin/ingredients/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/ingredients/add', 'active' => activeMenu('altadmin/ingredients/add')),
            array('label' => 'Еденицы измерения'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/units', 'active' => activeMenu('altadmin/units/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/units/add', 'active' => activeMenu('altadmin/units/add')),
            
            array('label' => 'Страница ингридиентов'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/ingredientsPage', 'active' => activeMenu('altadmin/ingredientsPage/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/ingredientsPage/add', 'active' => activeMenu('altadmin/ingredientsPage/add')),
            
            '---',
            array('label' => 'Новости'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/news', 'active' => activeMenu('altadmin/news/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/news/add', 'active' => activeMenu('altadmin/news/add')),
            array('label' => 'Настройки', 'icon' => 'cog', 'url' => '/altadmin/news/settings', 'active' => activeMenu('altadmin/news/settings')),
            '---',
            array('label' => 'Пользователи'),
            array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/user', 'active' => activeMenu('altadmin/user/index')),
            array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/user/add', 'active' => activeMenu('altadmin/user/add')),
            '---',
            array('label' => 'Выход', 'icon' => 'off', 'url' => '/altadmin/logout'),
        ),
    ));
    ?>
</div> 