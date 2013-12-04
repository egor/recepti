<?php

/**
 * This is the model class for table "ingredients".
 *
 * The followings are the available columns in table 'ingredients':
 * @property integer $ingredients_id
 * @property string $name
 * @property integer $position
 */
class Ingredients extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ingredients the static model class
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
        return 'ingredients';
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
            array('position, parser, verification', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ingredients_id, name, position, parser', 'safe', 'on' => 'search'),
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
            'composition'=>array(self::HAS_MANY, 'Composition', 'ingredients_id'),
            //'composition'=>array(self::BELONGS_TO, 'Composition', 'ingredients_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'ingredients_id' => 'Ingredients',
            'name' => 'Название',
            'position' => 'Position',
            'parser'=>'parser',
            'verification'=>'verification',
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

        $criteria->compare('ingredients_id', $this->ingredients_id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('position', $this->position);
        $criteria->compare('parser', $this->parser);
        $criteria->compare('verification', $this->verification);
        
        

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}