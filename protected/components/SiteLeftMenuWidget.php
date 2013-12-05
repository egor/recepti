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
class SiteLeftMenuWidget extends CWidget
{
    public $currentCategoryId = 0;
    /**
     * Вывод меню категорий с лева
     * 
     * @return render siteLeftMenuWidget
     */
    public function init()
    {        
        $model = Category::model()->findAll('`in_menu`="1" AND `visibility`="1"');
        $menuList[] = array('label' => 'Рецепты');
        foreach ($model as $value) {
            $menuList[] = array('label' => $value->menu_name, 'icon' => 'arrow-right', 'url' => '/recipes/'.$value->url, 'active' => ($this->currentCategoryId == $value->category_id ? 'true' : ''));
        }
        $this->render('siteLeftMenuWidget', array('menuList' => $menuList));
    }
}
?>