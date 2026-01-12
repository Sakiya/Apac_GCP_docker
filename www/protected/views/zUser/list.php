
    <!-- 申請藝術家資料  -->
    <nav>
        <form action="" method="get">
            <select name="shortlisted" onchange="javascript:location.href = '/zUser/adminlist/?YourLocation=<?=$location;?>&shortlisted='+this.value;">
                <?php foreach(Yii::app()->params['galler_short'] as $i => $row){?>
                    <option value="<?=$i;?>" <?=$shortlisted == $i ? 'selected' : '';?>><?=$row;?></option>
                <?php }?>
			</select>
            <select name="YourLocation" onchange="javascript:location.href = '/zUser/adminlist/?shortlisted=<?=$shortlisted?>&YourLocation='+this.value;">
            <?php 
            if ($EveryCountry){
                foreach($EveryCountry as $i => $row){
            ?>
				<option value="<?=$row['country'];?>" <?=$location == $row['country'] ? 'selected' : '';?>><?=$row['country'];?>（<?=$row['coutryCount'];?>間畫廊、<?=$row['galleryCount'];?>位藝術家）</option>
            <?php 
                }
            }
            ?>
			</select>
            <input type="number" id="gpage" name="gpage" value="<?=$rowRun;?>" min="1" max="<?=$countryCount;?>"> /<?=$countryCount;?> <button type="submit">Go!</button>
            <?php if (isset($prevGallery)){?><button type="button" onclick="location.href ='/zUser/adminlist/?id=<?=$prevGallery;?>&shortlisted=<?=$shortlisted?>&YourLocation=<?=$location;?>'">上一頁</button><?php }?>
            <?php if (isset($nextGallery)){?><button type="button" onclick="location.href ='/zUser/adminlist/?id=<?=$nextGallery;?>&shortlisted=<?=$shortlisted?>&YourLocation=<?=$location;?>'">下一頁</button><?php }?>
        </form>
    </nav>

<?php if ($model){?>
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
           echo $model->name . ' ' . $model->name_en . '- 無藝術家資料'; 
        }
    ?>
<?php }else{
    echo '<a href="/admin/index">無符合資料</a>';
} ?>