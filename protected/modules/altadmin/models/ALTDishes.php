<?php

/**
 * ALTDishes. Модель работы с рецептами CMS
 * 
 * @package CMS
 * @category Dishes
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class ALTDishes extends Dishes {

    /**
     * Название строго изображения
     * 
     * @var string
     */
    public $oldImg = '';
    public $imgSize = array(
        'small' => array(
            'width' => 300,
            'height' => 200
        ),
    );

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            //работа с изображениями
            'ALTImageDataBehavior' => array(
                'class' => 'ALTImageDataBehavior',
                'modelName' => 'ALTDishes',
                'aiName' => 'dishes_id',
            ),
            //работа с базовыми данными
            'ALTDefaultDataBehavior' => array(
                'class' => 'ALTDefaultDataBehavior',
            ),
        );
    }

    /**
     * Действия перед проверкой данных
     * 
     * @return boolean
     */
    protected function beforeValidate() {
        $this->date = $this->setDateAndTime($this->date);
        parent::beforeValidate();
        $this->url = $this->setUrl($this->url, $this->menu_name);
        return true;
    }

    /**
     * Действия перед сохранением записи
     * 
     * @return boolean
     */
    protected function beforeSave() {
        parent::beforeSave();        
        return true;
    }

    /**
     * Действия после сохранения записи
     * 
     * @return boolean
     */
    protected function afterSave() {
        parent::afterSave();
        $this->img = $this->uploadImage($this->dishes_id, 'img', '/images/dishes/', $this->imgSize['small']['width'], $this->imgSize['small']['height'], $this->oldImg);
        return true;
    }

    /**
     * Действия перед удалением записи
     * 
     * @return boolean
     */
    protected function beforeDelete() {
        parent::beforeDelete();
        //удалим изображение списка
        $this->deleteImage($this->dishes_id, 'img', '/images/dishes/');
        //удалим изображения галереи
        $galleryList = ALTDishesGallery::model()->findAll(array('condition'=>'pid="' . $this->dishes_id . '"'));
        foreach ($galleryList as $value) {
            ALTDishesGallery::model()->findByPk($value->dishes_gallery_id)->delete();
        }
        //удалим список ингредиентов
        ALTComposition::model()->deleteAll('`dishes_id`="' . $this->dishes_id . '"');
        return true;
    }
}
