<?php

/**
 * This is the model class for table "dishes_rating".
 *
 * The followings are the available columns in table 'dishes_rating':
 * @property integer $dishes_rating_id
 * @property integer $dishes_id
 * @property integer $plus
 * @property integer $minus
 */
class DishesRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DishesRating the static model class
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
		return 'dishes_rating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dishes_id, plus, minus', 'required'),
			array('dishes_id, plus, minus', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dishes_rating_id, dishes_id, plus, minus', 'safe', 'on'=>'search'),
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
                    'dishes_rating'=>array(self::HAS_ONE, 'Dishes', 'dishes_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dishes_rating_id' => 'Dishes Rating',
			'dishes_id' => 'Dishes',
			'plus' => 'Plus',
			'minus' => 'Minus',
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

		$criteria->compare('dishes_rating_id',$this->dishes_rating_id);
		$criteria->compare('dishes_id',$this->dishes_id);
		$criteria->compare('plus',$this->plus);
		$criteria->compare('minus',$this->minus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}