<?php

class User extends CActiveRecord
{
	public $password; // Virtual attribute for plain text password

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
		return array(

			array('username, password_hash, auth_key, email', 'required'),
            array('email_verified, is_admin', 'numerical', 'integerOnly' => true),
            array('email_verification_token', 'length', 'max' => 255),
			array('email', 'email'), // Ensure the email is valid
			array('email', 'unique'), // Ensure the email is unique
			array('password', 'length', 'min' => 6), // Ensure the password is at least 6 characters long
			array('username, password_hash, access_token, email', 'length', 'max' => 255),
			array('auth_key', 'length', 'max' => 32),
			// The following rule is used by search().
			array('id, username, password_hash, auth_key, access_token, email, email_verified', 'safe', 'on' => 'search'),
		);
	}
	public function generateEmailVerificationToken()
	{
		$this->email_verification_token = md5(uniqid(mt_rand(), true));
	}

	public function generateAuthKey()
	{
		$this->auth_key = md5(uniqid(mt_rand(), true));
	}

	public function setPassword($password)
	{
		$this->password_hash = CPasswordHelper::hashPassword($password);
	}

	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password, $this->password_hash);
	}

	public function sendVerificationEmail()
	{
		$verificationUrl = Yii::app()->createAbsoluteUrl('site/verifyEmail', array('token' => $this->email_verification_token));
		$subject = 'Email Verification';
		$body = "Hello, please verify your email by clicking the link: " . $verificationUrl;

		mail($this->email, $subject, $body); // Use a proper mailer in production
	}




	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'blogPosts' => array(self::HAS_MANY, 'BlogPost', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password', // Label for the virtual attribute
			'password_hash' => 'Password Hash',
			'auth_key' => 'Auth Key',
			'access_token' => 'Access Token',
			'email' => 'Email',
			'email_verified' => 'Email Verified',
		);
	}

	/**
	 * Hash the password before saving to database.
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			if (!empty($this->password)) {
				$this->password_hash = CPasswordHelper::hashPassword($this->password);
			}
			return true;
		}
		return false;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password_hash', $this->password_hash, true);
		$criteria->compare('auth_key', $this->auth_key, true);
		$criteria->compare('access_token', $this->access_token, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('email_verified', $this->email_verified);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}
