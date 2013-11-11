<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $news_id
 * @property integer $in_main
 * @property integer $visibility
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $menu_name
 * @property string $header
 * @property string $url
 * @property string $img
 * @property string $img_alt
 * @property string $img_title
 * @property string $text
 * @property string $short_text
 * @property integer $date
 */
class News extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'news';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('meta_title, menu_name, header, url, date', 'required'),
            array('in_main, visibility, meta_title, meta_description, meta_keywords, menu_name, header, url, img, img_alt, img_title, text, short_text, date', 'safe'),
            array('in_main, visibility, date', 'numerical', 'integerOnly' => true),
            array('meta_title, meta_description, meta_keywords, menu_name, header, url, img, img_alt, img_title', 'length', 'max' => 255),
            array('url', 'unique'),
            //array('img', 'file', 'types'=>'jpg, gif, png'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('news_id, in_main, visibility, meta_title, meta_description, meta_keywords, menu_name, header, url, img, img_alt, img_title, text, short_text, date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'news_id' => 'News',
            'in_main' => 'Выводить на главную',
            'visibility' => 'Выводит',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'menu_name' => 'Краткий заголовок',
            'header' => 'Заголовок',
            'url' => 'Url',
            'img' => 'Картинка',
            'img_alt' => 'Alt для картинки',
            'img_title' => 'Title для картинки',
            'text' => 'Текст',
            'short_text' => 'Краткое описание',
            'date' => 'Дата',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('news_id', $this->news_id);
        $criteria->compare('in_main', $this->in_main);
        $criteria->compare('visibility', $this->visibility);
        $criteria->compare('meta_title', $this->meta_title, true);
        $criteria->compare('meta_description', $this->meta_description, true);
        $criteria->compare('meta_keywords', $this->meta_keywords, true);
        $criteria->compare('menu_name', $this->menu_name, true);
        $criteria->compare('header', $this->header, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('img', $this->img, true);
        $criteria->compare('img_alt', $this->img_alt, true);
        $criteria->compare('img_title', $this->img_title, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('short_text', $this->short_text, true);
        $criteria->compare('date', $this->date);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}