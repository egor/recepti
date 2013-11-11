<?php

class SelectionRecipesController extends Controller
{

    public function actionIndex()
    {
        $ingredientsList = Ingredients::model()->findAll(array('order' => 'name'));
        $categoryList = Category::model()->findAll(array('condition' => 'visibility = "1"', 'order' => 'position'));
        $this->render('index', array('ingredientsList' => $ingredientsList, 'categoryList' => $categoryList));
    }

    public function actionList()
    {
        $this->render('list');
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