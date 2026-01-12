<?php
class Apply2Controller extends Controller{
	public $Gallery;
    public function init(){
        parent::init();
        $this->layout = '';
        
		Yii::import('application.controllers.MemberController');

		//若偷切換中英文版,則導到首頁
		
		if (Yii::app()->user->getState('acclang') != Yii::app()->language){
			$this->redirect(Yii::app()->createUrl('/member/index',array('language'=>Yii::app()->language)));
		}
	}
//取得畫廊
	public function getGallery(){
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and shortlisted = '2' ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
			))->findbyPk(Yii::app()->user->getState('accID'));

		if ($Gallery){
			return $Gallery;
		}

		return false;
	}
//授權
    public function actionAgree(){
		if (isset($_POST['read'])){
			$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
			
			if ($Gallery){
				$Gallery->finishStep2_1 = true;
				if($Gallery->save()){
					$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);					
					echo CJSON::encode(array('resu'=>'true','url'=>$goUrl,'message'=>''));
					Yii::app()->end();
				}
			}
			echo CJSON::encode(array('resu'=>'false','message'=>''));
			Yii::app()->end();	
		}
        $content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'agree',
            $data = array('model' => '', 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
//確認畫廊資料
	public function actionInfo(){
		//$Gallery = $this->getGallery();
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and shortlisted = '2' and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no'=> Yii::app()->user->getState('accID'))
			));

			if (isset($_POST['Gallerym1'])){
				
				if ($Gallery){
					$Gallery->attributes = $_POST['Gallerym1'];
					$Gallery->finishStep2_2 = true;
					if (strlen($Gallery->gallerymonth) > 5)
						$Gallery->gallerymonth = "";

					if($Gallery->save()){
						$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);					
						echo CJSON::encode(array('status'=>'success','url'=>$goUrl,'message'=>''));
						Yii::app()->end();
					}else{
						print_r($Gallery->errors);
					}
				}
				echo CJSON::encode(array('resu'=>'false','message'=>'資料不完整'));
				Yii::app()->end();	
			}
        $content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'info',
            $data = array('model' => $Gallery, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}

//確認參展方案及費用
	public function actionPrice(){
		$Gallery = $this->getGallery();

		$Roomm1 = Roomm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and RoomM1_no = :RoomM1_no",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':RoomM1_no'=>$Gallery->finishroom)
			));	

		if( count($Roomm1) > 0 ){
			$Gallery->pay_total = $Roomm1[0]['RoomM1_price']-8000;
			if (Yii::app()->language == 'en'){
				$Gallery->pay_total = $Roomm1[0]['RoomM1_price_en']-300;
			}
			if (isset($_POST['read'])){
				
				if ($Gallery){
					$Gallery->finishStep2_3 = true;
					if($Gallery->save()){
						$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);					
						echo CJSON::encode(array('resu'=>true,'url'=>$goUrl,'message'=>''));
						Yii::app()->end();
					}
				}
				echo CJSON::encode(array('resu'=>'false','message'=>''));
				Yii::app()->end();	
			}

			$content = $this->renderPartial(
				$view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'price',
				$data = array(
					'model' => $Gallery, 
					'Room' => $Roomm1,
					'loginInfo'=>$this->loginInfo()
				),
				$return = true
			);
			$this->render('/layouts/column1', array(
				'content' => $content,
			));	
		}else{
			print_r("<h1>請通知承辦單位，協助確定房型後，重整畫面。</h1>");

		}
	}

