<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/site.css" />        
        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
<!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/modernizr.custom.js"></script>-->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/lightbox-2.6.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/lightbox/lightbox.css" media="screen"/>
        <!--<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttonDown.css" media="screen"/>-->
        <title><?php echo CHtml::encode($this->pageTitle) . Yii::app()->params['extraTitle']; ?></title>

        <?php Yii::app()->bootstrap->register(); ?>

        <script>
            $(document).ready(function() {
                $('#send-search').click(function() {
                    $('#search-form').submit();
                });
            });
        </script>
    </head>
    <body>
        <?php $this->widget('HeaderMainWidget'); ?>     
            
        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Главная', 'url' => '/', 'active'=> (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index' ? true : false)),
                        //array('label' => 'О нас', 'url' => '/about'),
                        //array('label' => 'Рецепты', 'url' => array('/site/contact')),
                        array('label' => 'Рецепты', 'url' => array('/recipes'), 'active'=> (Yii::app()->controller->id == 'recipes' ? true : false)),
                        array('label' => 'Новости', 'url' => array('/news'), 'active'=> (Yii::app()->controller->id == 'news' ? true : false)),
                    //array('label' => 'Подбор рецепта', 'url' => array('/selection-recipes')),
                    //array('label' => 'Поделиться рецептом', 'url' => array('/share-recipe')),
                    //array('label' => 'Контакты', 'url' => array('/news')),
                    //array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                    //array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ),
            ),
        ));
        ?>

        <div class="container" id="page">

            <?php if (isset($this->breadcrumbs)): ?>
            
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'homeLink' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/" itemprop="url"><span itemprop="title">Главная</span></a></li>',
                    'links'=>$this->breadcrumbs,
                    'tagName'=>'ul',
                    'htmlOptions' => array('class'=>'breadcrumb'),
                    'activeLinkTemplate' => '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="{url}" itemprop="url"><span itemprop="title">{label}</span></a></li>',
                    'inactiveLinkTemplate' => '<li class="active"><span itemprop="title">{label}</span></li>',
                    'separator' => '<li><span class="divider">/</span></li>',
                ));
                /*$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink' => CHtml::link('Главная', '/'),
                    
                    'links' => $this->breadcrumbs,
                    'htmlOptions' => array('itemscope'=>'', 'itemtype'=>'http://data-vocabulary.org/Breadcrumb'),
                    'activeLinkTemplate' => '<li><a href="{url}">|{label}</a></li>',
                    'inactiveLinkTemplate' => '<li><span>{label}</span></li>',
                    //'separator' => '',
                ));*/
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <div class="row-fluid">

                <div class="span3"> 

                    <div style="padding: 8px 0;" class="well">
                        <?php $this->widget('SiteLeftMenuWidget', array('currentCategoryId' => $this->currentCategoryId)); ?>
                    </div>          
                    <form id="search-form" action="/search" method="GET">
                        <div class="input-append" class="span12" style="overflow: hidden;">
                            <input name="q" class="span12" style="width:80%;" placeholder="Поиск" id="appendedInputButton" type="text">        
                                <button class="btn" id="send-search" style="width:20%;" type="button"><i class="icon-search"></i></button>
                        </div>
                    </form>
                    <!--Sidebar content-->
                    <?php $this->widget('QuoteWidget'); ?>                        
                </div>
                <div class="span9">
                    <?php echo $content; ?>

                    <!--Body content-->
                </div>
            </div>

            <?php //echo $content;   ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by recepti.dp.ua.<br/>
                Все права защищены.<br/>
                Разработка сайтов <a href="http://alt.dp.ua" target="_balnk">alt.dp.ua</a>
            </div><!-- footer -->

        </div><!-- page -->

        <script>
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-45624181-1', 'recepti.dp.ua');
            ga('send', 'pageview');

        </script>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function(d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter22957543 = new Ya.Metrika({id: 22957543,
                            webvisor: true,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            trackHash: true});
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function() {
                    n.parentNode.insertBefore(s, n);
                };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/22957543" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
        <script>
            $(function()
            {
                $('.popover-right').popover({trigger: 'hover', placement: 'right', html: true});
                $('.popover-left').popover({trigger: 'hover', placement: 'left', html: true});
            });
        </script>
        
        <!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/buttonDown.js"></script>
        <div id="top-link">
            <a href="#top" id="top-link-a"><span id="topicon"></span><span id="text">наверх</span></a>
        </div>-->

    </body>
</html>
