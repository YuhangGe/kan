<?php

/**
 * This is the model class for table "active".
 *
 * The followings are the available columns in table 'active':
 * @property integer $act_id
 * @property string $act_name
 * @property integer $begin_time
 * @property integer $end_time
 * @property integer $act_type
 * @property string $image
 * @property string $description
 */
class Active extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Active the static model class
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
		return 'active';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_name, begin_time, end_time, act_type, image', 'required'),
			array('begin_time, end_time, act_type', 'numerical', 'integerOnly'=>true),
            array('act_type', 'in', 'range'=>array(0,1,2)),
			array('act_name', 'length', 'max'=>25),
            array('image', 'length', 'max'=>150),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('act_id, act_name, begin_time, end_time, act_type, image, description', 'safe', 'on'=>'search'),
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
            'user_active' => array(self::HAS_MANY, 'UserActive', 'act_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'act_id' => 'Act',
			'act_name' => 'Act Name',
			'begin_time' => 'Begin Time',
			'end_time' => 'End Time',
			'act_type' => 'Act Type',
			'image' => 'Image',
			'description' => 'Description',
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

		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('act_name',$this->act_name,true);
		$criteria->compare('begin_time',$this->begin_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('act_type',$this->act_type);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}