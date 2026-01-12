 <?php 
	 $Gallery = Gallerym1::model()->findbyPk($this->memberId);
	 $action = ($this->action->id);
	 $array = array(
		 'step1'=> array("class"=> ($Gallery->finishStep2_1 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/agree/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step2'=> array("class"=> ($Gallery->finishStep2_2 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/info/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step3'=> array("class"=> ($Gallery->finishStep2_3 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/price/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step4'=> array("class"=> ($Gallery->finishStep2_4 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/award/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step5'=> array("class"=> ($Gallery->finishStep2_5 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/usd300/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step6'=> array("class"=> ($Gallery->finishStep2_6 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/Marketing/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step7'=> array("class"=> ($Gallery->finishStep2_7 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/print/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step8'=> array("class"=> ($Gallery->finishStep2_8 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/vip/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step9'=> array("class"=> ($Gallery->finishStep2_9 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/review/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step10'=> array("class"=> ($Gallery->finishStep2_10 == true ? 'done' : '') ,'href'=>$this->createUrl('/apply2/remittance/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step11'=> array("class"=> ($Gallery->finishStep2_10 == true & $Gallery->pay_status > 1 ? 'done' : '') ,'href'=>$this->createUrl('/apply2/done/',array('language'=>Yii::app()->language)), 'status' => ''),
	 );
	 
	if ($Gallery->finishStep2_1){
		$array['step2']['class'] = $array['step2']['class'] != 'done' ? 'active' : 'done';
	}else{
		$array['step1']['class'] = 'active';
	}
	if ($Gallery->finishStep2_2){
		$array['step3']['class'] = $array['step3']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_3){
		$array['step4']['class'] = $array['step4']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_4){
		$array['step5']['class'] = $array['step5']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_5){
		$array['step6']['class'] = $array['step6']['class'] != 'done' ? 'active' : 'done';
	}else{
		$array['step6']['href'] = 'javascript:void(0)';
	}
	if ($Gallery->finishStep2_6){
		$array['step7']['class'] = $array['step7']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_7){
		$array['step8']['class'] = $array['step8']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_8){
		$array['step9']['class'] = $array['step9']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_9){
		$array['step10']['class'] = $array['step10']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep2_10){
		$array['step11']['class'] = $array['step10']['class'] != 'done' ? 'active' : 'done';
	}
	$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
/*
	if ($Gallery->pay_status2 <= 1){
		$array['step11']['href'] = '';
		$array['step11']['class'] = '';
	}else{
		$array['step11']['class'] = 'done';	
	}
*/
	switch(Yii::app()->language){
		case 'en':	
			$lang = array(
				"title"=>"Non-Taiwanese Gallery<br/>Campaign Information Form",
				"helloword"=>"Dear " . $Gallery->name_en,
				"pleasefinish"=>"Please complete the list below:",
				"unit1"=>"Campaign Announcement and Schedule",
				"unit2"=>"Gallery Information Confirmation",
				"unit3"=>"Sector and Booth fee Confirmation",
				"unit4"=>"Campaign Activity - ONE ART Award",
				"unit5"=>"Campaign Activity - Best Buy 3,000 USD",
				"unit6"=>"Images for Marketing Campaign",
				"unit7"=>"Selected Artwork for Catalogue",
				"unit8"=>"VIP Card Mailing List",
				"unit9"=>"Confirmation of Campaign Information",
				"unit10"=>"Confirmation of Account Information",
				"unit11"=>"Campaign Information Completed",
				"endalert"=>"",//"Reminder: Please submit your payment before <span>".(new DateTime($this->Year->Yearm1_payed2))->format('Y/m/d')."</span>. You can still make corrections on campaign information after submitting your exhibit booth fee. Please make sure you fill in  the information completely by <span>".(new DateTime($this->Year->Yearm1_open2ed))->format('Y/m/d')."</span>.",
				"btn_change"=>"Reset Password",
				"btn_cancel"=>"Cancel Application",
			);

			break;
			
		default:
			$lang = array(
				"title"=>"行銷活動資料表格",
				"helloword"=>$Gallery->name . "您好",
				"pleasefinish"=>"請確認以下行銷活動資料無誤",
				"unit1"=>"行銷配合事項及時程公告",
				"unit2"=>"畫廊資料確認",
				"unit3"=>"參展方案及費用確認",
				"unit4"=>"新賞獎ONE ART Award",
				"unit5"=>"收藏入門Best Buy 3,000 USD",
				"unit6"=>"上傳行銷活動可使用圖檔",
				"unit7"=>"上傳專刊使用圖檔",
				"unit8"=>"貴賓卡郵寄名單",
				"unit9"=>"行銷活動資料確認",
				"unit10"=>"帳號資訊確認",
				"unit11"=>"完成行銷資料上傳",
				"endalert"=>"",//"提醒您，請於 <span>".(new DateTime($this->Year->Yearm1_payed2))->format('Y/m/d')."</span> 前完成展位費用匯款，活動行銷資料於 <span>".(new DateTime($this->Year->Yearm1_open2ed))->format('Y/m/d')."</span> 前完成編輯修改。繳費完成後仍可在截止日前編輯資料，逾期則無法再修改。",
				"btn_change"=>"變更密碼",
				"btn_cancel"=>"取消報名",
			);
			break;
	}
 ?>
        <div class="left-menu">
            <div class="menu-top">
                <div class="menu-logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>" alt=""></div>
                <h4><?=$lang['title'];?></h4>
            </div>
            
            <div class="menu-container">
                <!--使用者名字-->
                <div class="userName"><?=$lang['helloword'];?><!--<span class="icon fa fa-pencil" onclick="window.location='<?=$this->createUrl('/fill/apply1_data/',array('language'=>Yii::app()->language))?>'"></span>--></div>
                <div class="plsfill"><?=$lang['pleasefinish'];?></div>
                <!--menu-list-->
                <ul class="menu" id="menu-apply">
                    <li class="menu-list <?=$array['step1']['class'];?>">
                        <a href="<?=$array['step1']['href'];?>">
                            <h3>1. <?=$lang['unit1'];?></h3>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step2']['class'];?>">
                        <a href="<?=($array['step2']['class'] != "" ? $array['step2']['href'] : "#");?>">
                            <h3>2. <?=$lang['unit2'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep2_2 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step3']['class'];?>">
                        <a href="<?=($array['step3']['class'] != "" ? $array['step3']['href'] : "#");?>">
                            <h3>3. <?=$lang['unit3'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep2_3 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step4']['class'];?>">
                        <a href="<?=($array['step4']['class'] != "" ? $array['step4']['href'] : "#");?>">
                            <h3>4. <?=$lang['unit4'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep2_4 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step5']['class'];?>">
                        <a href="<?=($array['step5']['href'] != "" ? $array['step5']['href'] : "javascript:void(0)");?>">
							<h3>5. <?=$lang['unit5'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_5 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step6']['class'];?>">
                        <a href="<?=($array['step6']['href'] != "" ? $array['step6']['href'] : "javascript:void(0)");?>">
							<h3>6. <?=$lang['unit6'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_6 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step7']['class'];?>">
                        <a href="<?=($array['step7']['href'] != "" ? $array['step7']['href'] : "javascript:void(0)");?>">
							<h3>7. <?=$lang['unit7'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_7 == true ? 'fa-check' : '');?>"></div>
                        </a>
					</li>
                    <li class="menu-list <?=$array['step8']['class'];?>">
                        <a href="<?=($array['step8']['href'] != "" ? $array['step8']['href'] : "javascript:void(0)");?>">
							<h3>8. <?=$lang['unit8'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_8 == true ? 'fa-check' : '');?>"></div>
                        </a>
					</li>
					</li>
                    <li class="menu-list <?=$array['step9']['class'];?>">
                        <a href="<?=($array['step9']['href'] != "" ? $array['step9']['href'] : "javascript:void(0)");?>">
							<h3>9. <?=$lang['unit9'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_9 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step10']['class'];?>">
                        <a href="<?=($array['step10']['href'] != "" ? $array['step10']['href'] : "javascript:void(0)");?>">
							<h3>10. <?=$lang['unit10'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep2_10 == true ? 'fa-check' : '');?>"></div>
                        </a>
					</li>
                    <li class="menu-list <?=$array['step11']['class'];?>">
                        <a href="<?=($array['step11']['href'] != "" ? $array['step11']['href'] : "javascript:void(0)");?>">
							<h3>11. <?=$lang['unit11'];?></h3>
                        </a>
                    </li>
                </ul>
                <!--remind  -->
                <div class="remind"><?=$lang['endalert'];?></div>
                <!--變更密碼 & 取消報名-->
                <div class="group-btn">
                    <div class="changePassword btn-grey pull-left">
                        <h5><?=$lang['btn_change'];?></h5>
                    </div>
                </div>
            </div>
		</div> 
			<script>
			//加入art
				function addart(){
					window.location = '<?php echo $this->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language));?>';
				}
			//刪除art
				function deleteart(id){
					$.post(
						'/<?=Yii::app()->language;?>/fill/Apply1Ajax_deleteart',
						{
						'id':id,
						'YII_CSRF_TOKEN':'<?=Yii::app()->request->csrfToken;?>'
						},
						function(xml){
			                var data = JSON.parse(xml);
			                console.log(data.status == 'success');
			                if (data.status == 'success'){
				               alert(data.message);
							   window.location.reload();
			                }else{
				                alert(data.message);
			                }
						}
					);
				}
			//忘記密碼
				function checksubmit(){
					var oldpwd = $('#oldpwd').val().trim();
					var newpwd = $('#newpwd').val().trim();
					var confirmpwd = $('#confirmpwd').val().trim();
					var checked = true;
					if (oldpwd == '' || newpwd == '' || confirmpwd == ''){
						checked = false;
					}
					if (newpwd.length < 4){
						checked = false;
					}
					if (newpwd != confirmpwd){
						checked = false;
					}
					
					if (checked){
						$.post(
							'/<?=Yii::app()->language;?>/member/resetpassword',
							{
							'oldpwd':oldpwd,
							'newpwd':newpwd,
							'confirmpwd':confirmpwd,
							'YII_CSRF_TOKEN':'<?=Yii::app()->request->csrfToken;?>'
							},
							function(xml){
								var data = JSON.parse(xml);
								if (data.status == 'success'){
								$('.popUp').hide();
								}else{
									alert(data.message);
								}
							}
						);
					}else{
						alert("請輸入正確舊密碼及確認密碼須相同(Please enter the same password again.)");
					}
				}
			//
			function cancelsubmit(){
					var checked = true;
					var newpwd = $('#cacnelpwd').val().trim();
					if (newpwd.length < 4){
						checked = false;
					}
					//console.log(newpwd);
					if (checked){
					$.post(
						'/<?=Yii::app()->language;?>/member/cancelapply',
						{
						'newpwd':newpwd,
						'YII_CSRF_TOKEN':'<?=Yii::app()->request->csrfToken;?>'
						},
						function(xml){
			                var data = JSON.parse(xml);
			                //console.log(data.status == 'success');
			                if (data.status == 'success'){
				               window.location = data.url;
			                }else{
				                alert(data.message);
			                }
						}
					);
					}else{
						alert("請輸入正確密碼(incorrect password.)");
					}			
			}
			</script>