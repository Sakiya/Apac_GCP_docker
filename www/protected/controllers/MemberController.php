<?php
class MemberController extends Controller{
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				//'backColor'=>0xFFFFFF,
				// 'backColor'=>0x383838,
				// 'foreColor'=>0xFFFFFF,
				'backColor'=>0xFFFFFF,
				'foreColor'=>0x000000,
				//'maxLength'=>6,
				//'minLength'=>5,
				'testLimit'=>1,
				'height'=>35,
				'width'=>100,
				//'padding'=>5,
				'offset'=>0

			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function init(){
        parent::init();
        $this->layout = '';
    }

    public function actionindex(){
	//是否在年度內
		if (!$this->Year){
			$this->redirect("/info/CloseMessage");
		}
		$model=new zLogin;
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['zLogin'])){
			
			$model->attributes=$_POST['zLogin'];
			$model['joinLv'] = $this->joinLv;
			$model['curStep'] = $this->curStep;

            if($model->validate() && $model->login()){
				$checkerStep = array_search($model->joinLv,$this->curStep);
// print_r('---');
// exit();
				if ($checkerStep !== false){
					$gourl = "";
					$Gallery = Gallerym1::model()->find(
					array(
						'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
						'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
					));


					$gourl = $this->getlastUrl($Gallery,$model->joinLv);
					
					echo CJSON::encode(array('status'=>'success','message'=>'', 'url'=>$gourl));
					Yii::app()->end();
				}else{
					echo CJSON::encode(array('status'=>'error','message'=>'此階段報名已截止'.json_encode($model['joinLv']).json_encode($model['curStep'])));
					Yii::app()->end();	
				}
			}
			
			echo CJSON::encode(array('status'=>'error','message'=>'Incorrect email or password(您的帳號或密碼錯誤).'));
			Yii::app()->end();
        }
        $content = $this->renderPartial(
            $view = '/Member/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'login',
            $data = array('model' => $model),
            $return = true
        );
		
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }

    public function actionapplylogout(){
		Yii::app()->user->setState('accID',"");
		$this->redirect(Yii::app()->createUrl('/member/index',array('language'=>Yii::app()->language)));
	}
	
    public function actionjoin(){
	    $model = new Gallerym1();

        $content = $this->renderPartial(
	        // . Yii::app()->params['LlangText'][Yii::app()->language]
            $view = '/Member/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'join',
            $data = array('model' => $model),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }	
    public function actionjoinAyns(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
			    "mail_subject"=>" 註冊帳號驗證",
				"error_msg"=>"您的驗證錯誤.",
				"success_msg"=>"您的信箱已註冊過,若忘記密碼請使用忘記密碼找回.",
		    ),
		    "en"=>array(
			    "mail_subject"=>" Registration Confirmation",
				"error_msg"=>"Incorrect valid value",
				"success_msg"=>"The email address you have entered is already associated with another account. If you experience difficulty logging into your previous account, you may reset your password by clicking on the Forget password?",
		    ),
	    );
	    
	    $model = new Gallerym1();

		if(isset($_POST['Gallerym1'])){
			// if (count($_POST['Gallerym1']['gallerymonth']) > 5){
			// 	$_POST['Gallerym1']['gallerymonth'] = '';
			// }
			$model->attributes = $_POST['Gallerym1'];
			//檢查 (今年度是否有此email報名)
			$checkGallery = Gallerym1::model()->find(
				array(
					'condition'=>"Yearm1_no =:Yearm1_no and email = :email ",
					'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':email'=>$model->email)
				));
				
			if (!$checkGallery){
				//$id = 'OAT' . substr($this->Year->Yearm1_year,2,2) . str_pad($this->Year->Yearm1_usernumber,3,'0',STR_PAD_LEFT);
				//預設資料
				//$model->finishStep1 = true;
				$model->createDateTime = date("Y-m-d H:i:s");
				$model->emailcheck = "0";
				$model->Yearm1_no = $this->Year->Yearm1_no;
				$model->status = "1"; // 狀態
				//$model->id = $id; // 狀態
				$model->pay_status = "0"; //繳款狀況
				$model->shortlisted = "0"; //入圍狀況
				$model->pwd = md5($model->pwd);//密碼加密
				$model->authorizecode = substr(md5(rand()),0,10);	
				//if ($model->validate()){
					if($model->save()){
						$mail_format = file_get_contents("./mail/" .Yii::app()->params['FlangText'][$model->lang]. "check.html");
						$mail_format = str_replace("{{checkUrl}}",Yii::app()->params['SSL'] . "/" . $model->lang . "/member/checkemail/" . $model->authorizecode,$mail_format);
						$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
						$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_picmb'],$mail_format);
						$mail_format = str_replace("{{username}}",($model->lang == 'en' ? $model->name_en : $model->name),$mail_format);
						$mail_format = str_replace("{{year}}",$this->Year->Yearm1_year,$mail_format);
						$mail=Yii::app()->Smtpmail;

						//發送信件
						$mail=Yii::app()->Smtpmail;
						$mail->IsHTML = true;
						$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
						$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $this->Year->Yearm1_year . $lang_txt[Yii::app()->language]['mail_subject']) . '?=';
						//$mail->AltBody = Yii::app()->params['SSL'] . "/" . $model->lang . "/member/checkemail/" . md5($model->Gallerym1_no);
						$mail->MsgHTML($mail_format);
						$mail->Addaddress($model->email, $model->name);

						$send = $mail->Send();

						if ($send){
							//print_r($this->Year->Yearm1_no);
								$Year = Yearm1::model()->findbyPk($this->Year->Yearm1_no);
								/*
								付款完畢做計算
								if ($Year){
									$Year->Yearm1_usernumber = (string)$this->Year->Yearm1_usernumber + 1;
									$Year->save();
								}
								*/
							echo CJSON::encode(array('status'=>'success','message'=>'','url'=>$this->createUrl('/member/verification/',array('language'=>Yii::app()->language,'id'=>$model->Gallerym1_no)) ));
							Yii::app()->end();
						}

						echo CJSON::encode(array('status'=>'success','message'=>'','url'=>$this->createUrl('/member/verification/',array('language'=>Yii::app()->language,'id'=>$model->Gallerym1_no)) ));
						Yii::app()->end();
					}else{
						echo CJSON::encode(array('status'=>'error','message'=>'','url'=>"/member/verification/",'errormsg'=>$model->errors));
						Yii::app()->end();
					}
			}else{
				echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[Yii::app()->language]['success_msg']));
				Yii::app()->end();
			}
	    }
	    
		echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[Yii::app()->language]['error_msg']));
		Yii::app()->end();
    }
    
    public function actionverification(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
				"error_msg"=>"您的驗證錯誤.",
		    ),
		    "en"=>array(
				"error_msg"=>"Incorrect valid value.",
		    ),
	    );
	    
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no' => $id)
			));

		if (!$Gallery){
			$this->redirect($this->createUrl('/info/message',array('language'=>Yii::app()->language,'i'=>$lang_txt[Yii::app()->language]['error_msg'])) );
		}

        $content = $this->renderPartial(
            $view = '/Member/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'verification',
            $data = array('model' => $Gallery),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    public function actionSuccess(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
				"error_msg"=>"您的驗證錯誤.",
		    ),
		    "en"=>array(
				"error_msg"=>"Incorrect valid value.",
		    ),
	    );
	    
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$model = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no' => $id)
			));  
		if (!$model){
			$this->redirect($this->createUrl('/info/message',array('language'=>Yii::app()->language,'i'=>$lang_txt[Yii::app()->language]['error_msg'])) );
		}		
        $content = $this->renderPartial(
            $view = '/Member/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'Success',
            $data = array('model' => $model),
            $return = true
        );

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }

    public function actioncheckemail(){
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and authorizecode = :authorizecode",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':authorizecode' => $id)
			));

	    if ($Gallery){
			if (!$Gallery->emailcheck){
				$Gallery->emailcheck = 1;
				$Gallery->status = "2"; // 狀態
				if ($Gallery->save()){
					$this->redirect("/" . Yii::app()->language . "/member/success/" . $Gallery->Gallerym1_no);
				}
			}else{
				$message = "您的帳號已驗證過";

				if (Yii::app()->language == 'en'){
					$message = "Your account has been verified";
				}
				$this->redirect("/" . Yii::app()->language . "/info/message?i=".$message);
			}
	    }
		$this->redirect("/" . Yii::app()->language . "/info/message?i=請確認您的驗證網址");
    }
    public function actionResetpassword(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
				"success_msg"=>"您的密碼已重新設定.",
				"incorrectmail"=>"請檢查您輸入的密碼是否正確.",
		    ),
		    "en"=>array(
		    	"success_msg"=>"Password has been reset.",
		    	"incorrectmail"=>"incorrect password",
		    ),
	    );  
		$oldpwd = (isset($_POST['oldpwd']) ? $_POST['oldpwd'] : '');
		$newpwd = (isset($_POST['newpwd']) ? $_POST['newpwd'] : '');
		$confirmpwd = (isset($_POST['confirmpwd']) ? $_POST['confirmpwd'] : '');
		$error = "";
		
		if ($oldpwd == '' || $newpwd == '' || $confirmpwd == '' || $newpwd != $confirmpwd){
		}else{
			$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and pwd = :pwd and status != 4 and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no' => Yii::app()->user->getState('accID'),':pwd' => md5($oldpwd) )
			));
			if ($Gallery){
				if ($Gallery->Gallerym1_no == Yii::app()->user->getState('accID')){

					$Gallery->pwd = md5($newpwd);
					if ($Gallery->save()){
						echo CJSON::encode(array('status'=>'success','message'=>$lang_txt[$Gallery->lang]['success_msg']));
						Yii::app()->end();
					}
					$error = $lang_txt[$Gallery->lang]['incorrectmail'];
				}
				$error = $lang_txt[$Gallery->lang]['incorrectmail'];
			}
		}
		
		echo CJSON::encode(array('status'=>'error','message'=>'請檢查您輸入的密碼是否正確(incorrect password)'));
		Yii::app()->end();
    }
    public function actionforget(){
		$model = new ForgetForm;

        $content = $this->renderPartial(
            $view = '/Member/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'forget',
            $data = array('model'=>$model),
            $return = true
        );
		
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    public function actionforgetAsyn(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
		    	"mail_subject"=>" 忘記密碼",
				"success_msg"=>"您的密碼已重新設定,請至您的信箱收信",
				"incorrectmail"=>"此郵箱尚未註冊, 請返回上頁重新註冊郵箱",
				"incorrectcaptcha"=>"驗證碼輸入錯誤,請重新輸入",
				
		    ),
		    "en"=>array(
		    	"mail_subject"=>" Forget password",
		    	"success_msg"=>"Password reset sent. Please check your email inbox in a few moments for confirmation.",
		    	"incorrectmail"=>"This email address has not signed up yet, please return to the previous page to sign up",
				"incorrectcaptcha"=>"captcha error, please reload captcha",
		    ),
	    );
	    
		$model = new ForgetForm;
		if(isset($_POST['ForgetForm'])){
			$model->attributes = $_POST['ForgetForm'];
			$model->Yearm1_no = $this->Year->Yearm1_no;
			$model->Year = $this->Year;
			$model->lang_txt = $lang_txt;
			
			$Gallery = Gallerym1::model()->find(
				array(
					'condition'=>"Yearm1_no =:Yearm1_no and email =:email ",
					'params'=>array(':Yearm1_no'=> $model->Yearm1_no,':email'=> $model->email)
				));
				// print_r($Gallery);
				// exit();
			if($Gallery){
				if($model->validate()){
					if($model->go($this->Year)){
						echo CJSON::encode(array('status'=>'success','message'=>$lang_txt[$Gallery->lang]['success_msg']) );
						Yii::app()->end();
					}

				// }else{
				// 	print_r( $model->errors );
				// 	exit();
				}
				echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[Yii::app()->language]['incorrectcaptcha']));
				Yii::app()->end();
			}
			echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[Yii::app()->language]['incorrectmail']));
			Yii::app()->end();
		}

	    $email = isset($_POST['email']) ? $_POST['email'] : '';
	    
		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no and email =:email ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':email'=> $email)
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
						$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $this->Year->Yearm1_year . $lang_txt[$Gallery->lang]['mail_subject']) . '?=';
						$mail->MsgHTML($mail_format);
						$mail->Addaddress($Gallery->email, $Gallery->name);
						
						$send = $mail->Send();
						if ($send){
					        echo CJSON::encode(array('status'=>'success','message'=>$lang_txt[$Gallery->lang]['success_msg']) );
					        Yii::app()->end();
						}				
				}
			}

		echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[Yii::app()->language]['incorrectmail']));
		Yii::app()->end();
	}

	public function actionCancelapply(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
		    	"error_pwd"=>"請檢查您輸入的密碼是否正確.",
				"success_msg"=>"您的帳號已成功取消.",
				"error_msg"=>"發生錯誤,無法取消.",
		    ),
		    "en"=>array(
		    	"error_pwd"=>"An error occurred. It cannot be deleted.",
				"success_msg"=>"Your account has been successfully deleted.",
				"error_msg"=>"An error occurred. It cannot be deleted.",
		    ),
	    );	
		
		$newpwd = isset($_POST['newpwd']) ? $_POST['newpwd']: '';
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no and pwd = :pwd ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no' => Yii::app()->user->getState('accID'), ':pwd'=> md5($newpwd))
			));
		if ($Gallery){
			$Gallery->status = '4';//Yii::app()->params['galler_status'][4];
			if ($Gallery->save()){
				Yii::app()->user->setState('accID',"");
				echo CJSON::encode(array('status'=>'success','url'=>"/" . Yii::app()->language . "/info/message?i=" . $lang_txt[$Gallery->lang]['success_msg']));
				Yii::app()->end();				
			}
		}else{
			echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[$Gallery->lang]['error_pwd']));
			Yii::app()->end();
		}
		echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[$Gallery->lang]['error_msg']));
		Yii::app()->end();	
	}
	public static function getlastUrl($Gallery, $joinLv){
		if ($joinLv == '1'){
			$max = 1;
			for($step = 1;$step <= 8;$step ++){
				if ($Gallery['finishStep'.$step] == 0){
					$max = $step;
					$step = 9;
				}
			}
			if ($Gallery->finishStep8 == 1 & $max == 1){
				$max = 9;
			}

			switch ($max-1){
				case 0:
					$gourl = Yii::app()->createUrl('/fill/apply1_agree/',array('language'=>$Gallery->lang));    
					break;
				case 1:
					$gourl = Yii::app()->createUrl('/fill/apply1_data/',array('language'=>$Gallery->lang));    
					break;
				case 2:
					$gourl = Yii::app()->createUrl('/fill/apply1_experience/',array('language'=>$Gallery->lang));    
					break;
				case 3:
					$gourl = Yii::app()->createUrl('/fill/apply1_program/',array('language'=>$Gallery->lang));
					break;
				case 4:
					$gourl = Yii::app()->createUrl('/fill/apply1_theme/',array('language'=>$Gallery->lang));
					break;
				case 5:
					if (count($Gallery->Galleryt1) > 0){
						$Id_ary = $Gallery->Galleryt1;
						$gourl = Yii::app()->createUrl('/fill/apply1_art/',array('language'=>$Gallery->lang,'id'=>$Id_ary[0]->Galleryt1_no));
					}else{
						$gourl = Yii::app()->createUrl('/fill/apply1_art/',array('language'=>$Gallery->lang));
					}
					break;
				case 6:
					$gourl = Yii::app()->createUrl('/fill/apply1_review/',array('language'=>$Gallery->lang));
					break;
				case 7:
					$gourl = Yii::app()->createUrl('/fill/apply1_payment/',array('language'=>$Gallery->lang));
					break;
				case 8:
					if ($Gallery->finishStep8 && $Gallery->pay_status > 1){
						$gourl = Yii::app()->createUrl('/fill/apply1_done/',array('language'=>$Gallery->lang));
					}else{
						$gourl = Yii::app()->createUrl('/fill/apply1_payment/',array('language'=>$Gallery->lang));
					}
					break;
			}
		}
		if ($joinLv == 2){
			$max = 1;
			for($step = 1;$step <= 10;$step ++){
				if ($Gallery['finishStep2_'.$step] == 0){
					$max = $step;
					$step = 12;
				}
				if ($step == 10){
					$max = 11;
				}
			}
			switch ($max-1){
				case 0:
					$gourl = Yii::app()->createUrl('/apply2/agree/',array('language'=>$Gallery->lang));    
					break;
				case 1:
					$gourl = Yii::app()->createUrl('/apply2/Info/',array('language'=>$Gallery->lang));    
					break;
				case 2:
					$gourl = Yii::app()->createUrl('/apply2/Price/',array('language'=>$Gallery->lang));    
					break;
				case 3:
					$gourl = Yii::app()->createUrl('/apply2/Award/',array('language'=>$Gallery->lang));    
					break;
				case 4:
					$gourl = Yii::app()->createUrl('/apply2/Usd300/',array('language'=>$Gallery->lang));    
					break;
				case 5:
					$gourl = Yii::app()->createUrl('/apply2/Marketing/',array('language'=>$Gallery->lang));    
					break;
				case 6:
					$gourl = Yii::app()->createUrl('/apply2/Print/',array('language'=>$Gallery->lang));    
					break;
				case 7:
					$gourl = Yii::app()->createUrl('/apply2/Vip/',array('language'=>$Gallery->lang));    
					break;
				case 8:
					$gourl = Yii::app()->createUrl('/apply2/review/',array('language'=>$Gallery->lang));    
					break;
				case 9:
					$gourl = Yii::app()->createUrl('/apply2/remittance/',array('language'=>$Gallery->lang));    
					break;
				case 10:
					$gourl = Yii::app()->createUrl('/apply2/done/',array('language'=>$Gallery->lang));    
					break;
			}
		}
		return $gourl;	
	}


}
?>