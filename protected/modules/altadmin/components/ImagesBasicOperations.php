<?php

/**
 * ImagesBasicOperations. Простые операции с картинками
 * 
 * @package CMS
 * @category CMS
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class ImagesBasicOperations {

    /**
     * Загрузка картинки к новости
     * 
     * К названию каждой картинки в начало добавляется приставка "<var>$id</var>-"<br>
     * где <var>$id</var> - id новости<br>
     * Картинки списка новостей загружаються в папку /images/news/<br>
     * Картинки новости на главной загружаються в папку /images/news/main/<br>
     * 
     * @todo ресайз картинки
     * @param int $id - id новости
     * @param int $imgType - тип изображения (на главной|в списке) новостей
     * @param string имя старой картинки
     * @return string имя картинки
     */
    public function uploadImg($id, $folder, $modelName, $fieldName, $oldImg = null) {
        $img = $oldImg;
        Yii::import('application.extensions.upload.Upload');
        foreach ($_FILES[$modelName] as $key => $value) {
            $file[$key] = $value[$fieldName];
        }
        Yii::app()->setComponents(array('imagemod' => array('class' => 'application.extensions.imagemodifier.CImageModifier')));
        Yii::app()->imagemod->setLanguage('ru_RU');
        $handle = Yii::app()->imagemod->load($file);
        if ($handle->uploaded) {
            ImagesBasicOperations::deleteImg($id, $folder, $modelName, $fieldName);
            //не заменять - на _
            $handle->file_safe_name = false;
            //не переименовывать
            $handle->file_auto_rename = false;
            $handle->jpeg_quality = 100;
            $handle->file_name_body_pre = $id . '-';
            $handle->process(Yii::getPathOfAlias('webroot') . $folder);
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
     * Удаляет картинку новости
     * 
     * @param int $id - id записи у которой нужно удалить картинку
     * @param int $type - тип картинки (в списке|на главной)
     * @return boolean результат удаления
     */
    public function deleteImg($id, $folder, $modelName, $fieldName) {
        $model = new $modelName;
        $fileName = $model->findByPk($id);
        $model->updateByPk($id, array($fieldName => ''));
        if (!empty($fileName->$fieldName) && file_exists(Yii::getPathOfAlias('webroot') . $folder . $fileName->$fieldName)) {
            unlink(Yii::getPathOfAlias('webroot') . $folder . $fileName->$fieldName);
        }
        return true;
    }

    /**
     * Сохранение порядка вывода картинок
     * 
     * @param string $model - название класса модели
     * @param json $array - массив с данными порядка сортировки
     * @return json - результат выполнения
     */
    public function changeOrder($model, $array) {
        $data = json_decode($array);
        if (null == $data) {
            return json_encode(array('status' => 0));
        }
        $currentModel = new $model;
        foreach ($data as $note) {
            $currentModel->updateByPk(substr($note->id, 5), array('position' => $note->order));
        }
        return json_encode(array('status' => 'OK'));
    }

    /**
     * Удаление картинки из БД и папок указанных в $imageFolder
     * 
     * @param string $model - название класса модели
     * @param int $id - id записи картинки из модели $model
     * @param array $imageFolder - массив папок в которых необходимо удаляить картинку
     * @return json - результат выполнения
     */
    public function deleteImage($model, $id, $imageFolder) {
        $imageModel = new $model;
        $img = $imageModel->findByPk($id);
        if ($img) {
            foreach ($imageFolder as $folder) {
                $file = Yii::getPathOfAlias('webroot') . $folder . '/' . $img->name;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            $imageModel->deleteByPk($id);
            return json_encode(array('error' => 0));
        }
    }

    /**
     * Редактирование мета тегов картинки
     * 
     * @param string $model - название класса модели
     * @param array $data - содержит id записи и отредактированные данные
     * @return json - результат выполнения
     */
    public function editMetaImage($model, $data) {
        $imageModel = new $model;
        $img = $imageModel->findByPk($data['id']);
        $img->alt = $data['alt'];
        $img->title = $data['title'];
        if ($img->save()) {
            return json_encode(array('error' => 0));
        } else {
            return json_encode(array('error' => 1));
        }
    }

    //----

    public function upload($id, $folder, $modelName, $fieldName, $width = 0, $height = 0, $oldImg = null, $clean = true) {
        $img = $oldImg;
        Yii::import('application.extensions.upload.Upload');
        foreach ($_FILES[$modelName] as $key => $value) {
            $file[$key] = $value[$fieldName];
        }
        Yii::app()->setComponents(array('imagemod' => array('class' => 'application.extensions.imagemodifier.CImageModifier')));
        Yii::app()->imagemod->setLanguage('ru_RU');
        $handle = Yii::app()->imagemod->load($file);
        if ($handle->uploaded) {
            ImagesBasicOperations::delete($id, $folder, $modelName, $fieldName, $oldImg);
            //не заменять - на _
            $handle->file_safe_name = false;
            //не переименовывать
            $handle->file_auto_rename = false;
            $handle->jpeg_quality = 100;
            $handle->file_name_body_pre = $id . '-';

            $handle->image_resize = true;
            $handle->image_ratio = false;
            $handle->image_ratio_crop = true;

            if ($width != 0) {
                $handle->image_x = $width;
            } else {
                $handle->image_x = $handle->image_src_x;
            }
            if ($height != 0) {
                $handle->image_y = $height;
            } else {
                $handle->image_y = $handle->image_src_y;
            }

            $handle->process(Yii::getPathOfAlias('webroot') . $folder);
            if ($handle->processed) {
                $img = $handle->file_dst_name;
                if ($clean) {
                    $handle->clean();
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
            }
        } else {
            $img = $oldImg;
        }
        return $img;
    }

    /**
     * 
     * @todo
     * 
     * @param type $id
     * @param type $folder
     * @param type $modelName
     * @param type $fieldName
     * @param type $oldImg
     * @return boolean
     */
    public function delete($id, $folder, $modelName, $fieldName, $oldImg = '') {
        $model = new $modelName;
        $fileName = $model->findByPk($id);
        $model->updateByPk($id, array($fieldName => ''));
        if (!empty($oldImg) && file_exists(Yii::getPathOfAlias('webroot') . $folder . $oldImg)) {
            unlink(Yii::getPathOfAlias('webroot') . $folder . $oldImg);
        }
        if (!empty($fileName->$fieldName) && file_exists(Yii::getPathOfAlias('webroot') . $folder . $fileName->$fieldName)) {
            unlink(Yii::getPathOfAlias('webroot') . $folder . $fileName->$fieldName);
            return true;
        } else {
            return false;
        }
    }

    public function deleteGroup($id, $folder, $modelName, $fieldName, $oldImg = '') {
        $model = new $modelName;
        $fileName = $model->findByPk($id);
        $model->updateByPk($id, array($fieldName => ''));
        foreach ($folder as $value) {
            if (!empty($oldImg) && file_exists(Yii::getPathOfAlias('webroot') . $value . $oldImg)) {
                unlink(Yii::getPathOfAlias('webroot') . $value . $oldImg);
            }
            if (!empty($fileName->$fieldName) && file_exists(Yii::getPathOfAlias('webroot') . $value . $fileName->$fieldName)) {
                unlink(Yii::getPathOfAlias('webroot') . $value . $fileName->$fieldName);

            }
        }
        return true;
    }

}
