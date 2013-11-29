<?php

/**
 * This is the model class for table "dishes_parser_info".
 *
 * The followings are the available columns in table 'dishes_parser_info':
 * @property string $dishes_parser_info_id
 * @property string $dishes_id
 * @property string $site
 * @property string $url
 * @property string $img
 */
class DishesParserInfo extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DishesParserInfo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'dishes_parser_info';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dishes_id, site, url, img', 'required'),
            array('dishes_id', 'length', 'max' => 10),
            array('site, url, img', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('dishes_parser_info_id, dishes_id, site, url, img', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'dishes_parser_info_id' => 'Dishes Parser Info',
            'dishes_id' => 'Dishes',
            'site' => 'Site',
            'url' => 'Url',
            'img' => 'Img',
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

        $criteria->compare('dishes_parser_info_id', $this->dishes_parser_info_id, true);
        $criteria->compare('dishes_id', $this->dishes_id, true);
        $criteria->compare('site', $this->site, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('img', $this->img, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function truncateTable() {
        $this->getDbConnection()->createCommand()->truncateTable($this->tableName());
    }

}