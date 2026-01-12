<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_FREEZED = '999';//停權中
	const ERROR_ACTIVE = '998';//未啟用
	private $_id;//用 user id 取代 user account
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
        $condition = array(
            'condition' => "account = :account",
            'params' => array(':account'=>$this->username),
        );
        
        $user = User::model()->find($condition);
		
		if (!$user){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			return !$this->errorCode;
		}
		
		if (!$user->passwordMatch($this->password)){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
			return !$this->errorCode;
		}
		
		//停權中 freezed
		if ($user->freezed){
			$this->errorCode=self::ERROR_FREEZED;
			return !$this->errorCode;
		}
		
		//未啟用 active
		if (!$user->active){
			$this->errorCode=self::ERROR_ACTIVE;
			return !$this->errorCode;
		}
		
		$this->_id = $user->id;
		$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}

    
	/**
	 * 原本使用 Yii::app()->user->id 會取到 username 也就是 account，用此方法讓序號取代 account
	 */
    public function getId()
    {
        return $this->_id;
    }

}