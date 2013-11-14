<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="ru" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/site.css" />        

<!--<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/modernizr.custom.js"></script>-->
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/jquery-1.10.2.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/lightbox/lightbox-2.6.min.js"></script>
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/lightbox/lightbox.css" media="screen"/>

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
        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Главная', 'url' => '/'),
                        //array('label' => 'О нас', 'url' => '/about'),
                        //array('label' => 'Рецепты', 'url' => array('/site/contact')),
                        array('label' => 'Рецепты', 'url' => array('/recipes')),
                        array('label' => 'Новости', 'url' => array('/news')),
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
                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                    'homeLink' => CHtml::link('Главная', '/'),
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <div class="row-fluid">

                <div class="span3"> 

                    <div style="padding: 8px 0;" class="well">
                        <?php $this->widget('SiteLeftMenuWidget'); ?>
                    </div>          
                    <form id="search-form" action="/search" method="GET">
                        <div class="input-append" class="span12" style="overflow: hidden;">
                            <input name="q" class="span12" style="width:80%;" placeholder="Поиск" id="appendedInputButton" type="text">        
                                <button class="btn" id="send-search" style="width:20%;" type="button"><i class="icon-search"></i></button>
                        </div>
                    </form>
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
    </body>
</html>
