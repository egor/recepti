<?php

/**
 * DeleteOperations. Удаление записей и изображений
 * 
 * @package CMS
 * @category Other
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2014, Egor Rihnov
 */
class DeleteConfirmationWindow extends CWidget
{
    /**
     * Вызываемый метод
     * 
     * @var string 
     */
    public $method;
    
    /**
     * Передаваемые данные методу
     * 
     * @var array 
     */
    public $data = array();
    
    /**
     * Вызов необходимого метода
     */
    public function init()
    {
        $method = $this->method;
        $this->$method();
    }
    
    /**
     * Удаление изображения
     * Пример вызова:
     * <code>$this->widget('application.modules.altadmin.widgets.DeleteOperations', array('method' => 'deleteImage', 'data'=>array('id'=>$model->id, 'url'=>'/altadmin/news/deleteImage', 'body'=>'<p>Вы уверены что хотите удалить изображение списка?</p>', 'pathToImage' => '/images/news/list/'.$model->image)));</code>
     */
    protected function deleteImage() {
        $this->render('webroot.themes.'.Yii::app()->theme->name.'.widgets.DeleteConfirmationWindow.deleteImage', array('data' => $this->data));
    }
    
    /**
     * Удаление записей
     * Удаляет запись по id и скрывает ее в таблице
     * Пример вызова:
     * <code>$this->widget('application.modules.altadmin.widgets.DeleteOperations', array('method' => 'deleteTrRecord', 'data'=>array('url'=>'/altadmin/news/delete', 'body'=>'<p>Вы уверены что хотите удалить новость <b>"<span id="recordName"></span>"</b>?</p>', 'td' => 5)));</code>
     */
    protected function deleteTrRecord() {
        $this->render('webroot.themes.'.Yii::app()->theme->name.'.widgets.DeleteConfirmationWindow.deleteTrRecord', array('data' => $this->data));
    }
    
    protected function deleteMassRecord() {
        $this->render('webroot.themes.'.Yii::app()->theme->name.'.widgets.DeleteConfirmationWindow.deleteMassRecord', array('data' => $this->data));
    }
}