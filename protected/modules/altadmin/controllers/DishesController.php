<?php

class DishesController extends Controller
{

    /**
     * Вывод списка рецептов
     * 
     * В списке может применяться фильтр по категориям
     * 
     * @param int $category - $_GET['category'] id категории, рецепты которой нужно вывести
     * @return render index
     */
    public function actionIndex()
    {
        if (isset($_GET['category'])) {
            $category = (int)$_GET['category'];
            $condition = '`category_id` ="'.$category.'"';
        } else {
            $condition = '';
        }
        $this->pageTitle = 'Рецепты';
        $model = Dishes::model()->with('category')->findAll($condition);
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление новости
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление рецепта';
        $model = new Dishes;

        if (isset($_POST['Dishes']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Dishes'];

            if (empty($model->date)) {
                $model->date = DateOperations::dateToUnixTime(date('d.m.Y'));
            } else {
                $model->date = DateOperations::dateToUnixTime($model->date);
            }
            if (empty($model->url)) {
                $model->url = Transliteration::ruToLat($model->menu_name);
            } else {
                $model->url = Transliteration::ruToLat($model->url);
            }
            if ($model->validate()) {
                $file = CUploadedFile::getInstance($model, 'img');
                $model->save();
                if (!empty($file->name)) {
                    $model->img = $model->dishes_id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img);
                    Category::model()->updateByPk($model->dishes_id, array('img' => $model->img));
                }
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Рецепт успешно добавлен.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/dishes');
                } else {
                    Yii::app()->request->redirect('/altadmin/dishes/edit/' . $model->dishes_id);
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
        $model = Dishes::model()->findByPk($id);
        $oldImg = $model->img;
        $this->pageTitle = 'Редактирование рецепта (' . $model->menu_name . ')';
        if (isset($_POST['Dishes']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Dishes'];
            $model->date = DateOperations::dateToUnixTime($model->date);
            if ($model->validate()) {
                $model->img = $this->uploadMainFoto($id, $oldImg);
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Рецепт успешно отредактирован.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/dishes');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $model->date = date('d.m.Y', $model->date);
        $this->render('edit', array('model' => $model));
    }

    private function uploadMainFoto($id, $oldImg = null)
    {
        Yii::import('application.extensions.upload.Upload');
        foreach ($_FILES['Dishes'] as $key => $value) {
            $file[$key] = $value['img'];
        }
        Yii::app()->setComponents(array('imagemod' => array('class' => 'application.extensions.imagemodifier.CImageModifier')));
        Yii::app()->imagemod->setLanguage('ru_RU');
        $handle = Yii::app()->imagemod->load($file);
        if ($handle->uploaded) {
            $this->deletePic($id);
            //не заменять - на _
            $handle->file_safe_name = false;
            //не переименовывать
            $handle->file_auto_rename = false;
            $handle->jpeg_quality = 100;
            $handle->file_name_body_pre = $id . '-';
            $handle->process(Yii::getPathOfAlias('webroot') . '/images/dishes/');
            if ($handle->processed) {
                $img = $handle->file_dst_name;
                $handle->clean();
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
            }
        } else {
            $img = $oldImg;
        }
        return $img;
    }

    /**
     * Удаление категории по $id
     * AJAX
     */
    public function actionDelete()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            $model = Dishes::model()->findByPk($id);
            if ($model->dishes_id > 0) {
                $transaction = $model->dbConnection->beginTransaction();
                try {
                    Dishes::model()->deleteByPk($id);
                    $this->deletePic($id);
                    Composition::model()->deleteAll('`dishes_id`="'.$id.'"');
                    echo json_encode(array('error' => 0));
                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollback();
                }
            } else {
                echo json_encode(array('error' => 1));
            }
        } else {
            echo json_encode(array('error' => 1));
        }
    }



    /**
     * Удаление картинки категории
     * AJAX
     */
    public function actionDeletePic()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            if ($this->deletePic($id)) {
                Dishes::model()->updateByPk($id, array('img' => ''));
                echo json_encode(array('error' => 0));
            } else {
                echo json_encode(array('error' => 1));
            }
        }
    }

    /**
     * Удаляет картинку
     * 
     * @param int $id - id записи у которой нужно удалить картинку
     * @return boolean
     */
    private function deletePic($id)
    {
        $model = Dishes::model()->findByPk($id);
        if (!empty($model->img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img)) {
            unlink(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img);
        }
        return true;
    }

    public function actionCompositionAdd()
    {
        $id = $_POST['id'];
        $model = new Composition;
        
        if (isset($_POST['ingredients_id']) && isset($_POST['units_id'])) {
            
            $model->dishes_id = $id;
            $model->ingredients_id = $_POST['ingredients_id'];
            $model->units_id = $_POST['units_id'];
            $model->info = $_POST['info'];
            $model->required = $_POST['required'];
            $model->count = $_POST['count'];
            if ($model->validate()) {
                $model->save();
                echo json_encode(array('error' => 0));
                exit();
            }            
        }
        $this->renderPartial('compositionAdd', array('model' => $model, 'id'=>$id));
    }
    
    public function actionCompositionEdit()
    {
        $iId = (int)$_POST['iId'];
        $model = Composition::model()->findByPk($iId);        
        if (isset($_POST['ingredients_id']) && isset($_POST['units_id'])) {
            $model->ingredients_id = $_POST['ingredients_id'];
            $model->units_id = $_POST['units_id'];
            $model->info = $_POST['info'];
            $model->required = $_POST['required'];
            $model->count = $_POST['count'];
            if ($model->validate()) {
                $model->save();
                echo json_encode(array('error' => 0));
                exit();
            }            
        }
        $this->renderPartial('compositionAdd', array('model' => $model, 'id'=>$model->dishes_id, 'iId'=>$iId, 'edit'=>1));
    }
    
    /**
     * Вывод списка компонентов из состава рецепта AJAX
     * 
     * Вывод списка компонентов из состава рецепта по id из POST массива
     * int <var>$id</var> - $_POST['id'] id рецепта из таблицы dishes
     * 
     * @return renderPartial compositionShowList
     */    
    public function actionCompositionShowList()
    {
        $id = (int)$_POST['id'];        
        $model = Composition::model()->with('ingredients', 'units')->findAll('`dishes_id`="' . $id.'"');
        $this->renderPartial('compositionShowList', array('model' => $model));
    }
    
    /**
     * Удаление компонента из состава рецепта AJAX
     * 
     * Удаляет компонент по id из POST массива
     * int <var>$id</var> - $_POST['id'] id компонента из таблицы composition
     * 
     * @return array json (1 - ошибка, 0 - успех)
     */
    public function actionCompositionDelete()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            Composition::model()->deleteByPk($id);            
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }
    
}