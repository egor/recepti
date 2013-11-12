<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
    /**
     * Постраничный навигатор в админке
     * 
     * @var integer количество позиций на страницу для вывода в постраничном навигаторе
     */
    public $altAdminPageSize = 10;
    
    /**
     * Постраничный навигатор для ингредиентов в админке
     * 
     * @var integer количество ингредиентов на страницу для вывода в постраничном навигаторе
     */    
    public $altAdminIngredientsPageSize = 35;

    /**
     * Постраничный навигатор для ингредиентов в админке
     * 
     * @var integer количество ингредиентов на страницу для вывода в постраничном навигаторе
     */    
    public $altAdminDishesPageSize = 20;

    /**
     * Постраничный навигатор для ингредиентов в админке
     * 
     * @var integer количество ингредиентов на страницу для вывода в постраничном навигаторе
     */    
    public $altAdminUnitsPageSize = 15;
    
    /**
     * H1
     * 
     * @var string H1 для страницы
     */
    public $pageHeader = '';
    
    /**
     * Заголовок хлебных крошек
     * 
     * @var string
     */
    public $breadcrumbsTitle = '';        
}