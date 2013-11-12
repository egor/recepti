<?php

class NewsController extends Controller
{

    public function actionIndex()
    {
        $newsList = News::model()->findAll('visibility = 1 ORDER BY date DESC');
        $this->render('index', array('newsList' => $newsList));
    }
    
    public function actionDetail($id)
    {
        $model = News::model()->findByPk($id);
        $this->render('detail', array('model' => $model));
    }
}