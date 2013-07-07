<?php

/**
 * This is the model class for table "photo_view".
 *
 * The followings are the available columns in table 'photo_view':
 * @property integer $id
 * @property integer $photo_id
 * @property integer $user_id
 * @property integer $view_time
 * @property integer $view_number
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
			array('photo_id, user_id, view_time', 'required'),
			array('photo_id, user_id, view_time, view_number', 'numerical', 'integerOnly'=>true),
		);
	}

}