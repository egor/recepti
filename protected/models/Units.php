<?php

/**
 * This is the model class for table "units".
 *
 * The followings are the available columns in table 'units':
 * @property integer $units_id
 * @property string $name
 * @property integer $position
 */
class Units extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Units the static model class
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
		return 'units';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
                        array('name', 'unique'),                    
                        array('name, position', 'safe'),

			array('position', 'numerical', 'integerOnly'=>true),
			array('name, declension, match', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('units_id, name, position, declension, match', 'safe', 'on'=>'search'),
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
                    'composition'=>array(self::HAS_MANY, 'Composition', 'units_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'units_id' => 'Units',
			'name' => 'Название',
			'position' => 'Position',
            'declension' => 'Склонения',
            'match' => 'Совпадения'
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

		$criteria->compare('units_id',$this->units_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('position',$this->position);
        $criteria->compare('declension',$this->declension);
        $criteria->compare('match',$this->match);
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}