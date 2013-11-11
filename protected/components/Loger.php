<?php
/**
 * Loger
 * Логирование действий пользователя
 * @package backEnd
 * @category loger
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class Loger
{
    /**
     * Записывает действия пользователя в БД
     * 
     * @param string $action - описание действий пользователя
     * @param array $json - дополнительные параметры о действиях
     * @param tinyint $error - 0|1 указывает является ли действие ошибкой
     * @param int $userId - id пользователя совершившего действие
     * @param string $comment - комментарий к действию
     */
    public function addLog($action, $json=array(), $error = 0, $userId = 'session', $comment = '')
    {
        if (Yii::app()->params['loger']) {
            $log = new UserActionLog;
            $log->user_id = ($userId == 'session' ? Yii::app()->user->id : $userId);
            $log->action = $action;
            $log->date = time();
            $log->error = $error;
            $json['ip']= Yii::app()->request->userHostAddress;
            $json['user-agent']= $_SERVER['HTTP_USER_AGENT'];
            $log->array = json_encode($json);
            $log->comment = $comment;
            $log->save();
        }
    }
}
?>