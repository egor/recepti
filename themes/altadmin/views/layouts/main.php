<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="/css/altadmin/style.css" />
        <title><?php echo CHtml::encode($this->pageTitle) . Yii::app()->params['extraTitle']; ?></title>

        <?php Yii::app()->bootstrap->register(); ?>
    </head>
    <body>
        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        ));
        ?>

        <div class="container" id="page">

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink' => CHtml::link('CMS ALT ADMIN','/altadmin'),
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <div class="row-fluid">
                <div class="span3">   
                    <div style="padding: 8px 0;" class="well">
                        <?php
                        $this->widget('bootstrap.widgets.TbMenu', array(
                            'type' => 'list',
                            'items' => array(
                                array('label' => 'Каталог'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/category', 'active' => false),
                                array('label' => 'Добаваить', 'icon' => 'plus', 'url' => '/altadmin/categoryAdd', 'active' => false),

                                array('label' => 'Рецепты'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/dishes', 'active' => false),
                                array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/dishes/add', 'active' => false),

                                array('label' => 'Ингридиенты'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/ingredients', 'active' => false),
                                array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/ingredients/add', 'active' => false),

                                array('label' => 'Еденицы измерения'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/units', 'active' => false),
                                array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/units/add', 'active' => false),

                                array('label' => 'Контент'),
                                array('label' => 'Дерево страниц', 'icon' => 'align-left', 'url' => '/altadmin/pages', 'active' => false),
                                array('label' => 'Настройки', 'icon' => 'cog', 'url' => '/altadmin/news/settings', 'active' => false),
                                array('label' => 'Новости'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/news', 'active' => false),
                                array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/news/add', 'active' => false),
                                array('label' => 'Настройки', 'icon' => 'cog', 'url' => '/altadmin/news/settings', 'active' => false),
                                array('label' => 'Пользователи'),
                                array('label' => 'Список', 'icon' => 'th-list', 'url' => '/altadmin/user', 'active' => false),
                                array('label' => 'Добавить', 'icon' => 'plus', 'url' => '/altadmin/user/add', 'active' => false),                                
                                array('label' => 'LIST HEADER'),
                                array('label' => 'Home', 'icon' => 'home', 'url' => '#', 'active' => true),
                                array('label' => 'Library', 'icon' => 'book', 'url' => '#'),
                                array('label' => 'Application', 'icon' => 'pencil', 'url' => '#'),
                                array('label' => 'ANOTHER LIST HEADER'),
                                array('label' => 'Profile', 'icon' => 'user', 'url' => '#'),
                                array('label' => 'Settings', 'icon' => 'cog', 'url' => '#'),
                                
                                array('label' => 'Помощь', 'icon' => 'flag', 'url' => '#'),
                                array('label' => 'Лог действий', 'icon' => 'hdd', 'url' => '#'),
                                array('label' => 'Выход', 'icon' => 'off', 'url' => '/altadmin/logout'),
                            ),
                        ));
                        ?>
                    </div>          
                    <div class="well sidebar-nav">

                        <h4>Тут будет что-то важное</h3>
                            <ul class="nav nav-list">
                                <li><a href="">Потому что я на пути создания такого робота</a></li>
                                <li><a href="">Есть много вариантов Lorem Ipsum</a></li>
                                <li><a href="">Многие думают, что Lorem Ipsum - взятый с потолка</a></li>
                                <li><a href="">Lorem Ipsum не только успешно пережил</a></li>
                                <li><a href="">Давно выяснено, что при оценке дизайна</a></li>
                                <li><a href="">В результате сгенерированный Lorem Ipsum выглядит правдоподобно</a></li>
                                <li><a href="">Классический текст Lorem Ipsum</a></li>
                            </ul>
                    </div>
                    <!--Sidebar content-->
                </div>
                <div class="span9">
<?php echo $content; ?>

                    <!--Body content-->
                </div>
            </div>

<?php //echo $content;   ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
<?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
