<?php

/**
 * IngredientsController. Вывод списка и подробного описания ингредиентов
 * 
 * @package Fronend
 * @category Ingredients
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class IngredientsController extends Controller {

    /**
     * Вывод списка ингредиентов
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->condition = 't.visibility="1"';
        $criteria->order = 't.name DESC';
        $count = Ingredients::model()->count($criteria);
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->siteLimit;
        //$paginator->route = '/ingredients/';
        $paginator->applyLimit($criteria);
        $model = Ingredients::model()->findAll($criteria);
        Yii::app()->clientScript->registerMetaTag('', 'keywords');
        Yii::app()->clientScript->registerMetaTag('', 'description');
        $this->pageTitle = 'Ингредиенты';
        $this->pageHeader = 'Ингредиенты';
        $this->render('index', array('model' => $model, 'paginator' => $paginator));
    }

    /**
     * Вывод подробной информации
     * 
     * @param int $id - id ингредиента
     */
    public function actionDetail($id) {
        $model = Ingredients::model()->findByPk($id);
        Yii::app()->clientScript->registerMetaTag($model->meta_keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($model->meta_description, 'description');
        $this->pageTitle = $model->meta_title;
        $this->pageHeader = $model->header;
        $this->render('detail', array('model' => $model));
    }

}
