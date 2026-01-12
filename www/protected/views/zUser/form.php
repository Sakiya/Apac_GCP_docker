    <div class="container">
        <div id="apply6">
            <?php echo CHtml::beginForm('', 'post', array('class' => 'form-horizontal','enctype'=>'multipart/form-data')); ?>
	        <?php echo CHtml::tag('button',array('class' => 'back', 'onClick' => "window.location='/" . Yii::app()->controller->id . "/adminindex/';return false;"),'❮ 回報名列表');?>
            <h3 class="title"><?=$model->name;?><?=$model->name_en;?></h3> 
            <div style="display:none;"><?=$model->authorizecode;?></div>
            <table class="top_form">
                <tr>
                    <th>報名狀態: </th>
                    <td class="tb_r">
		                <?php 
							echo CHtml::activeDropDownList($model, 'status', Yii::app()->params['galler_status'], array('class'=>'Select_1')); 
						?>
					</td>
                </tr>
                <tr>
                    <th>入圍:</th>
                    <td class="tb_r">
					<?php 
						echo CHtml::activeDropDownList($model, 'shortlisted', array('1'=>'未入圍','2'=>'已入圍','3'=>'未審核'), array('class'=>'Select_1')); 
					?>
					</td>
                </tr>
                <tr>
                    <th>付款狀態:</th>
                    <td class="tb_r">
					<?php
						echo CHtml::activeDropDownList($model, 'pay_status', Yii::app()->params['galler_pay_status'], array('class'=>'Select_1')); 
					?>
					</td>
                </tr>
                <tr>
                    <th>付款方式:</th>
                    <td class="tb_r">
					<?php
						echo CHtml::activeDropDownList($model, 'pay_method', array('AT'=>'匯款','CR'=>'信用卡'), array('class'=>'Select_1')); 
					?>
					</td>
                </tr>
                <tr>
                    <th><?php echo CHtml::activeLabelEx($model,'paydate'); ?>:</th>
                    <td class="tb_r">
	                    <?php echo CHtml::activeTextField($model, 'paydate', array('class'=>'col-sm-4 date-picker_1','data-date-format'=>'yyyymmdd')); ?>
	                </td>
                </tr>
                <tr>
                    <th>報名序號:</th>
                    <td class="tb_r"><?=$model->id;?></td>
                </tr>
                <tr>
                    <th>匯款帳號:</th>
                        <td class="tb_r">
                            <?=$model->paybank_bank ."  ". $model->paybank_name ."  ". $model->paybank_account;?>
                        </td>
                    </th>
                </tr>
                <tr>
                    <th>退款帳號:</th>
                        <td class="tb_r">
                            <?=$model->returnbank_bank ."  ". $model->returnbank_name ."  ". $model->returnbank_account;?>
                        </td>
                    </th>
                </tr>
                <!--
                <tr>
                    <th>匯款帳號:</th>
                        <td class="tb_r">
                            <?php //$model->Recordt1->bankaccount;?>
                        </td>
                    </th>
                </tr>
                <tr>
                    <th>匯款期限:</th>
                        <td class="tb_r">
                            <?php //$model->Recordt1->enddate;?>
                        </td>
                    </th>
                </tr>
                -->
                <tr>
                    <th><?php echo CHtml::activeLabelEx($model,'pay_return'); ?>:</th>
                    <td class="tb_r">
					<?php
						echo CHtml::activeDropDownList($model, 'pay_return', array('N'=>'否','Y'=>'是'), array('class'=>'Select_1')); 
					?>
					</td>
                </tr>
                <tr>
                    <th><?php echo CHtml::activeLabelEx($model,'finishroom'); ?>:</th>
                    <td class="tb_r">
					<?php
						echo CHtml::activeDropDownList($model, 'finishroom', Roomm1::model()->listData(), array('class'=>'Select_1','empty'=>'')); 
					?>
                    </td>
                </tr>
                <tr>
                    <th><?php echo CHtml::activeLabelEx($model,'remark'); ?>:</th>
                    <td class="tb_r"><?php echo CHtml::activetextArea($model, 'remark', array('class'=>' ')); ?></th>
                </tr>
            </table>
            <button type="submit">儲存</button>
			<?php 
				$firstEndDay = (strtotime($model->Yearm1->Yearm1_open1ed) - strtotime(date('Ymd')))/3600/12;
				//if ($model->payYN != 'Y' & $firstEndDay <= 20 & $firstEndDay >= 0){
			?>
                <button onclick="payalert('<?=$model->Gallerym1_no;?>');">發送繳費提醒</button>
                <button type="button" onclick="paysuccess('<?=$model->Gallerym1_no;?>');">發送繳費完成通知</button>
                <button type="button" onclick="shortlisted('<?=$model->Gallerym1_no;?>');">發送入圍通知</button>
			<?php //}?>
            <?php echo CHtml::endForm(); ?>
            <!-- 1-->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3">
                            <h2> 1.畫廊資訊</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> 帳號</th>
                        <td> <?=$model->email;?></td>
                    </tr>
                    <tr>
                        <th> 單位名稱</th>
                        <td> <?=$model->name;?> <?=$model->name_en;?></td>
                    </tr>
                    <tr>
                        <th> 成立日期</th>
                        <td> <?=$model->galleryyear . ", " . $model->gallerymonth;?></td>
                    </tr>
                    <tr>
                        <th> 負責人</th>
                        <td> <?=$model->bossname;?> <?=$model->bossname_en;?></td>
                    </tr>
                    <tr>
                        <th> 聯絡電話</th>
                        <td> <?=$model->tel;?></td>
                    </tr>
                    <tr>
                        <th> 傳真</th>
                        <td> <?=$model->fax;?></td>
                    </tr>
                    <tr>
                        <th> 國家 / 地區</th>
                        <td> <?=$model->country." / ".$model->city."<br/>住址：".$model->address;?></td>
                    </tr>
                    <tr>
                        <th> 聯絡住址</th>
                        <td> 國家：<?=$model->country." ".$model->city."<br/>住址：".$model->address;?></td>
                    </tr>
                    <tr>
                        <th> 網址</th>
                        <td> <?=$model->websiteurl;?></td>
                    </tr>
                    <tr>
                        <th> 展務人聯絡</th>
                        <td> <?=$model->contactname;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> <?=$model->contactemail;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> <?=$model->contactphone;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> Line︰ <?=$model->lineid;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> Wechat︰ <?=$model->wechat;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td> what’app︰ <?=$model->whatapp;?></td>
                    </tr>
                </tbody>
            </table>
            <!--2        -->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="5">
                            <h2> 2. 參展經歷</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> <?php echo $model->Yearm1->Yearm1_year - 1;?></th>
                        <td colspan="4"><?=$model->experienceoneyear;?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th> <?php echo $model->Yearm1->Yearm1_year - 1;?></th>
                        <td colspan="4"><?=$model->experiencetwoyear;?></td>
                    </tr>
                </tbody>
                <!--展覽記錄1-->
                <tbody>
                    <tr>
                        <th> 展覽記錄1</th>
                        <td colspan="3"> <?=$model->exhibition1name;?></td>
                        <td class="text-right"> <?=$model->exhibition1date;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td colspan="4">
                            <div class="card-group">
	                        <?php if ($model->exhibition1pic1 != ''){?>
                                <div class="card">
                                    <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition1pic1;?>')" class="card-top"></div>
                                </div>
                            <?php }?>
                            <?php if ($model->exhibition1pic2 != ''){?>
                                <div class="card">
                                    <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition1pic2;?>')" class="card-top"></div>
                                </div>
                            <?php }?>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <!--展覽記錄2-->
                <tbody>
                    <tr>
                        <th> 展覽記錄2</th>
                        <td colspan="3"> <?=$model->exhibition2name;?></td>
                        <td class="text-right"> <?=$model->exhibition2date;?></td>
                    </tr>
                    <tr>
                        <th> </th>
                        <td colspan="4">
                            <div class="card-group">
                            <?php if ($model->exhibition2pic1 != ''){?>
                                <div class="card">
                                    <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition2pic1;?>')" class="card-top"></div>
                                </div>
                            <?php }?>
                            <?php if ($model->exhibition2pic2 != ''){?>
                                <div class="card">
                                    <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition2pic2;?>')" class="card-top"></div>
                                </div>
                            <?php }?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- 3-->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3">
                            <h2>3. 預定參展方案</h2>
                        </th>
                    </tr>
                </thead>
                <!--藝術無限-->
	                <?php
		                if ($Method){
						foreach ($Method as $y => $rows){
                            $j = 0;
                            if (isset($rows['check'])){
							if ($rows['check']){
					?>
					<tbody>
						<?php
							if (isset($rows['Roomm1'])){
							foreach ($rows['Roomm1'] as $row){
								
								switch ($row['sort']){
									case '1':
										$abc = "one";
										break;
									case '2':
										$abc = "two";
										break;
									case '3':
										$abc = "three";
										break;
									case '4':
										$abc = "four";
										break;
									case '5':
										$abc = "five";
										break;	
                                    case '6':
                                        $abc = "six";
                                        break;
									default:
										$abc = "";
										break;
								}
						?>
						<?php if ($abc != ""){$j ++;?>
						<tr>
							<th class="fa <?=($rows['check'] == 1 & $j == 1 ? 'fa-check' : '')?>"><span><?=($j == 1 ? $rows['MethodM1_title'] : '');?></span></th>
							<td class="<?=$abc;?>" style="width:100%"> 
                                <?php 
                                if (isset($row['RoomM1_nm'])){
                                    echo $row['RoomM1_nm'];
                                }
                                ?>
                            </td>
						</tr>
                        <?php }?>
                        <?php }
                        }?>
					</tbody>
					<?php 		}}
							}
						}
					?>
            </table>
            <!-- 4-->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3">
                            <h2> 4.OAT 策展主題</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> 策展主題</th>
                        <td colspan="2"> <?=$model->showtitle;?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>策展說明</th>
                        <td colspan="3"> <?=$model->showscript;?></td>
                    </tr>
                </tbody>
            </table>
            <!-- 5-->
			<?php 
			if (count($model->Galleryt1) > 0){
				foreach ($model->Galleryt1 as $i => $row){
					$Joins = array();
					if ($MethodMain){
						foreach ($MethodMain as $j => $Methods){
							$Program = json_decode($row->Program);
							if ((string)array_search($Methods->MethodM1_no, $Program) != ''){
								array_push($Joins,$Methods->MethodM1_title);
							}
						}
					}
			?> 
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3">
                            <h2> 5-1 藝術家</h2>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th> 藝術家基本資料</th>
                        <td colspan="4"><?=$row->name;?><?=$row->name_en;?> <?=date('Y')-$row->birthyear;?>歲 <?=$row->country;?></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>參展方案</th>
                        <td colspan="4">
	                        <?php
		                        if ($Joins){
				                    for($x = 0; $x < count($Joins); $x++) {
										echo $Joins[$x] . "<br>";
									}
								}
	                        ?>
                        </td>
                    </tr>
                </tbody>
                <!--學歷-->
                <tbody>
                    <tr>
                        <th>學歷</th>
                       <td colspan="4"> <?=nl2br($row->jointex);?></td>
                    </tr>
                </tbody>
                <!--個展/聯展經歷-->
                <tbody>
                    <tr>
                        <th>個展/聯展經歷</th>
                        <td colspan="4"> <?=nl2br($row->personalex);?></td>
                    </tr>
                </tbody>
                <!--獲獎/典藏經歷-->
                <tbody>
                    <tr>
						<th>獲獎/典藏經歷</th>
                        <td colspan="4"> <?=nl2br($row->prize);?></td>
                    </tr>
                </tbody>
                <!--作品-->
				<tbody>
					<tr>
						<th>作品</th>
                        <td colspan="4">
                            <div class="card-group">
						<?php if ($row->datafile1 != ''){?>     
                                <div class="card">
                                    <div style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile1;?>);" class="card-top"></div>
                                    <div class="card-body">
                                        <div class="card-title"><?=$row->dataname1 . $row->dataname_en1;?></div>
                                        <div class="card-text">
                                            <div class="card-size"><?=$row->datasize1;?></div>
                                            <div class="card-discription"><?=$row->datamedia1;?></div>
                                            <div class="card-year"><?=$row->datayear1;?></div>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>
						<?php if ($row->datafile2 != ''){?>        
                                <div class="card">
                                    <div style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile2;?>);" class="card-top"></div>
                                    <div class="card-body">
                                        <div class="card-title"><?=$row->dataname2 . $row->dataname_en2;?></div>
                                        <div class="card-text">
                                            <div class="card-size"><?=$row->datasize2;?></div>
                                            <div class="card-discription"><?=$row->datamedia2;?></div>
                                            <div class="card-year"><?=$row->datayear2;?></div>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>
						<?php if ($row->datafile3 != ''){?>        
                                <div class="card">
                                    <div style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile3;?>);" class="card-top"></div>
                                    <div class="card-body">
                                        <div class="card-title"><?=$row->dataname3 . $row->dataname_en3;?></div>
                                        <div class="card-text">
                                            <div class="card-size"><?=$row->datasize3;?></div>
                                            <div class="card-discription"><?=$row->datamedia3;?></div>
                                            <div class="card-year"><?=$row->datayear3;?></div>
                                        </div>
                                    </div>
                                </div>
                        <?php }?>
                        </div> 
                        </td>
					</tr>
				</tbody>
            </table>
			<?php }
				}
			?>
			<?php echo CHtml::tag('button',array('class' => 'back', 'onClick' => "window.location='/" . Yii::app()->controller->id . "/adminindex/';return false;"),'❮ 回報名列表');?>
        </div>
    </div>

    </div>
	<script>
		function payalert(id){
			$.post(
				'/zEmail/AdminPayAlert/',
				{YII_CSRF_TOKEN:'<?=Yii::app()->request->csrfToken?>',id:id},
				function(xml){
					var _xml = JSON.parse(xml);
					if (_xml.status == 'success'){
						alert(_xml.message)
					}else{
						alert(_xml.message)
					}
				}
			)
		}
        function paysuccess(id){
			$.post(
				'/zEmail/AdminPaySuccess/',
				{YII_CSRF_TOKEN:'<?=Yii::app()->request->csrfToken?>',id:id},
				function(xml){
					var _xml = JSON.parse(xml);
					if (_xml.status == 'success'){
						alert(_xml.message)
					}else{
                        alert(_xml.message)
					}
				}
			)    
        }
        function shortlisted(id){
			$.post(
				'/zEmail/AdminShortlisted/',
				{YII_CSRF_TOKEN:'<?=Yii::app()->request->csrfToken?>',id:id},
				function(xml){
					var _xml = JSON.parse(xml);
					if (_xml.status == 'success'){
						alert(_xml.message)
					}else{
                        alert(_xml.message)
					}
				}
			)    
        }
        
	</script>
	
