<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $role
 */
class User extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email, password, name, role', 'required'),
            array('email, password, name', 'length', 'max' => 255),
            array('password', 'length', 'min'=>7, 'max' => 255),
            array('name', 'length', 'min'=>3, 'max' => 255),
            array('role', 'length', 'max' => 20),
            array('email', 'email'),
            array('email', 'unique'),
            
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_id, email, password, name, role', 'safe', 'on' => 'search'),
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
            'user_id' => 'User',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'name' => 'Имя',
            'role' => 'Роль',
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

        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('role', $this->role, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}