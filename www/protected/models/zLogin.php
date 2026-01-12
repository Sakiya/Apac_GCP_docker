<?php
 
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class zLogin extends CFormModel
{
    public $username;
    public $email;
    public $password;
    public $rememberMe;
    public $year;
    public $joinLv;
    public $curStep;
    private $_identity;
 
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email, password, year', 'required'),
            array('email', 'email'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }
 
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'rememberMe'=>'Remember Me',
        );
    }
 
    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
	    /*
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username, $this->password, $this->email);
            if(!$this->_identity->authenticate())
                $this->addError('password','Incorrect username or password.');
        }
        */

    }
 
    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
		//if (Yii::app()->user->getState('accID') == ""){
            $Gallery = null;
            
        /*
            if ($this->joinLv == '1'){
                $Gallery = Gallerym1::model()->find(
                array(
                    'condition'=>"Yearm1_no =:Yearm1_no and email =:email ",
                    'params'=>array(':Yearm1_no'=> $this->year,':email'=> $this->email),
                    'limit'=>1
                ));
                if ($Gallery){
                    if (!($Gallery->emailcheck & $Gallery->status != 4)){
                        $Gallery = null;
                        if ($Gallery->status == 4){
                            $this->addError('status','您的帳號已取消申請.');
                            return false;
                        }
                    }
                }
            }
            if ($this->joinLv == '2'){
                $Gallery = Gallerym1::model()->find(
                    array(
                        'condition'=>"Yearm1_no =:Yearm1_no and email =:email and shortlisted = '2' ",
                        'params'=>array(':Yearm1_no'=> $this->year,':email'=> $this->email),
                        'limit'=>1
                    ));
            }
        */
        /*
        2020更改規則 一二階段同時存在，
        1.先檢查會員是否存在
        2.在檢查當年度符合階段是否有開啟
        */
            $Gallery = Gallerym1::model()->find(
            array(
                'condition'=>"Yearm1_no =:Yearm1_no and email =:email ",
                'params'=>array(':Yearm1_no'=> $this->year,':email'=> $this->email),
                'limit'=>1
            ));
            if ($Gallery){
                if (!($Gallery->emailcheck & $Gallery->status != 4)){
                    $Gallery = null;
                    if ($Gallery->status == 4){
                        $this->addError('status','您的帳號已取消申請.');
                        return false;
                    }
                }

                Yii::app()->user->setState('memberStep',1);
                $this->joinLv = 1;

                if ($Gallery->shortlisted == '2'){
                    //$checkerStep = array_search(2,$this->curStep);
                    $checkerStep = in_array(2,$this->curStep);
                    if ($checkerStep != ''){
                        Yii::app()->user->setState('memberStep',2);
                        $this->joinLv = 2;
                    }
                }
            }

			if ($Gallery){
				if ($Gallery->pwd == md5($this->password)){
                    //if ($Gallery->emailcheck){
                        Yii::app()->user->setState('accID',$Gallery->Gallerym1_no);
                        Yii::app()->user->setState('acclang',$Gallery->lang);
                        Yii::app()->user->setState('userSessionTimeout', 14400);
                        //更新上線時間
                        $Gallery->lastloginDate = $Gallery->loginDate;
                        $Gallery->loginDate = date("Y-m-d H:i:s");
                        $Gallery->save();
                        return true;
                    //}else{
                    //    $this->addError('password','Email尚未驗證.');
                    //}
                }else{
                    $this->addError('email','您的資料輸入錯誤.');
                }
			}else{
				$this->addError('email','您的資料輸入錯誤.');
			}
			return false;
		//}
    }
}