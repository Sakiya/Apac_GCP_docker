<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container">
                <form id="apply6">
                    <div class="title">Confirmation of Application</div>
                    <h5>Please confirm the information given in this application is complete and accurate.</h5>
                    <!-- 1-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2> 1.Gallery Infomation</h2>
                                </th>
                                <th>
                                    <div class="edit-btn">
	                                    <a href="<?php echo $this->createUrl('/fill/apply1_data/',array('language'=>Yii::app()->language));?>">
                                        	<div class="fa fa-pencil">Edit</div>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> Gallery Name</th>
                                <td> <?=$model->name_en;?><?=$model->name;?></td>
                            </tr>
                            <tr>
                                <th> Gallery Established Time</th>
                                <td> <?=$model->galleryyear . "," . $model->gallerymonth;?></td>
                            </tr>
                            <tr>
                                <th> Director Name</th>
                                <td> <?=$model->bossname_en;?></td>
                            </tr>
                            <tr>
                                <th> Phone</th>
                                <td> <?=$model->tel;?></td>
                            </tr>
                            <tr>
                                <th> Fax</th>
                                <td> <?=$model->fax;?></td>
                            </tr>
                            <tr>
                                <th> Address</th>
                                <td> <?=$model->country . $model->city . $model->address;?></td>
                            </tr>
                            <tr>
                                <th> Website</th>
                                <td> <?=$model->websiteurl;?></td>
                            </tr>
                            <tr>
                                <th> Contact</th>
                                <td> <?=$model->contactname;?></td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td> <?=$model->contactemail;?></td>
                            </tr>
                            <?php if ($model->contactphone != ""){?>
                            	<tr><th> </th><td><?=$model->contactphone;?></td></tr>
                            <?php }?>
                            <?php if ($model->lineid != ""){?>
                            	<tr><th> </th><td> Line︰ <?=$model->lineid;?></td></tr>
                            <?php }?>
                            <?php if ($model->wechat != ""){?>
                            	<tr><th></th><td> Wechat︰ <?=$model->wechat;?></td></tr>
                            <?php }?>
                            <?php if ($model->whatapp != ""){?>
                            	<tr><th></th><td> what’app︰ <?=$model->whatapp;?></td></tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <!--2        -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4">
                                    <h2> 2. Past Experience with Art Fairs/ Exhibitions</h2>
                                </th>
                                <th>
                                    <div class="edit-btn">
	                                    <a href="<?php echo $this->createUrl('/fill/apply1_experience/',array('language'=>Yii::app()->language));?>">
                                        	<div class="fa fa-pencil">Edit</div>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> <?php echo $this->Year['Yearm1_year'] - 1;?></th>
                                <td colspan="4"><?=($model->experienceoneyear);?></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th> <?php echo $this->Year['Yearm1_year'] - 2;?></th>
                                <td colspan="4"><?=($model->experiencetwoyear);?></td>
                            </tr>
                        </tbody>
                        <!--Exhibitions History1-->
                        <tbody>
                            <tr>
                                <th> Exhibition History1</th>
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
                        <!--Exhibitions History2-->
                        <tbody>
                            <tr>
                                <th> Exhibition History2</th>
                                <td colspan="3"><?=$model->exhibition2name;?></td>
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
                                    <h2>3. Room type</h2>
                                </th>
                                <th>
                                    <div class="edit-btn">
	                                    <a href="<?php echo $this->createUrl('/fill/apply1_program/',array('language'=>Yii::app()->language));?>">
                                        	<div class="fa fa-pencil">Edit</div>
	                                    </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!--藝術無限-->
                            <?php 
		                        foreach ($Method as $y => $rows){
                                    $j = 0;
	                        ?>
	                        <tbody>
								<?php
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
								if (isset($rows['check'] ) == 1 & $row['sort'] != ""){
								?>
	                            <tr>
	                                <th class="fa <?=($rows['check'] == 1 & $j == 0 ? 'fa-check' : '')?>"><span><?=($j == 0 ? $rows['MethodM1_title_en'] : '');?></span></th>
	                                <td class="<?=$rows['check'] ? $abc : '';?>" colspan="3"> <?=$row['RoomM1_nm_en'];?></td>
	                            </tr>
	                            <?php 
		                            $j ++;
		                            }
		                        }
	                            ?>
	                        </tbody>
                            <?php }?>
                    </table>
                    <!-- 4-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <h2> 4.Exhibition Concpet in ONE ART Taipei <?php echo $this->Year['Yearm1_year'];?></h2>
                                </th>
                                <th>
                                    <div class="edit-btn">
	                                    <a href="<?php echo $this->createUrl('/fill/apply1_theme/',array('language'=>Yii::app()->language));?>">
                                        	<div class="fa fa-pencil">Edit</div>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> Exhibition Title</th>
                                <td colspan="2"> <?=$model->showtitle;?></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th>Statement</th>
                                <td colspan="3"> <?=nl2br($model->showscript);?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- 5-->
						<?php 
							foreach ($model->Galleryt1 as $i => $row){
								$Joins = array();
								foreach ($MethodMain as $j => $Methods){
									$Program = json_decode($row->Program);
									if ((string)array_search($Methods->MethodM1_no, $Program) != ''){
										array_push($Joins,$Methods->MethodM1_title_en);
									}
								}
						?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    <h2> 5-<?=$i + 1;?> Artist</h2>
                                </th>
                                <th>
                                    <div class="edit-btn">
	                                    <a href="<?php echo $this->createUrl('/fill/apply1_art/',array('language'=>Yii::app()->language,'id'=>$row->Galleryt1_no));?>">
                                        	<div class="fa fa-pencil">Edit</div>
	                                    </a>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> Artist Information</th>
                                <td colspan="4"><?=$row->name;?> <?=date('Y')-$row->birthyear;?> years old <?=$row->country;?></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th>Selected Sector</th>
                                <td colspan="4">
	                                <?php
			                            for($x = 0; $x < count($Joins); $x++) {
										    echo $Joins[$x];
										    echo "<br>";
										}
	                                ?>
                                </td>
                            </tr>
                        </tbody>                        
                        <!--學歷-->
                        <tbody>
                            <tr>
                                <th>Education</th>
                                <td colspan="4"> <?=nl2br($row->jointex);?></td>
                            </tr>
                        </tbody>
                        <!--Solo Exhibition / Group Exhibition-->
                        <tbody>
                            <tr>
                                <th>Solo Exhibition / Group Exhibition</th>
                                <td colspan="4"> <?=nl2br($row->personalex);?></td>
                            </tr>
                        </tbody>
                        <!--Certificate / Collection-->
                        <tbody>
                            <tr>
                                <th>Awards / Collections</th>
                                <td colspan="4"> <?=nl2br($row->prize);?></td>
                            </tr>
                        </tbody>
                        <!--Works-->
                        <tbody>
                            <tr>
                                <th>Works</th>
                                <td colspan="4">
                                    <div class="card-group">
	                                    <?php if ($row->datafile1 != ''){?>
                                        <div class="card">
                                            <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile1;?>')" class="card-top"></div>
                                            <div class="card-body">
                                            <div class="card-title"><?=$row->dataname1;?></div>
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
                                            <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile2;?>')" class="card-top"></div>
                                            <div class="card-body">
                                            <div class="card-title"><?=$row->dataname2;?></div>
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
                                            <div style="background: url('<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile3;?>')" class="card-top"></div>
                                            <div class="card-body">
                                            <div class="card-title"><?=$row->dataname3;?></div>
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
                        <?php }?>
                    <div class="btn-group">
                        <button class="btn-green" type="button" onclick="Nextsubmit();">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
function Nextsubmit(){
	$.post(
		'/<?=Yii::app()->language;?>/fill/Ajax_review/',
		{YII_CSRF_TOKEN: '<?=Yii::app()->request->csrfToken?>'},
		function(xml){
			var data = JSON.parse(xml);
			if (data.status == 'success'){				                
				window.location = '<?=$this->createUrl('/fill/apply1_payment/',array('language'=>Yii::app()->language));?>';
			}else{
				alert(data.message);
			}
		}	
	);
}
        </script>