<?php

/**
 * Виджет QuoteWidget
 * 
 * Виджет вывода цитат в случайном порядке.
 * 
 * @package FrontEnd
 * @category Quote
 * @author Egor Rihnov <egor.developer@gmail.com>
 * @version 1.0
 * @copyright Copyright (c) 2013, Egor Rihnov
 */
class SimilarRecipesWidget extends CWidget
{
    public $categoryId;
    
    public $dishesId;
    
    public $ingredients = array();
    
    public $similarRecipesLimit = 4;
    
    public $similarRecipesAddLimit;
    /**
     * Вывод цитат в случайном порядке
     * 
     * @return render quoteWidget
     */
    public function init()
    {        
        $this->similarRecipesAddLimit = $this->similarRecipesLimit;
        $similarRecipes = $this->similarRecipesIngredient($this->ingredients[0]);
        $count = count($similarRecipes);
        if ($count < $this->similarRecipesLimit) {
            $this->similarRecipesAddLimit = $this->similarRecipesLimit - $count;
            if ($similarRecipes) {
                //$similarRecipes = array_merge($similarRecipes, $this->similarRecipesIngredient($this->ingredients[1], $similarRecipes));
                $similarRecipes = array_merge($this->similarRecipesIngredient($this->ingredients[1], $similarRecipes), $similarRecipes);
            } else {
                $similarRecipes = $this->similarRecipesIngredient($this->ingredients[1], $similarRecipes);
            }
            $count = count($similarRecipes);
            if ($count < $this->similarRecipesLimit) {
                $this->similarRecipesAddLimit = $this->similarRecipesLimit - $count;
                if ($similarRecipes) {
                    //$similarRecipes = array_merge($similarRecipes, $this->similarRecipesCategory($similarRecipes));
                    $similarRecipes = array_merge($this->similarRecipesCategory($similarRecipes), $similarRecipes);
                } else {
                    $similarRecipes = $this->similarRecipesCategory($similarRecipes);
                }
            }
            $count = count($similarRecipes);
            if ($count < $this->similarRecipesLimit) {
                $this->similarRecipesAddLimit = $this->similarRecipesLimit - $count;
                if ($similarRecipes) {
                    //$similarRecipes = array_merge($similarRecipes, $this->similarRecipesCategory($similarRecipes, 0));
                    $similarRecipes = array_merge($this->similarRecipesCategory($similarRecipes, 0), $similarRecipes);
                } else {
                    $similarRecipes = $this->similarRecipesCategory($similarRecipes, 0);
                }
            }
        }
        $this->render('similarRecipesWidget', array('model' => $this->similarRecipeDataList($similarRecipes)));
    }
    
    private function similarRecipesIngredient($ingredientId, $thereIsDishes = array())
    {
        $addCondition = '';
        if ($thereIsDishes) {
            $addCondition = ' AND (';
            foreach ($thereIsDishes as $value) {
                $addCondition .= 'dishes.dishes_id <> "'.$value->dishes_id.'" AND ';
            }
            $addCondition .= '1=1)';            
        }
        //echo $addCondition;
        $model = Composition::model()->with('dishes')->findAll(array('select'=>'dishes_id, ingredients_id', 'condition' => 'dishes.category_id ="'.$this->categoryId.'" AND dishes.visibility = 1 AND dishes.dishes_id <>"'.$this->dishesId.'" AND ingredients_id = "'.$ingredientId.'" '.$addCondition, 'limit' => $this->similarRecipesAddLimit));
        return $model;
    }
    
    private function similarRecipesCategory($thereIsIngredient = array(), $byCategory = 1)
    {
        $addCondition = '';
        if ($thereIsIngredient) {
            $addCondition = ' AND (';
            foreach ($thereIsIngredient as $value) {
                $addCondition .= 'dishes_id <> "'.$value->dishes_id.'" AND ';
            }
            $addCondition .= '1=1)';            
        }
        if ($byCategory == 1) {
            $condition = 'category_id = "'.$this->categoryId.'" AND dishes_id <>"'.$this->dishesId.'" AND visibility = 1';
        } else {
            $condition = 'dishes_id <> "'.$this->dishesId.'" AND visibility = 1';
        }
        $model = Dishes::model()->findAll(array('select'=>'dishes_id', 'condition' => $condition.$addCondition, 'limit' => $this->similarRecipesAddLimit, 'order' => 'RAND()'));
        return $model;
    }
    
    private function similarRecipeDataList($dishesId)
    {        
        $condition = '';
        $i=0;
        foreach ($dishesId as $value) {
            $i++;
            $condition .= 'dishes_id = "'.$value->dishes_id.'"';
            if ($i < $this->similarRecipesLimit) {
                $condition .= ' OR ';
            }
        }   
        //echo $condition; die
        $model = Dishes::model()->with('category')->findAll(array('condition' => $condition));
        return $model;
    }
}