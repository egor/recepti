<?php

/**
 * This is the model class for table "ingredients".
 *
 * The followings are the available columns in table 'ingredients':
 * @property integer $ingredients_id
 * @property string $name
 * @property integer $position
 */
class Ingredients extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ingredients the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'ingredients';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('name, position, parser, verification, url, visibility, header, short_text, text, img, img_alt, img_title, meta_title, meta_keywords, meta_description', 'safe'),
            array('name, url, header, meta_title', 'required'),
            array('name', 'unique'),
            array('position, parser, verification, visibility', 'numerical', 'integerOnly' => true),
            array('name, url, header, img, img_alt, img_title, meta_title, meta_keywords', 'length', 'max' => 255),
            array('ingredients_id, name, position, parser, verification, url, visibility, header, short_text, text, img, img_alt, img_title, meta_title, meta_keywords, meta_description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'composition' => array(self::HAS_MANY, 'Composition', 'ingredients_id'),
                //'composition'=>array(self::BELONGS_TO, 'Composition', 'ingredients_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ingredients_id' => 'Ingredients',
            'name' => 'Название',
            'position' => 'Position',
            'parser' => 'parser',
            'verification' => 'verification',
            'url' => 'url',
            'visibility' => 'Выводить',
            'header' => 'Заголовок',
            'short_text' => 'Краткое описание',
            'text' => 'Подробное описание',
            'img' => 'Картинка',
            'img_alt' => 'Alt для картинки',
            'img_title' => 'Title для картинки',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
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

        $criteria->compare('ingredients_id', $this->ingredients_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('position', $this->position);
        $criteria->compare('parser', $this->parser);
        $criteria->compare('verification', $this->verification);
        $criteria->compare('url', $this->url);
        $criteria->compare('visibility', $this->visibility);
        $criteria->compare('header', $this->header);
        $criteria->compare('short_text', $this->short_text);
        $criteria->compare('text', $this->text);
        $criteria->compare('img', $this->img);
        $criteria->compare('img_alt', $this->img_alt);
        $criteria->compare('img_title', $this->img_title);
        $criteria->compare('meta_title', $this->meta_title);
        $criteria->compare('meta_keywords', $this->meta_keywords);
        $criteria->compare('meta_description', $this->meta_description);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
