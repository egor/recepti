<?php
/**
 * StringOperation
 * Логирование действий пользователя
 * @package backEnd
 * @category loger
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class StringOperation
{
    
    public function cutStringByWord($string, $length, $add = '') {
        $strLength = strlen($string);
        if ($strLength > $length) {
            $string = mb_substr($string, 0, $length, 'UTF-8');
            $pos = mb_strrpos($string, ' ', 'UTF-8');
            $string = mb_substr($string, 0, $pos, 'UTF-8');
            return ($strLength >$length ? $string.$add : $string);
        } else {
            return $string;
        }
    }
    
    public function cutString($string, $length, $add = '') {
        $strLength = mb_strlen($string, 'UTF-8');        
        if ($strLength > $length) {
            $string = mb_substr($string, 0, $length, 'UTF-8');
            return $string.$add;
        } else {
            return $string;
        }
    }
}