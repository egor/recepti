<?php

/**
 * SiteUrlRule
 * 
 * Распарисиваем urls и определяем какие контроллеры и экшыны подключать
 * 
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @package frontEnd
 * 
 */
class SiteUrlRule extends CBaseUrlRule {

    public $connectionID = 'db';

    public function createUrl($manager, $route, $params, $ampersand) {
        return false;  // не применяем данное правило
    }

    /**
     * @todo
     * @param type $manager
     * @param type $request
     * @param type $pathInfo
     * @param type $rawPathInfo
     * @return string|boolean
     */
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo) {
        if (empty($pathInfo)) {
            return 'site/index';
        }
        $url = explode('/', $pathInfo);
        if ($url[0] == 'altadmin') {
            return false;
        }
        /*Рецепты*/
        if ($url[0] == 'recipes' && isset($url[1]) && $url[1] != 'dishesRating') {
            if (isset($url[1])) {
                $category = Category::model()->find('`url`="' . $url[1] . '"');
                if ($category->category_id) {
                    //список рецептов
                    if (!isset($url[2])) {
                        return 'recipes/dishesList/id/' . $category->category_id;
                    } else {
                        $dishes = Dishes::model()->find('`url`="' . $url[2] . '"');
                        //подробная страница рецепта
                        if ($dishes->dishes_id && $dishes->category_id == $category->category_id) {
                            return 'recipes/dishesDetail/id/' . $dishes->dishes_id;
                        }
                    }
                } 
            }
        }

        /*Новости*/
        if ($url[0] == 'news') {
            if (isset($url[1]) && !isset($url[2])) {
                $model = News::model()->find(array('condition'=>'url="'.$url[1].'"'));
                //подробная страница новости
                if ($model) {
                    return '/news/detail/id/' . $model->news_id;
                }
            }
        }
        return false;  // не применяем данное правило
    }
}