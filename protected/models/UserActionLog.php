<?php

/**
 * This is the model class for table "user_action_log".
 *
 * The followings are the available columns in table 'user_action_log':
 * @property integer $user_action_log_id
 * @property integer $user_id
 * @property string $action
 * @property integer $date
 * @property string $array
 * @property string $comment
 * @property integer $error
 */
class UserActionLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserActionLog the static model class
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
		return 'user_action_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('user_id, action, date, array, comment, error', 'required'),
                        array('user_id, action, date, array, comment, error', 'safe'),
			array('user_id, date, error', 'numerical', 'integerOnly'=>true),
			array('action, comment', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_action_log_id, user_id, action, date, array, comment, error', 'safe', 'on'=>'search'),
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
			'user_action_log_id' => 'User Action Log',
			'user_id' => 'User',
			'action' => 'Action',
			'date' => 'Date',
			'array' => 'Array',
			'comment' => 'Comment',
			'error' => 'Error',
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

		$criteria->compare('user_action_log_id',$this->user_action_log_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('array',$this->array,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('error',$this->error);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}