<?php
/**
 * DateOperations
 *
 * Операции с датой и временем
 * 
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.1
 */
class DateOperations {
    
    /**
     * Перевод даты из формата д.м.Г в unix время
     * @param string $date - дата
     * @return int - unix время
     */
    public function dateToUnixTime($date)
    {
        $data = explode('.', $date);
        return mktime(0, 0, 0, $data[1], $data[0], $data[2]);
    }
    
    /**
     * Перевод время из формата ч:м в unix время
     * @param string $time - дата
     * @return int - unix время
     */
    public function timeToUnixTime($time)
    {
        $time = explode(':', $time);
        return mktime($time[0], $time[1], 0, 0, 0);
    }    
}
?>