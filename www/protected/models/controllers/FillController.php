<?php
class FillController extends Controller{
	public $Gallery;
    public function init(){
        parent::init();
        $this->layout = '';
        
		Yii::import('application.controllers.MemberController');

		//若偷切換中英文版,則導到首頁
		
		// if (Yii::app()->user->getState('acclang') != Yii::app()->language){
		// 	$this->redirect(Yii::app()->createUrl('/member/index',array('language'=>Yii::app()->language)));
		// }
	}
//取得畫廊
	public function getGallery(){
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
			))->findbyPk(Yii::app()->user->getState('accID'));

		if ($Gallery){
			return $Gallery;
		}

		return false;
	}
//個人資料
    public function actionApply1_data(){
		//print_r($this->Gallery);
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));

		if (isset($_POST['Gallerym1'])){
			$Gallery->attributes = $_POST['Gallerym1'];
			$Gallery->finishStep2 = true;
			if ($Gallery->validate()){
				if ($Gallery->save()){
					$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
					$this->redirect($goUrl);
				}
			}
		}
		// print_r($Gallery->finishStep2);
		// exit();
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'data',
			$data = array(
				'model' => $Gallery,
				'loginInfo'=>$this->loginInfo(),
				'finishStep2'=>$Gallery->finishStep2
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
    public function actionAjax_data(){

		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
		));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
	}
	public function actionAjax_import_data(){

		$Year = Yearm1::model()->find(
			array(
				'condition'=>"Yearm1_open1st <:open1st ",
				'params'=>array(':open1st'=> $this->Year->Yearm1_open1st),
				'order'=>' Yearm1_open1st desc '
			));

		$The_Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
			// $json = CJSON::encode($The_Gallery);
			// echo $json;
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_email = :Gallerym1_email ",
				'params'=>array(':Yearm1_no'=> $Year->Yearm1_no, ':Gallerym1_email'=>$The_Gallery->email)
			));

		if ($Gallery){
			if( $Gallery->gallerymonth == "" ){
				$Gallery->gallerymonth == "Jan";
			}
			$json = CJSON::encode($Gallery);
			echo $json;
		}
	}
	
