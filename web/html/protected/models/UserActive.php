<?php

/**
 * This is the model class for table "user_active".
 *
 * The followings are the available columns in table 'user_active':
 * @property integer $user_id
 * @property integer $act_id
 * @property integer $photo_number
 * @property string $intro
 * @property string $slogan
 */
class UserActive extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserActive the static model class
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
		return 'user_active';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, act_id', 'required'),
			array('user_id, act_id, photo_number', 'numerical', 'integerOnly'=>true),
			array('intro', 'length', 'max'=>300),
			array('slogan', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
//			array('user_id, act_id, photo_number, intro, slogan', 'safe', 'on'=>'search'),
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
            'active' => array(self::BELONGS_TO, 'Active', 'act_id')
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
			'photo_number' => 'Photo Number',
			'intro' => 'Intro',
			'slogan' => 'Slogan',
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
		$criteria->compare('photo_number',$this->photo_number);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('slogan',$this->slogan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function isUserJoin() {
        $criteria=new CDbCriteria;
        $criteria->select= "user_id";
        $criteria->condition = "user_id=:userId AND act_id=:actId";
        $criteria->params = array(":userId"=>$this->user_id, ":actId"=>$this->act_id);
        $r = $this->find($criteria);
        if($r===null) {
            return false;
        } else {
            return true;
        }
    }
}