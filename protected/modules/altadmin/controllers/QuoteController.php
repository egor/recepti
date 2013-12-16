<?php

/**
 * QuoteController. Контроллер управления цитатами.
 * 
 * @package Back End
 * @category Quote
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class QuoteController extends Controller {

    /**
     * Вывод списка цитат.
     */
    public function actionIndex() {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Цитаты';
        $model = Quote::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление цитаты.
     */
    public function actionAdd() {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Добавление цитаты';
        $model = new Quote;
        if (isset($_POST['Quote']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Quote'];            
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Цитата успешно добавлена.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/quote');
                } else {
                    Yii::app()->request->redirect('/altadmin/quote/edit/' . $model->quote_id);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * Редактирование цитаты
     * 
     * @param int $id - id цитаты из таблицы Quote
     */
    public function actionEdit($id) {
        $model = Quote::model()->findByPk($id);
        $this->pageTitle = 'Редактирование цитаты';
        if (isset($_POST['Quote']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Quote'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Цитата успешно отредактирована.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/quote');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }
}