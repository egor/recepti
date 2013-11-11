<?php
/**
 * UnitsController. Конироллер управления еденицами измерения.
 * 
 * Контроллер содержит функции:<br>
 * <ul>
 * <li>Вывод списка ингредиентов</li>
 * <li>Добавление</li>
 * <li>Редактирование</li>
 * <li>Удаление</li>
 * </ul>
 * 
 * @package Back End
 * @category Units
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class UnitsController extends Controller
{
    /**
     * Список едениц измерения использующихся на сайте
     * 
     * @return render index
     */
    public function actionIndex()
    {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Еденицы измерения';
        $criteria = new CDbCriteria();
        $criteria->order = 'name';
        $count = Units::model()->count($criteria);
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->altAdminUnitsPageSize;
        $paginator->applyLimit($criteria);
        $model = Units::model()->findAll($criteria);
        $this->render('index', array('model' => $model, 'paginator' => $paginator));
    }

    /**
     * Добавление еденицы измерения на сайт
     * 
     * @return render unitsForm
     */
    public function actionAdd()
    {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Добавление еденицы измерения';
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
        $this->render('unitsForm', array('model' => $model));
    }

    /**
     * Редактирование едениц измерения на сайте
     * 
     * @return render unitsForm
     */
    public function actionEdit($id)
    {
        $model = Units::model()->findByPk($id);
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Редактирование еденицы измерения (' . $model->name . ')';
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
        $this->render('unitsForm', array('model' => $model));
    }

    /**
     * Удаление еденицы измерения по ее id
     * 
     * @param integer $id - id ингредиента
     * @return json 0 - успех, 1 - ошибка
     */
    public function actionDelete($id)
    {
        if (Units::model()->deleteByPk($id)) {
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }
}