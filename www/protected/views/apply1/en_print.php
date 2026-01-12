<!DOCTYPE html>
<html>

<head>
</script>
    <style type="text/css">
 body, table, tr, td, p, ul, li, h1, h2, h3, img{margin: 0; padding: 0; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; border: 0px solid #000;} body{background: rgb(129, 129, 129); text-align: center; margin: 0 auto;} @page{margin: 5mm; /*print邊界*/ size: 297mm 210mm; /*列印紙張大小*/} .page{display: block; width: 1050px; height: 700px; background-color: #fff; page-break-after: always; margin: 10px auto 60px; box-shadow: 0px 5px 30px rgb(80, 80, 80); padding: 15px; /*print分頁面*/} @media print{nav{display: none;} .page{box-shadow: none; padding: 0;} .page .image{background-color: #fff !important; -webkit-print-color-adjust: exact;} } .serial{text-align: right;} .serial span{border: 1px solid #000; padding: 2px; font-size: 14px;} table{border: 0px solid #000;} /* 可被共用元件 */ .lil{text-align: right; padding-right: 10px; font-weight: 500px; width: 70px; font-size: 14px; vertical-align: top;} .lir{text-align: left; font-weight: 100px; font-size: 12px; color: #666; line-height: 20px} .lir br{display: block;} .bdr1px{border-right: 1px solid #000;} .bdb1px{border-bottom: 1px solid #000;} /* Page1、2、3 head_title */ .titlebox{width: 1024px; border-bottom: 2px solid #000; padding: 3px 0px; font-size: 30px;} .titlebox .year_Local td{padding-right: 5px;} /* Page1 畫廊基本資料、2016、2017聯展經歷 */ .info1{padding: 5px 0px; height: 320px;} .info1 table td{padding-top: 0px; padding-bottom: 2px;} /* Page1 參展經歷 */ .history{padding-top: 5px; font-size: 12px;} .history .date{color: #666; font-size: 14px;} /* Page2 房型方案選擇 */ .room{padding-left: 30px; padding-top: 10px;} .room ul{padding: 0 0 20px 0;} .room h1{font-size: 18px; margin: 0 0 5px 0;} .room h2{font-size: 16px; margin: 0 0 5px 0px;} .room li{margin: 0 0 5px 3px; font-size: 16px; list-style-type: none;} .room span{display: inline-block; border-radius: 20px; width: 16px; height: 16px; background-color: #000; padding: 2px; color: #fff; margin-right: 5px; text-align: center; font-size: 14px;} /* Page2 策展理念 */ .topics{padding-right: 30px; padding-top: 10px} .info2{height: 610px;} .info2 .topics .lir_title{font-size: 18px; color: #000; height: auto; padding-bottom: 10px} .info2 .topics .lir{line-height: 22px; text-indent: 14px;} .info2 .topics .lil{font-size: 16px; padding-left: 20px;} .info2 .topics .lir br{content: ""; margin: 2em; display: block; font-size: 24%;} /* Page3展覽經歷*/ .exp{font-size: 12px; height: 200px} .exp table{width: 320px; color: #000;} .exp .title{font-size: 16px; display: block; padding-bottom: 5px; padding-top: 10px;} .exp .list p{font-size: 12px; margin: 0; padding: 0px 10px 0 0; line-height: 22px} /* Page3作品展示說明 */ .work{font-size: 14px;} .work .image{display: inline-block; width: 230px; height: 230px; margin: 0 5px 0 0; background: no-repeat left bottom; background-size: contain} .work .image img{width: auto; /* height: auto; */ min-height: 60%; min-width: 60%; /* max-width: 90%; */ height: 100%; width: auto;} .work .work-info{font-size: 12px; width: 320px;} .work .work-info .image{background-color: #fff; background: center no-repeat bottom; background-size: contain; width: 320px; height: 320px;} .work .work-info .name{color: #000} .work .work-info .year, .size, .material{color: #666;} nav{width: 100%; background: rgba(0, 0, 0, 0.80); position: fixed; bottom: 0; right: 0; /* text-align: right; */ padding-top: 10px; padding-right: 15px; color: #fff} nav button{background-color: rgb(0, 255, 200); border-radius: 5px; border: 0; font-size: 16px; color: rgb(44, 44, 44);}
    </style>
</head>

<body>
    <!-- 申請藝術家資料  -->
    <nav>
        <form>
            <button onclick="window.print();">PRINT</button>
        </form>

    </nav>
    <!-- 畫廊簡介 -->
    <div id="page" class="page">
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
                                    <td class="lil">Director Name</td>
                                    <td class="lir"><?=$model->bossname;?>&nbsp;&nbsp;<?=$model->bossname_en;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">Phone</td>
                                    <td class="lir"><?=$model->tel;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">Fax</td>
                                    <td class="lir"><?=$model->fax;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">Address</td>
                                    <td class="lir"><?=$model->country . $model->city . $model->address;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">Website</td>
                                    <td class="lir"><?=$model->websiteurl;?></td>
                                </tr>
                                <tr>
                                    <td class="lil">Contact</td>
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
                                    Exhibitions History1
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
                                    Exhibitions History2
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
    <!-- 徵件資料 -->
    <div id="page" class="page">
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
                    <!-- 房型 -->
                    <td valign="top" width="200" class="room bdr1px">
                        <table>
	                        <?php 
		                        foreach ($Method as $y => $rows){
			                        $j = 0;
			                        if (isset($rows['check']) == 1){
	                        ?>
                            <tr>
                                <h1>房型選擇</h1>
                                <h2><?=$rows['MethodM1_title_en'];?></h2>
                                <ul>
								<?php
									foreach ($rows['Roomm1'] as $row){
										if ($row['sort'] != ""){
										$j ++;
								?> 
                                    <li><span><?=$row['sort'];?></span>
                                    <?php
                                            if(isset($row['RoomM1_nm'])){
                                                echo $row['RoomM1_nm'];
                                            }
                                    ?>
                                    </li>
								<?php }
									}
								?>
                                </ul>
                            </tr>
                            <?php }
	                            }
                            ?>
                        </table>
                    </td>
                    <!-- 策展主題 -->
                    <td class="topics" valign="top">
                        <table>
                            <tr valign="top">
                                <td class="lil">Exhibition Title</td>
                                <td class="lir_title"><?=$model->showtitle;?></td>
                            </tr>
                            <tr valign="top">
                                <td class="lil">Statement</td>
                                <td class="lir"><?=nl2br($model->showscript);?></td>
                            </tr>
                        </table>
                        </td>
                </table>
            </tbody>
        </table>
    </div>
    <!-- 申請藝術家資料  -->
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
    <div id="page" class="page">
        <div class="serial"><span>Seral: <?=$model->id;?></span></div>
        <table>
            <tr>
                <table class="titlebox">
                    <tr class="year_Local">
                        <td style="text-align: left;font-size:16px"><?=$row->name;?>&nbsp;<?=$row->name_en;?><br><?=date('Y')-$row->birthyear;?> years old / <?=$row->country;?></td>
                        <td style="text-align: left;font-size:14px">Selected Sector︰</br>
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
                                        <div class="title">Education</div>
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
                                        <div class="title">Solo Exhibition / Group Exhibition</div>
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
                                        <div class="title">Awards / Collections</div>
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
                                        <div class="name"><?=$row->dataname_en1;?></div>
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
                                        <div class="name"><?=$row->dataname_en2;?></div>
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
                                        <div class="name"><?=$row->dataname_en3;?></div>
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
    <?php }?>
</body>

</html>