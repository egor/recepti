<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $category_id
 * @property integer $pid
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $menu_name
 * @property string $header
 * @property integer $in_menu
 * @property integer $visibility
 * @property string $short_text
 * @property string $text
 * @property integer $position
 * @property integer $date
 * @property string $url
 * @property string $img
 * @property string $img_alt
 * @property string $img_title
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pid, meta_title, meta_keywords, meta_description, menu_name, header, in_menu, visibility, short_text, text, position, date, url, img, img_alt, img_title', 'required'),
                    array('pid, meta_title, menu_name, header date, url', 'required'),
                    array('pid, meta_title, meta_keywords, meta_description, menu_name, header, in_menu, visibility, short_text, text, position, date, url, img, img_alt, img_title', 'safe'),
			array('pid, in_menu, visibility, position, date', 'numerical', 'integerOnly'=>true),
			array('meta_title, meta_keywords, menu_name, header, url, img, img_alt, img_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('category_id, pid, meta_title, meta_keywords, meta_description, menu_name, header, in_menu, visibility, short_text, text, position, date, url, img, img_alt, img_title', 'safe', 'on'=>'search'),
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
                    'dishes'=>array(self::HAS_MANY, 'Dishes', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => 'Category',
			'pid' => 'Pid',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'menu_name' => 'Краткий заголовок',
			'header' => 'Заголовок',
			'in_menu' => 'Выводить в меню',
			'visibility' => 'Выводить на сайте',
			'short_text' => 'Краткое описание',
			'text' => 'Текст',
			'position' => 'Позиция',
			'date' => 'Дата',
			'url' => 'Url',
			'img' => 'Картинка',
			'img_alt' => 'Alt для картинки',
			'img_title' => 'Title для картинки',
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

		$criteria=new CDbCriteria;

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('in_menu',$this->in_menu);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('short_text',$this->short_text,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('date',$this->date);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('img_alt',$this->img_alt,true);
		$criteria->compare('img_title',$this->img_title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}