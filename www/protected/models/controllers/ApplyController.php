<?php
class ApplyController extends Controller{
	public $Gallery;
    public function init(){
        parent::init();
        $this->layout = '';
	}
//個人資料
	public function actionlist(){
		$Works = Works::model()->findAll(
			array(
				'condition'=>"Member_no = :Member_no ",
				'params'=>array(':Member_no'=>Yii::app()->user->getState('accID'))
			));
		$Works02 = Works02::model()->findAll(
			array(
				'condition'=>"Member_no = :Member_no ",
				'params'=>array(':Member_no'=>Yii::app()->user->getState('accID'))
			));

		$Model = Yearm1::model()->findbyPk($this->Year->Yearm1_no);
        $content = $this->renderPartial(
            $view = '/apply/list',
			$data = array(
				'model' => $Works, 
				'model2' => $Works02,
				'dateend' => (new DateTime($Model->Yearm1_opened))->format('Y/m/d')
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}

	public function actiondata(){
		$Member = Member::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Member_no = :Member_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Member_no'=>Yii::app()->user->getState('accID'))
			));

		if (isset($_POST['Member'])){
			$Pt = $_POST['Member'];
			$Member = Member::model()->findbypk(Yii::app()->user->getState('accID'));
			$Member->contactname = $Pt['contactname'];
			$Member->contactgender = $Pt['contactgender'];
			$Member->contacttel = $Pt['contacttel'];
			$Member->contactphone = $Pt['contactphone'];
			$Member->province = $Pt['province'];
			$Member->contactaddress = $Pt['contactaddress'];
			$Member->save();

			$this->redirect('/apply/data/');
		}

        $content = $this->renderPartial(
            $view = '/apply/data',
			$data = array(
				'model' => $Member
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
	public function actionajax_data(){
		$Member = Member::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Member_no = :Member_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Member_no'=>Yii::app()->user->getState('accID'))
			));

		$json = CJSON::encode($Member);
		echo $json;
	}
	public function actionfolk(){
		$Member = Member::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Member_no = :Member_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Member_no'=>Yii::app()->user->getState('accID'))
			));

		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$Works02 = null;
		if ($id){
			$Works02 = Works02::model()->findbyPk($id);
		}
		if ($Works02){
			if ($Works02->Member_no != Yii::app()->user->getState('accID')){
				$this->redirect('/apply/list/');
			}
		}
		if (!$Works02){
			$Works02 = new Works02();
		}
		$Workst1 = new Workst1();
		$Workst2 = new Workst2();

