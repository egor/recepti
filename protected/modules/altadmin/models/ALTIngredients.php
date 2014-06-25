<?php

/**
 * CMSIngredients. Модель работы с ингредиентами в CMS
 * 
 * @package CMS
 * @category Ingredients
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class ALTIngredients extends Ingredients {

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
        'big' => array(
            'width' => 400,
            'height' => 300)
    );

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            //работа с изображениями
            'ALTImageDataBehavior' => array(
                'class' => 'ALTImageDataBehavior',
                'modelName' => 'ALTIngredients',
                'aiName' => 'ingredirnts_id',
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
        parent::beforeValidate();
        $this->url = $this->setUrl($this->url, $this->name);
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
        $this->img = $this->uploadImage($this->ingredients_id, 'img', '/images/ingredients/small/', $this->imgSize['small']['width'], $this->imgSize['small']['height'], $this->oldImg);
        $this->uploadImage($this->ingredients_id, 'img', '/images/ingredients/big/', $this->imgSize['big']['width'], $this->imgSize['big']['height'], $this->oldImg);
        $this->uploadImage($this->ingredients_id, 'img', '/images/ingredients/real/', 0, 0, $this->oldImg);
        return true;
    }

    /**
     * Действия перед удалением записи
     * 
     * @return boolean
     */
    protected function beforeDelete() {
        parent::beforeDelete();
        $this->deleteImageGroup($this->ingredients_id, 'img', array('/images/ingredients/small/', '/images/ingredients/big/', '/images/ingredients/real/'));
        return true;
    }

}
