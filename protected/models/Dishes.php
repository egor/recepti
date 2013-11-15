<?php

/**
 * This is the model class for table "dishes".
 *
 * The followings are the available columns in table 'dishes':
 * @property integer $dishes_id
 * @property integer $category_id
 * @property string $url
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $menu_name
 * @property string $header
 * @property string $short_text
 * @property string $text
 * @property integer $visibility
 * @property integer $in_menu
 * @property integer $date
 * @property integer $user_id
 * @property integer $cooking_time
 * @property integer $complexity_id
 * @property double $servings
 * @property string $img
 * @property string $img_alt
 * @property string $img_title
 * @property string $tags
 * @property string $category_add
 */
class Dishes extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Dishes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dishes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, url, meta_title, menu_name, header, date', 'required'),
            array('category_id, url, meta_title, meta_keywords, meta_description, menu_name, header, short_text, text, visibility, in_menu, date, user_id, cooking_time, complexity_id, servings, img, img_alt, img_title, tags, category_add', 'safe'),
            //array('category_id, url, meta_title, meta_keywords, meta_description, menu_name, header, short_text, text, visibility, in_menu, date, user_id, cooking_time, complexity_id, servings, img, img_alt, img_title, tags, category_add', 'required'),
            array('category_id, visibility, in_menu, date, user_id, cooking_time, complexity_id', 'numerical', 'integerOnly' => true),
            array('servings', 'numerical'),
            array('url, meta_title, meta_keywords, menu_name, header, img, img_alt, img_title, category_add', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dishes_id, category_id, url, meta_title, meta_keywords, meta_description, menu_name, header, short_text, text, visibility, in_menu, date, user_id, cooking_time, complexity_id, servings, img, img_alt, img_title, tags, category_add', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'complexity' => array(self::BELONGS_TO, 'Complexity', 'complexity_id'),
            'dishes_rating' => array(self::HAS_ONE, 'DishesRating', 'dishes_id'),
            'dishes_visits' => array(self::HAS_ONE, 'DishesVisits', 'dishes_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dishes_id' => 'Dishes',
            'category_id' => 'Категория',
            'url' => 'Url',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'menu_name' => 'Краткий заголовок',
            'header' => 'Заголовок',
            'short_text' => 'Краткое описание',
            'text' => 'Текс',
            'visibility' => 'Выводить на сайте',
            'in_menu' => 'Выводить в меню',
            'date' => 'Дата',
            'user_id' => 'Автор',
            'cooking_time' => 'Время приготовления',
            'complexity_id' => 'Сложность приготовления',
            'servings' => 'Кол-во порций',
            'img' => 'Img',
            'img_alt' => 'Img Alt',
            'img_title' => 'Img Title',
            'tags' => 'Теги',
            'category_add' => 'Category Add',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('dishes_id', $this->dishes_id);
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('meta_title', $this->meta_title, true);
        $criteria->compare('meta_keywords', $this->meta_keywords, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('menu_name', $this->menu_name, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('visibility', $this->visibility);
        $criteria->compare('in_menu', $this->in_menu);
        $criteria->compare('date', $this->date);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('cooking_time', $this->cooking_time);
        $criteria->compare('complexity_id', $this->complexity_id);
        $criteria->compare('servings', $this->servings);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('img_alt', $this->img_alt, true);
        $criteria->compare('img_title', $this->img_title, true);
        $criteria->compare('tags', $this->tags, true);
        $criteria->compare('category_add', $this->category_add, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}