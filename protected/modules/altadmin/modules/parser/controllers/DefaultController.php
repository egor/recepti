<?php

class DefaultController extends Controller {

    /**
     * Варианты едениц измерений
     * @var array
     */
    public $normUnitsArr = array();

    /**
     * Адресс страницы со списком рецептов для парсинга
     * @var string
     */
    public $siteUrl = '';

    /**
     * Контейнер ссылки на подробное описание рецепта
     * @var string
     */
    public $listElementAttribute = '';

    /**
     * Список ссылок на подробное описание рецептов
     * @var array 
     */
    public $linkToDetailPage = array();

    /**
     * Название категории в которую будет занесен список рецептов
     * @var string
     */
    public $categoryName = '';

    /**
     * Контейнер H1 рецепта
     * @var string
     */
    public $detailNameElementAttribute = '';

    /**
     * Контейнер пошаговых инструкций
     * @var string 
     */
    public $detailInstructuionElementAttribute = '';

    /**
     * Контейнер названия ингредиентов
     * @var string 
     */
    public $detailIngredientNameElementAttribute = '';

    /**
     * Контейнер названий едениц измерений
     * @var string 
     */
    public $detailIngredientCountElementAttribute = '';

    /**
     * Контейнер количества едениц измерений
     * @var string 
     */
    public $detailIngredientCountNameElementAttribute = '';

    /**
     * Контейнер времени приготовления
     * @var string 
     */
    public $detailTimeElementAttribute = '';

    /**
     * Контейнер изображения рецепта
     * @var string 
     */
    public $detailImgElementAttribute = '';

    public function actionIndex() {
        $model = new ParserForm;
        if (isset($_POST['ParserForm'])) {
            $model->attributes = $_POST['ParserForm'];
            Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');
            if ($model->site == 'namnamra.ru') {
                //Строка со списком
                $this->siteUrl = $model->url;
                $this->categoryName = $model->categoryId;
                $this->namnamraRu();
                Yii::app()->user->setFlash('success', '<strong>Успех!</strong> Спарсили.');
                exit;
            } else {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Нет правил парсинга для сайта '.$model->site.'.');
                $this->render('index', array('model' => $model));
            }
        } else {
            $this->render('index', array('model' => $model));
        }        
    }

    protected function findLinkToDetailPage() {
        $simpleHTML = new SimpleHTMLDOM;
        $html = $simpleHTML->file_get_html($this->siteUrl);
        foreach ($html->find($this->listElementAttribute) as $element) {
            $this->linkToDetailPage[] = $element->href;
        }
    }

