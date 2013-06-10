<?php

/**
 * This is the model class for table "chat".
 *
 * The followings are the available columns in table 'chat':
 * @property integer $msg_id
 * @property integer $to_user_id
 * @property integer $from_user_id
 * @property integer $time
 * @property integer $is_read
 * @property string $content
 */
class Chat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Chat the static model class
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
		return 'chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('to_user_id, from_user_id, time', 'required'),
			array('to_user_id, from_user_id, time, is_read', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'min'=>1, 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('msg_id, to_user_id, user_id, time, read, content', 'safe', 'on'=>'search'),
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
			'msg_id' => 'Msg',
			'to_user_id' => 'To User',
			'from_user_id' => 'User',
			'time' => 'Time',
			'is_read' => 'Read',
			'content' => 'Content',
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
//
//		$criteria=new CDbCriteria;
//
//		$criteria->compare('msg_id',$this->msg_id);
//		$criteria->compare('to_user_id',$this->to_user_id);
//		$criteria->compare('user_id',$this->user_id);
//		$criteria->compare('time',$this->time);
//		$criteria->compare('read',$this->read);
//		$criteria->compare('content',$this->content,true);
//
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));
	}
}