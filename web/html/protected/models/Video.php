<?php

/**
 * This is the model class for table "video".
 *
 * The followings are the available columns in table 'video':
 * @property integer $video_id
 * @property string $big_url
 * @property string $small_url

 * @property integer $user_id
 * @property integer $act_id
 * @property string $user_name
 * @property string $act_name
 * @property integer $upload_time
 * @property integer $vote_num
 * @property integer $view_num
 * @property string $video_name
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return 'video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, act_id, user_name, act_name, video_name, big_url, small_url, upload_time', 'required'),
			array('user_id, act_id, upload_time, vote_num, view_num', 'numerical', 'integerOnly'=>true),
			array('act_name, video_name', 'length', 'max'=>25),
			array('user_name', 'length', 'max'=>15),
            array('big_url, small_url', 'length', 'max'=>150),

            // The following rule is used by search().
			// Please remove those attributes that should not be searched.
//			array('video_id, url, user_id, act_id, user_name, act_name, upload_time, vote_num, view_num', 'safe', 'on'=>'search'),
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
			'video_id' => 'Video',
			'url' => 'Url',
			'user_id' => 'User',
			'act_id' => 'Act',
			'user_name' => 'User Name',
			'act_name' => 'Act Name',
			'upload_time' => 'Upload Time',
			'vote_num' => 'Vote Num',
			'view_num' => 'View Num',
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

		$criteria->compare('video_id',$this->video_id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('act_name',$this->act_name,true);
		$criteria->compare('upload_time',$this->upload_time);
		$criteria->compare('vote_num',$this->vote_num);
		$criteria->compare('view_num',$this->view_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}