//同意簡章
    public function actionApply1_agree(){
		if (isset($_POST['read'])){
			$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
			
			if ($Gallery){
				$Gallery->finishStep1 = true;
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
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'agree',
            $data = array('model' => "", 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    public function actionAjax_agree(){

		$Gallery = Gallerym1::model()->find(
		array(
			"select"=>"finishStep1",
			'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
		));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
	}
//經歷
    public function actionApply1_experience(){
	    $model = new zExperience();
		$Gallery = $this->getGallery();
		
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
	    
	    if (isset($_POST['zExperience'])){
			$model->attributes=$_POST['zExperience'];
			//$model->finishStep3 = true;
			if ($Gallery){
				$result = $model->upload();
				if ($result){
					$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
					$this->redirect($goUrl);
				}
			}
		}
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'experience',
            $data = array('model' => $model, 'Gallery' => $Gallery, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    public function actionAjax_experience(){
	    
	    $model = new zExperience();
		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
    }
    
    public function actionAjax_experience_delete(){
	    $filename = (isset($_POST['filename']) ? $_POST['filename'] : '');
	    $name = (isset($_POST['name']) ? $_POST['name'] : '');

	    if ($filename != '' & $name != ''){
			$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
			if ($Gallery){
				if (is_file('.' . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $Gallery[$name])){
					unlink('.' . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $Gallery[$name]);
					$Gallery[$name] = '';
				}
				
				$Gallery->save();
			}
		}
    }
    
//方案選擇
    public function actionApply1_program(){

	    $Methodm1 = Methodm1::model()->findAll(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no),
			'order'=>'sort'
		));
		
		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
		));
		
		if (isset($_POST['program'])){
			$post_program = $_POST['program'];
			$program = Array();
			
			$ArtChang = 0;

			foreach ($Methodm1 as $i => $rows){
				if (isset($post_program["program" . $rows->MethodM1_no])){
					$checkMethod = $post_program['art' . $rows->MethodM1_no];

					$valueArry = array();

					foreach ($checkMethod as $key => $value) {
						array_push($valueArry,$value);
					}
					$roomArray = array();

					foreach ($rows->Roomm1 as $j => $value) {
						array_push($roomArray,$value->RoomM1_no);
					}
					
					$singleMethod = (object)array(
						'program'=>$rows->MethodM1_no,
						'value'=>$valueArry,
						'room'=>$roomArray,
					);
					array_push($program,$singleMethod);
					
				}else{
					if (count($Gallery->Galleryt1) > 0){
						foreach($Gallery->Galleryt1 as $row){
                            if ($row->Program != null){
								if (strpos($row->Program,$rows->MethodM1_no) >= 0){
									$Art = Galleryt1::model()->findbyPk($row->Galleryt1_no);
									$Art->Galleryt1_finish = 0;
									$Art->save();
	
									//$Gallery->finishStep7 = 0;
									$Gallery->finishStep7 = 0;
									$Gallery->finishStep6 = 0;
									
									$ArtChang = 1;
	                            }
                            }
                        }
					}
				}
			}
			if ($program != ""){
				$program = json_encode($program);
				$Gallery->program = $program;
				$Gallery->finishStep4 = 1;
				if ($Gallery->save()){
					$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
					
					if ($ArtChang){
						$script = "由於您已新增或取消參展的方案，將會影響到藝術家的報名資料，我們需要您進入報名第5步驟確認每位藝術家的報名參展方案是否無誤";
						if ($Gallery->lang == 'en'){
							$script = "Notice!Due to a change you made on sector selection, we are directing you to the fifth step- Artist Information for double - confirmation. Please make sure each participating artist has selected their sector correctly.";
						}
						
						echo "<script>alert('" . $script . "');window.location.href='" . $goUrl . "';</script>";
					}else{
						$this->redirect($goUrl);
					}
				}else{
					print_r($Gallery->errors);
				}
			}
		}

        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'program',
            $data = array('model' => $Gallery, 'Methodm1'=>$Methodm1, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
//參展主題
    public function actionApply1_theme(){
	    
	    $model = new zTheme();
		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
		));
		//$model = $Gallery;

        if(isset($_POST['ajax']) && $_POST['ajax']==='apply4')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
	    if (isset($_POST['zTheme'])){
		    
		    $model->attributes=$_POST['zTheme'];
			if ($Gallery){
				if ($model->upload()){
					$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
					$this->redirect($goUrl);
				}else{
					print_r($model->errors);
				}
			}
	    }
	    
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'theme',
            $data = array('model' => $model, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionAjax_theme(){

		$Gallery = Gallerym1::model()->find(
		array(
			"select"=>"showtitle,showscript",
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
	}
	
    public function actionAjax_pay(){

		$Gallery = Gallerym1::model()->find(
		array(
			"select"=>"paybank_account,paybank_name,paybank_bank,returnbank_account,returnbank_name,returnbank_bank",
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
	}
	
//藝術家
    public function actionApply1_art(){
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
	//檢查ART
		$Art = null;
		if ($id){
			$Art = Galleryt1::model()->findbyPk($id);
		}
		if (!$Art){
			$Art = new Galleryt1();	
		}
		
	    $Methodm1 = Methodm1::model()->findAll(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no),
			'order'=>'sort'
		));

		if (isset($_POST['Galleryt1'])){
			$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['art'];
			$Art->attributes = $_POST['Galleryt1'];
			$Art->Gallerym1_no = Yii::app()->user->getState('accID');
			$Art->Yearm1_no = $this->Year->Yearm1_no;
			$Art->Galleryt1_finish = 'Y';
			$Program_ary = Array();
			foreach ($Methodm1 as $i => $rows){

				if (isset($_POST['Galleryt1']['program']["program" . $rows->MethodM1_no])){
					$checkMethod = $rows->MethodM1_no;

					array_push($Program_ary,$checkMethod);
				}
			}
			$Art->Program = json_encode($Program_ary);

			if ($Art->validate()){

				if (CUploadedFile::getInstance($Art,'datafile1')){
					$Art->datafile1=CUploadedFile::getInstance($Art,'datafile1');
					$newimg = Yii::app()->myClass->renameFile($Art->datafile1);
					$Art->datafile1->saveAs($filepath_img . $newimg);
					$Art->datafile1 = $newimg;
				}
				if (CUploadedFile::getInstance($Art,'datafile2')){
					$Art->datafile2=CUploadedFile::getInstance($Art,'datafile2');
					$newimg = Yii::app()->myClass->renameFile($Art->datafile2);
					$Art->datafile2->saveAs($filepath_img . $newimg);
					$Art->datafile2 = $newimg;
				}
				if (CUploadedFile::getInstance($Art,'datafile3')){
					$Art->datafile3=CUploadedFile::getInstance($Art,'datafile3');
					$newimg = Yii::app()->myClass->renameFile($Art->datafile3);
					$Art->datafile3->saveAs($filepath_img . $newimg);
					$Art->datafile3 = $newimg;
				}
				
				if ($Art->save()){
					//取得藝術家是否都符合
					$YearArt = Galleryt1::model()->findAll(
						array(
							'condition'=>"Yearm1_no =:Yearm1_no and Galleryt1_finish != :Galleryt1_finish and Gallerym1_no = :m1 and Galleryt1_no != :no ",
							'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Galleryt1_finish'=>'Y',':m1'=>Yii::app()->user->getState('accID'), ':no'=>$id)
						));
					if ($YearArt == null){
						$Gallery->finishStep6 = 1;
					}
					$Gallery->save();

					if (isset($_POST['backurl'])){
						switch ($_POST['backurl']){
							case 'add':
								$this->redirect(Yii::app()->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language)));
								break;
							default:
							if ($YearArt == null){
								$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
								$this->redirect($goUrl);
							}else{
								$this->redirect(Yii::app()->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language,'id'=>$YearArt[0]->Galleryt1_no)));
							}
								break;
						}
					}
					
				}else{
					//print_r($Art->errors);
				}
			}
		}	
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'art',
            $data = array('model' => $Art, 'Gallery' => $Gallery,'Method'=>$Methodm1,'program'=>$Gallery->program, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionAjax_art(){
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$Art = Galleryt1::model()->findbyPk($id);
		$json = CJSON::encode($Art);
		echo $json;
    }
    public function actionAjax_art_filedelete(){
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
	    $filename = (isset($_POST['filename']) ? $_POST['filename'] : '');
	    $name = (isset($_POST['name']) ? $_POST['name'] : '');
	    
	    if ($filename != '' & $name != ''){
			$Art = Galleryt1::model()->findbyPk($id);
			
						
			if ($Art){
				if (is_file(Yii::app()->params['dirname'] . Yii::app()->params['folder']['def'] . $Art->$Gallery->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $Art[$name])){
					unlink(Yii::app()->params['dirname'] . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $Art[$name]);
					$Art[$name] = '';
				}
				
				print_r(Yii::app()->params['dirname'] . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $Art[$name]);
				$Art->save();
			}
	    }
    }
    
    
    public function actionApply1Ajax_deleteart(){
	//中英
	    $lang_txt = array(
		    "zh"=>array(
				"success_msg"=>array("已將","刪除成功."),
				"error_msg"=>"發生錯誤,無法刪除藝術家",
		    ),
		    "en"=>array(
		    	"success_msg"=>"Password has been reset.",
		    	"incorrectmail"=>"An error occurred. The information of artist cannot be deleted.",
		    ),
	    );
	    
	    $id = (isset($_POST['id']) ? $_POST['id'] : '');
		
		if ($id){
			$Art = Galleryt1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no and Galleryt1_no = :no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=> Yii::app()->user->getState('accID'),':no'=> $id)
			));
			//刪除圖片
			
			//刪除資料
			if ($Art->delete()){
				//取得帳號若沒有藝術家則要記錄取消
				$Gallery = Gallerym1::model()->find(
				array(
					'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
					'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
				));
				if ($Gallery){
					if (count($Gallery->Galleryt1) <= 0){
						$Gallery->finishStep6 = 0;
						$Gallery->save();
					}
				}
				
				echo CJSON::encode(array('status'=>'success','message'=>$lang_txt[Yii::app()->language]['success_msg'][0] . $Art->name . $lang_txt[Yii::app()->language]['success_msg'][1]));
				Yii::app()->end();
			}
		}
		echo CJSON::encode(array('status'=>'error','message'=>$lang_txt[$Gallery->lang]['error_msg']));
		Yii::app()->end();
    }
