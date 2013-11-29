<?php

/**
 * DishesController. Контроллер управления рецептами и их ингредиентами.
 * 
 * @package Back End
 * @category Ingredients
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class DishesController extends Controller {

    /**
     * Вывод списка рецептов
     * 
     * В списке может применяться фильтр по категориям
     * 
     * @param int $category - id категории, рецепты которой нужно вывести
     * @return render index
     */
    public function actionIndex($category = 0, $parser = 0, $listPic = 0, $visibility = 0, $show = 0, $sort = 0) {
        $condition = $this->_categoryFilter($category);        
        $condition .= $this->_parserFilter($parser);
        $condition .= $this->_listPicFilter($listPic);
        $condition .= $this->_visibilityFilter($visibility);
        $condition .= '1=1';
        $criteria = new CDbCriteria();
        $criteria->order = $this->_orderList($sort);
        $criteria->condition = $condition;
        $count = Dishes::model()->count($criteria);        
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->_showFilter($show);
        $paginator->applyLimit($criteria);
        $model = Dishes::model()->with('category', 'dishes_rating', 'dishes_visits', 'user')->findAll($criteria);
        $modelCategory = Category::model()->findAll();
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Рецепты ('.$count.')';
        $this->render('index', array('model' => $model, 'modelCategory'=>$modelCategory, 'paginator' => $paginator));
    }

    /**
     * Добавление рецепта
     * 
     * @render render dishesForm
     */
    public function actionAdd() {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Добавление рецепта';
        $model = new Dishes;
        if (isset($_POST['Dishes']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Dishes'];
            if (empty($model->date)) {
                $model->date = DateOperations::dateToUnixTime(date('d.m.Y'));
            } else {
                $model->date = DateOperations::dateToUnixTime($model->date);
            }
            if (empty($model->url)) {
                $model->url = Transliteration::ruToLat($model->menu_name);
            } else {
                $model->url = Transliteration::ruToLat($model->url);
            }
            if ($model->validate()) {
                $file = CUploadedFile::getInstance($model, 'img');
                $model->save();
                if (!empty($file->name)) {
                    $model->img = $model->dishes_id . '_' . $file->name;
                    $file->saveAs(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img);
                    Category::model()->updateByPk($model->dishes_id, array('img' => $model->img));
                }
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Рецепт успешно добавлен.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/dishes');
                } else {
                    Yii::app()->request->redirect('/altadmin/dishes/edit/' . $model->dishes_id);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('dishesForm', array('model' => $model));
    }

    /**
     * Редактирование рецепта
     * 
     * @param integer $id - id рецепта
     */
    public function actionEdit($id) {
        $model = Dishes::model()->with('user', 'dishes_parser_info')->findByPk($id);
        $modelCategory = Category::model()->findByPk($model->category_id);
        $oldImg = $model->img;
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Редактирование рецепта (' . $model->menu_name . ')';
        if (isset($_POST['Dishes']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['Dishes'];
            $model->date = DateOperations::dateToUnixTime($model->date);
            if ($model->validate()) {
                $model->img = $this->uploadMainFoto($id, $oldImg);
                $model->save();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Рецепт успешно отредактирован.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/dishes');
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $model->date = date('d.m.Y', $model->date);
        $this->render('dishesForm', array('model' => $model, 'modelCategory' => $modelCategory, 'edit' => 1));
    }

    /**
     * Загрузка основного фото рецепта
     * 
     * @param integer $id - id рецепта
     * @param string $oldImg - имя старого изображения, если есть
     * @return string - имя нового изображения, если было загружено
     */
    private function uploadMainFoto($id, $oldImg = null) {
        Yii::import('application.extensions.upload.Upload');
        foreach ($_FILES['Dishes'] as $key => $value) {
            $file[$key] = $value['img'];
        }
        Yii::app()->setComponents(array('imagemod' => array('class' => 'application.extensions.imagemodifier.CImageModifier')));
        Yii::app()->imagemod->setLanguage('ru_RU');
        $handle = Yii::app()->imagemod->load($file);
        if ($handle->uploaded) {
            $this->_deletePic($id);
            //не заменять - на _
            $handle->file_safe_name = false;
            //не переименовывать
            $handle->file_auto_rename = false;
            $handle->jpeg_quality = 100;
            $handle->file_name_body_pre = $id . '-';
            $handle->process(Yii::getPathOfAlias('webroot') . '/images/dishes/');
            if ($handle->processed) {
                $img = $handle->file_dst_name;
                $handle->clean();
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> ' . $handle->error);
            }
        } else {
            $img = $oldImg;
        }
        return $img;
    }

    /**
     * Удаление рецепта
     * 
     * Удаляет рецепт, его ингредиенты и картинки
     * 
     * @param integer $id - id рецепта
     */
    public function actionDelete($id) {
        $model = Dishes::model()->findByPk($id);
        if ($model->dishes_id > 0) {
            $transaction = $model->dbConnection->beginTransaction();
            try {
                Dishes::model()->deleteByPk($id);
                $this->_deletePic($id);
                Composition::model()->deleteAll('`dishes_id`="' . $id . '"');
                echo json_encode(array('error' => 0));
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollback();
            }
        } else {
            echo json_encode(array('error' => 1));
        }
    }

    /**
     * Удаление картинки рецепта
     * 
     * @param integer $id - id рецепта
     */
    public function actionDeleteMainPic($id) {
        if ($this->_deletePic($id)) {
            Dishes::model()->updateByPk($id, array('img' => ''));
            echo json_encode(array('error' => 0));
        } else {
            echo json_encode(array('error' => 1));
        }
    }

    /**
     * Удаляет картинку рецепта с диска
     * 
     * @param int $id - id записи у которой нужно удалить картинку
     * @return boolean
     */
    private function _deletePic($id) {
        $model = Dishes::model()->findByPk($id);
        if (!empty($model->img) && file_exists(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img)) {
            unlink(Yii::getPathOfAlias('webroot') . '/images/dishes/' . $model->img);
        }
        return true;
    }

    private function _categoryFilter($category) {
        $condition = '';      
        if ($category == -1) {            
            unset(Yii::app()->session['dishesCategory']);
        } else if ($category != 0) {
            Yii::app()->session['dishesCategory'] = $category;
        } else {
            $category = Yii::app()->session['dishesCategory'];
        }
        if ($category != 0 && $category != -1) {
            $condition = 't.category_id ="' . $category . '" AND ';
        }
        return $condition;
    }
    
    private function _parserFilter($parser) {
        $condition = '';      
        if ($parser == -1) {            
            unset(Yii::app()->session['dishesParser']);
        } else if ($parser != 0) {
            Yii::app()->session['dishesParser'] = $parser;
        } else {
            $parser = Yii::app()->session['dishesParser'];
        }
        if ($parser != 0 && $parser != -1) {
            if ($parser == 1) {
                $condition = 't.parser ="1" AND ';
            } else {
                $condition = 't.parser ="0" AND ';
            }
        }
        return $condition;
    }
    
    private function _listPicFilter($listPic) {
        $condition = '';      
        if ($listPic == -1) {            
            unset(Yii::app()->session['dishesListPic']);
        } else if ($listPic != 0) {
            Yii::app()->session['dishesListPic'] = $listPic;
        } else {
            $listPic = Yii::app()->session['dishesListPic'];
        }
        if ($listPic != 0 && $listPic != -1) {
            if ($listPic == 1) {
                $condition = 't.img <>"" AND ';
            } else {
                $condition = 't.img ="" AND ';
            }
        }
        return $condition;
    }        
    
    private function _visibilityFilter($visibility) {
        $condition = '';      
        if ($visibility == -1) {            
            unset(Yii::app()->session['dishesVisibility']);
        } else if ($visibility != 0) {
            Yii::app()->session['dishesVisibility'] = $visibility;
        } else {
            $visibility = Yii::app()->session['dishesVisibility'];
        }
        if ($visibility != 0 && $visibility != -1) {
            if ($visibility == 1) {
                $condition = 't.visibility = "1" AND ';
            } else {
                $condition = 't.visibility = "0" AND ';
            }
        }
        return $condition;
    }
    
    private function _orderList($sort) {
        if ($sort) {
            Yii::app()->session['dishesSort'] = $sort;
        } else {
            $sort = (Yii::app()->session['dishesSort'] ? Yii::app()->session['dishesSort'] : '-1');
        }
        $order = '';      
        if ($sort == -1) {
            $order = 't.menu_name';            
        } else if ($sort == 1) {
            $order = 't.menu_name DESC';  
        } else if ($sort == 2) {
            $order = 't.date DESC';  
        } else if ($sort == 3) {
            $order = 't.date';  
        } else if ($sort == 4) {
            $order = '(dishes_rating.plus - dishes_rating.minus) DESC';  
        } else if ($sort == 5) {
            $order = '(dishes_rating.plus - dishes_rating.minus)';  
        } else if ($sort == 6) {
            $order = 'dishes_visits.count DESC';  
        } else if ($sort == 7) {
            $order = 'dishes_visits.count';  
        } else if ($sort == 8) {
            $order = '';  
        } else if ($sort == 9) {
            $order = '';  
        }
        return $order;
    }
    
    private function _showFilter($show ) {         
        if ($show == -1) {            
            unset(Yii::app()->session['dishesShow']);
        } else if ($show != 0) {
            Yii::app()->session['dishesShow'] = $show;
        } else {
            $show = Yii::app()->session['dishesShow'];
        }
        if ($show != 0 && $show != -1) {
            return $show;
        }
        return $this->altAdminDishesPageSize;
    }   
    //Ингредиенты
    
    /**
     * Добавление ингредиента в рецепт
     */
    public function actionCompositionAdd() {
        $id = (int)$_POST['id'];
        $model = new Composition;
        if (isset($_POST['ingredients_id']) && isset($_POST['units_id'])) {
            $model->dishes_id = $id;
            $model->ingredients_id = $_POST['ingredients_id'];
            $model->units_id = $_POST['units_id'];
            $model->info = $_POST['info'];
            $model->required = $_POST['required'];
            $model->count = $_POST['count'];
            if ($model->validate()) {
                $model->save();
                echo json_encode(array('error' => 0, 'required' => $_POST['required']));
                exit();
            }
        }
        $this->renderPartial('compositionForm', array('model' => $model, 'id' => $id));
    }

    /**
     * Редактирование ингредиента в рецепте
     * 
     */
    public function actionCompositionEdit() {
        $iId = (int) $_POST['iId'];
        $model = Composition::model()->findByPk($iId);
        if (isset($_POST['ingredients_id']) && isset($_POST['units_id'])) {
            $model->ingredients_id = $_POST['ingredients_id'];
            $model->units_id = $_POST['units_id'];
            $model->info = $_POST['info'];
            $model->required = $_POST['required'];
            $model->count = $_POST['count'];
            if ($model->validate()) {
                $model->save();
                echo json_encode(array('error' => 0));
                exit();
            }
        }
        $this->renderPartial('compositionForm', array('model' => $model, 'id' => $model->dishes_id, 'iId' => $iId, 'edit' => 1));
    }

    /**
     * Вывод списка ингредиентов рецепта
     * 
     * @param integer $id - id рецепта
     * 
     * @return renderPartial compositionShowList - список ингредиентов
     */
    public function actionCompositionShowList($id) {
        $model = Composition::model()->with('ingredients', 'units')->findAll('`dishes_id`="' . $id . '"');
        $this->renderPartial('compositionShowList', array('model' => $model));
    }

    /**
     * Удаление ингредиента из состава рецепта
     * 
     * Удаляет ингредиент по его id
     * 
     * @param integer $id - id ингредиента
     */
    public function actionCompositionDelete($id) {        
        Composition::model()->deleteByPk($id);
        echo json_encode(array('error' => 0));        
    }
        public function actionChangeOrder()
    {
        echo ImagesBasicOperations::changeOrder('DishesGallery', $_POST['neworder']);
    }
    
    public function actionDeleteImage()
    {
        $imageFolder = array('/images/dishes/small', '/images/dishes/big', '/images/dishes/real');
        echo ImagesBasicOperations::deleteImage('DishesGallery', $_POST['id'], $imageFolder);
    }
    
    public function actionEditMetaImage()
    {
        echo ImagesBasicOperations::editMetaImage('DishesGallery', $_POST);
    }

}