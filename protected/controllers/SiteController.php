<?php

class SiteController extends Controller
{
	public $layout = 'column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate()) {
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the register page
	 */
	public function actionRegister()
	{
		$model = new User('register'); // Assuming you have a 'register' scenario in your User model

		if (isset($_POST['User'])) {
			$model->attributes = $_POST['User'];
			$model->setPassword($_POST['User']['password']); // Set hashed password
			$model->generateAuthKey(); // Generate auth key for session management
			$model->generateEmailVerificationToken(); // Generate email verification token

			if ($model->save()) {
				$model->sendVerificationEmail(); // Send verification email
				Yii::app()->user->setFlash('success', 'Registration successful! Please check your email to verify your account.');
				$this->redirect(array('site/login')); // Redirect to login page or anywhere you see fit
			}
		}

		$this->render('register', array('model' => $model));
	}



	public function actionVerifyEmail($token)
	{
		$user = User::model()->findByAttributes(array('email_verification_token' => $token));

		if ($user !== null) {
			$user->email_verified = 1;
			$user->email_verification_token = null; // Clear the token
			if ($user->save(false)) {
				Yii::app()->user->setFlash('success', 'Email verified successfully!');
			} else {
				Yii::app()->user->setFlash('error', 'Failed to verify email.');
			}
		} else {
			Yii::app()->user->setFlash('error', 'Invalid verification token.');
		}

		$this->redirect(array('site/login'));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH)
			throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");

		$model = new LoginForm;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the dashboard page if valid
			if ($model->validate() && $model->login())
				$this->redirect(array('dashboard/index')); // Redirect to the dashboard after login
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