//瀏覽
    public function actionApply1_review(){
	    $id = (isset($_GET['id']) ? $_GET['id'] : '');
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
			
	    $Methodm1 = Methodm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no),
				'order'=>'sort'
			));

		$Method = Methodm1::model()->choose($Methodm1, $Gallery);
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'review',
            $data = array('model' => $Gallery, 'Method' => $Method, 'MethodMain' => $Methodm1, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	} 

    public function actionAjax_review(){

		$Gallery = Gallerym1::model()->find(
		array(
			"select"=>"showtitle,showscript",
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
		
		if ($Gallery){
			$Gallery->finishStep7 = "1";
			$Gallery->save();
			
			echo CJSON::encode(array('status'=>'success','message'=>''));
			Yii::app()->end();
		}
		
		echo CJSON::encode(array('status'=>'error','message'=>'發生錯誤'));
		Yii::app()->end();
	}	
//支付
    public function actionapply1_payment(){

		$zPay = new zPay();
		
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(
					':Yearm1_no'=> $this->Year->Yearm1_no, 
					':Gallerym1_no'=>Yii::app()->user->getState('accID')
				)
			));
			//MemberController::getlastUrl($Gallery,$this->joinLv);	
/*
			if(isset($_POST['zPay']) && $_POST['zPay']==='apply7')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
*/
			$view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'payment';
			if ($Gallery){
				if (isset($_POST['zPay'])){
					$zPay->attributes=$_POST['zPay'];			
					if ($zPay->upload()){
						$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
						$this->redirect($goUrl);
					}else{
						//print_r($zPay->errors);
					}
				}
				if ($Gallery->finishStep8){
					$view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'unpayment';
					if ($Gallery->pay_status > 1){
						$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
						$this->redirect($goUrl);
					}
				}
			}
		//$orderid = "B".substr($Gallery->Yearm1->Yearm1_year,2,2) . str_pad($Gallery->sort,4,"0",STR_PAD_LEFT) . "1" . str_pad(count($Gallery->Recordt1Count) + 1,2,"0",STR_PAD_LEFT).rand(1,100);

		$content = $this->renderPartial(
			$view = $view,
			$data = array('model'=> $Gallery,'zPay' => $zPay, 'loginInfo'=>$this->loginInfo()),
			$return = true
		);
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }

