<?php

/**
 * CompositionListWidget. Вывод ингредиентов рецепта в таблицу.
 * 
 * @package FrontEnd
 * @category Dishes
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class CompositionListWidget extends CWidget {

    /**
     *
     * @var int id рецета
     */
    public $dishesId;

    public function init() {
        $model = Composition::model()->with('ingredients', 'units')->findAll('`dishes_id`="' . $this->dishesId . '"');
        $this->render('compositionListWidget', array('model' =>$model));
    }
}