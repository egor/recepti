<?php

class NewsController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Новости';
        $model = News::model()->findAll(array('order' => 'date DESC'));
        $this->render('index', array('model' => $model));
    }

    /**
     * Добавление новости
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление новости';
        $model = new News;
        if (isset($_POST['News']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['News'];
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
                    $model->img = $model->news_id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/news/' . $model->img);
                    News::model()->updateByPk($model->news_id, array('img' => $model->img));
                }
                Loger::addLog('добавление новости', array('new_news_id' => $model->news_id));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Новость успешно добавлена.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/news');
                } else {
                    Yii::app()->request->redirect('/altadmin/news/edit/' . $model->news_id);
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
        $model = News::model()->findByPk($id);
        $oldImg = $model->img;
        $this->pageTitle = 'Редактирование новости (' . $model->menu_name . ')';
        if (isset($_POST['News']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['News'];
            $model->date = DateOperations::dateToUnixTime($model->date);
            if ($model->validate()) {
                $model->img = $this->uploadMainFoto($id, $oldImg);
                $model->save();
                Loger::addLog('редактирование новости', array('news_id' => $model->news_id, 'menu_name' => $model->menu_name));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Новость успешно отредактирована.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/news');
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
        foreach ($_FILES['News'] as $key => $value) {
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
            $handle->process(Yii::getPathOfAlias('webroot') . '/images/news/');
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
     * Удаление новости по $id
     * AJAX
     */
    public function actionDelete()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            $model = News::model()->findByPk($id);
            if ($model->news_id > 0) {
                $transaction = $model->dbConnection->beginTransaction();
                try {
                    //удаляем новость
                    News::model()->deleteByPk($id);
                    //удаляем картинку
                    $this->deletePic($id);
                    //логируем
                    Loger::addLog('удаление новости', array('news_id' => $id, 'news_menu_name' => $model->menu_name, 'news_date' => date('d.m.Y', $model->date)));
                    echo json_encode(array('error' => 0));
                    $transaction->commit();
                } catch (Exception $e) {
                    Loger::addLog('удаление новости. ошибка при удалении', array('news_id' => $id), 1);
                    $transaction->rollback();
                }
            } else {
                Loger::addLog('удаление новости. ошибка при удалении', array('news_id' => $id), 1);
            }
        } else {
            Loger::addLog('удаление новости. ошибка при удалении', array('news_id' => $id), 1);
            echo json_encode(array('error' => 1));
        }
    }

    /**
     * Удаление картинки новости
     * AJAX
     */
    public function actionDeletePic()
    {
        $id = (int) ($_POST['id']);
        if ($id > 0) {
            if ($this->deletePic($id)) {
                News::model()->updateByPk($id, array('img' => ''));
                Loger::addLog('удаление картинки новости.', array('news_id' => $id), 0);
                echo json_encode(array('error' => 0));
            } else {
                Loger::addLog('удаление картинки новости. ошибка при удалении', array('news_id' => $id), 1);
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
        $model = News::model()->findByPk($id);
        if (!empty($model->img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/news/' . $model->img)) {
            unlink(Yii::getPathOfAlias('webroot') . '/images/news/' . $model->img);
        }
        return true;
    }

}