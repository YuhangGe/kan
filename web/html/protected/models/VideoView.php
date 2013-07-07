<?php

/**
 * This is the model class for table "video_view".
 *
 * The followings are the available columns in table 'video_view':
 * @property integer $video_id
 * @property integer $user_id
 * @property integer $id
 * @property integer $view_number
 * @property integer $view_time
 */
class VideoView extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VideoView the static model class
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
		return 'video_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('video_id, user_id, view_time', 'required'),
			array('video_id, user_id, view_time, view_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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
			'user_id' => 'User',
			'id' => 'ID',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('view_num',$this->view_num);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}