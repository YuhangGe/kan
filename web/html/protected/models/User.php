<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property integer $level
 * @property integer $view_num
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $nick_name
 * @property string $real_name
 * @property integer $sex
 * @property integer $constellation
 * @property string $birthday
 * @property string $personalsay
 * @property string $company
 * @property string $hobby
 * @property string $big_avatar
 * @property string $small_avatar
 * @property string $image_server
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password', 'required'),
			array('level, view_num, sex, constellation, birthday', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>30),
			array('phone', 'numerical', 'integerOnly'=>true),
			array('password', 'length', 'max'=>32),
			array('nick_name', 'length', 'max'=>25),
			array('real_name', 'length', 'max'=>10),
			array('personalsay', 'length', 'max'=>50),
			array('company', 'length', 'max'=>35),
			array('hobby', 'length', 'max'=>45),
            array('big_avatar, small_avatar', 'length', 'max'=>150),
            array('image_server','length','max'=>100),
			//array('birthday', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('user_id, level, view_num, email, phone, password, nick_name, real_name, sex, constellation, birthday, personalsay, company, hobby, avatar', 'safe', 'on'=>'search'),
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
            'fan_number' => array(self::HAS_ONE, 'UserFanNumber', 'user_id'),
            'friend_number' => array(self::HAS_ONE, 'UserFriendNumber', 'user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User Id',
			'level' => 'Level',
			'view_num' => 'View Number',
			'email' => 'Email',
			'phone' => 'Phone',
			'password' => 'Password',
			'nick_name' => 'Nick Name',
			'real_name' => 'Real Name',
			'sex' => 'Sex',
			'constellation' => 'Constellation',
			'birthday' => 'Birthday',
			'personalsay' => 'Personalsay',
			'company' => 'Company',
			'hobby' => 'Hobby',
			'big_avatar' => 'Big Avatar',
            'small_avatar'=>'Small Avatar',
            'image_server'=>'Image Server'
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

//		$criteria->compare('user_id',$this->user_id);
//		$criteria->compare('level',$this->level);
//		$criteria->compare('view_num',$this->view_num);
//		$criteria->compare('email',$this->email,true);
//		$criteria->compare('phone',$this->phone,true);
//		$criteria->compare('password',$this->password,true);
//		$criteria->compare('nick_name',$this->nick_name,true);
//		$criteria->compare('real_name',$this->real_name,true);
//		$criteria->compare('sex',$this->sex);
//		$criteria->compare('constellation',$this->constellation);
//		$criteria->compare('birthday',$this->birthday,true);
//		$criteria->compare('personalsay',$this->personalsay,true);
//		$criteria->compare('company',$this->company,true);
//		$criteria->compare('hobby',$this->hobby,true);
//		$criteria->compare('avatar',$this->avatar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function findIdByAttributes($params, $op = "AND") {
        $criteria=new CDbCriteria;
        $criteria->select='user_id';
        $con = "";
        $par = array();
        $i = 0;
        foreach($params as $key => $value) {
            if($i>0) {
                $con .= ($op=="AND" ? " AND " : " OR ");
            }
            $con .= $key.'=:'.$key;
            $par[':'.$key] = $value;
            $i++;
        }
        $criteria->condition = $con;
        $criteria->params = $par;
        return User::model()->find($criteria);
    }
    public function findColumnByPk($columns, $user_id) {
        $criteria=new CDbCriteria;
        $criteria->select= join($columns, ",");
        $criteria->condition = "user_id=:userId";
        $criteria->params = array(":userId"=>$user_id);
        return User::model()->find($criteria);
    }
    public function findColumnByAttributes($columns, $params, $op = "AND") {
        $criteria=new CDbCriteria;
        $criteria->select= join($columns, ",");
        $con = "";
        $par = array();
        $i = 0;
        foreach($params as $key => $value) {
            if($i>0) {
                $con .= ($op=="AND" ? " AND " : " OR ");
            }
            $con .= $key.'=:'.$key;
            $par[':'.$key] = $value;
        }
        $criteria->condition = $con;
        $criteria->params = $par;
        return User::model()->find($criteria);
    }
}