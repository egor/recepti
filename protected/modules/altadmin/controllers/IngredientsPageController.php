<?php

class IngredientsPageController extends Controller {

    /**
     * Вывод списка рецептов
     * 
     * В списке может применяться фильтр по категориям
     * 
     * @param int $category - id категории, рецепты которой нужно вывести
     * @return render index
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();
        $count = IngredientsPage::model()->count($criteria);
        $paginator = new CPagination($count);
        $paginator->pageSize = $this->_showFilter($show);
        $paginator->applyLimit($criteria);
        $model = IngredientsPage::model()->findAll($criteria);
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Описание ингредиентов (' . $count . ')';
        $this->render('index', array('model' => $model, 'paginator' => $paginator));
    }

    /**
     * Добавление рецепта
     * 
     * @render render dishesForm
     */
    public function actionAdd() {
        $this->pageTitle = $this->pageHeader = $this->breadcrumbsTitle = 'Добавление описание ингредиента';
        $model = new IngredientsPage;
        if (isset($_POST['IngredientsPage']) && !isset($_POST['yt2'])) {
            $model->attributes = $_POST['IngredientsPage'];
            if (empty($model->url)) {
                $model->url = Transliteration::ruToLat($model->menu_name);
            } else {
                $model->url = Transliteration::ruToLat($model->url);
            }
            if ($model->validate()) {

                $model->save();
                $img = ImagesBasicOperations::uploadFoto($model->ingredients_page_id, '/images/ingredients/small/', 'IngredientsPage', true, 300, 200, true, true, true);
                if ($img) {
                    ImagesBasicOperations::uploadFoto($model->ingredients_page_id, '/images/ingredients/big/', 'IngredientsPage', true, 400, 300, true, true, true);
                    ImagesBasicOperations::uploadFoto($model->ingredients_page_id, '/images/ingredients/real/', 'IngredientsPage', true, 0, 0, false, false, false);
                    $model->img = $img;
                    $model->save();
                }

                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Рецепт успешно добавлен.');
                if (isset($_POST['yt1'])) {
                    Yii::app()->request->redirect('/altadmin/ingredientsPage');
                } else {
                    Yii::app()->request->redirect('/altadmin/ingredientsPage/edit/' . $model->ingredients_page_id);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверте поля еще раз.');
            }
        }
        $this->render('ingredientsPageForm', array('model' => $model));
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
    private function uploadMFoto($id, $oldImg = null) {
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

}