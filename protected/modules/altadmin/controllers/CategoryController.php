<?php

class CategoryController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Категории';
        $model = Category::model()->findAll();
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление новости
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление категории';
        $model = new Category;
        if (isset($_POST['Category']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Category'];
            $model->pid = 0;
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
                    $model->img = $model->category_id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/category/' . $model->img);
                    Category::model()->updateByPk($model->category_id, array('img' => $model->img));
                }
                Loger::addLog('добавление категории', array('new_category_id' => $model->category_id));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Категория успешно добавлена.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/category');
                } else {
                    Yii::app()->request->redirect('/altadmin/category/edit/' . $model->category_id);
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
        $model = Category::model()->findByPk($id);
        $oldImg = $model->img;
        $this->pageTitle = 'Редактирование категории (' . $model->menu_name . ')';
        if (isset($_POST['Category']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Category'];
            $model->date = DateOperations::dateToUnixTime($model->date);
            if ($model->validate()) {
                $model->img = $this->uploadMainFoto($id, $oldImg);
                $model->save();
                Loger::addLog('редактирование категории', array('category_id' => $model->category_id, 'menu_name' => $model->menu_name));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Категория успешно отредактирована.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/category');
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
        foreach ($_FILES['Category'] as $key => $value) {
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
            $handle->process(Yii::getPathOfAlias('webroot') . '/images/category/');
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
            $model = Category::model()->findByPk($id);
            if ($model->category_id > 0) {
                $transaction = $model->dbConnection->beginTransaction();
                try {
                    //удаляем новость
                    Category::model()->deleteByPk($id);
                    //удаляем картинку
                    $this->deletePic($id);
                    //логируем
                    Loger::addLog('удаление категории', array('category_id' => $id, 'category_menu_name' => $model->menu_name, 'category_date' => date('d.m.Y', $model->date)));
                    echo json_encode(array('error' => 0));
                    $transaction->commit();
                } catch (Exception $e) {
                    Loger::addLog('удаление категории. ошибка при удалении', array('category_id' => $id), 1);
                    $transaction->rollback();
                }
            } else {
                Loger::addLog('удаление категории. ошибка при удалении', array('category_id' => $id), 1);
            }
        } else {
            Loger::addLog('удаление категории. ошибка при удалении', array('category_id' => $id), 1);
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
                Category::model()->updateByPk($id, array('img' => ''));
                Loger::addLog('удаление картинки категории.', array('category_id' => $id), 0);
                echo json_encode(array('error' => 0));
            } else {
                Loger::addLog('удаление картинки категории. ошибка при удалении', array('category_id' => $id), 1);
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
        $model = Category::model()->findByPk($id);
        if (!empty($model->img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/category/' . $model->img)) {
            unlink(Yii::getPathOfAlias('webroot') . '/images/category/' . $model->img);
        }
        return true;
    }
}