<?php

/**
 * This is the model class for table "composition".
 *
 * The followings are the available columns in table 'composition':
 * @property integer $composition_id
 * @property integer $dishes_id
 * @property integer $ingredients_id
 * @property integer $units_id
 * @property string $info
 * @property integer $position
 * @property integer $required
 * @property double $count
 */
class Composition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Composition the static model class
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
		return 'composition';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dishes_id, ingredients_id, units_id', 'required'),
                    //array('dishes_id, ingredients_id, units_id, info, position, required, count', 'required'),
                    array('dishes_id, ingredients_id, units_id, info, position, required, count', 'safe'),
			array('dishes_id, ingredients_id, units_id, position, required', 'numerical', 'integerOnly'=>true),
			array('count', 'numerical'),
			array('info', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('composition_id, dishes_id, ingredients_id, units_id, info, position, required, count', 'safe', 'on'=>'search'),
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
                    'ingredients'=>array(self::BELONGS_TO, 'Ingredients', 'ingredients_id'),
                    'units'=>array(self::BELONGS_TO, 'Units', 'units_id'),
                    //'ingredients'=>array(self::HAS_MANY, 'Ingredients', 'ingredients_id'),                    
                    //'units'=>array(self::HAS_MANY, 'Units', 'units_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'composition_id' => 'Composition',
			'dishes_id' => 'Dishes',
			'ingredients_id' => 'Ingredients',
			'units_id' => 'Units',
			'info' => 'Info',
			'position' => 'Position',
			'required' => 'Required',
			'count' => 'Count',
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

		$criteria->compare('composition_id',$this->composition_id);
		$criteria->compare('dishes_id',$this->dishes_id);
		$criteria->compare('ingredients_id',$this->ingredients_id);
		$criteria->compare('units_id',$this->units_id);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('required',$this->required);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}