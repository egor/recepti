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
class DishesListWidget extends CWidget
{
    public $modelList = array();
    public $paginator = array();
    public $viewWitget = 'dishesListTableWidget';
    /**
     * Вывод меню категорий с лева
     * 
     * @return render siteLeftMenuWidget
     */
    
    public function init()
    {                
        $this->render($this->viewWitget, array('modelList' => $this->modelList, 'paginator'=>$this->paginator));
    }
}
?>