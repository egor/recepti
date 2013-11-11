<?php
/**
 * DefaultController
 * Действия по умолчанию
 * 
 * @package CMS
 * @category CMS
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class DefaultController extends Controller
{

    /**
     * Главная страница
     * Авторизация или главное меню CMS
     */
    public function actionIndex()
    {
        $this->pageTitle = 'CMS ALTADMIN';
        if (Yii::app()->user->isGuest || Yii::app()->user->role != 'admin') {
            Yii::app()->theme = 'altenter';
            $model = new LoginForm;
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            if (isset($_POST['LoginForm'])) {
                $model->attributes = $_POST['LoginForm'];
                if ($model->validate() && $model->login()) {
                    $this->redirect('/altadmin/');
                }
            }
            $this->render('login', array('model' => $model));
        } else {
            $this->render('index');
        }
    }

    /**
     * Выход из CMS
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Восстановление пароля
     */
    public function actionRestore()
    {
        $model = new UserRestore;
        Yii::app()->theme = 'altenter';
        if (isset($_POST['UserRestore'])) {
            $model->attributes = $_POST['UserRestore'];
            if ($model->validate()) {
                $user = User::model()->find('email=:email', array(':email' => $model->email));
                if (isset($user->user_id)) {
                    $newPass = $model->password;
                    $model->password = md5($model->password);
                    $model->date = time();
                    $model->user_id = $user->user_id;
                    $model->str = GenerateString::generateIdString($user->user_id, 20);
                    $model->save();
                    Loger::addLog('смена пароля', array('user_email' => $model->email, 'user_str' => $model->str), 0, $user->user_id);
                    SendStandartMail::confirmationRegistration(array('email' => $user->email), $model->str, $newPass);
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('restore', array('mail' => $model->email));
                    } else {
                        $this->render('restore', array('mail' => $model->email));
                    }
                    exit;
                } else {
                    Loger::addLog('смена пароля. пользователь не существует', array('user_email' => $model->email), 1, 0);
                }
            } else {
                Loger::addLog('смена пароля. не прошел валидацию', array(), 1, 0);
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('restore', array('model' => $model));
        } else {
            $this->render('restore', array('model' => $model));
        }
    }

    /**
     * Подтверждение смены пароля
     * 
     * @param string $key - хеш строка подтверждения смены пароля
     */
    public function actionConfirmation($key = null)
    {   
        Yii::app()->theme = 'altenter';
        if ($key == null) {
            Loger::addLog('смена пароля. строка подтверждения пустая.', array(), 1, 0);
            $this->render('confirmation', array('confirmation' => 0));
            exit;
        }        
        $model = UserRestore::model()->find('str=:str', array(':str' => $key));
        if (isset($model->user_restore_id)) {
            $user = User::model()->updateByPk($model->user_id, array('password' => $model->password));
            UserRestore::model()->deleteByPk($model->user_restore_id);
            Loger::addLog('смена пароля. подтверждение', array('user_email' => $user->email), 0, $user->user_id);
            $this->render('confirmation', array('confirmation' => 1));
        } else {
            Loger::addLog('смена пароля. ошибка в строке подтверждения', array(), 1, 0);
            $this->render('confirmation', array('confirmation' => 0));
        }
    }
}