        <div class="left-menu">
            <?php $this->renderPartial('/layouts/menu_data2'); ?> 
        </div>
<!--登出時間-->
        <?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container">
                <form action="<?=$this->createUrl('/apply2/review_next/',array('language'=>Yii::app()->language))?>" id="apply6">
                    <div class="title">行銷活動資料確認</div>
                    <h5>請確認以下行銷活動資料無誤。</h5>
                    <!-- 1-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2> 1.畫廊資料</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/info/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> 畫廊名稱</th>
                                <td> <?=$model->name;?> <?=$model->name_en;?></td>
                            </tr>
                            <tr>
                                <th> 成立日期</th>
                                <td> <?=$model->galleryyear . "," . $model->gallerymonth;?></td>
                            </tr>
                            <tr>
                                <th> 負責人</th>
                                <td> <?=$model->bossname;?> <?=$model->bossname_en;?></td>
                            </tr>
                            <tr>
                                <th> 電話</th>
                                <td> <?=$model->tel;?></td>
                            </tr>
                            <tr>
                                <th> 傳真</th>
                                <td> <?=$model->fax;?></td>
                            </tr>
                            <tr>
                                <th> Email</th>
                                <td> <?=$model->Gallerym1_email;?></td>
                            </tr>
                            <tr>
                                <th> 國家 / 城市</th>
                                <td> <?=$model->country . " / " . $model->city;?></td>
                            </tr>
                            <tr>
                                <th> 畫廊地址(中)</th>
                                <td> <?=$model->address;?></td>
                            </tr>
                            <tr>
                                <th> 畫廊地址(英)</th>
                                <td> <?=$model->address_en;?></td>
                            </tr>
                            <tr>
                                <th> 網址</th>
                                <td> <?=$model->websiteurl;?></td>
                            </tr>
                            <tr>
                                <th> 社群帳號</th>
                                <td> 
                                    <?=$model->Facebook ? 'Facebook：'.$model->Facebook.'</br>' : ''?>
                                    <?=$model->Twitter ? 'Twitter：'.$model->Twitter.'</br>' : ''?>
                                    <?=$model->Instagram ? 'Instagram：'.$model->Instagram.'</br>' : ''?>
                                    <?=$model->weibo ? 'weibo：'.$model->weibo.'</br>' : ''?>
                                    <?=$model->Youtube ? 'Youtube：'.$model->Youtube.'</br>' : ''?>
                                </td>
                            </tr>
                            <tr>
                                <th> 公司名稱 / 統一編號</th>
                                <td> <?=$model->companyname;?> / <?=$model->companyid;?></td>
                            </tr>
                            <tr>
                                <th> 代理藝術家</th>
                                <td> <?=($model->actingartist);?></td>
                            </tr>
                            <tr>
                                <th> 展出藝術家</th>
                                <td> <?=($model->exhibitionartist);?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--2        -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2> 2. 新賞獎ONE ART Award</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/award/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$model->Award){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                    未報名
                                </th>
                            </tr> 
                            <?php }?>  
                            <?php if ($model->Award){
                                $Galleryt1 = NULL;
                                if ($model->Award){
                                    $Galleryt1 = $model->Award->Galleryt1;
                                }
                            ?>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item noBorder" colspan="2">
                                    <span class="listItem">1</span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['award'] . $model->Award->workpic1;?>" alt=""></span>
                                    <span class="workDetails">
                                        <?php if ($Galleryt1){?>
                                            <span class="artist"><?=$Galleryt1->name  . ($Galleryt1->name_en ? ' | ' . $Galleryt1->name_en : "" )  . ' | ' . $Galleryt1->birthyear . ' | ' . $Galleryt1->country;?></span>
                                        <?php }?>
                                        <span class="titl"><?=$model->Award->workname;?> <?=$model->Award->workname_en;?></span>
                                        <span class="details">
                                            <span class="size"><?=$model->Award->datasize;?></span>
                                            <span class="meterialCh"><?=$model->Award->media;?></span>
                                            <span class="meterialEn"><?=$model->Award->media_en;?></span>
                                            <span class="workYear"><?=$model->Award->year;?></span>   
                                        </span>
                                        <div class="workYear"><?=nl2br($model->Award->description);?></div>
                                    </span>
                                </td>
                            </tr>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item noBorder" colspan="2">
                                    <span class="listItem"></span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['award'] . $model->Award->pic1;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="addText"><?=$model->Award->content1;?></span>
                                       
                                    </span>
                                </td>
                            </tr>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item noBorder" colspan="2">
                                    <span class="listItem"></span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['award'] . $model->Award->pic2;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="addText"><?=$model->Award->content2;?></span>
                                    </span>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    <!-- 3-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2>3. Best Buy 3,000 USD 收藏入門</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/usd300/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($model->WorkUsd) <= 0){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                    未報名
                                </th>
                            </tr> 
                            <?php }?> 
                            <?php 
                            if (count($model->WorkUsd) > 0){
                                foreach ($model->WorkUsd as $index => $Work){
                            ?>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item" colspan="2">
                                    <span class="listItem"><?=$index+1;?></span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['usd300'] . $Work->pic;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="artist"><?=$Work->Galleryt1->name . ($Work->Galleryt1->name_en ? ' / ' .$Work->Galleryt1->name_en : "" ) . ' / ' . $Work->Galleryt1->birthyear . ' / ' . $Work->Galleryt1->country;?></span>
                                        <span class="titl"><?=$Work->workname_en;?> <?=$Work->workname;?></span>
                                        <span class="details">
                                            <span class="size"><?=$Work->datasize;?></span>
                                            <span class="meterialCh"><?=$Work->media;?></span>
                                            <span class="meterialEn"><?=$Work->media_en;?></span>
                                            <span class="workYear"><?=$Work->year;?></span>  
                                            <span class="workLink">
                                                檔案連結︰<a target="_blank" href="<?=$Work->link;?>">連結網址</a>
                                            </span>    
                                        </span>
                                    </span>
                                </td>
                            </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- 4-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2>4. 活動行銷可使用圖檔</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/Marketing/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($model->WorkMarket) <= 0){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                    未報名
                                </th>
                            </tr> 
                            <?php }?> 
                            <?php 
                            if (count($model->WorkMarket) > 0){
                                foreach ($model->WorkMarket as $i => $Work){
                            ?>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item" colspan="2">
                                    <span class="listItem"><?=$i+1;?></span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['usd300'] . $Work->pic;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="artist"><?=$Work->Galleryt1->name . ($Work->Galleryt1->name_en ? ' / ' .$Work->Galleryt1->name_en : "" ) . ' / ' . $Work->Galleryt1->birthyear . ' / ' . $Work->Galleryt1->country;?></span>
                                        <span class="titl"><?=$Work->workname;?> <?=$Work->workname_en;?></span>
                                        <span class="details">
                                            <span class="size"><?=$Work->datasize;?></span>
                                            <span class="meterialCh"><?=$Work->media;?></span>
                                            <span class="meterialEn"><?=$Work->media_en;?></span>
                                            <span class="workYear"><?=$Work->year;?></span>  
                                            <span class="workLink">
                                                檔案連結︰<a target="_blank" href="<?=$Work->link;?>">連結網址</a>
                                            </span>    
                                        </span>
                                    </span>
                                </td>
                            </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- 5-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2>5. 專刊使用圖檔</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/print/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item" colspan="2">
                                    <span class="listItem">1</span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['print'].$model->spissue_pic;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="artist">上傳檔名：<?=$model->spissue_pic;?></span>
                                        <span class="workDes"><?=$model->spissue_text;?></span>
                                        <span class="workLink">
                                            檔案連結︰<a target="_blank" href="<?=$model->spissue_link;?>">連結網址</a>
                                        </span>   
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- 6-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2>6. 貴賓卡郵寄名單</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/vip/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">修改</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $showVIP = false;
                            foreach ($model->Vipcard as $i => $item){
                                if ($item->company != '' || $item->name != '' || $item->tel != '' || $item->address != '' ){
                            ?> 
                            <tr class="vipTicketBox">
                                <td class="vipTicket-item" colspan="2">
                                    <?php if ($item->type == 1){?>
                                    <span class="ticketTtl">VVIP藏家卡  <span class="txt-sm">大會將協助寄發一張藏家卡</span></span>
                                    <?php }?>
                                    <?php if ($item->type == 2 && !$showVIP){
                                        $showVIP = true;
                                    ?>
                                    <span class="ticketTtl">VIP貴賓卡  <span class="txt-sm">大會將協助寄發五張貴賓卡</span></span>
                                    <?php }?>
                                    <span class="ticketCont">
                                        <table>
                                            <tr>
                                                <th>公司職稱</th>
                                                <td><?=$item->company;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>貴賓姓名</th>
                                                <td><?=$item->name;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>聯絡電話</th>
                                                <td><?=$item->tel;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>郵遞區號＆寄送地址</th>
                                                <td><?=$item->address;?></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </span>
                                </td>
                            </tr>
                            <?php }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="btn-group"><button class="inlin-blk btn-green" type="sumbit">確認</button></div>
                </form>
            </div>
        </div>
    <script>
        $('#apply6').parsley();
    </script>