		if (isset($_POST['Works02'])){
			$Works02->attributes = $_POST['Works02'];

			$Works02->Member_no = Yii::app()->user->getState('accID');
            if ($Works02->validate()){
	            if ($Works02->save()){  
				//存參加方案				
					$Award = Award::model()->find(array(
						'condition'=>"Yearm1_no =:Yearm1_no and type = :type ",
						'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':type'=>'2'))
					);
					if ($Award){
						$Membert1 = Membert1::model()->find(array(
							'condition'=>"Works_no =:Works_no and Award_no = :Award_no ",
							'params'=>array(':Works_no'=> $Works02->Works02_no, ':Award_no'=>$Award->Award_no))
						);
						if (!$Membert1){
							$Membert1 = new Membert1();
							$Membert1->Works_no = $Works02->Works02_no;
							$Membert1->Award_no = $Award->Award_no;
							$Membert1->Award_type = 2;
							$Membert1->save();
						}
					}

					$now = date('Y/m/d H:i:s');
					if (isset($_POST['Workst1'])){
						$_Workst1 = $_POST['Workst1'];
						foreach ($_Workst1 as $i => $item){
							$Workst1_add = Workst1::model()->findbyPk($item['Workst1_no']);
							$filepath_img = "." . Yii::app()->params['customerfile']['art'];
							if ($Workst1_add){
								for($pici = 1;$pici <= 3;$pici ++){
									if ($Workst1_add['pic'.$pici] != '' & isset($_POST['temp_'.$item['Workst1_no'].'_pic'.$pici])){
										if ($_POST['temp_'.$item['Workst1_no'].'_pic'.$pici] == ''){
											if (file_exists('.'.$Workst1_add['pic'.$pici])){unlink('.'.$Workst1_add['pic'.$pici]);}
											$Workst1_add['pic'.$pici] = '';
										}
									}
								}
							}
							
							if (!$Workst1_add){
								$Workst1_add = new Workst1();
								$Workst1_add->Works_no = $Works02->Works02_no;
								$Workst1_add->type = 'f';
								$Workst1_add->createDateTime = $now;
							}
							$Workst1_add->attributes = $item;
							$Workst1_add->updateDateTime = $now;
							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic1]')){
								$Workst1_add->pic1=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic1]');
								$newimg = '1'.Yii::app()->myClass->renameFile($Workst1_add->pic1);
								$Workst1_add->pic1->saveAs($filepath_img . $newimg);
								$Workst1_add->pic1 = Yii::app()->params['customerfile']['art'].$newimg;
							}
							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic2]')){
								$Workst1_add->pic2=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic2]');
								$newimg = '2'.Yii::app()->myClass->renameFile($Workst1_add->pic2);
								$Workst1_add->pic2->saveAs($filepath_img . $newimg);
								$Workst1_add->pic2 = Yii::app()->params['customerfile']['art'].$newimg;
							}
							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic3]')){
								$Workst1_add->pic3=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic3]');
								$newimg = '3'.Yii::app()->myClass->renameFile($Workst1_add->pic3);
								$Workst1_add->pic3->saveAs($filepath_img . $newimg);
								$Workst1_add->pic3 = Yii::app()->params['customerfile']['art'].$newimg;
							}
							if ($Workst1_add->validate()){
								$Workst1_add->save();
							}else{
								print_r($Workst1_add->errors);
							}
						}
					}
					$Workst1_delete = Workst1::model()->findAll(array(
						'condition' => 'updateDateTime != :now and type = :type and Works_no = :Works_no',
						'params'    => array(':now' => $now, ':type' => 'f', ':Works_no'=>$Works02->Works02_no)
					));
					foreach ($Workst1_delete as $pic){
						if (is_file('.'.$pic->pic1)){unlink('.'.$pic->pic1);}
						if (is_file('.'.$pic->pic2)){unlink('.'.$pic->pic2);}
						if (is_file('.'.$pic->pic3)){unlink('.'.$pic->pic3);}
					}
					Workst1::model()->deleteAll(array(
						'condition' => 'updateDateTime != :now and type = :type and Works_no = :Works_no',
						'params'    => array(':now' => $now, ':type' => 'f', ':Works_no'=>$Works02->Works02_no)
					));

					if (isset($_POST['Workst2'])){
						$_Workst1 = $_POST['Workst2'];
						foreach ($_Workst1 as $i => $item){
							$Workst1_add = Workst2::model()->findbyPk($item['Workst2_no']);
							if (!$Workst1_add){
								$Workst1_add = new Workst2();
								$Workst1_add->Works02_no = $Works02->Works02_no;
								$Workst1_add->type = 'f';
							}
							$Workst1_add->attributes = $item;
							if ($Workst1_add->validate()){
								$Workst1_add->save();
							}else{
								print_r($Workst1_add->errors);
							}
						}
					}
					$this->redirect('/apply/assessment/'.$Works02->Works02_no.'?t=f');
				}
			}else{
				print_r($Works02->errors);
			}
		}

        $content = $this->renderPartial(
            $view = '/apply/folk',
			$data = array(
				'model' => $Works02,
				'Member'=>$Member,
				'Workst1'=>$Workst1,
				'Workst2'=>$Workst2,
				'id'=>$id
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
	public function actiongeneral(){
		$Member = Member::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Member_no = :Member_no ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Member_no'=>Yii::app()->user->getState('accID'))
			));
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$Works = null;
		if ($id){
			$Works = Works::model()->findbyPk($id);
		}
		if ($Works){
			if ($Works->Member_no != Yii::app()->user->getState('accID')){
				$this->redirect('/apply/list/');
			}
		}
		if (!$Works){
			$Works = new Works();
		}

		$Workst1 = new Workst1();

		if (isset($_POST['Works'])){
			$Works->attributes = $_POST['Works'];

			$Works->Member_no = Yii::app()->user->getState('accID');
            if ($Works->validate()){
	            if ($Works->save()){
					$checkbox = isset($_POST['NameOfCheckboxList']) ? $_POST['NameOfCheckboxList'] : array();
					$Membert1 = CHtml::listData($Works->Membert1, 'Membert1_no', 'Award_no');
					Membert1::model()->savedate($Membert1,$checkbox,$Works->Works_no);
					if (isset($_POST['Workst1'])){
						$_Workst1 = $_POST['Workst1'];
						$now = date('Y/m/d H:i:s');
						foreach ($_Workst1 as $i => $item){
							$Workst1_add = Workst1::model()->findbyPk($item['Workst1_no']);
							$filepath_img = "." . Yii::app()->params['customerfile']['art'];
							//檢查檔案是否刪除

							if ($Workst1_add){
								for($pici = 1;$pici <= 3;$pici ++){
									if ($Workst1_add['pic'.$pici] != '' & isset($_POST['temp_'.$item['Workst1_no'].'_pic'.$pici])){
										if ($_POST['temp_'.$item['Workst1_no'].'_pic'.$pici] == ''){
											if (file_exists('.'.$Workst1_add['pic'.$pici])){unlink('.'.$Workst1_add['pic'.$pici]);}
											$Workst1_add['pic'.$pici] = '';
										}
									}
								}
							}

							if (!$Workst1_add){
								$Workst1_add = new Workst1();
								$Workst1_add->Works_no = $Works->Works_no;
								$Workst1_add->createDateTime = $now;
								$Workst1_add->type = 'g';
							}							
							$Workst1_add->attributes = $item;
							$Workst1_add->updateDateTime = $now;

							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic1]')){
								$Workst1_add->pic1=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic1]');
								$newimg = '1'.Yii::app()->myClass->renameFile($Workst1_add->pic1);
								$Workst1_add->pic1->saveAs($filepath_img . $newimg);
								$Workst1_add->pic1 = Yii::app()->params['customerfile']['art'].$newimg;
							}
							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic2]')){
								$Workst1_add->pic2=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic2]');
								$newimg = '2'.Yii::app()->myClass->renameFile($Workst1_add->pic2);
								$Workst1_add->pic2->saveAs($filepath_img . $newimg);
								$Workst1_add->pic2 = Yii::app()->params['customerfile']['art'].$newimg;
							}
							if (CUploadedFile::getInstanceByName('Workst1['.$i.'][pic3]')){
								$Workst1_add->pic3=CUploadedFile::getInstanceByName('Workst1['.$i.'][pic3]');
								$newimg = '3'.Yii::app()->myClass->renameFile($Workst1_add->pic3);
								$Workst1_add->pic3->saveAs($filepath_img . $newimg);
								$Workst1_add->pic3 = Yii::app()->params['customerfile']['art'].$newimg;
							}

							if ($Workst1_add->validate()){
								$Workst1_add->save();
							}else{
								print_r($Workst1_add->errors());
							}
						}
						$Workst1_delete = Workst1::model()->findAll(array(
							'condition' => 'updateDateTime != :now and type = :type and Works_no = :Works_no',
							'params'    => array(':now' => $now, ':type' => 'g', ':Works_no'=>$Works->Works_no)
						));

						foreach ($Workst1_delete as $pic){
							if (file_exists('.'.$pic->pic1)){unlink('.'.$pic->pic1);}
							if (file_exists('.'.$pic->pic2)){unlink('.'.$pic->pic2);}
							if (file_exists('.'.$pic->pic3)){unlink('.'.$pic->pic3);}
						}
						Workst1::model()->deleteAll(array(
							'condition' => 'updateDateTime != :now and type = :type and Works_no = :Works_no',
							'params'    => array(':now' => $now, ':type' => 'g', ':Works_no'=>$Works->Works_no)
						));
					}
					$this->redirect('/apply/assessment/'.$Works->Works_no.'?t='.($Works->type == '1' ? 'g':'t'));
				}
			}else{
				print_r($Works->errors);
			}
		}
        $content = $this->renderPartial(
            $view = '/apply/general',
			$data = array(
				'model' => $Works,
				'Member'=>$Member,
				'Workst1'=>$Workst1,
				'id'=>$id
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
	public function actiondelete(){
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$type = isset($_POST['t']) ? $_POST['t'] : 0;

		$resu = false;
		$Works = null;
		$key = 0;
		if ($id > 0){
			switch ($type){
				case 'f':
					$Works = Works02::model()->findbyPk($id);	
					$key = $Works->Works02_no;
					break;
				case 'g':
					$Works = Works::model()->findbyPk($id);	
					$key = $Works->Works_no;
					break;
			}
			if ($Works){
				//刪除作品
				$Workst1_delete = Workst1::model()->findAll(array(
					'condition' => 'type = :type and Works_no = :Works_no',
					'params'    => array(':type' => $type, ':Works_no'=>$key)
				));
				foreach ($Workst1_delete as $pic){
					if (is_file('.'.$pic->pic1)){unlink('.'.$pic->pic1);}
					if (is_file('.'.$pic->pic2)){unlink('.'.$pic->pic2);}
					if (is_file('.'.$pic->pic3)){unlink('.'.$pic->pic3);}
				}
				Workst1::model()->deleteAll(array(
					'condition' => 'type = :type and Works_no = :Works_no',
					'params'    => array(':type' => $type, ':Works_no'=>$key)
				));

				//刪除聯絡
				if ($type == 'f'){
					Workst2::model()->deleteAll(array(
						'condition' => 'Works02_no = :Works02_no',
						'params'    => array(':Works02_no'=>$key)
					));	
				}
				//刪除參加
				//if ($type == 'g'){
					Membert1::model()->deleteAll(array(
						'condition' => 'Works_no = :Works_no and Award_type = 1',
						'params'    => array(':Works_no'=>$key)
					));	
				}
				if ($type == 'f'){
					Membert1::model()->deleteAll(array(
						'condition' => 'Works_no = :Works_no and Award_type = 2',
						'params'    => array(':Works_no'=>$key)
					));	
				//}

				//正式刪除
				$Works->delete();

				echo CJSON::encode(array('resu'=>true,'message'=>$id));
				Yii::app()->end();
			}
		}
		echo CJSON::encode(array('resu'=>false,'message'=>$id));
		Yii::app()->end();	
	}
	public function actionassessment(){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$t = isset($_GET['t']) ? $_GET['t'] : 0;
		$table = '';
		$Works = null;
		switch ($t){
			case 'g':
				$Works = Works::model()->findbyPk($id);
				$table = 'Works';
				break;
			case 'f':
				$Works = Works02::model()->findbyPk($id);
				$table = 'Works02';

				break;
		}

		if (!$Works){
			$this->redirect('/apply/list/');
		}

		if ($Works->Member_no != Yii::app()->user->getState('accID')){
			$this->redirect('/apply/list/');
		}
		$Member = Member::model()->findbypk(Yii::app()->user->getState('accID'));
		if (isset($_POST[$table])){
			$Works->attributes = $_POST[$table];
            if ($Works->validate()){
	            if ($Works->save()){  
					$mail_format = file_get_contents("./mail/finishmail.html");
					$mail_format = str_replace("{{website}}",Yii::app()->params['SSL'],$mail_format);
					$mail_format = str_replace("{{username}}",$Member->contactname,$mail_format);
					$mail_format = str_replace("{{enddate}}",(new DateTime($this->Year->Yearm1_opened))->format('Y/m/d'),$mail_format);
					//發送信件
					$mail=Yii::app()->Smtpmail;
					$mail->IsHTML = true;
					$mail->SetFrom(Yii::app()->params['adminEmail'][0], Yii::app()->params['mailFromName']);
					$mail->Subject = '=?UTF-8?B?'.base64_encode('恭喜您已完成「第六屆公共藝術獎」徵件活動報名！') . '?=';
					//$mail->AltBody = Yii::app()->params['SSL'] . "/" . $model->lang . "/member/checkemail/" . md5($model->Member_no);
					$mail->MsgHTML($mail_format);
					$mail->Addaddress($Member->email, $Member->contactname);

					$send = $mail->Send();

					$this->redirect('/apply/finish/');
				}
			}else{
				print_r($Works->errors);
			}
		}
        $content = $this->renderPartial(
            $view = '/apply/assessment',
			$data = array(
				'model' => $Works
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));	
	}
	public function actionajax_assessment(){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		//$Works = Works::model()->with('Workst1')->findbyPk($id);
		$Works = Works::model()->findbyPk($id);

		$ary = Works::model()->convertModelToArray($Works);

		if (count($Works->Workst1) > 0){
			$ary['Workst1'] = Works::model()->convertModelToArray($Works->Workst1);
		}

		$json = CJSON::encode($ary);
		echo $json;

	}
	public function actionajax_folk(){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		//$Works = Works02::model()->with('Workst1')->with('Workst2')->together()->findbyPk($id);
		$Works = Works02::model()->findbyPk($id);	
		$ary = Works::model()->convertModelToArray($Works);

		if (count($Works->Workst1) > 0){
			$ary['Workst1'] = Works::model()->convertModelToArray($Works->Workst1);
		}
		if (count($Works->Workst2) > 0){
			$ary['Workst2'] = Works::model()->convertModelToArray($Works->Workst2);
		}

		$json = CJSON::encode($ary);
		echo $json;
	}

	public function actionfinish(){
		$Model = Yearm1::model()->findbyPk($this->Year->Yearm1_no);

        $content = $this->renderPartial(
            $view = '/apply/finish',
			$data = array(
				'dateend' => (new DateTime($Model->Yearm1_opened))->format('Y/m/d')
			),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
	}
}
?>