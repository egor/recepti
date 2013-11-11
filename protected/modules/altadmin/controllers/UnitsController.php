<?php

class UnitsController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Еденицы измерения';
        $model = Units::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление ингридиента
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление еденицы измерения';
        $model = new Units;
        if (isset($_POST['Units']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Units'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Еденица измерения успешно добавлена.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/units');
                } else {
                    Yii::app()->request->redirect('/altadmin/units/edit/' . $model->units_id);
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
        $model = Units::model()->findByPk($id);
        $this->pageTitle = 'Редактирование еденицы измерения (' . $model->name . ')';
        if (isset($_POST['Units']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Units'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Еденица измерения успешно отредактирована.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/units');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

    /**
     * Удаление новости по $id
     * AJAX
     */
    public function actionDelete()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            $model = Units::model()->findByPk($id);
            if ($model->units_id > 0) {
                Units::model()->deleteByPk($id);
                echo json_encode(array('error' => 0));
            } else {
                echo json_encode(array('error' => 1));
            }
        } else {
            echo json_encode(array('error' => 1));
        }
    }

}