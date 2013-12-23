<?php

/**
 * This is the model class for table "ingredients_page".
 *
 * The followings are the available columns in table 'ingredients_page':
 * @property integer $ingredients_page_id
 * @property string $ingredients_name
 * @property string $menu_name
 * @property string $header
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $text
 * @property string $short_text
 * @property string $img
 * @property string $img_alt
 * @property string $img_title
 * @property string $url
 * @property integer $visibility
 * @property integer $in_menu
 */
class IngredientsPage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IngredientsPage the static model class
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
		return 'ingredients_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ingredients_name, menu_name, header, meta_title, meta_description, meta_keywords, text, short_text, img, img_alt, img_title, url, visibility, in_menu', 'required'),
			array('visibility, in_menu', 'numerical', 'integerOnly'=>true),
			array('ingredients_name, menu_name, header, meta_title, meta_keywords, img, img_alt, img_title, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ingredients_page_id, ingredients_name, menu_name, header, meta_title, meta_description, meta_keywords, text, short_text, img, img_alt, img_title, url, visibility, in_menu', 'safe', 'on'=>'search'),
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
			'ingredients_page_id' => 'Ingredients Page',
			'ingredients_name' => 'Ingredients Name',
			'menu_name' => 'Menu Name',
			'header' => 'Header',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'text' => 'Text',
			'short_text' => 'Short Text',
			'img' => 'Img',
			'img_alt' => 'Img Alt',
			'img_title' => 'Img Title',
			'url' => 'Url',
			'visibility' => 'Visibility',
			'in_menu' => 'In Menu',
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

		$criteria->compare('ingredients_page_id',$this->ingredients_page_id);
		$criteria->compare('ingredients_name',$this->ingredients_name,true);
		$criteria->compare('menu_name',$this->menu_name,true);
		$criteria->compare('header',$this->header,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('short_text',$this->short_text,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('img_alt',$this->img_alt,true);
		$criteria->compare('img_title',$this->img_title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('visibility',$this->visibility);
		$criteria->compare('in_menu',$this->in_menu);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}