//Award新賞獎
	public function actionAward(){
		$Gallery = $this->getGallery();
		$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['award'];
		$Fields = ['Galleryt1_no','workname','workname_en','media','media_en','datasize','year','content1','content2','description'];

		$Award = $Gallery->Award;
		if (!$Gallery->Award){
			$Award = new Award();
		}

		if (isset($_POST['Award'])){		
			if ($Award){
				foreach ($Fields as $Field){
					$Award[$Field] = $_POST['Award'][$Field];
				}
				$Award->Gallerym1_no = Yii::app()->user->getState('accID');

				//Galleryt1_no
				if (!is_numeric($Award->Galleryt1_no)){
					$Award->Galleryt1_no = null;
				}
				if ($Award->validate()){
					
					if (CUploadedFile::getInstance($Award,'workpic1')){
						if (file_exists($filepath_img.$Award->workpic1) && $Award->workpic1 != ''){
							unlink($filepath_img.$Award->workpic1);
						}
						$Award->workpic1=CUploadedFile::getInstance($Award,'workpic1');
						$newimg = Yii::app()->myClass->renameFile($Award->workpic1);
						$Award->workpic1->saveAs($filepath_img . $newimg);
						$Award->workpic1 = $newimg;
					}

					if (CUploadedFile::getInstance($Award,'pic1')){
						if (file_exists($filepath_img.$Award->pic1) && $Award->pic1 != ''){
							unlink($filepath_img.$Award->pic1);
						}
						$Award->pic1=CUploadedFile::getInstance($Award,'pic1');
						$newimg = Yii::app()->myClass->renameFile($Award->pic1);
						$Award->pic1->saveAs($filepath_img . $newimg);
						$Award->pic1 = $newimg;
					}	
					
					if (CUploadedFile::getInstance($Award,'pic2') ){
						if (file_exists($filepath_img.$Award->pic2) && $Award->pic2 != ''){
							unlink($filepath_img.$Award->pic2);
						}
						$Award->pic2=CUploadedFile::getInstance($Award,'pic2');
						$newimg = Yii::app()->myClass->renameFile($Award->pic2);
						$Award->pic2->saveAs($filepath_img . $newimg);
						$Award->pic2 = $newimg;
					}	
					$Award->save();
					/*
					if($Award->save()){
						$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);					
						$this->redirect($goUrl);
						Yii::app()->end();
					}
					*/
				}else{
					print_r($Award->errors);
				}
			}
			$Gallery->finishStep2_4 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
				$this->redirect($goUrl);
			}
		}

		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'award',
			$data = array(
				'model' => $Gallery,
				'Award' => $Award,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
		
		
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionAward_next(){
		$Gallery = $this->getGallery();
			
		if($Gallery){
			if ($Gallery->Award){
				$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['award'];
				if (file_exists($filepath_img.$Gallery->Award->pic1)){
					unlink($filepath_img.$Gallery->Award->pic1);
				}
				if (file_exists($filepath_img.$Gallery->Award->pic2)){
					unlink($filepath_img.$Gallery->Award->pic2);
				}
				if (file_exists($filepath_img.$Gallery->Award->workpic1)){
					unlink($filepath_img.$Gallery->Award->workpic1);
				}
				$Gallery->Award->delete();
			}
			$Gallery->finishStep2_4 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
				$this->redirect($goUrl);
			}
		}
	}
	public function actionUsd300(){
		$Gallery = $this->getGallery();
		$Fields = ['Galleryt1_no','link','workname','workname_en','media','media_en','datasize','year'];
		$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['usd300'];
		
		$Work = new Work();

		if (isset($_POST['Work'])){
			$now = date('Y:m:d H:i:s');
			$Post_Work = $_POST['Work'];
			foreach ($Post_Work as $i => $item){
				$_Work = null;
				if ($item['Work_no'] != ''){
					$_Work = Work::model()->findbypk($item['Work_no']);
				}
				if (!$_Work){
					$_Work = new Work();
				}
				foreach ($Fields as $Field){
					$_Work[$Field] = $item[$Field];
				}

				$_Work->Gallerym1_no = Yii::app()->user->getState('accID');
				$_Work->type = 1;
				$_Work->updateDateTime = $now;

				if ($_Work->validate()){
					if (CUploadedFile::getInstanceByName('Work['.$i.'][pic]')){
						if ($item['Work_no'] != ''){
							if (file_exists($filepath_img.$_Work->pic)){
								if ($_Work->pic != ''){
									unlink($filepath_img.$_Work->pic);
								}
							}
						}
						$_Work->pic = CUploadedFile::getInstanceByName('Work['.$i.'][pic]');
						$newimg = Yii::app()->myClass->renameFile($_Work->pic);
						$_Work->pic->saveAs($filepath_img . $newimg);
						$_Work->pic = $newimg;
					}
					$_Work->save();
				}else{
					print_r($_Work->errors);
				}
			}
			//刪除
			$_willDelet = Work::model()->findAll(			
			array(
				'condition'=>"Gallerym1_no = :Gallerym1_no and updateDateTime != :updateDateTime and type = 1 ",
				'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'),':updateDateTime'=>$now)
			));

			foreach ($_willDelet as $delete){
				if ($delete->pic != ''){
					if (is_file($filepath_img.$delete->pic)){
						unlink($filepath_img.$delete->pic);
					}
				}
				$delete->delete();
			}
			$Gallery->finishStep2_5 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
				$this->redirect($goUrl);
			}
		}

		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'usd300',
			$data = array(
				'model' => $Gallery,
				'Work' => $Work,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionUsd300_next(){
		$Gallery = $this->getGallery();
			
		if($Gallery){
			$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['usd300'];
			$_willDelet = Work::model()->findAll(			
				array(
					'condition'=>"Gallerym1_no = :Gallerym1_no and type = 1",
					'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'))
				));
				foreach ($_willDelet as $delete){
					if (is_file($filepath_img.$delete->pic)){
						unlink($filepath_img.$delete->pic);
					}
					$delete->delete();
				}

			$Gallery->finishStep2_5 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);
				$this->redirect($goUrl);
			}
		}
	}
	public function actionMarketing(){
		$Gallery = $this->getGallery();
		$Fields = ['Galleryt1_no','link','workname','workname_en','media','media_en','datasize','year','content1'];
		$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['usd300'];
		
		$Work = new Work();

		if (isset($_POST['Work'])){
			$now = date('Y:m:d H:i:s');
			$Post_Work = $_POST['Work'];
			foreach ($Post_Work as $i => $item){
				$_Work = null;
				if ($item['Work_no'] != ''){
					$_Work = Work::model()->findbypk($item['Work_no']);
				}
				if (!$_Work){
					$_Work = new Work();
				}

				foreach ($Fields as $Field){
					$_Work[$Field] = $item[$Field];
				}

				$_Work->Gallerym1_no = Yii::app()->user->getState('accID');
				$_Work->type = 2;
				$_Work->updateDateTime = $now;

				if ($_Work->validate()){
					if (CUploadedFile::getInstanceByName('Work['.$i.'][pic]')){
						if ($item['Work_no'] != ''){
							if (is_file($filepath_img.$_Work->pic)){
								unlink($filepath_img.$_Work->pic);
							}
						}
						$_Work->pic = CUploadedFile::getInstanceByName('Work['.$i.'][pic]');
						$newimg = Yii::app()->myClass->renameFile($_Work->pic);
						$_Work->pic->saveAs($filepath_img . $newimg);
						$_Work->pic = $newimg;
					}
					$_Work->save();
				}else{
					//print_r($_Work->errors);
				}
			}
			//刪除
			$_willDelet = Work::model()->findAll(			
			array(
				'condition'=>"Gallerym1_no = :Gallerym1_no and updateDateTime != :updateDateTime and type = 2 ",
				'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'),':updateDateTime'=>$now)
			));

			foreach ($_willDelet as $delete){
				if (is_file($filepath_img.$delete->pic)){
					unlink($filepath_img.$delete->pic);
				}
				$delete->delete();
			}
			$Gallery->finishStep2_6 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
				$this->redirect($goUrl);
			}
		}
		
		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'marketing',
			$data = array(
				'model' => $Gallery,
				'Work' => $Work,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionMarketing_next(){
		$Gallery = $this->getGallery();
			
		if($Gallery){
			$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['usd300'];
			$_willDelet = Work::model()->findAll(			
				array(
					'condition'=>"Gallerym1_no = :Gallerym1_no and type = 2 ",
					'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'))
				));
				foreach ($_willDelet as $delete){
					if (is_file($filepath_img.$delete->pic)){
						unlink($filepath_img.$delete->pic);
					}
					$delete->delete();
				}

			$Gallery->finishStep2_6 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);
				$this->redirect($goUrl);
			}
		}
	}
	public function actionPrint(){
		$Gallery = $this->getGallery();
		$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['print'];
		if (isset($_POST['Gallerym1'])){
			if ($Gallery){
				$Gallery['spissue_link'] = $_POST['Gallerym1']['spissue_link'];
				$Gallery['spissue_text'] = $_POST['Gallerym1']['spissue_text'];

				$Gallery->finishStep2_7 = true;

				if ($Gallery->spissue_pic != '' && $_POST['Gallerym1']['spissue_pic'] != $Gallery->spissue_pic){
					if (is_file($filepath_img.$Gallery->spissue_pic)){
						unlink($filepath_img.$Gallery->spissue_pic);
					}
				}

				if (CUploadedFile::getInstance($Gallery,'spissue_pic')){
					$Gallery->spissue_pic=CUploadedFile::getInstance($Gallery,'spissue_pic');
					$newimg = Yii::app()->myClass->renameFile($Gallery->spissue_pic);
					$Gallery->spissue_pic->saveAs($filepath_img . $newimg);
					$Gallery->spissue_pic = $newimg;
				}
				if($Gallery->save()){
					$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);
					$this->redirect($goUrl);
					//echo CJSON::encode(array('status'=>'success','url'=>$goUrl,'message'=>''));
					//Yii::app()->end();
				}
			}
			echo CJSON::encode(array('resu'=>'false','message'=>''));
			Yii::app()->end();	
		}

		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'print',
			$data = array(
				'model' => $Gallery,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionVip(){
		$Gallery = $this->getGallery();
		$Vipcard = new Vipcard();

		if (isset($_POST['Vipcard'])){
			$Post_Vip = $_POST['Vipcard'];
			foreach ($Post_Vip as $item){
				$OneVip = null;
				if ($item['card_no'] != ''){$OneVip = Vipcard::model()->findbypk($item['card_no']);}
				if (!$OneVip){$OneVip = new Vipcard();}
				$OneVip->attributes = $item;
				$OneVip->Gallerym1_no = Yii::app()->user->getState('accID');
				if ($OneVip->validate()){
					$OneVip->save();
					//print_r($OneVip->errors);		
				}
			}
			
			$Gallery->finishStep2_8 = true;
			if ($Gallery->save()){
				$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);
				$this->redirect($goUrl);
			}
		}

		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'vip',
			$data = array(
				'model' => $Gallery,
				'Vipcard' => $Vipcard,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionReview(){
		$Gallery = $this->getGallery();

		$content = $this->renderPartial(
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'review',
			$data = array(
				'model' => $Gallery,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionReview_next(){
		$Gallery = $this->getGallery();
			
		if($Gallery){
			$Gallery->finishStep2_9 = true;
			if($Gallery->save()){
				$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);
				$this->redirect($goUrl);
			}
		}
	}
	
	public function actionRemittance(){
		$Gallery = $this->getGallery();
		$Fields = ['paybank_name2','paybank_bank2','paybank_account2','returnbank_name2','returnbank_bank2','returnbank_account2'];
/*
		if ($Gallery->pay_status2 != 1){
			$this->redirect(Yii::app()->createUrl('/apply2/done',array('language'=>Yii::app()->language)));
		}
*/
		if (isset($_POST['Gallerym1'])){
			if ($Gallery){
				foreach ($Fields as $Field){
					$Gallery[$Field] = $_POST['Gallerym1'][$Field];
				}
				$Gallery->finishStep2_10 = true;

				if($Gallery->save()){
					$goUrl = MemberController::getlastUrl($Gallery,$this->joinLv);					
					echo CJSON::encode(array('status'=>'success','url'=>$goUrl,'message'=>''));
					Yii::app()->end();
				}
			}
			echo CJSON::encode(array('resu'=>'false','message'=>''));
			Yii::app()->end();	
		}

		$content = $this->renderPartial(
			//$view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . ($Gallery->finishStep2_10 ? 'unpayment' : 'remittance'),
			$view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'remittance',
			$data = array(
				'model' => $Gallery,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionDone(){
		$Gallery = $this->getGallery();
/*
		if ($Gallery->pay_status2 == 1){
			$this->redirect(Yii::app()->createUrl('/apply2/remittance',array('language'=>Yii::app()->language)));
		}
*/
		$content = $this->renderPartial(
			//$view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . ($Gallery->pay_status2 <= 1 ? 'unpayment' : 'done'),
            $view = '/apply2/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'done',
			$data = array(
				'model' => $Gallery,
				'loginInfo'=>$this->loginInfo()
			),
            $return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
}
?>