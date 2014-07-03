<?php

/**
 * TagsController.
 * 
 * @package Fronend
 * @category Tags
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class TagsController extends Controller {

    /**
     * Вывод списка тегов
     */
    public function actionIndex() {
        $model = Tag::model()->with('tagDishesCount')->findAll(array('order' => 'name'));
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_keywords, 'keywords');
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_description, 'description');
        $this->pageTitle = 'Теги';
        $this->pageHeader = 'Теги';
        $this->render('index', array('model' => $model));
    }
    
    /**
     * Список рецептов по конкретному тегу
     * 
     * @param int $id - id тега
     */
    public function actionRecipes($id = 0) {
        if ($id == 0) {
            throw new CHttpException(404);
        }
        $modelTag = Tag::model()->findByPk($id);
        if (empty($modelTag)) {
            throw new CHttpException(404);
        }
        $modelDishesTags = DishesTag::model()->findAll(array('select' => 'dishes_id', 'condition' => 'tag_id="' . $id . '"'));
        $countModelDishesTags = count($modelDishesTags);
        $c = 0;
        $condition = '';
        foreach ($modelDishesTags as $value) {
            $c++;
            $condition .= "t.dishes_id = '" . $value->dishes_id . "'" . ($c < $countModelDishesTags ? ' OR ' : '');
        }
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = 't.menu_name';
        $count = Dishes::model()->count($criteria);
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->siteLimit;
        $paginator->route = '/tags/recipes';
        $paginator->applyLimit($criteria);
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_keywords, 'keywords');
        //Yii::app()->clientScript->registerMetaTag($modelCategory->meta_description, 'description');
        $this->pageTitle = 'Рецепты с тегом ' . $modelTag->name;
        $this->pageHeader = 'Рецепты с тегом "' . $modelTag->name . '"';
        $modelList = Dishes::model()->with('complexity', 'category', 'dishes_rating', 'dishes_visits')->findAll($criteria);//(array('condition' => '(' . $condition . ') AND t.visibility="1"', 'order' => 't.menu_name'));
        $this->render('recipes', array('modelList' => $modelList, 'paginator' => $paginator, 'modelTag' => $modelTag));
    }

}
