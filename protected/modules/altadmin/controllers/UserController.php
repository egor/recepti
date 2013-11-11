<?php

class UserController extends Controller
{

    public function actionIndex()
    {
        $this->pageTitle = 'Пользователи';
        $model = User::model()->findAll();
        $this->render('index', array('model'=>$model));
    }
    
    /**
     * Добавление пользователя
     */
    public function actionAdd()
    {
        $this->pageTitle = 'Добавление пользователя';
        $model = new User;
        if (isset($_POST['User']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['User'];
            $model->role = 'admin';
            if ($model->validate()) {
                $model->password = md5($model->password);
                $model->save();
                Loger::addLog('добавление пользователя', array('new_user_id' => $model->user_id, 'new_user_email' => $model->email, 'new_user_name' => $model->name));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Пользователь успешно добавлен.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/user');
                } else {
                    Yii::app()->request->redirect('/altadmin/user/edit/'.$model->user_id);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('add', array('model' => $model));
    }
    
    /**
     * Добавление пользователя
     */
    public function actionEdit($id)
    {
        $model = User::model()->findByPk($id);
        $passwordTmp = $model->password;
        $this->pageTitle = 'Редактирование пользователя ('.$model->name.')';
        if (isset($_POST['User']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['User'];
            $model->role = 'admin';
            if (empty($model->password)) {
                $model->password = $passwordTmp;
            }
            if ($model->validate()) {
                if (!empty($model->password)) {                
                    $model->password = md5($model->password);
                }
                $model->save();
                Loger::addLog('редактирование пользователя', array('user_id' => $model->user_id, 'user_email' => $model->email, 'user_name' => $model->name));
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Пользователь успешно отредактирован.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/user');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('edit', array('model' => $model));
    }
    
    /**
     * Лог действий пользователя
     * @param type $id - id пользователя
     */
    public function actionLog($id)
    {
        $user = User::model()->findByPk($id);
        $model = UserActionLog::model()->findAll('user_id = '.$id.' ORDER BY date DESC');
        $this->render('log', array('model' => $model, 'user' => $user));
    }
    
    /**
     * Удаление пользователя по $id
     * AJAX
     */
    public function actionDelete()
    {
        $id = (int) ($_POST['id']);
        if ($id == Yii::app()->user->id) {
            Loger::addLog('удаление пользователя. ошибка при удалении. самоудаление запрещено', array('user_id' => $id), 1);
            echo json_encode(array('error' => 1, 'message' => 'Самоудаление запрещено!'));
            exit;
        }
        if ($id > 0) {
            $model = User::model()->findByPk($id);
            if ($model->user_id > 0) {
                $transaction = $model->dbConnection->beginTransaction();
                try {
                    //удаляем пользователя
                    User::model()->deleteByPk($id);
                    //логируем
                    Loger::addLog('удаление пользователя', array('user_id' => $id, 'email'=>$model->email, 'name' =>$model->name));
                    echo json_encode(array('error' => 0));
                    $transaction->commit();
                } catch (Exception $e) {
                    Loger::addLog('удаление пользователя. ошибка при удалении', array('user_id' => $id), 1);
                    $transaction->rollback();
                }
            } else {
                Loger::addLog('удаление пользователя. ошибка при удалении', array('user_id' => $id), 1);
            }
        } else {
            Loger::addLog('удаление пользователя. ошибка при удалении', array('user_id' => $id), 1);
            echo json_encode(array('error' => 1));
        }
    }
    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}