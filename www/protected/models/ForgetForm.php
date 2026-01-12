<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgetForm extends CFormModel
{
	public $email;
	public $captchaCode;
	public $Yearm1_no;
    public $Year;
    public $lang_txt;
	//private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, captchaCode', 'required'),
            array('Yearm1_no, captchaCode', 'safe'),
            
			// password needs to be authenticated
			//array('password', 'authenticate'),
            
            array('captchaCode','captcha', 'captchaAction'=>'member/captcha'),						

		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'',
			'captchaCode'=>''
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function go()
	{
        $Gallery = Gallerym1::model()->find(
            array(
                'condition'=>"Yearm1_no =:Yearm1_no and email =:email ",
                'params'=>array(':Yearm1_no'=> $this->Yearm1_no,':email'=> $this->email)
            ));
            
        if ($Gallery){
            $password = substr(md5(rand()),0,10);
            $Gallery = Gallerym1::model()->findbyPk($Gallery->Gallerym1_no);
            $Gallery->pwd = md5($password);
            if ($Gallery->save()){

                $mail_format = file_get_contents("./mail/" .Yii::app()->params['FlangText'][$Gallery->lang]. "forget.html");
                $mail_format = str_replace("{{checkUrl}}",Yii::app()->params['SSL'] . "/" . Yii::app()->language . "/Member/checkemail/" . $Gallery->Gallerym1_no,$mail_format);
                $mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
                $mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_picmb'],$mail_format);
                $mail_format = str_replace("{{password}}",$password,$mail_format);
                $mail_format = str_replace("{{username}}",($Gallery->lang == 'en' ? $Gallery->name_en : $Gallery->name),$mail_format);
                $mail_format = str_replace("{{year}}",$this->Year->Yearm1_year,$mail_format);
                
                    
                //發送信件
                    $mail=Yii::app()->Smtpmail;
                    $mail->IsHTML = true;
                    $mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
                    $mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $this->Year->Yearm1_year . $this->lang_txt[$Gallery->lang]['mail_subject']) . '?=';
                    $mail->MsgHTML($mail_format);
                    $mail->Addaddress($Gallery->email, $Gallery->name);
                    
                    $send = $mail->Send();
                    if ($send){
                        return true;
                    }			
            }
            return true;
		}

        return false; 
        /*
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
        */
	}
}
