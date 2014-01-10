<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CheckUrl
 *
 * @author egorik
 */
class GetFlashesWidget extends CWidget {
    public $type = 'standart';
    public function init() {
        if ($this->type == 'standart') {
            $this->render('getFlashesStandartWidget');
        }
    }
}