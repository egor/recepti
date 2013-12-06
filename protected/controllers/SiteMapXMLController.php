<?php

class SiteMapXMLController extends Controller
{
    public $inSiteMap = array (
        'category' => true,
        'dishes' => true,
        'news' => false,
        'pages' => true,
        'other' => true
    );
	public function actionIndex()
	{
        $xml = '<url><loc>http://recepti.dp.ua</loc></url>';
        if ($this->inSiteMap['category']) {
            $xml .= $this->catalogMap();
        }
        $this->renderPartial('index', array('xml' => $xml));
	}
    
    protected function catalogMap()
    {
        $text = '<url><loc>http://recepti.dp.ua/recipes</loc></url>';
        $category = Category::model()->findAll(array('condition' => 'visibility = 1', 'select' => 'url', 'order' => 'menu_name'));
        foreach ($category as $categoryValue) {
            $text .= '<url><loc>http://recepti.dp.ua/recipes/'.$categoryValue->url.'</loc></url>';
            if ($this->inSiteMap['dishes']) {
                $recipes = Dishes::model()->findAll(array('condition' => 'visibility = 1', 'select' => 'url', 'order' => 'menu_name'));
                foreach ($recipes as $recipesValue) {
                    $text .= '<url><loc>http://recepti.dp.ua/recipes/'.$categoryValue->url.'/'.$categoryValue->url.'</loc></url>';
                }
            }
        }
        return $text;
    }
}