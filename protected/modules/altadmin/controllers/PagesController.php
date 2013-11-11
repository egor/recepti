<?php

class PagesController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public function init() {
        $this->registerAssets();
        parent::init();
    }

    private function registerAssets() {

        Yii::app()->clientScript->registerCoreScript('jquery');
        //$this->registerJs('webroot.js.altadmin.jstree','/jquery.cookie.js');
        //$this->registerJs('webroot.js.altadmin.jstree','/jquery.hotkeys.js');
        //$this->registerJs('webroot.js.altadmin.jstree','/jquery.jstree.js');
        //$this->registerCssAndJs('webroot.js.altadmin.fancybox', '/jquery.fancybox-1.3.4.js', '/jquery.fancybox-1.3.4.css');
        //$this->registerCssAndJs('webroot.js.altadmin.jqui1812', '/js/jquery-ui-1.8.12.custom.min.js', '/css/dark-hive/jquery-ui-1.8.12.custom.css');
        $this->registerCssAndJs('webroot.js.altadmin.jqui1812', '/js/jquery-ui-1.8.12.custom.min.js', '');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/altadmin/json2/json2.js');
        //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/client_val_form.css', 'screen');
        //Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/altadmin/jstree/themes/classic/style.css','screen');
    }

    public function actionEdit($id = 0) {
        // = $_GET['id'];
        $this->pageTitle = 'Редактирование страницы | CMS ALTADMIN';
        $model = Pages::model()->findByPk($id);
        $model->scenario = 'edit';
        $img = $model->img;
        $img_top_form = $model->img_top_form;
        //echo     Yii::getPathOfAlias('webroot') ;
        if (isset($_POST['Pages'])) {
            $model->attributes = $_POST['Pages'];
            $model->date = DateOperations::dateToUnixTime($model->date);
            $model->end_date_top_form = DateOperations::dateToUnixTime($model->end_date_top_form);
            $model->end_time_top_form = DateOperations::timeToUnixTime($model->end_time_top_form);            
            if ($model->validate()) {
                $file = CUploadedFile::getInstance($model, 'img');
                if (!empty($file->name)) {
                    if (!empty($img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/pages/' . $img)) {
                        unlink(Yii::getPathOfAlias('webroot') . '/images/pages/' . $img);
                    }
                    $model->img = $id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/pages/' . $model->img);
                } else {
                    $model->img = $img;
                }
                $file = CUploadedFile::getInstance($model, 'img_top_form');
                if (!empty($file->name)) {
                    if (!empty($img) && !empty($img_top_form) && file_exists(Yii::getPathOfAlias('webroot') . '/images/pages/form/top/' . $img_top_form)) {
                        unlink(Yii::getPathOfAlias('webroot') . '/images/pages/form/top/' . $img_top_form);
                    }
                    $model->img_top_form = $id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/pages/form/top/' . $model->img_top_form);
                } else {
                    $model->img_top_form = $img_top_form;
                }
                $u = Pages::model()->find('url="' . $model->url . '" AND pages_id!="' . $id . '"');

                if (!empty($u->pages_id)) {
                    //$model->date = date('d.m.Y', $model->date);
                    $model->addError('url', 'url уже занят');
                    $this->render('edit', array('pages' => $model));
                    return;
                }
                if (empty($model->url)) {
                    $model->addError('url', 'url не может быть пустым');
                    $this->render('edit', array('pages' => $model));
                    return;
                }
                //sreturn $model;
                Yii::app()->user->setFlash('success', "Страница отредактирована");
                if (!isset($_POST['yt0'])) {
                    $model->saveNode();
                }
                if (isset($_POST['yt2']) || isset($_POST['yt0'])) {
                    Yii::app()->request->redirect('/altadmin/pages/');
                } else {
                    Yii::app()->request->redirect('/altadmin/pages/edit/' . $model->pages_id);
                }
                // form inputs are valid, do something here
                return;
            }
        }
        $model->end_time_top_form = date('h:i', $model->end_time_top_form);
        $model->end_date_top_form = date('d.m.Y', $model->end_date_top_form);
        $model->date = date('d.m.Y', $model->date);
        //$this->render('edit');
        //$this->render('_form',array('model'=>$model));
        $this->render('edit', array('pages' => $model));
    }

    /**
     * @return array action filters
     */
    /** 	public function filters()
      {
      return array(
      'accessControl', // perform access control for CRUD operations
      );
      }
     */
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    /** 	public function accessRules()
      {
      return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
      'actions'=>array('index','view'),
      'users'=>array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
      'actions'=>array('create','update'),
      'users'=>array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
      'actions'=>array('admin','delete'),
      'users'=>array('admin'),
      ),
      array('deny',  // deny all users
      'users'=>array('*'),
      ),
      );
      } */

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->pageTitle = 'Дерево страниц  | CMS ALTADMIN';
        //create an array open_nodes with the ids of the nodes that we want to be initially open
        //when the tree is loaded.Modify this to suit your needs.Here,we open all nodes on load.
        $categories = Pages::model()->findAll(array('order' => 'lft'));
        $identifiers = array();
        foreach ($categories as $n => $category) {
            $identifiers[] = "'" . 'node_' . $category->pages_id . "'";
        }
        $open_nodes = implode(',', $identifiers);

        $baseUrl = Yii::app()->baseUrl;

        $dataProvider = new CActiveDataProvider('Pages');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'baseUrl' => $baseUrl,
            'open_nodes' => $open_nodes
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Pages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionFetchTree() {

        Pages::printULTree();
    }

    public function actionRename() {

        $new_name = $_POST['new_name'];
        $id = $_POST['id'];
        $renamed_cat = $this->loadModel($id);
        $renamed_cat->menu_name = $new_name;
        if ($renamed_cat->saveNode()) {
            echo json_encode(array('success' => true));
            exit;
        } else {
            echo json_encode(array('success' => false));
            exit;
        }
    }

    public function actionRemove() {
        $id = $_POST['id'];
        if (
        $id == Yii::app()->params['modules']['news'] ||
        $id == Yii::app()->params['modules']['works'] ||
        $id == Yii::app()->params['modules']['reviews'] ||
        $id == Yii::app()->params['modules']['main'] ||
        $id == Yii::app()->params['modules']['zayavka'] ||
        $id == Yii::app()->params['modules']['sitemap'] ||
        $id == Yii::app()->params['modules']['videoTips'] ||
        $id == Yii::app()->params['modules']['stock'] ||
        $id == Yii::app()->params['modules']['404'] ||
        $id == Yii::app()->params['modules']['contacts']
        ) {
            echo json_encode(array('success' => false, 'message' => 'Эту страницу нельзя удалять'));
            exit;
        }
        $deleted_cat = $this->loadModel($id);
        //attention if there is no related product,you must remove the associated code!.
        /* $products = $deleted_cat->products;
          $products_deleted = true;
          foreach ($products as $product) {
          $product_deleted = $product->delete();
          $products_deleted = $products_deleted && $product_deleted;
          }
         */
        if ($deleted_cat->deleteNode()) {
            echo json_encode(array('success' => true));
            exit;
        } else {
            echo json_encode(array('success' => false));
            exit;
        }
    }

    public function actionReturnForm() {

        $this->actionTCreate($_POST['parent_id'], $_POST['name']);
        exit;
        //don't reload these scripts or they will mess up the page
        //yiiactiveform.js still needs to be loaded that's why we don't use
        // Yii::app()->clientScript->scriptMap['*.js'] = false;
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.min.js' => false,
            'jquery.js' => false,
            'jquery.fancybox-1.3.4.js' => false,
            'jquery.jstree.js' => false,
            'jquery-ui-1.8.12.custom.min.js' => false,
            'json2.js' => false,
        );


        //Figure out if we are updating a Model or creating a new one.
        if (isset($_POST['update_id']))
            $model = $this->loadModel($_POST['update_id']);else
            $model = new Pages;


        $this->renderPartial('_form', array('model' => $model,
            'parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : ''
                ), false, true);
    }

    public function actionReturnView() {

        //don't reload these scripts or they will mess up the page
        //yiiactiveform.js still needs to be loaded that's why we don't use
        // Yii::app()->clientScript->scriptMap['*.js'] = false;
        $cs = Yii::app()->clientScript;
        $cs->scriptMap = array(
            'jquery.min.js' => false,
            'jquery.js' => false,
            'jquery.fancybox-1.3.4.js' => false,
            'jquery.jstree.js' => false,
            'jquery-ui-1.8.12.custom.min.js' => false,
            'json2.js' => false,
        );

        $model = $this->loadModel($_POST['id']);

        $this->renderPartial('view', array(
            'model' => $model,
                ), false, true);
    }

    public function actionCreateRoot() {

        if (isset($_POST['Categorydemo'])) {

            $new_root = new Pages;
            $new_root->attributes = $_POST['Categorydemo'];
            if ($new_root->saveNode(false)) {
                echo json_encode(array('success' => true,
                    'id' => $new_root->primaryKey)
                );
                exit;
            } else {
                echo json_encode(array('success' => false,
                    'message' => 'Error.Root Categorydemo was not created.'
                        )
                );
                exit;
            }
        }
    }

    public function actionCreate() {

        //if (isset($_POST['Categorydemo'])) {
        $model = new Pages;
        //set the submitted values
        //$model->attributes = $_POST['Categorydemo'];
        $parent = $this->loadModel($_POST['parent_id']);
        //return the JSON result to provide feedback.
        if ($model->appendTo($parent)) {
            echo json_encode(array('success' => true,
                'id' => $model->primaryKey)
            );
            exit;
        } else {
            echo json_encode(array('success' => false,
                'message' => 'Error.Categorydemo was not created.'
                    )
            );
            exit;
        }
        //}
    }

    public function actionTCreate($pid, $name) {

        //if (isset($_POST['Categorydemo'])) {
        $model = new Pages;
        $model->menu_name = $name;
        $model->date = time();
        $model->h1 = $name;
        $model->url = Transliteration::ruToLat($name);
        //set the submitted values
        //$model->attributes = $_POST['Categorydemo'];
        $parent = $this->loadModel($pid);
        //return the JSON result to provide feedback.
        if ($model->appendTo($parent)) {
            echo json_encode(array('success' => true,
                'id' => $model->primaryKey)
            );
            exit;
        } else {
            echo json_encode(array('success' => false,
                'message' => 'Error.Categorydemo was not created.'
                    )
            );
            exit;
        }
        //}
    }

    public function actionUpdate() {

        if (isset($_POST['Categorydemo'])) {

            $model = $this->loadModel($_POST['update_id']);
            $model->attributes = $_POST['Categorydemo'];

            if ($model->saveNode(false)) {
                echo json_encode(array('success' => true));
            }else
                echo json_encode(array('success' => false));
        }
    }

    public function actionMoveCopy() {

        $moved_node_id = $_POST['moved_node'];
        $new_parent_id = $_POST['new_parent'];
        $new_parent_root_id = $_POST['new_parent_root'];
        $previous_node_id = $_POST['previous_node'];
        $next_node_id = $_POST['next_node'];
        $copy = $_POST['copy'];

        //the following is additional info about the operation provided by
        // the jstree.It's there if you need it.See documentation for jstree.
        //  $old_parent_id=$_POST['old_parent'];
        //$pos=$_POST['pos'];
        //  $copied_node_id=$_POST['copied_node'];
        //  $replaced_node_id=$_POST['replaced_node'];
        //the  moved,copied  node
        $moved_node = $this->loadModel($moved_node_id);

        //if we are not moving as a new root...
        if ($new_parent_root_id != 'root') {
            //the new parent node
            $new_parent = $this->loadModel($new_parent_id);
            //the previous sibling node (after the move).
            if ($previous_node_id != 'false')
                $previous_node = $this->loadModel($previous_node_id);


//if we move
            if ($copy == 'false') {


                //if the moved node is only child of new parent node
                if ($previous_node_id == 'false' && $next_node_id == 'false') {

                    if ($moved_node->moveAsFirst($new_parent)) {
                        echo json_encode(array('success' => true));
                        exit;
                    }
                }

                //if we moved it in the first position
                else if ($previous_node_id == 'false' && $next_node_id != 'false') {

                    if ($moved_node->moveAsFirst($new_parent)) {
                        echo json_encode(array('success' => true));
                        exit;
                    }
                }
                //if we moved it in the last position
                else if ($previous_node_id != 'false' && $next_node_id == 'false') {

                    if ($moved_node->moveAsLast($new_parent)) {
                        echo json_encode(array('success' => true));
                        exit;
                    }
                }
                //if the moved node is somewhere in the middle
                else if ($previous_node_id != 'false' && $next_node_id != 'false') {

                    if ($moved_node->moveAfter($previous_node)) {
                        echo json_encode(array('success' => true));
                        exit;
                    }
                }
            }//end of it's a move
            //else if it is a copy
            else {
                //create the copied Categorydemo model
                $copied_node = new Pages;
                //copy the attributes (only safe attributes will be copied).
                $copied_node->attributes = $moved_node->attributes;
                //remove the primary key
                $copied_node->id = null;


                if ($copied_node->appendTo($new_parent)) {
                    echo json_encode(array('success' => true,
                        'id' => $copied_node->primaryKey
                            )
                    );
                    exit;
                }
            }
        }//if the new parent is not root end
//else,move it as a new Root
        else {
            //if moved/copied node is not Root
            if (!$moved_node->isRoot()) {

                if ($moved_node->moveAsRoot()) {
                    echo json_encode(array('success' => true));
                } else {
                    echo json_encode(array('success' => false));
                }
            }
            //else if moved/copied node is Root
            else {

                echo json_encode(array('success' => false, 'message' => 'Нельзя менять порядок корневых элементов'));
            }
        }
    }

