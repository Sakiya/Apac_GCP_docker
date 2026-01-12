<?php

class zEmailController extends Controller
{
	public function init()
    {
        parent::init();
        $this->layout = 'admin';
	}
	public function actionAdminShortlisted(){
		$id = ( isset($_POST['id']) ? $_POST['id'] : "");
		$this->AdminFirstshortlisted($id ,2);
		echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出繳款通知'));
		Yii::app()->end();
	}
//第一階段入園 - 信件寄送
     //public function actionAdminFirstshortlisted(){
    function AdminFirstshortlisted($id, $type = 1){
   
	    //$id = ( isset($_POST['id']) ? $_POST['id'] : "");
        $Model = Gallerym1::model()->findByPk($id);
        
        if ($Model){
			//中英
			$lang_txt = array(
				"zh"=>array(
					"mail_subject"=>" 第二階段報名 通知",
				),
				"en"=>array(
					"mail_subject"=>" Admission Notice- Campaign Information",
				),
			);

			$mail_format = file_get_contents("./mail/" . $Model->lang . "_firstshortlisted.html");
			$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
			$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
			$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
			$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);
				
			//發送信件
				$mail=Yii::app()->Smtpmail;
				$mail->IsHTML = true;
				$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
				$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $Model->Yearm1->Yearm1_year . $lang_txt[$Model->lang]['mail_subject']) . '?=';
				$mail->MsgHTML($mail_format);
				$mail->Addaddress($Model->email, $Model->name);
				//$mail->Addaddress("juso@3wcreative.com.tw", "name");
	
			//-- content --
				$send = $mail->Send(); 
				
				if ($send){
					$Model->email_shortlisted = 1;
					$Model->save();

					if ($type == 2){
						echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出繳款通知'));
						Yii::app()->end();
					}
				}else{
					if ($type == 2){
						echo CJSON::encode(array('status'=>'error','message'=>'=='));
						Yii::app()->end();	
					}
				}
				//刪除email才不會前面的都會寄給後面
				$mail->ClearAddresses();
			
		}
		if ($type == 2){
		echo CJSON::encode(array('status'=>'error','message'=>'繳款通知無法寄出,請洽工程人員'));
		Yii::app()->end();
		}		
	}  
//繳費提醒 - 信件寄送   
    public function actionAdminPayAlert(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
			    "mail_subject"=>" 報名尚未完成通知",
		    ),
		    "en"=>array(
			    "mail_subject"=>" : Incomplete Application",
		    ),
	    );   
	    
	    $id = ( isset($_POST['id']) ? $_POST['id'] : "");
        $Model = Gallerym1::model()->findByPk($id);
        
        if ($Model){
				$mail_format = file_get_contents("./mail/" . $Model->lang . "_payalert.html");
				$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
				$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
				$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
				$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);
				$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_open1ed))->format('Y/m/d'),$mail_format);
				
				//發送信件
					$mail=Yii::app()->Smtpmail;
					$mail->IsHTML = true;
					$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
					$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $Model->Yearm1->Yearm1_year . $lang_txt[$Model->lang]['mail_subject']) . '?=';
					$mail->MsgHTML($mail_format);
					$mail->Addaddress($Model->email, $Model->name);
					
				/*-- content --*/		

					$send = $mail->Send(); 
					
					if ($send){
						echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出繳款通知'));
						Yii::app()->end();
					}else{
						echo CJSON::encode(array('status'=>'error','message'=>'=='));
						Yii::app()->end();	
					}
        }
		echo CJSON::encode(array('status'=>'error','message'=>'繳款通知無法寄出,請洽工程人員'));
		Yii::app()->end();
	}
