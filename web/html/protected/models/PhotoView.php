<?php

/**
 * This is the model class for table "photo_view".
 *
 * The followings are the available columns in table 'photo_view':
 * @property integer $id
 * @property integer $photo_id
 * @property integer $user_id
 * @property integer $view_date
 */
class PhotoView extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PhotoView the static model class
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
		return 'photo_view';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photo_id, user_id', 'required'),
			array('photo_id, user_id, view_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, photo_id, user_id, view_date', 'safe', 'on'=>'search'),
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
			'photo_id' => 'Photo',
			'user_id' => 'User',
			'view_date' => 'View Date',
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
		$criteria->compare('photo_id',$this->photo_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('view_date',$this->view_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}