//action moveCopy
//UTILITY FUNCTIONS
    public static function registerCssAndJs($folder, $jsfile, $cssfile) {
        $sourceFolder = YiiBase::getPathOfAlias($folder);
        $publishedFolder = Yii::app()->assetManager->publish($sourceFolder);
        Yii::app()->clientScript->registerScriptFile($publishedFolder . $jsfile, CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerCssFile($publishedFolder . $cssfile);
    }

    public static function registerCss($folder, $cssfile) {
        $sourceFolder = YiiBase::getPathOfAlias($folder);
        $publishedFolder = Yii::app()->assetManager->publish($sourceFolder);
        Yii::app()->clientScript->registerCssFile($publishedFolder . '/' . $cssfile);
        return $publishedFolder . '/' . $cssfile;
    }

    public static function registerJs($folder, $jsfile) {
        $sourceFolder = YiiBase::getPathOfAlias($folder);
        $publishedFolder = Yii::app()->assetManager->publish($sourceFolder);
        Yii::app()->clientScript->registerScriptFile($publishedFolder . '/' . $jsfile);
        return $publishedFolder . '/' . $jsfile;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'categorydemo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    
    
    
    /**
     * Настройки модуля новости
     * @return type
     */
    public function actionSettings() {
        
        // = $_GET['id'];
        $modelSettings['numPage'] = Settings::model()->findByPk(9);

        $this->pageTitle = 'Настройка страниц | CMS ALTADMIN';
        //if (isset($_POST['News'])) {
        //}  
        //var_dump($_POST['Pages']);
        if (isset($_POST['Settings'])) {
        
        $modelSettings['numPage']->attributes = $_POST['Settings'];
        $modelSettings['numPage']->attributes = (int)$modelSettings['numPage']->attributes;
        $modelSettings['numPage']->save();
        
       
        //sreturn $model;
        Yii::app()->user->setFlash('success', "Настройки сохранены");
        if (!isset($_POST['yt0'])) {

        }
        if (isset($_POST['yt2']) || isset($_POST['yt0'])) {
            Yii::app()->request->redirect('/altadmin/pages/');
        } elseif (isset($_POST['yt1'])) {
            Yii::app()->request->redirect('/altadmin/pages/settings/');
        }
}

        $this->render('settings', array('paginator' => $modelSettings['numPage']));
    }
    
    
    /**
     * Настройки модуля новости
     * @return type
     */
    public function actionSettingsMain() {
        
        // = $_GET['id'];
        $modelSettings['numPage'] = Settings::model()->findByPk(8);

        $this->pageTitle = 'Настройка главной страницы | CMS ALTADMIN';
        //if (isset($_POST['News'])) {
        //}  
        //var_dump($_POST['Pages']);
        if (isset($_POST['Settings'])) {
        
        $modelSettings['numPage']->attributes = $_POST['Settings'];
        $modelSettings['numPage']->attributes = (int)$modelSettings['numPage']->attributes;
        $modelSettings['numPage']->save();
        
       
        //sreturn $model;
        Yii::app()->user->setFlash('success', "Настройки сохранены");
        if (!isset($_POST['yt0'])) {

        }
        if (isset($_POST['yt2']) || isset($_POST['yt0'])) {
            Yii::app()->request->redirect('/altadmin/pages/');
        } elseif (isset($_POST['yt1'])) {
            Yii::app()->request->redirect('/altadmin/pages/settingsMain/');
        }
}

        $this->render('settingsMain', array('paginator' => $modelSettings['numPage']));
    }
}
