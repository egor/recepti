<?php

/**
 * This is the model class for table "user_restore".
 *
 * The followings are the available columns in table 'user_restore':
 * @property integer $user_restore_id
 * @property integer $user_id
 * @property string $email
 * @property integer $date
 * @property string $str
 * @property string $password
 */
class UserRestore extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserRestore the static model class
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
		return 'user_restore';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password', 'required'),
                        array('user_id, date, str', 'safe'),
			array('user_id, date', 'numerical', 'integerOnly'=>true),
			array('email, str, password', 'length', 'max'=>255),
                        array('password', 'length', 'min'=>7, 'max' => 255),
                        array('email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_restore_id, user_id, email, date, str, password', 'safe', 'on'=>'search'),
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
			'user_restore_id' => 'User Restore',
			'user_id' => 'User',
			'email' => 'Ваш Email',
			'date' => 'Date',
			'str' => 'Str',
			'password' => 'Новый пароль',
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

		$criteria->compare('user_restore_id',$this->user_restore_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('str',$this->str,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}