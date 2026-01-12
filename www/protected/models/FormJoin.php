<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class FormJoin extends CFormModel
{

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('Yearm1_no, lang, email, pwd, createDateTime, lastloginDate, loginDate, name, name_en, galleryyear, gallerymonth, bossname, bossname_en, tel, fax, country, city, address, contactname, contactphone, contactemail', 'required'),
			array('no, Yearm1_no', 'numerical', 'integerOnly'=>true),
			array('lang', 'length', 'max'=>3),
			array('galleryyear', 'length', 'max'=>4),
			array('gallerymonth', 'length', 'max'=>2),
			array('tel, fax, contactphone', 'length', 'max'=>30),
			array('country, city', 'length', 'max'=>20),
			array('emailcheck', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Gallerym1_no, Yearm1_no, lang, email, pwd, createDateTime, lastloginDate, loginDate, name, name_en, galleryyear, gallerymonth, bossname, bossname_en, tel, fax, country, city, address, contactname, contactphone, contactemail, emailcheck, experienceoneyear, experiencetwoyear', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'Gallerym1_no' => '序號',
			'Yearm1_no' => '年度序號',
			'lang' => '語言版本',
			'email' => '登入Email',
			'pwd' => '登入密碼',
			'createDateTime' => '建立日期',
			'lastloginDate' => '最後登入日期',
			'loginDate' => '登入日期',
			'name' => '畫廊名稱(中)',
			'name_en' => 'Gallery English Name',
			'galleryyear' => '成立年份',
			'gallerymonth' => '成日月份',
			'bossname' => '負責人姓名(中)',
			'bossname_en' => '負責人姓名(英)',
			'tel' => '電話號碼',
			'fax' => '傳真',
			'country' => '國家',
			'city' => '城市',
			'address' => '畫廊地址',
			'contactname' => '展務人姓名',
			'contactphone' => '展務人手機',
			'contactemail' => '展務人Email',
			'emailcheck' => '是否驗證信箱',
			'experienceoneyear' => '參展前一年經歷',
			'experiencetwoyear' => '參展前兩年經歷',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','帳號或密碼有誤');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
