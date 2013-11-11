<?php
/**
 * IngredientsController. Контроллер управления ингредиентами. 
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
 * @category Ingredients
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class IngredientsController extends Controller
{

    /**
     * Список ингредиентов использующихся на сайте
     * 
     * @return render index
     */
    public function actionIndex()
    {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Ингредиенты';
        $criteria = new CDbCriteria();
        $criteria->order = 'name';
        $count = Ingredients::model()->count($criteria);
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->altAdminIngredientsPageSize;        
        $paginator->applyLimit($criteria);

        $model = Ingredients::model()->findAll($criteria);
        $this->render('index', array('model' => $model, 'paginator' => $paginator));
    }

    /**
     * Добавление ингредиента
     * 
     * @return render add
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление ингредиента';
        $model = new Ingredients;
        if (isset($_POST['Ingredients']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Ингредиент успешно добавлен.');
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
     * Редактирование ингредиента
     * 
     * @param integer $id - id ингредиента
     * @return render edit
     */
    public function actionEdit($id)
    {
        $model = Ingredients::model()->findByPk($id);
        $this->pageTitle = 'Редактирование ингредиента (' . $model->name . ')';
        if (isset($_POST['Ingredients']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Ingredients'];
            if ($model->validate()) {
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Ингредиент успешно отредактирован.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/ingredients');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }

    /**
     * Удаление ингредиента по его id
     * 
     * @param integer $id - id ингредиента
     * @return json 0 - успех, 1 - ошибка
     */
    public function actionDelete($id)
    {
        if (Ingredients::model()->deleteByPk($id)) {
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }
}