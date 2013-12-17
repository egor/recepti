<?php

/**
 * Виджет ControlPanelWidget
 * 
 * Виджет вывода цитат в случайном порядке.
 * 
 * @package FrontEnd
 * @category Quote
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class ControlPanelWidget extends CWidget
{

    /**
     * Вывод цитат в случайном порядке
     * 
     * @return render сontrolPanelWidget
     */
    public function init()
    {
        $this->render('controlPanelWidget');
    }
}