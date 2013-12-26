<?php

/**
 * SiteLeftMenuWidget Вывод меню категорий с лева
 * 
 * @package FrontEnd
 * @category FrontEnd
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class NewsMainListWidget extends CWidget
{

    /**
     * Вывод меню категорий с лева
     * 
     * @return render siteLeftMenuWidget
     */
    public function init()
    {
        $newsList = News::model()->findAll(
                array(
                    'condition' => '`visibility` = "1" AND `in_main` = "1"',
                    'order' => 'date DESC, news_id DESC',
                    'limit' => '3'
                )
        );
        $this->render('newsMainListWidget', array('newsList' => $newsList));
    }

}

?>