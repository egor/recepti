<?php

/**
 * This is the model class for table "dishes_gallery".
 *
 * The followings are the available columns in table 'dishes_gallery':
 * @property integer $dishes_gallery_id
 * @property integer $pid
 * @property string $name
 * @property integer $position
 * @property string $alt
 * @property string $title
 * @property integer $visibility
 */
class DishesGallery extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DishesGallery the static model class
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
		return 'dishes_gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pid, name, position, alt, title, visibility', 'required'),
            array('pid, name, position, alt, title, visibility', 'safe'),
			array('pid, position, visibility', 'numerical', 'integerOnly'=>true),
			array('name, alt, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dishes_gallery_id, pid, name, position, alt, title, visibility', 'safe', 'on'=>'search'),
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
			'dishes_gallery_id' => 'Dishes Gallery',
			'pid' => 'Pid',
			'name' => 'Name',
			'position' => 'Position',
			'alt' => 'Alt',
			'title' => 'Title',
			'visibility' => 'Visibility',
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

		$criteria->compare('dishes_gallery_id',$this->dishes_gallery_id);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('visibility',$this->visibility);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function mainGalleryImage($pid)
    {
        $model = DishesGallery::model()->find(array('condition'=>'pid="'.$pid.'"', 'order'=>'position DESC'));
        if ($model) {
            return '<a href="/images/dishes/real/'.$model->name.'" data-lightbox="roadtrip" ><img class="img-polaroid" src="/images/dishes/big/'.$model->name.'" alt="'.$model->alt.'" title="'.$model->title.'" /></a>';
        } else {
            return '<img src="/images/nf.jpg" />';
        }
    }
    
    public function listGalleryImages($pid)
    {
        $model = DishesGallery::model()->findAll(array('condition'=>'pid="'.$pid.'"', 'order'=>'position DESC'));
        return $model;
    }
    
    public function existImage($pid)
    {
        $model = DishesGallery::model()->find(array('condition'=>'pid="'.$pid.'"'));
        if ($model) {
            return true;
        } else {
            return false;
        }
    }
    
}