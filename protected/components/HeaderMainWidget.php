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
class HeaderMainWidget extends CWidget
{

    /**
     * Вывод меню категорий с лева
     * 
     * @return render siteLeftMenuWidget
     */
    public function init()
    {
        if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') {
        Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl."/css/mainHeader.css");
        
        $this->render('headerMainWidget');
    }
    }

}

?>