//完成頁面
    public function actionapply1_done(){
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
		//若知道網址,則導向
		if ($Gallery->pay_status <= 1){
			$goUrl = MemberController::getlastUrl($this->getGallery(),$this->joinLv);
			$this->redirect($goUrl);
		}
        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'done',
            $data = array('model' => $Gallery, 'loginInfo'=>$this->loginInfo()),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
		));
    }
	public function actionCreatePDF(){

		$this->layout = '';
		ob_start();
        echo $listTable = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'pdf',
            $data = array('model' => $Model,'main' => $arrayobj,'relate' => $relationModel,'action' => 'pdf'),
            $return = true
        );	
		$data = ob_get_clean();
		ob_end_flush();

		Yii::import('application.extensions.tcpdf.HTML2PDF');
		try
		{
			$html2pdf = new HTML2PDF('L', 'A4', 'en');
	
			$html2pdf->pdf->SetDisplayMode('real');
			$html2pdf->setDefaultFont('javiergb');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			//$html2pdf->setDefaultFont('Arial');
			//$html2pdf->pdf->IncludeJS("print(true);");              // To open Printer dialog box
			$html2pdf->writeHTML($data, isset($_GET['vuehtml']));
			$html2pdf->Output('download.pdf','I');		// To download PDF
			//$html2pdf->Output(dirname(__FILE__) . '/name.pdf','F');	// To PDF Server
			//$html2pdf->Output(“name1.pdf”,'I');                  		// To display PDF in browser
			
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}

	}
	
	public function actionapply1_pdf(){
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no' => Yii::app()->user->getState('accID'))
			));
			
	    $Methodm1 = Methodm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no),
				'order'=>'sort'
			));

		$Method = Methodm1::model()->choose($Methodm1, $Gallery);
        $this->layout = 'empty';

        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'pdf',
            $data = array('model' => $Gallery,'Method' => $Method, 'MethodMain' => $Methodm1),
            $return = true
        );

        $this->render('/layouts/empty', array(
            'content' => $content,
        ));
	}
    public function actionapply1_print(){
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no,':Gallerym1_no' => Yii::app()->user->getState('accID'))
			));
			
	    $Methodm1 = Methodm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no),
				'order'=>'sort'
			));

		$Method = Methodm1::model()->choose($Methodm1, $Gallery);
        $this->layout = 'empty';

        $content = $this->renderPartial(
            $view = '/apply1/' . Yii::app()->params['FlangText'][Yii::app()->language] . 'print',
            $data = array('model' => $Gallery,'Method' => $Method, 'MethodMain' => $Methodm1),
            $return = true
        );

        $this->render('/layouts/empty', array(
            'content' => $content,
        ));
    }	
	
}
?>