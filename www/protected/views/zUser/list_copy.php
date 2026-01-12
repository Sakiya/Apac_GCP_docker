    <!-- 申請藝術家資料  -->
    <nav>
        <form action="" method="get">
            <select name="YourLocation" onchange="javascript:location.href = this.value;">
			<?php foreach($EveryCountry as $i => $row){?>
				<option value="/zUser/adminlist/?YourLocation=<?=$row['country'];?>" <?=$location == $row['country'] ? 'selected' : '';?>><?=$row['country'];?>（<?=$row['coutryCount'];?>間畫廊、<?=$row['galleryCount'];?>位藝術家）</option>
			<?php }?>
			</select>
            <input type="number" id="gpage" name="gpage" value="<?=$rowRun;?>" min="1" max="<?=$countryCount;?>"> /<?=$countryCount;?> <button type="submit">Go!</button>
            <?php if (isset($prevGallery)){?><button type="button" onclick="location.href ='/zUser/adminlist/?id=<?=$prevGallery;?>&YourLocation=<?=$location;?>'">上一頁</button><?php }?>
            <?php if (isset($nextGallery)){?><button type="button" onclick="location.href ='/zUser/adminlist/?id=<?=$nextGallery;?>&YourLocation=<?=$location;?>'">下一頁</button><?php }?>
        </form>
    </nav>
    <!-- 畫廊簡介 -->
    <!--
    <div class="page">
        <div class="serial"><span>Seral: <?=$model->id;?></span></div>
        <table width="1024" border="0">
            <tbody>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td><?=$model->name;?>&nbsp;<?=$model->name_en;?></td>
                        <td style="text-align: right;font-size:16px"><?=$model->galleryyear;?></br><?=$model->country . $model->city . $model->address;?></td>
                    </tr>
                </table>
            </tbody>
            <tbody>
                <table width="1024" class="info1">
                    <tr valign="top">
                        <td>
                            <table style="width:320px;">
                                <tr>
                                    <td class="lil">負責人</td>
                                    <td class="lir"><?=$model->bossname;?>&nbsp;&nbsp;<?=$model->bossname_en;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">聯絡電話</td>
                                    <td class="lir"><?=$model->tel;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">傳真</td>
                                    <td class="lir"><?=$model->fax;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">聯絡住址</td>
                                    <td class="lir"><?=$model->country . $model->city . $model->address;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">網址</td>
                                    <td class="lir"><?=$model->websiteurl;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">展務人聯絡</td>
                                    <td class="lir">
	                                    <?=$model->contactname;?>
	                                    <?=($model->contactphone ? '<br>'.$model->contactphone : '');?>
	                                    <?=($model->contactemail ? '<br>'.$model->contactemail : '');?>
	                                    <?=($model->lineid ? '<br>Line︰'.$model->lineid : '');?>
	                                    <?=($model->wechat ? '<br>WeChat︰'.$model->wechat : '');?>
	                                    <?=($model->whatapp ? '<br>Whatsapp︰'.$model->whatapp : '');?>
									</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table width="320 ">
                                <tr>
                                    <td class="lil"><?php //echo $this->Year['Yearm1_year'] - 1;?></td>
                                    <td class="lir"><?=($model->experienceoneyear);?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table width="320 ">
                                <tr>
                                    <td class="lil"><?php //echo $this->Year['Yearm1_year'] - 2;?></td>
                                    <td class="lir"><?=($model->experiencetwoyear);?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </tbody>
            <tbody>
                <table class="work" width="1024" valign="top">
                    <tr valign="top">
                        <td style="width:510px;">
                            <table>
                                <tr>
                                    展覽1
                                    <td>
	                                    <?php if ($model->exhibition1pic1 != ''){?>
	                                    	<div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition1pic1;?>);"></div>
                                        <?php }?>
	                                    <?php if ($model->exhibition1pic2 != ''){?>
	                                    	<div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition1pic2;?>);"></div>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="history"><?=$model->exhibition1name;?><div class="date"><?=$model->exhibition1date;?></div></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:510px;">
                            <table>
                                <tr>
                                    展覽2
                                    <td>
	                                    <?php if ($model->exhibition2pic1 != ''){?>
	                                    	<div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition2pic1;?>);"></div>
                                        <?php }?>
	                                    <?php if ($model->exhibition2pic2 != ''){?>
	                                    	<div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['experience'] . $model->exhibition2pic2;?>);"></div>
                                        <?php }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="history"><?=$model->exhibition2name;?><div class="date"><?=$model->exhibition2date;?></div></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </tbody>

        </table>
    </div>
    -->
    <!-- 徵件資料 -->
    <!--
    <div class="page" >
        <div class="serial"><span>Seral: <?=$model->id;?></span></div>
        <table>
            <tbody>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td><?=$model->name;?>&nbsp;<?=$model->name_en;?></td>
                        <td style="text-align: right;font-size:16px"><?=$model->galleryyear;?></br><?=$model->country . $model->city . $model->address;?></td>
                    </tr>
                </table>
            </tbody>
            <tbody>
                <table width="1024" class="info2">
                    <td valign="top" width="200" class="room bdr1px">

                        <table>
	                        <?php 
		                        if (count($Method) > 0){
		                        foreach ($Method as $y => $rows){
			                        $j = 0;
			                        if (isset($rows['check']) == 1){
	                        ?>
                            <tr>
                                <h1>房型選擇</h1>
                                <h2><?=$rows['MethodM1_title'];?></h2>
                                <ul>
								<?php
									if (count($rows['Roomm1']) > 0){
									foreach ($rows['Roomm1'] as $row){
										if ($row['sort'] != ""){
										$j ++;
								?> 
                                    <li>
                                        <span><?=$row['sort'];?></span>
                                        <?php
                                            if (isset($row['RoomM1_nm'])){
                                                echo $row['RoomM1_nm'];
                                            }
                                        ?>
                                    </li>
								<?php 	}
									}
									}
								?>
                                </ul>
                            </tr>
                            <?php }
	                            }
	                            }
                            ?>
                        </table>
                    </td>
                    <td class="topics" valign="top">
                        <table>
                            <tr valign="top">
                                <td class="lil">策展主題</td>
                                <td class="lir_title"><?=$model->showtitle;?></td>
                            </tr>
                            <tr valign="top">
                                <td class="lil">策展說明</td>
                                <td class="lir"><?=nl2br($model->showscript);?></td>
                            </tr>
                        </table>
                        </td>
                </table>
            </tbody>
        </table>
    </div>
    -->
    <!-- 申請藝術家資料  -->
	<?php 
		if (count($model->Galleryt1) > 0){
		foreach ($model->Galleryt1 as $i => $row){
			$Joins = array();
			if (count($MethodMain) > 0){
			foreach ($MethodMain as $j => $Methods){
				$Program = json_decode($row->Program);
				if ((string)array_search($Methods->MethodM1_no, $Program) != ''){
					array_push($Joins,$Methods->MethodM1_title);
				}
			}	
			}
	?>
    <div class="page">
        <div class="serial"><span>Seral: <?=$model->id;?></span></div>
        <table>
            <tr>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td style="text-align: left;font-size:18px"><?=$row->name;?>&nbsp;<?=$row->name_en;?><br><?=date('Y')-$row->birthyear;?>歲 / <?=$row->country;?></td>
                        <td style="text-align: left;font-size:14px">參展方案︰</br>
		                                    <?php
				                            for($x = 0; $x < count($Joins); $x++) {
											    echo $Joins[$x];
											    if ($x < count($Joins) - 1)echo "、";
											}
		                                	?>
                        </td>
                        <td style="text-align:right;font-size:22px; " class="bdr1px"><?=$model->name;?>&nbsp;<?=$model->name_en;?></td>
                        <td style="text-align: right;font-size:14px "><?=$model->galleryyear;?></br><?=$model->country . "." . $model->city;?></td> 
                    </tr>
                </table>
            </tr>
            <tr>
                <table width="1024" class="bdb1px exp">
                    <tr valign="top">	                    
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">學歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list"><p><?=nl2br($row->jointex);?></p></div>
                                    </tr>
                                </td>
                            </table>
                        </td>
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">個展/聯展經歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list"><p><?=nl2br($row->personalex);?></p></div>
                                    </tr>
                                </td>
                            </table>
                        </td>
                        <td>
                            <table>
                                <td>
                                    <tr>
                                        <div class="title">獲獎/典藏經歷</div>
                                    </tr>
                                    <tr>
                                        <div class="list"><p><?=nl2br($row->prize);?></p></div>
                                    </tr>
                                </td>
                            </table>
                        </td>
                    </tr>
                </table>
            </tr>
            <tr valign="top">
                <table class="work" width="1024" valign="top">
                    <tr valign="top">
						<?php if ($row->datafile1 != ''){?>        
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile1;?>);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name"><?=$row->dataname1.$row->dataname_en1;?></div>
                                        <div class="size"><?=$row->datasize1;?></div>
                                        <div class="material"><?=$row->datamedia1;?></div>
                                        <div class="year"><?=$row->datayear1;?></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php }?>
						<?php if ($row->datafile2 != ''){?>        
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile2;?>);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name"><?=$row->dataname2.$row->dataname_en2;?></div>
                                        <div class="size"><?=$row->datasize2;?></div>
                                        <div class="material"><?=$row->datamedia2;?></div>
                                        <div class="year"><?=$row->datayear2;?></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php }?>
						<?php if ($row->datafile3 != ''){?>        
                        <td valign="top">
                            <table class="work-info">
                                <tr>
                                    <td>
                                        <div class="image" style="background-image: url(<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['art'] . $row->datafile3;?>);"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="name"><?=$row->dataname3.$row->dataname_en3;?></div>
                                        <div class="size"><?=$row->datasize3;?></div>
                                        <div class="material"><?=$row->datamedia3;?></div>
                                        <div class="year"><?=$row->datayear3;?></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php }?>
                    </tr>
                </table>
            </tr>

        </table>
    </div>
    <?php }
        }
        
        if (count($model->Galleryt1) <= 0){
           echo '無藝術家資料'; 
        }
    ?>