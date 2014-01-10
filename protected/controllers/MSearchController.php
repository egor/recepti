<?php

class MSearchController extends Controller {

    public function actionIndex() {

        $this->pageTitle = 'Расширеный поиск рецептов';
        $this->pageHeader = 'Расширеный поиск рецептов';
        $category = Category::model()->findAll(array('select' => 'category_id, menu_name', 'condition' => 'visibility = 1', 'order' => 'position'));
        $ingredients = Ingredients::model()->findAll(array('select' => 'ingredients_id, name', 'condition' => 'verification = 1', 'order' => 'name'));
        if (isset($_POST['mSearchForm'])) {
            $whereIngredients = array();
            foreach ($ingredients as $value) {
                if (isset($_POST['ingredients-' . $value->ingredients_id])) {
                    $whereIngredients[] = $value->ingredients_id;
                }
            }
            $whereCategory = '';
            foreach ($category as $value) {
                if (isset($_POST['category-' . $value->category_id])) {
                    $whereCategory .= 't.category_id = ' . $value->category_id . ' OR ';
                }
            }
            $whereCategory = substr($whereCategory, 0, strlen($whereCategory) - 4);
            $error = 0;
            if (empty($whereIngredients)) {
                $error = 1;
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Необходимо отметить ингредиенты для поиска.');
            }

            if (empty($whereCategory)) {
                $error = 1;
                Yii::app()->user->setFlash('error 1', '<strong>Ошибка!</strong> Необходимо отметить категории для поиска.');
            }

            if ($error == 1) {
                unset($_POST['mSearchForm']);
                $this->render('index', array('category' => $category, 'ingredients' => $ingredients, 'modelCategory' => $modelCategory, 'modelList' => $modelList, 'paginator' => $paginator));
                exit;
            }
            $dishesList = Yii::app()->db->createCommand()->
                    select('dishes_id, COUNT(*) AS c')->
                    from('composition')->
                    where(array('in', 'ingredients_id', $whereIngredients))->
                    group('dishes_id')->
                    //having('c>2')->
                    order('c DESC')->
                    //limit(21)->
                    queryAll();
            $whereDishes = '';
            foreach ($dishesList as $value) {
                $whereDishes .= 't.dishes_id = "' . $value[dishes_id] . '" OR ';
            }
            $whereDishes = substr($whereDishes, 0, strlen($whereDishes) - 4);
            //----------------------------------------------------------------------
            //если этого не сделать, то будет тулить id в урл

            $time = $_POST['time'];
            if ($time == 0) {
                $timeWhere = '';
            } else if ($time != 30 && $time != 60 && $time != 120) {
                $timeWhere = '';
            } else {
                $timeWhere = ' AND t.cooking_time <= "'.(int)($time).'"';                
            }
            
            $complexity = $_POST['complexity'];
            if ($complexity == 0) {
                $complexityWhere = '';
            } else if ($complexity != 1 && $complexity != 2) {
                $complexityWhere = '';
            } else {
                $complexityWhere = ' AND t.complexity_id = "'.(int)($complexity).'"';                
            }
            
            unset($_GET['id']);
            $limit = 21;
            
            $condition = '(' . $whereDishes . ') AND t.visibility=1 AND (' . $whereCategory . ')'.$timeWhere.$complexityWhere;
            $criteria = new CDbCriteria();
            $criteria->condition = $condition;
            $criteria->order = 't.date DESC';
            $criteria->limit = 21;
            $count = Dishes::model()->count($criteria);
            /*
            $paginator = new CPagination($count);
            $paginator->pageSize = $limit;
            $paginator->route = '/mSearch';
            $paginator->applyLimit($criteria);
             * 
             */
            $modelList = Dishes::model()->with('complexity', 'category', 'dishes_rating', 'dishes_visits')->findAll($criteria);
            if (empty($modelList)) {
                Yii::app()->user->setFlash('warning', '<strong>Внимание!</strong> По заданным параметрам нисего не найдено.');                
                unset($_POST['mSearchForm']);
            }
        }
        Yii::app()->clientScript->registerMetaTag('', 'keywords');
        Yii::app()->clientScript->registerMetaTag('', 'description');

        //$this->render('dishesList', array('modelCategory' => $modelCategory, 'modelList' => $modelList, 'paginator' => $paginator));

        $this->render('index', array('category' => $category, 'ingredients' => $ingredients, 'modelCategory' => $modelCategory, 'modelList' => $modelList, 'paginator' => $paginator));
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