//發送匯款資訊
	public function AdminPayAccount($id){
	//中英
		$lang_txt = array(
			"zh"=>array(
				"mail_subject"=>" 匯款通知",
			),
			"en"=>array(
				"mail_subject"=>" Remittance Account",
			),
		);
		
		$Model = Gallerym1::model()->findByPk($id);
        if ($Model){
			$mail_format = file_get_contents("./mail/" . $Model->lang . "_payaccount.html");
			$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
			$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
			$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
			$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);
			$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_open1ed))->format('Y/m/d'),$mail_format);
			
			$mail_format = str_replace("{{account_dateend}}",(new DateTime($Model->Yearm1->Yearm1_open1ed))->format('Y/m/d'),$mail_format);
			//$mail_format = str_replace("{{account_dateend}}",$Model->Recordt1->enddate,$mail_format);
			//$mail_format = str_replace("{{bank_account}}",$Model->Recordt1->bankaccount,$mail_format);
			//$mail_format = str_replace("{{price}}",$Model->Recordt1->price,$mail_format);
			
			
			
			//發送信件
				$mail=Yii::app()->Smtpmail;
				$mail->IsHTML = true;
				$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
				$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $Model->Yearm1->Yearm1_year . $lang_txt[Yii::app()->language]['mail_subject']) . '?=';
				$mail->MsgHTML($mail_format);
				$mail->Addaddress($Model->email, $Model->name);
				$mail->AddBCC('info@onearttaipei.com');
				
			/*-- content --*/		

				$send = $mail->Send(); 
				
				if ($send){
					return true;
				//	echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出匯款帳號通知'));
				//	Yii::app()->end();
				}else{
					return false;
				}
		}
		return false;
	}
//付款完成通知
	public function actionAdminPaySuccess(){
	//中英
		$lang_txt = array(
			"zh"=>array(
				"mail_subject"=>" 繳費完成通知",
			),
			"en"=>array(
				"mail_subject"=>" Your application has been successfully submitted!",
			),
		);
			
		$id = (isset($_POST['id']) ? $_POST['id'] : "");
		$Model = Gallerym1::model()->findByPk($id);
		
		if ($Model){
			$mail_format = file_get_contents("./mail/" . $Model->lang . "_paysuccess.html");
			$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
			$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
			$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
			$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);
				
			//發送信件
				$mail=Yii::app()->Smtpmail;
				$mail->IsHTML = true;
				$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
				$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $Model->Yearm1->Yearm1_year . $lang_txt[$Model->lang]['mail_subject']) . '?=';
				$mail->MsgHTML($mail_format);
				$mail->Addaddress($Model->email, $Model->name);
				//$mail->Addaddress("juso@3wcreative.com.tw", "name");
					
			/*-- content --*/
				$send = $mail->Send(); 
				
				if ($send){
					$Model->email_shortlisted = 1;
					$Model->save();
					echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出繳款完成通知'));
					Yii::app()->end();
				}else{
					echo CJSON::encode(array('status'=>'error','message'=>'=='));
					Yii::app()->end();	
				}
		}
		echo CJSON::encode(array('status'=>'error','message'=>'繳款通知無法寄出,請洽工程人員'));
		Yii::app()->end();
	
	} 



