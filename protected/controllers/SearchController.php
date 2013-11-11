<?php

class SearchController extends Controller
{
    public function actionIndex()
    {
        $model = array();
        $limit = 0;
        $query = trim($_GET['q']);
        if (mb_strlen($query)<5) {
            $error = 'Поисковая фраза должна быть не мение 5 - ти символов';
            $this->render('index', array('error' => $error));
            exit();
        }
        $condition = '`t`.`header` LIKE "%' . $query . '%" OR `t`.`text` LIKE "%' . $query . '%"';
        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        $criteria->order = 't.date DESC';
        $count = Dishes::model()->count($criteria);
        if ($count == 0) {
            $error = 'По запросу <b>'.$query.'</b> ничего не найдено!';
            $this->render('index', array('error' => $error));
            exit();
        }

        if ($limit != 0) {
            $paginator = new CPagination($count);
            $paginator->pageSize = $limit;
            $paginator->route = '/search';
            $paginator->applyLimit($criteria);
        }
        $modelList = Dishes::model()->with('complexity', 'category', 'dishes_rating', 'dishes_visits')->findAll($criteria);

        Yii::app()->clientScript->registerMetaTag($model->meta_keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($model->meta_description, 'description');
        $this->pageTitle = $model->meta_title;
        $this->pageHeader = $model->header;

        $this->render('index', array('model' => $model, 'modelList' => $modelList, 'paginator' => $paginator, 'searchCount' => $count, 'query'=>$query));
    }

}