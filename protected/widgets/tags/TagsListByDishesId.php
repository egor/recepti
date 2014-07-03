<?php

class TagsListByDishesId extends CWidget {

    public $dishesId;
    
    public function init() {
        $model = DishesTag::model()->with('tag')->findAll(array('condition' => 'dishes_id="'.$this->dishesId.'"'));
        $this->render('webroot.themes.bootstrap.widgets.tags.tagsListByDishesId', array('model' => $model));
    }

}
