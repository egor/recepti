<?php

class NewsController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Новости';
        $newsList = News::model()->findAll('visibility = 1 ORDER BY date DESC, news_id DESC');
        $this->render('index', array('newsList' => $newsList));
    }
    
    public function actionDetail($id)
    {
        $model = News::model()->findByPk($id);
        $this->pageTitle = $model->meta_title;
        Yii::app()->clientScript->registerMetaTag($model->meta_keywords, 'keywords');
        Yii::app()->clientScript->registerMetaTag($model->meta_description, 'description');
        $this->render('detail', array('model' => $model));
    }
}