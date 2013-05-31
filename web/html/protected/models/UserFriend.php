<?php

/**
 * This is the model class for table "user_friend".
 *
 * The followings are the available columns in table 'user_friend':
 * @property integer $id
 * @property integer $user_id_1
 * @property integer $user_id_2
 * @property string $user_name_1
 * @property string $user_name_2
 * @property string $user_avatar_1
 * @property string $user_avatar_2
 */
class UserFriend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFriend the static model class
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
		return 'user_friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id_1, user_id_2, user_name_1, user_name_2', 'required'),
			array('user_id_1, user_id_2', 'numerical', 'integerOnly'=>true),
			array('user_name_1, user_name_2', 'length', 'max'=>25),
            array('user_avatar_1, user_avatar_2', 'length', 'max'=>125),

            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, user_id_1, user_id_2, user_name_1, user_name_2', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id_1' => 'User Id 1',
			'user_id_2' => 'User Id 2',
			'user_name_1' => 'User Name 1',
			'user_name_2' => 'User Name 2',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id_1',$this->user_id_1);
		$criteria->compare('user_id_2',$this->user_id_2);
		$criteria->compare('user_name_1',$this->user_name_1,true);
		$criteria->compare('user_name_2',$this->user_name_2,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}