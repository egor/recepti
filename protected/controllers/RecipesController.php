<?php

class RecipesController extends Controller {

    public function actionIndex() {
        $modelCategory = Category::model()->findAll(array('condition' => 'visibility="1"', 'order' => 'position DESC'));
        foreach ($modelCategory as $value) {
            $bestDishes[$value->category_id] = Dishes::model()->with('category')->findAll(array('condition' => 't.visibility="1" AND t.category_id="' . $value->category_id . '"', 'order' => 't.date, t.dishes_id', 'limit' => 3));
        }
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_keywords, 'keywords');
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_description, 'description');
        $this->pageTitle = 'Категории рецептов';
        $this->pageHeader = 'Категории рецептов';
        $this->render('index', array('modelCategory' => $modelCategory, 'bestDishes' => $bestDishes));
    }

    /**
     * Подробное описание рецепта
     * 
     * @param type $id
     */
    public function actionDishesDetail($id) {
        $model = Dishes::model()->with('complexity', 'dishes_rating', 'user')->findByPk($id);
        if ($model->visibility == 1) {
            $modelCategory = Category::model()->findByPk($model->category_id);
            $modelComposition = Composition::model()->with('ingredients', 'units')->findAll('`dishes_id`="' . $id . '"');
            Yii::app()->clientScript->registerMetaTag($model->meta_keywords, 'keywords');
            Yii::app()->clientScript->registerMetaTag($model->meta_description, 'description');
            $this->pageTitle = $model->meta_title;
            $this->pageHeader = $model->header;
            $this->_dishesVisitsAdd($id);
            $this->render('dishesDetail', array('model' => $model, 'modelCategory' => $modelCategory, 'modelComposition' => $modelComposition, 'visits' => $this->getCountDishesVisits($id)));
        } else {
            throw new CHttpException(404);
        }
    }

    /**
     * Список рецептов в категории
     * 
     * @param type $id
     */
    public function actionDishesList($id) {
        //если этого не сделать, то будет тулить id в урл
        unset($_GET['id']);
        //var_dump($_GET); die;
        $modelCategory = Category::model()->findByPk($id);
        $limit = 9;
        $condition = '`t`.`category_id`="' . $id . '" AND t.visibility=1';
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = 't.date DESC';
        //'order' => 'date DESC',
        $count = Dishes::model()->count($criteria);
//echo $count; die;
        $paginator = new CPagination($count);
        // элементов на страницу
        $paginator->pageSize = $limit;
        $paginator->route = '/recipes/' . $modelCategory->url;
        $paginator->applyLimit($criteria);

        //$paginator->pageVar = '';
        //$paginator->
        //$model = News::model()->with('news_type')->findAll($criteria);


        $modelList = Dishes::model()->with('complexity', 'category', 'dishes_rating', 'dishes_visits')->findAll($criteria);

        Yii::app()->clientScript->registerMetaTag($modelCategory->meta_keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($modelCategory->meta_description, 'description');
        $this->pageTitle = $modelCategory->meta_title;
        $this->pageHeader = $modelCategory->header;

        $this->render('dishesList', array('modelCategory' => $modelCategory, 'modelList' => $modelList, 'paginator' => $paginator));
    }

    /**
     * Добавление рейтинга рецепта AJAX
     * 
     */
    public function actionDishesRating() {
        if (Yii::app()->request->isAjaxRequest) {
            $id = (int) $_POST['id'];
            $type = $_POST['type'];
            if ($type != 'up' && $type != 'down') {
                echo json_encode(array('error' => 1, 'message' => 'неверно указан тип'));
                exit();
            }
            if ($id > 0) {
                $model = Dishes::model()->findByPk($id);
                if ($model) {
                    $modelRating = DishesRating::model()->find('`dishes_id`="' . $id . '"');
                    if ($modelRating) {
                        if ($type == 'up') {
                            $modelRating->plus = $modelRating->plus + 1;
                        } else {
                            $modelRating->minus = $modelRating->minus + 1;
                        }
                    } else {
                        $modelRating = new DishesRating;
                        $modelRating->dishes_id = $id;
                        if ($type == 'up') {
                            $modelRating->plus = 1;
                            $modelRating->minus = 0;
                        } else {
                            $modelRating->minus = 1;
                            $modelRating->plus = 0;
                        }
                    }
                    $modelRating->save();
                    $rating = $modelRating->plus - $modelRating->minus;
                    echo json_encode(array('error' => 0, 'rating' => $rating));
                    exit();
                } else {
                    echo json_encode(array('error' => 1, 'message' => 'нет такого рецепта'));
                    exit();
                }
            } else {
                echo json_encode(array('error' => 1, 'message' => 'ай, нет такого рецепта'));
                exit();
            }
        } else {
            //404
        }
    }

    /**
     * Счетчик просмотров рецепта
     * 
     * @param int $id - id рецепта из таблицы dishes
     * @return boolean
     */
    private function _dishesVisitsAdd($id) {
        $model = DishesVisits::model()->find('`dishes_id`="' . $id . '"');
        if ($model) {
            $model->count = $model->count + 1;
            $model->save();
        } else {
            $model = new DishesVisits;
            $model->count = 1;
            $model->dishes_id = $id;
            $model->save();
        }
        return true;
    }

    /**
     * Возвращает количество просмотров рецепта
     * 
     * Возвращает количество просмотров рецепта с учетом текущего просмотра
     * 
     * @param int $id - id рецепта из таблицы dishes
     * @return int - количество просмотров
     */
    public function getCountDishesVisits($id) {
        $model = DishesVisits::model()->find('`dishes_id`="' . $id . '"');
        if ($model) {
            return $model->count;
        } else {
            return 1;
        }
    }

    /**
     * Печать рецепта
     * 
     * @param integer $id - id рецепта
     * @throws CHttpException
     */
    public function actionPrint($id) {
        $model = Dishes::model()->with('complexity', 'dishes_rating')->findByPk($id);
        $modelCategory = Category::model()->findByPk($model->category_id);
        $modelComposition = Composition::model()->with('ingredients', 'units')->findAll('`dishes_id`="' . $id . '"');
        $this->pageTitle = $model->meta_title;
        $this->pageHeader = $model->header;
        if ($model) {
            $this->layout = '/layouts/printVersion';
            $this->render('print', array('model' => $model, 'modelCategory' => $modelCategory, 'modelComposition' => $modelComposition, 'visits' => $this->getCountDishesVisits($id)));
        } else {
            throw new CHttpException(404);
        }
    }

}