//繳費提醒 - 信件寄送   
	public function actionAdminPayAlert2(){	    
	    $id = ( isset($_POST['id']) ? $_POST['id'] : "");
        $Model = Gallerym1::model()->findByPk($id);
		
		//中英
		$lang_txt = array(
			"zh"=>array(
				"mail_subject"=>" ONE ART Taipei ".$Model->Yearm1->Yearm1_year." 通知: 參展費已逾期",
			),
			"en"=>array(
				"mail_subject"=>" ONE ART Taipei ".$Model->Yearm1->Yearm1_year." Notice: Exhibit Booth Fee Past Due ",
			),
		);

        if ($Model){
				$mail_format = file_get_contents("./mail/" . $Model->lang . "_payalert2.html");
				$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
				$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
				$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
				$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);

				if ($Model->lang == 'en'){
					$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_payed2))->format('dS,F, Y'),$mail_format);
				}else{
					$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_payed2))->format('m/d/Y'),$mail_format);
				}
				
					//發送信件
					$mail=Yii::app()->Smtpmail;
					$mail->IsHTML = true;
					$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
					$mail->Subject = '=?UTF-8?B?'.base64_encode($lang_txt[$Model->lang]['mail_subject']) . '?=';
					$mail->MsgHTML($mail_format);
					$mail->Addaddress($Model->email, $Model->name);
					$mail->AddBCC('info@onearttaipei.com');
					
				/*-- content --*/		

					$send = $mail->Send(); 
					
					if ($send){
						$Model->remark = $Model->remark."\n " . date('Y/m/d H:i:s') ." 送出繳款通知Email";
						$Model->save();
						echo CJSON::encode(array('status'=>'success','message'=>'已成功寄出繳款通知'));
						Yii::app()->end();
					}else{
						echo CJSON::encode(array('status'=>'error','message'=>'=='));
						Yii::app()->end();	
					}
        }
		echo CJSON::encode(array('status'=>'error','message'=>'繳款通知無法寄出,請洽工程人員'));
		Yii::app()->end();
	}
	//付款完成通知
	public function actionAdminPaySuccess2(){
	//中英
		$lang_txt = array(
			"zh"=>array(
				"mail_subject"=>" 繳費完成通知",
			),
			"en"=>array(
				"mail_subject"=>" Your application has been successfully submitted!",
			),
		);
			
		$id = (isset($_POST['id']) ? $_POST['id'] : "");
		$Model = Gallerym1::model()->findByPk($id);
		
		if ($Model){
			$mail_format = file_get_contents("./mail/" . $Model->lang . "_paysuccess2.html");
			$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
			$mail_format = str_replace("{{logopath}}",Yii::app()->params['customerfile']['year'] . $Model->Yearm1->Yearm1_picmb,$mail_format);
			$mail_format = str_replace("{{username}}",($Model->lang == 'en' ? $Model->name_en : $Model->name),$mail_format);
			$mail_format = str_replace("{{year}}",$Model->Yearm1->Yearm1_year,$mail_format);
			
			if ($Model->lang == 'en'){
				$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_open2ed))->format('dS,F, Y'),$mail_format);
				$mail_format = str_replace("{{year_end_week}}",(new DateTime($Model->Yearm1->Yearm1_open2ed))->format('l'),$mail_format);
			}else{
				$mail_format = str_replace("{{year_end}}",(new DateTime($Model->Yearm1->Yearm1_open2ed))->format('m/d/Y'),$mail_format);
				$mail_format = str_replace("{{year_end_week}}","周".Yii::app()->params['week_chinese'][(new DateTime($Model->Yearm1->Yearm1_open2ed))->format('w')],$mail_format);
			}
			
			//發送信件
				$mail=Yii::app()->Smtpmail;
				$mail->IsHTML = true;
				$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
				$mail->Subject = '=?UTF-8?B?'.base64_encode(Yii::app()->name . $Model->Yearm1->Yearm1_year . $lang_txt[$Model->lang]['mail_subject']) . '?=';
				$mail->MsgHTML($mail_format);
				$mail->Addaddress($Model->email, $Model->name);
				$mail->AddBCC('info@onearttaipei.com');

			/*-- content --*/
				$send = $mail->Send(); 
				
				if ($send){
					$Model->remark = $Model->remark."\n " . date('Y/m/d H:i:s') ." 繳費完成通知Email";
					$Model->save();
					echo CJSON::encode(array('status'=>'success','message'=>'已成功繳費完成通知'));
					Yii::app()->end();
				}else{
					echo CJSON::encode(array('status'=>'error','message'=>'=='));
					Yii::app()->end();	
				}
		}
		echo CJSON::encode(array('status'=>'error','message'=>'繳款通知無法寄出,請洽工程人員'));
		Yii::app()->end();
	}
}