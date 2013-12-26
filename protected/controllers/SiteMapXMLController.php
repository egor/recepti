<?php

class SiteMapXMLController extends Controller
{
    public $inSiteMap = array (
        'category' => true,
        'dishes' => true,
        'news' => true,
        'pages' => true,
        'other' => true
    );
	public function actionIndex()
	{
        $xml = '<url><loc>http://recepti.dp.ua</loc></url>';
        if ($this->inSiteMap['category']) {
            $xml .= $this->catalogMap();
        }
        if ($this->inSiteMap['news']) {
            $xml .= $this->newsMap();
        }
        $this->renderPartial('index', array('xml' => $xml));
	}
    
    protected function catalogMap()
    {
        $text = '<url><loc>http://recepti.dp.ua/recipes</loc></url>';
        $category = Category::model()->findAll(array('condition' => 'visibility = 1', 'select' => 'url, category_id', 'order' => 'menu_name'));
        foreach ($category as $categoryValue) {
            $text .= '<url><loc>http://recepti.dp.ua/recipes/'.$categoryValue->url.'</loc></url>';
            if ($this->inSiteMap['dishes']) {
                $recipes = Dishes::model()->findAll(array('condition' => 'visibility = 1 AND category_id = "' . $categoryValue->category_id . '"', 'select' => 'url', 'order' => 'menu_name'));
                foreach ($recipes as $recipesValue) {
                    $text .= '<url><loc>http://recepti.dp.ua/recipes/'.$categoryValue->url.'/'.$recipesValue->url.'</loc></url>';
                }
            }
        }
        return $text;
    }
    
    protected function newsMap()
    {
        $text = '<url><loc>http://recepti.dp.ua/news</loc></url>';
        $news = News::model()->findAll(array('condition' => 'visibility = 1', 'select' => 'url', 'order' => 'date DESC, news_id DESC'));
        foreach ($news as $newsValue) {
            $text .= '<url><loc>http://recepti.dp.ua/news/'.$newsValue->url.'</loc></url>';            
        }
        return $text;
    }
}