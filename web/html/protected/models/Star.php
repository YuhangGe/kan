<?php

/**
 * This is the model class for table "star".
 *
 * The followings are the available columns in table 'star':
 * @property integer $user_id
 * @property integer $act_id
 * @property integer $act_vote
 * @property integer $act_view
 * @property integer $act_score
 * @property string $poster_url
 * @property string $user_name
 * @property integer $time
 */
class Star extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Star the static model class
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
		return 'star';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, act_id, user_name, time', 'required'),
			array('user_id, act_id, act_vote, act_view, act_score, time', 'numerical', 'integerOnly'=>true),
			array('poster_url', 'length', 'max'=>150),
			array('user_name', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, act_id, act_vote, act_view, act_score, poster_url, user_name', 'safe', 'on'=>'search'),
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
			'act_id' => 'Act',
			'act_vote' => 'Act Vote',
			'act_view' => 'Act View',
			'act_score' => 'Act Score',
			'poster_url' => 'Poster Url',
			'user_name' => 'User Name',
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
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('act_vote',$this->act_vote);
		$criteria->compare('act_view',$this->act_view);
		$criteria->compare('act_score',$this->act_score);
		$criteria->compare('poster_url',$this->poster_url,true);
		$criteria->compare('user_name',$this->user_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}