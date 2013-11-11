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
class SiteUrlRule extends CBaseUrlRule
{

    public $connectionID = 'db';

    public function createUrl($manager, $route, $params, $ampersand)
    {

        if ($route === 'car/index') {
            if (isset($params['manufacturer'], $params['model']))
                return $params['manufacturer'] . '/' . $params['model'];
            else if (isset($params['manufacturer']))
                return $params['manufacturer'];
        }
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
    public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
    {
        //return false;
        if (empty($pathInfo)) {
            return 'site/index';
        }
        $url = explode('/', $pathInfo);
        if ($url[0] == 'altadmin') {
            return false;
        }
        $model = Pages::model()->find('url="' . $url[0] . '"');


        if ($url[0] == 'recipes' && isset($url[1]) && $url[1] != 'dishesRating') {
            if (isset($url[1])) {
                $category = Category::model()->find('`url`="' . $url[1] . '"');
                if (empty($category->category_id)) {
                    return '404';
                }
                
                if (!isset($url[2])) {
                        //$_GET['id'] = $category->category_id;
                        return 'recipes/dishesList/id/' . $category->category_id;
                        //return 'recipes/dishesList';
                        exit();
                } else {
                    $dishes = Dishes::model()->find('`url`="' . $url[2] . '"');
                    if (empty($dishes->dishes_id)) {
                        return '404';
                    } else {
                        return 'recipes/dishesDetail/id/' . $dishes->dishes_id;
                    }
                }                
            }
        }

        if (isset($model)) {

            if (!empty($model->module)) {
                if ($url[0] === end($url)) {
                    return $model->module . '/index';
                } else {

                    //новости. разбор url модуля "Новости"
                    if ($model->module == 'news') {
                        if (!isset($url[1])) {
                            return 'news/';
                        } else if ($url[1] === 'page') {
                            if (!$this->badPaginationMod($url[2], 'News', 1)) {
                                return 'pages/404';
                            }
                            return 'news/index/page/' . $url[2];
                        } else if ($url[1] === end($url)) {
                            $modelN = News::model()->find('url="' . $url[1] . '"');
                            return 'news/detail/id/' . $modelN->news_id;
                        } else {
                            return false;
                        }
                    }



                    //отзывы. разбор url модуля "Отзывы"
                    if ($model->module == 'reviews') {
                        if (!isset($url[1])) {
                            return 'reviews/';
                        } else if ($url[1] === 'page') {
                            if (!$this->badPaginationMod($url[2], 'Reviews', 4)) {
                                return 'pages/404';
                            }
                            return 'reviews/index/page/' . $url[2];
                        } else {
                            return false;
                        }
                    }
                    //наши работы. разбор url модуля "Наши работы"
                    if ($model->module == 'works') {
                        if (!isset($url[1])) {
                            return 'works/';
                        } else if ($url[1] === 'page') {
                            if (!$this->badPaginationMod($url[2], 'Works', 6)) {
                                return 'pages/404';
                            }
                            return 'works/index/page/' . $url[2];
                        } else {
                            return false;
                        }
                    }
                    //видео советы. разбор url модуля "Видео советы"
                    if ($model->module == 'videoTips') {
                        if (!isset($url[1])) {
                            return 'videoTips/';
                        } else if ($url[1] === 'page') {
                            if (!$this->badPaginationMod($url[2], 'VideoTips', 5)) {
                                return 'pages/404';
                            }
                            return 'videoTips/index/page/' . $url[2];
                        } else {
                            return false;
                        }
                    }
                    //акции. разбор url модуля "Акции"
                    if ($model->module == 'stock') {
                        if (!isset($url[1])) {
                            return 'stock/';
                        } else if ($url[1] === 'page') {
                            if (!$this->badPaginationMod($url[2], 'Stock', 7)) {
                                return 'pages/404';
                            }
                            return 'stock/index/page/' . $url[2];
                        } else {
                            return false;
                        }
                    }
                }
            } else {
                //проверим все ли уровни вложености перед страницей
                //что бы избежать такой работы
                // реальная страница: /1/2/3/4/5
                // url: /5

                $cou = count($url);

                if (isset($url[($cou - 2)]) && isset($url[($cou - 1)]) && $url[($cou - 2)] == 'page' && $url[($cou - 1)] > 1) {
                    if (!$this->badPaginationPage($url[($cou - 1)], $model)) {
                        return 'pages/404';
                    }
                    $_GET['page'] = $url[($cou - 1)];
                    unset($url[($cou - 2)]);
                    unset($url[($cou - 1)]);
                    $cou = count($url);
                }
                $model = Pages::model()->find('url="' . end($url) . '"');
                if (($cou + 1) != $model->level) {
                    return 'pages/404';
                }
                //что бы избежать такой работы
                // реальная страница: /1/2/3/4/5
                // url: /4/3/1/4/5
                foreach ($url as $value) {
                    $modelTest = Pages::model()->find('url="' . $value . '" AND root="' . $model->root . '"');
                    if (!isset($modelTest->pages_id)) {
                        return 'pages/404';
                    }
                }
                if (isset($model)) {
                    return 'pages/detail/id/' . $model->pages_id;
                }
            }
        }
        return false;
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {
            // Проверяем $matches[1] и $matches[3] на предмет
            // соответствия производителю и модели в БД.
            // Если соответствуют, выставляем $_GET['manufacturer'] и/или $_GET['model']
            // и возвращаем строку с маршрутом 'car/index'.
        }
        return false;  // не применяем данное правило
    }

    /**
     * Проверка постраничного навигатора
     * Если значение навигатора больше чем может быть, то вернем 404 ошибку
     * 
     * @param int $currentPage текущее значение навигатора
     * @param object $model модель
     * @return boolean если false - 404
     */
    private function badPaginationPage($currentPage, $model)
    {
        //если постраничка есть, а выводить нечего
        $countPage = $model->children()->count(array("condition" => "visibility=1"));
        $setting = Settings::model()->findByPk(9);
        //echo $url[$cou-1].' '.ceil($countPage/$setting->value); die;
        if ($currentPage > ceil($countPage / $setting->value) || $countPage == 0) {
            //echo             
            return false;
        } else {
            return true;
        }
    }

    /**
     * Проверка постраничного навигатора для модулей
     * Если значение навигатора больше чем может быть, то вернем 404 ошибку
     * 
     * @param int $currentPage текущее значение навигатора
     * @param string $mod модель модуля
     * @param int $settingId id записи в таблице settings (узнаем сколько записей на странице)
     * @return boolean если false - 404
     */
    private function badPaginationMod($currentPage, $mod, $settingId)
    {
        $countPage = $mod::model()->count(array("condition" => "visibility=1"));
        $setting = Settings::model()->findByPk($settingId);
        //echo $url[$cou-1].' '.ceil($countPage/$setting->value); die;
        if ($currentPage > ceil($countPage / $setting->value) || $countPage == 0) {
            return false;
        } else {
            return true;
        }
    }

}

?>