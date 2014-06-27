<?php

/**
 * ALTDishesGallery. Модель работы с ингредиентами в CMS
 * 
 * @package CMS
 * @category DishesGallery
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class ALTDishesGallery extends DishesGallery {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            //работа с изображениями
            'ALTImageDataBehavior' => array(
                'class' => 'ALTImageDataBehavior',
                'modelName' => 'ALTDishesGallery',
                'aiName' => 'dishes_gallery_id',
            ),
            //работа с базовыми данными
            'ALTDefaultDataBehavior' => array(
                'class' => 'ALTDefaultDataBehavior',
            ),
        );
    }

    /**
     * Действия перед удалением записи
     * 
     * @return boolean
     */
    protected function beforeDelete() {
        parent::beforeDelete();
        $this->deleteImageGroup($this->dishes_gallery_id, 'name', array('/images/dishes/small/', '/images/dishes/big/', '/images/dishes/real/'));
        return true;
    }

}
