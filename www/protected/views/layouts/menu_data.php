 <?php 
	 $Gallery = Gallerym1::model()->findbyPk($this->memberId);
	 $action = ($this->action->id);
	 $array = array(
		 'step1'=> array("class"=> ($Gallery->finishStep1 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_agree/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step2'=> array("class"=> ($Gallery->finishStep2 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_data/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step3'=> array("class"=> ($Gallery->finishStep3 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_experience/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step4'=> array("class"=> ($Gallery->finishStep4 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_program/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step5'=> array("class"=> ($Gallery->finishStep5 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_theme/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step6'=> array("class"=> ($Gallery->finishStep6 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step7'=> array("class"=> ($Gallery->finishStep7 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_review/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step8'=> array("class"=> ($Gallery->finishStep8 == true ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_payment/',array('language'=>Yii::app()->language)), 'status' => ''),
		 'step9'=> array("class"=> ($Gallery->finishStep8 == true & $Gallery->pay_status > 1 ? 'done' : '') ,'href'=>$this->createUrl('/fill/apply1_done/',array('language'=>Yii::app()->language)), 'status' => ''),
	 );
	 
	if ($Gallery->finishStep1){
		$array['step2']['class'] = $array['step2']['class'] != 'done' ? 'active' : 'done';
	}else{
		$array['step1']['class'] = 'active';
	}
	if ($Gallery->finishStep2){
		$array['step3']['class'] = $array['step3']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep3){
		$array['step4']['class'] = $array['step4']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep4){
		$array['step5']['class'] = $array['step5']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep5){
		$array['step6']['class'] = $array['step6']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep6){
		$array['step7']['class'] = $array['step7']['class'] != 'done' ? 'active' : 'done';
	}else{
		$array['step7']['href'] = 'javascript:void(0)';
	}
	if ($Gallery->finishStep8){
		$array['step9']['class'] = $array['step9']['class'] != 'done' ? 'active' : 'done';
	}
	if ($Gallery->finishStep8 && $Gallery->finishStep7 && $Gallery->finishStep6){
		$array['step8']['class'] = $array['step8']['class'] != 'done' ? 'active' : 'done';
	}else{
		$array['step8']['class'] = 'disEdited';
		$array['step8']['href'] = '';

		$array['step9']['class'] = 'disEdited';
		$array['step9']['href'] = '';
	}
	if ($Gallery->pay_status <= 1){
		$array['step9']['href'] = '';
	}
	$Gallery = Gallerym1::model()->find(
		array(
			'condition'=>"Yearm1_no =:Yearm1_no ",
			'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no)
		))->findbyPk(Yii::app()->user->getState('accID'));
		
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	

	switch(Yii::app()->language){
		case 'en':	
			$lang = array(
				"title"=>"Non-Taiwanese Gallery<br/>Online Application",
				"helloword"=>"Dear " . $Gallery->name_en,
				"pleasefinish"=>"Please complete the list below:",
				"unit1"=>"Introduction",
				"unit2"=>"Edit Gallery information",
				"unit3"=>"Past Experience with Art Fairs / Exhibitions",
				"unit4"=>"Select Sector / Room Type",
				"unit5"=>"Exhibition Concept in OAT",
				"unit6"=>"Fill in OAT Artist Information",
				"unit7"=>"Confirmation of Application",
				"unit8"=>"Deposit Payment Options",
				"unit9"=>"Application Completed",
				"endalert"=>"Reminder: You can edit your application until <span>" . (new DateTime($this->Year->Yearm1_open1ed))->format('Y/m/d') . "</span>. You can still make corrections after making a deposit. No corrections can be made after deadline.",
				"btn_change"=>"Reset Password",
				"btn_cancel"=>"Cancel Application",
			);
			break;
			
		default:
			$lang = array(
				"title"=>"台灣畫廊 線上報名",
				"helloword"=>$Gallery->name . "您好",
				"pleasefinish"=>"請完成以下報名申請資料",
				"unit1"=>"閱讀報名簡章",
				"unit2"=>"基本資料填寫",
				"unit3"=>"填寫過去參展經歷",
				"unit4"=>"預定參展方案",
				"unit5"=>"OAT策展主題",
				"unit6"=>"登錄參展藝術家",
				"unit7"=>"確認報名資料",
				"unit8"=>"預繳保證金",
				"unit9"=>"報名完成",
				"endalert"=>"提醒您，報名資料於 <span>" . (new DateTime($this->Year->Yearm1_open1ed))->format('Y/m/d') . "</span> 日前都可以編輯修改。繳交完保證金後仍可在報名截止日前編輯資料，逾期則無法再修改。",
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
                <div class="userName"><?=$lang['helloword'];?>
					<!-- <span class="icon fa fa-pencil" onclick="window.location='<?=$this->createUrl('/fill/apply1_data/',array('language'=>Yii::app()->language))?>'"></span> -->
				</div>
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
                            <div class="icon fa <?=($Gallery->finishStep2 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step3']['class'];?>">
                        <a href="<?=($array['step3']['class'] != "" ? $array['step3']['href'] : "#");?>">
                            <h3>3. <?=$lang['unit3'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep3 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step4']['class'];?>">
                        <a href="<?=($array['step4']['class'] != "" ? $array['step4']['href'] : "#");?>">
                            <h3>4. <?=$lang['unit4'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep4 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step5']['class'];?>">
                        <a href="<?=($array['step5']['class'] != "" ? $array['step5']['href'] : "#");?>">
                            <h3>5. <?=$lang['unit5'];?></h3>
                            <div class="icon fa <?=($Gallery->finishStep5 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step6']['class'];?>">
                        <!--<a href="<?php echo $this->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language));?>"></a>-->
                        <a>
                            <h3>6. <?=$lang['unit6'];?></h3>
                            <?php if ($array['step6']['class'] != ""){?>
                            <div class="icon fa fa-user-plus"></div>
                            <?php }?>
                        </a>
                        <ul>
	                        <?php 
		                        foreach ($Gallery->Galleryt1 as $row){
	                        ?>
                            <li class="<?=($id == $row->Galleryt1_no ? 'active' : '');?>" >
                                <a href="<?=$this->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language,'id'=>$row->Galleryt1_no));?>">
                                    <h6 style="<?=($row->Galleryt1_finish != 'Y' ? 'color:red' : '')?>"><?=(Yii::app()->language == 'en' ? $row->name_en : $row->name);?></h6>
                                    <div class="icon fa fa-trash deleteArticle" id="<?=$row->Galleryt1_no;?>" name="<?=$row->name;?>"></div>
                                    <?=($id == $row->Galleryt1_no ? '<div class="icon fa fa-pencil"></div>' : '<div class="icon fa fa-check"></div>');?>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </li>
                    <li class="menu-list <?=$array['step7']['class'];?>">
                        <a href="<?=($array['step7']['href'] != "" ? $array['step7']['href'] : "javascript:void(0)");?>">
                            <h3>7. <?=$lang['unit7'];?></h3>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step8']['class'];?>">
                        <a href="<?=($array['step8']['href'] != "" ? $array['step8']['href'] : "javascript:void(0)");?>">
							<h3>8. <?=$lang['unit8'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep8 == true ? 'fa-check' : '');?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step9']['class'];?>">
                        <a href="<?=($array['step8']['href'] != "" ? $array['step9']['href'] : "javascript:void(0)");?>">
							<h3>9. <?=$lang['unit9'];?></h3>
							<div class="icon fa <?=($Gallery->finishStep7 == true ? 'fa-check' : '');?>"></div>
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
                    <div class="cancleRegistret btn-grey pull-right">
                        <h5><?=$lang['btn_cancel'];?></h5>
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