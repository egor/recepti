<?php

/**
 * Виджет QuoteWidget
 * 
 * Виджет вывода цитат в случайном порядке.
 * 
 * @package FrontEnd
 * @category Quote
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class QuoteWidget extends CWidget
{

    /**
     * Вывод цитат в случайном порядке
     * 
     * @return render quoteWidget
     */
    public function init()
    {
        $model = Quote::model()->find(array('order' => 'RAND()'));
        $this->render('quoteWidget', array('model' => $model));
    }
}