<?php

class IngredientsController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Ингридиенты';
        $model = Ingredients::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление ингридиента
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление ингридиента';
        $model = new Ingredients;
        if (isset($_POST['Ingredients']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Новость успешно добавлена.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/ingredients');
                } else {
                    Yii::app()->request->redirect('/altadmin/ingredients/edit/' . $model->ingredients_id);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model));
    }

    /**
     * Редактирование новости
     */
    public function actionEdit($id)
    {
        $model = Ingredients::model()->findByPk($id);
        $this->pageTitle = 'Редактирование ингридиента (' . $model->name . ')';
        if (isset($_POST['Ingredients']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Ингридиент успешно отредактирован.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/ingredients');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

}