<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property integer $photo_id
 * @property integer $user_id
 * @property integer $act_id
 * @property string $url
 * @property string $user_name
 * @property string $act_name
 * @property string $vote_num
 * @property string $view_num
 * @property integer $upload_time
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photo the static model class
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
		return 'photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, act_id, url, user_name, act_name, upload_time', 'required'),
			array('user_id, act_id, upload_time', 'numerical', 'integerOnly'=>true),
			array('url, act_name', 'length', 'max'=>25),
			array('user_name', 'length', 'max'=>15),
			array('vote_num, view_num', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('photo_id, user_id, act_id, url, user_name, act_name, vote_num, view_num, upload_time', 'safe', 'on'=>'search'),
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
			'photo_id' => 'Photo',
			'user_id' => 'User',
			'act_id' => 'Act',
			'url' => 'Url',
			'user_name' => 'User Name',
			'act_name' => 'Act Name',
			'vote_num' => 'Vote Num',
			'view_num' => 'View Num',
			'upload_time' => 'Upload Time',
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

		$criteria->compare('photo_id',$this->photo_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('act_name',$this->act_name,true);
		$criteria->compare('vote_num',$this->vote_num,true);
		$criteria->compare('view_num',$this->view_num,true);
		$criteria->compare('upload_time',$this->upload_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}