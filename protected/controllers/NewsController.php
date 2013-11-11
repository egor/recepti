<?php

class NewsController extends Controller
{

    public function actionIndex()
    {
        $newsList = News::model()->findAll('visibility = 1 ORDER BY date DESC');
        $this->render('index', array('newsList' => $newsList));
    }
    
    public function actionDetail()
    {
        $model = News::model()->find('url = "klaviatura-vyipolnyaet-funktsiyu-keysa"');
        $this->render('detail', array('model' => $model));
    }
}