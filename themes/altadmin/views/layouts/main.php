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
                        array('label' => 'Главная', 'url' => array('/altadmin')),
                        array('label' => 'На сайт', 'url' => '/'),
                        array('label' => 'Выход (' . Yii::app()->user->name . ')', 'url' => array('/altadmin/logout'), 'visible' => !Yii::app()->user->isGuest)
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
                <?php $this->widget('AltAdminLeftMenuWidget'); ?>                             
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
