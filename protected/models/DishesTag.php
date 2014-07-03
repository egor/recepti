<?php

/**
 * This is the model class for table "dishes_tag".
 *
 * The followings are the available columns in table 'dishes_tag':
 * @property integer $dishes_tag_id
 * @property integer $tag_id
 * @property integer $dishes_id
 * @property integer $position
 */
class DishesTag extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DishesTag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dishes_tag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tag_id, dishes_id, position', 'required'),
            array('tag_id, dishes_id, position', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dishes_tag_id, tag_id, dishes_id, position', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tag' => array(self::BELONGS_TO, 'Tag', 'tag_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dishes_tag_id' => 'Dishes Tag',
            'tag_id' => 'Tag',
            'dishes_id' => 'Dishes',
            'position' => 'Position',
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

        $criteria->compare('dishes_tag_id', $this->dishes_tag_id);
        $criteria->compare('tag_id', $this->tag_id);
        $criteria->compare('dishes_id', $this->dishes_id);
        $criteria->compare('position', $this->position);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
