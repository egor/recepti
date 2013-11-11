<?php
/**
 * SendStandartMail
 * Отправка писем
 * @package frontEnd
 * @category mail
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class SendStandartMail
{
    public function confirmationRegistration($userData, $cStr, $newPass)
    {
        $to = $userData . '<' . $userData['email'] . '>';
        $subject = 'restore password ' . Yii::app()->request->serverName;
        $url = 'http://' . Yii::app()->request->serverName . '/altadmin/confirmation/' . $cStr;
        $message = '
            <html>
                <head>
                    <title>Смена пароля</title>
                </head>
                <body>
                    <p>Запрос на смену пароля.</p>
                    <p>Логин: '.$userData['email'].'</p>
                    <p>Новый пароль: '.$newPass.'</p>
                    <p>Для подтверждения смены пароля перейдите по ссылке</p>
                    <p><a href="'.$url.'">'.$url.'</a></p>
                    <p><b>Если Вы не запрашивали смену пароля, то проигнорируйте это письмо.</b></p>
                </body>
            </html>';
        /* Для отправки HTML-почты вы можете установить шапку Content-type. */
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        /* дополнительные шапки */
        $headers .= 'From: restore password <robot@' . Yii::app()->request->serverName . '>\r\n';
        $headers .= 'Cc: robot@' . Yii::app()->request->serverName . '\r\n';
        $headers .= 'Bcc: robot@' . Yii::app()->request->serverName . '\r\n';
        /* и теперь отправим из */
        mail($to, $subject, $message, $headers);
    }
}
?>