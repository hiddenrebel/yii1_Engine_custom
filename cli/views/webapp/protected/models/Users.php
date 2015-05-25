<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id_user
 * @property string $username
 * @property string $password
 * @property string $role_user
 */
class Users extends CActiveRecord
{
	const ROLE_HEADIT='headIT';
	const ROLE_HEADSALES='headsales';
	const ROLE_ADMIN='admin';
	const ROLE_HEADFINANCE='headfinance';
	const ROLE_DIRECTOR='director';
	const ROLE_CSO='CSO';

	public $password_repeat;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username', 'length', 'max'=>30),
			array('role_user', 'length', 'max'=>15),
			array('username', 'unique'),
			array('password_user, password_repeat', 'required', 'on'=>'register'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_user, username, role_user', 'safe', 'on'=>'search'),
			array('password_repeat, user_nicename, user_email, user_url, user_photo, user_registered, user_activation_key, display_name', 'safe'),
			array('password_user', 'compare', 'compareAttribute'=>'password_repeat','allowEmpty'=>false),
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
			'id_user' => 'Id User',
			'username' => 'Username',
			'role_user' => 'Role User',
			'user_nicename' => 'User Nicename',
			'user_email' => 'User Email',
			'user_url' => 'User Url',
			'user_photo' => 'User Photo',
			'user_registered' => 'User Registered',
			'user_activation_key' => 'User Activation Key',
			'display_name' => 'Display Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_user',$this->id_user,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('role_user',$this->role_user,true);
		$criteria->compare('user_nicename',$this->user_nicename,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('user_url',$this->user_url,true);
		$criteria->compare('user_photo',$this->user_photo,true);
		$criteria->compare('user_registered',$this->user_registered,true);
		$criteria->compare('user_activation_key',$this->user_activation_key,true);
		$criteria->compare('display_name',$this->display_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		if (!empty($this->password_user) && strlen($this->password_user)) {
            $this->password_user = CPasswordHelper::hashPassword($this->password_user);
        } else {
            if (empty($this->password_user))
                $this->password_user = $this->findByPk($this->id_user)->password_user;
        }
        return parent::beforeSave();
	 }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
