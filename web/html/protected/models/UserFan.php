<?php

/**
 * This is the model class for table "user_fan".
 *
 * The followings are the available columns in table 'user_fan':
 * @property integer $user_id
 * @property integer $fan_id
 * @property string $fan_name
 * @property string $fan_avatar
 */
class UserFan extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFan the static model class
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
		return 'user_fan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, fan_id, fan_name', 'required'),
			array('user_id, fan_id', 'numerical', 'integerOnly'=>true),
			array('fan_name', 'length', 'max'=>25),
            array('fan_avatar', 'length', 'max'=>125)
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('user_id, fan_id, fan_name', 'safe', 'on'=>'search'),
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
			'fan_id' => 'Fan',
			'fan_name' => 'Fan Name',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('fan_id',$this->fan_id);
		$criteria->compare('fan_name',$this->fan_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}