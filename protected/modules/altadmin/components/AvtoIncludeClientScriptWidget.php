<?php

/**
 * Виджет AvtoIncludeClientScript
 * 
 * Автоматически подключает js и css файлы к текущему акшену
 * Подключает основные js и css модуля и контроллера
 * (webroot/themes/moduleName/main webroot/themes/moduleName/controllerName/main)
 * Подключает дополнительные файлы js и css
 * 
 * Пример использования с дополнительным подключением файлов:<br>
 * <code>
 * $this->widget('AvtoIncludeClientScriptWidget', array('addJS' => array('/test/folder/file.js', ...), 'addCSS' => array('/test/folder/file.css', ...)));
 * </code>
 * 
 * @package Back End
 * @category CMS
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class AvtoIncludeClientScriptWidget extends CWidget {

    /**
     * Массив дополнительных js скриптов
     * 
     * @var array 
     */
    public $addJS = array();
    
    /**
     * Массив дополнительных css скриптов
     * 
     * @var array
     */
    public $addCSS = array();

    /**
     * Конструктор автоматического подключения скриптов
     */
    public function run() {
        $path = '';
        $pathToMainModule = '';
        $pathToMainController = '';
        if (Yii::app()->controller->module->id) {
            $path .= '/' . Yii::app()->controller->module->id;
            $pathToMainModule = $path . '/main';
        }
        if (Yii::app()->controller->id) {
            $path .= '/' . Yii::app()->controller->id;
            $pathToMainController = $path.'/main';
        }
        if (Yii::app()->controller->action->id) {
            $path .= '/' . Yii::app()->controller->action->id;
        }
        $this->includeFile($pathToMainModule, 'js');
        $this->includeFile($pathToMainModule, 'css');
        $this->includeFile($pathToMainController, 'js');
        $this->includeFile($pathToMainController, 'css');
        $this->includeFile($path, 'js');
        $this->includeFile($path, 'css');
        $this->includeAddFile('js');
        $this->includeAddFile('css');
    }

    /**
     * Подключение скриптов
     * 
     * @param string $dir путь к скриптам
     * @param string $ext расширение скриптов
     */
    protected function includeFile($dir, $ext) {
        if (file_exists(Yii::getPathOfAlias('webroot') . '/themes' . $dir . '/' . $ext)) {
            $handle = opendir(Yii::getPathOfAlias('webroot') . '/themes' . $dir . '/' . $ext);
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    if ($ext == 'js') {
                        Yii::app()->getClientScript()->registerScriptFile('/themes' . $dir . '/' . $ext . '/' . $file);
                    } else if ($ext == 'css') {
                        Yii::app()->getClientScript()->registerCssFile('/themes' . $dir . '/' . $ext . '/' . $file);
                    }
                }
            }
        }
    }

    /**
     * Подключение дополнительных скриптов
     * 
     * @param string $ext расширение скриптов
     */
    protected function includeAddFile($ext) {
        if ($ext == 'js') {
            foreach ($this->addJS as $value) {
                Yii::app()->getClientScript()->registerScriptFile($value);
            }
        } else if ($ext == 'css') {
            foreach ($this->addCSS as $value) {
                Yii::app()->getClientScript()->registerCssFile($value);
            }
        }
    }
}