    public function namnamraRu() {
        //echo Yii::t('app', 'штука|штуки|штук', 10).'<br>';
        //DishesParserInfo::model()->truncateTable();
        //ссылка на подробное описание рецепта
        $this->listElementAttribute = 'a.irecipe';
        //h1
        $this->detailNameElementAttribute = 'h1.fn';
        //теги инструкций
        $this->detailInstructuionElementAttribute = 'p.instruction';
        //теги названией ингредиентов
        $this->detailIngredientNameElementAttribute = 'a.name';
        //теги названий едениц измерений
        $this->detailIngredientCountElementAttribute = 'span.amount';
        //теги названий количества
        $this->detailIngredientCountNameElementAttribute = 'span.amount';
        //теги времени приготовления
        $this->detailTimeElementAttribute = 'span.duration';
        $this->detailImgElementAttribute = 'img.photo';
        

        $i = 0;
        $this->findLinkToDetailPage();
        foreach ($this->linkToDetailPage as $link) {
            $i++;
            $data[$i]['link'] = $link;
            $data[$i]['info'] = '';
            //echo '<h1>Рецепт ' . $link . '</h1>';

            $newDishes = new Dishes;
            $simpleHTML = new SimpleHTMLDOM;

            $html = $simpleHTML->file_get_html($link);
            $newDishes->visibility = 0;
            $newDishes->in_menu = 0;
            $newDishes->parser = 1;
            $newDishes->user_id = rand(2, 8);
            $newDishes->date = time();
            $newDishes->complexity_id = 1;
            $newDishes->category_id = $this->spotCategoryId($this->categoryName);

            $header = $html->find($this->detailNameElementAttribute, 0);
            $data[$i]['header'] = $newDishes->menu_name = $newDishes->header = $newDishes->meta_title = $header->innertext;
            $newDishes->url = Transliteration::ruToLat($header->innertext);
            $time = $html->find($this->detailTimeElementAttribute, 0);
            $newDishes->cooking_time = (int) (strip_tags($time));
            $text = '';
            foreach ($html->find($this->detailInstructuionElementAttribute) as $element) {
                $text .= '<p>' . $element->innertext . '</p>';
            }
            $newDishes->text = $text;

            $img = $html->find($this->detailImgElementAttribute, 0);
            if ($newDishes->validate()) {
                $existence = DishesParserInfo::model()->find(array('condition' => 'url="' . $link . '"'));
                if ($existence) {
                    $data[$i]['info'] .= 'уже есть в базе парсера<br />';
                    $data[$i]['error'] = 1;
                } else {
                    $newDishes->save();
                    $newParser = new DishesParserInfo;
                    $newParser->dishes_id = $newDishes->dishes_id;
                    $newParser->site = 'namnamra.ru';
                    $newParser->url = $link;
                    $newParser->img = $img->src;
                    if ($newParser->validate()) {
                        $newParser->save();
                    }
                    $data[$i]['info'] .= 'успех<br />';

                    $data[$i]['info'] .= 'присвоен id: ' . $newDishes->dishes_id . '<br />';
                    $data[$i]['info'] .= '<a href="/altadmin/dishes/edit/' . $newDishes->dishes_id . '">редактировать</a><br />';
                    $data[$i]['error'] = 0;
                    //foreach ($html->find($this->detailIngredientCountElementAttribute) as $element) {
                    //    echo '<p>' . $element->innertext . '</p>';
                    //}
                    $ingCount = $html->find($this->detailIngredientCountElementAttribute);
                    $ingStr = 0;
                    foreach ($html->find($this->detailIngredientNameElementAttribute) as $element) {
                        $countAndUnit = explode(' ', $ingCount[$ingStr]->innertext);
                        $unit = $this->normUnits($countAndUnit[1] . ($countAndUnit[2] ? ' ' . $countAndUnit[2] : ''));
                        $count = ($countAndUnit[0]) * 1;
                        $ingredient = Ingredients::model()->find(array('condition' => 'name="' . $this->badCodeStrToLower($element->innertext) . '"'));
                        if (!$ingredient) {
                            $ingredient = new Ingredients;
                            $ingredient->name = $this->badCodeStrToLower($element->innertext);
                            $ingredient->position = 0;
                            $ingredient->parser = 1;
                            if ($ingredient->validate()) {
                                $ingredient->save();
                            }
                        } else {

                            //echo $ingredient->ingredients_id;
                            //die($this->badCodeStrToLower($element->innertext));
                        }
                        $composition = new Composition;
                        $composition->dishes_id = $newDishes->dishes_id;
                        $composition->ingredients_id = $ingredient->ingredients_id;
                        $composition->units_id = $unit;
                        $composition->info = '';
                        $composition->position = 0;
                        $composition->required = 1;
                        $composition->count = $count;
                        if ($composition->validate()) {
                            $composition->save();
                            $data[$i]['info'] .= 'добавлен игредиент. ' . $composition->ingredients_id . ' ' . $composition->units_id . ' ' . $count . ' (инг., ед.изм., кол.)';
                            $data[$i]['info'] .= '<hr/>';
                        } else {
                            //var_dump($composition->getErrors());
                            $data[$i]['error'] = 1;
                            $data[$i]['info'] .= 'не добавлен игредиент. ' . $composition->ingredients_id . ' ' . $composition->units_id . ' ' . $count . ' (инг., ед.изм., кол.) - не прошел валидацию<br />';
                            foreach ($composition->getErrors() as $err) {
                                $data[$i]['info'] .= '<b>' . $err[0] . '</b><hr/><br />';
                            }
                        }
                        $ingStr++;
                        //echo '<p>' . $element->innertext . '</p>';
                    }
                    //foreach ($html->find($this->detailIngredientCountElementAttribute) as $element) {
                    //    echo '<p>' . $element->innertext . '</p>';
                    //}
                }
            } else {
                $data[$i]['info'] .= 'не прошел валидацию<br />';
                $data[$i]['error'] = 1;
            }
        }
        //$cfile = Yii::app()->file->create(Yii::getPathOfAlias('webroot').'/logs/parser/'.date('d-m-Y_H-i-s').'.txt');
        //$cfile = Yii::app()->file->setBasename(Yii::getPathOfAlias('webroot').'/logs/parser/'.date('d-m-Y_H-i-s').'.txt');
        //Yii::app()->file->setContents('Error '.$data[$i]['error'].'; ' . 'Инфо: '.$data[$i]['info'], true, 1);
        $this->render('parserResult', array('data' => $data, 'count' => $i));
    }

    protected function spotCategoryId($name) {
        $category = Category::model()->find(array('condition' => 'menu_name = "' . $name . '"'));
        if ($category) {
            return $category->category_id;
        }
    }

    protected function normUnits($val) {
        if (!$this->normUnitsArr) {
            $this->normUnitsArr = $this->unitsToArray();
        }
        $val = trim($val);

        foreach ($this->normUnitsArr as $key => $value) {
            if (in_array($val, $value)) {
                return $key;
            }
        }
        return 0;
    }

    protected function unitsToArray() {
        $model = Units::model()->findAll();
        foreach ($model as $value) {
            $arr[$value->units_id] = explode('|', $value->match); //$value->match;            
        }
        return $arr;
    }

    protected function badCodeStrToLower($string) {
        $small = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ч', 'ц', 'ш', 'щ', 'э', 'ю', 'я', 'ы', 'ъ', 'ь',
            'э', 'ю', 'я');
        $large = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ч', 'Ц', 'Ш', 'Щ', 'Э', 'Ю', 'Я', 'Ы', 'Ъ', 'Ь',
            'Э', 'Ю', 'Я');
        return str_replace($large, $small, $string);
    }

}