        <div class="left-menu">
            <?php $this->renderPartial('/layouts/menu_data2'); ?> 
        </div>
<!--登出時間-->
        <?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container">
                <form action="<?=$this->createUrl('/apply2/review_next/',array('language'=>Yii::app()->language))?>" id="apply6">
                    <div class="title">Confirmation of Campaign Information</div>
                    <h5>Please confirm the following information given is true, complete, and accurate.</h5>
                    <!-- 1-->
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">
                                    <h2> 1.Gallery Information Confirmation</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/info/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th> Gallery Name</th>
                                <td> <?=$model->name_en;?> <?=$model->name;?></td>
                            </tr>
                            <tr>
                                <th> Gallery Established Time</th>
                                <td> <?=$model->galleryyear . "," . $model->gallerymonth;?></td>
                            </tr>
                            <tr>
                                <th> Director Name</th>
                                <td> <?=$model->bossname;?> <?=$model->bossname_en;?></td>
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
                                <th> Email</th>
                                <td> <?=$model->Gallerym1_email;?></td>
                            </tr>
                            <tr>
                                <th> Nationality / City</th>
                                <td> <?=$model->country . " / " . $model->city;?></td>
                            </tr>
                            <tr>
                                <th> Gallery Address (Chinese)</th>
                                <td> <?=$model->address;?></td>
                            </tr>
                            <tr>
                                <th> Gallery Address (EN)</th>
                                <td> <?=$model->address_en;?></td>
                            </tr>
                            <tr>
                                <th> Website</th>
                                <td> <?=$model->websiteurl;?></td>
                            </tr>
                            <tr>
                                <th> Social Account </th>
                                <td> 
                                    <?=$model->Facebook ? 'Facebook：'.$model->Facebook.'</br>' : ''?>
                                    <?=$model->Twitter ? 'Twitter：'.$model->Twitter.'</br>' : ''?>
                                    <?=$model->Instagram ? 'Instagram：'.$model->Instagram.'</br>' : ''?>
                                    <?=$model->weibo ? 'weibo：'.$model->weibo.'</br>' : ''?>
                                    <?=$model->Youtube ? 'Youtube：'.$model->Youtube.'</br>' : ''?>
                                </td>
                            </tr>
                            <tr>
                                <th> Company</th>
                                <td> <?=$model->companyname;?></td>
                            </tr>
                            <tr>
                                <th> Represented Artist</th>
                                <td> <?=nl2br($model->actingartist);?></td>
                            </tr>
                            <tr>
                                <th> Exhibiting Artist</th>
                                <td> <?=nl2br($model->exhibitionartist);?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!--2        -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <h2> 2. Campaign Activity - ONE ART Award</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/award/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$model->Award){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                Not Participating
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
                                            <span class="artist"><?=($Galleryt1->name != '' ? $Galleryt1->name . ' / ' : "" ) . $Galleryt1->name_en . ' / ' . $Galleryt1->birthyear . ' / ' . $Galleryt1->country;?></span>
                                        <?php }?>
                                        <span class="titl"><?=$model->Award->workname_en;?> <?=$model->Award->workname;?></span>
                                        <span class="details">
                                            <span class="size"><?=$model->Award->datasize;?></span>
                                            <span class="meterialCh"><?=$model->Award->media;?></span>
                                            <span class="meterialEn"><?=$model->Award->media_en;?></span>
                                            <span class="workYear"><?=$model->Award->year;?></span>   
                                        </span>
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
                                    <h2>3. Campaign Activity - Best Buy 3,000 USD</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/usd300/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($model->WorkUsd) <= 0){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                Not Participating
                                </th>
                            </tr> 
                            <?php }?> 
                            <?php 
                            if (count($model->WorkUsd) > 0){
                                foreach ($model->WorkUsd as $Work){
                            ?>
                            <tr class="updatedDetails">
                                <td class="updatedDetails-item" colspan="2">
                                    <span class="listItem">1</span>
                                    <span class="workImg"><img src="<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['usd300'] . $Work->pic;?>" alt=""></span>
                                    <span class="workDetails">
                                        <span class="artist"><?=($Work->Galleryt1->name ? ' / ' . $Work->Galleryt1->name : "") . $Work->Galleryt1->name_en . ' / ' . $Work->Galleryt1->birthyear . ' / ' . $Work->Galleryt1->country;?></span>
                                        <span class="titl"><?=$Work->workname_en;?> <?=$Work->workname;?></span>
                                        <span class="details">
                                            <span class="size"><?=$Work->datasize;?></span>
                                            <span class="meterialCh"><?=$Work->media;?></span>
                                            <span class="meterialEn"><?=$Work->media_en;?></span>
                                            <span class="workYear"><?=$Work->year;?></span>
                                            <span class="workLink">
                                                link︰<a target="_blank" href="<?=$Work->link;?>">連結網址</a>
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
                                    <h2>4. Images for Marketing Campaign</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/Marketing/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($model->WorkMarket) <= 0){?>
                            <tr class="notUpdateAny">
                                <th colspan="2" style="border-bottom: 2px solid #333;">
                                Not Participating
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
                                        <span class="artist"><?=($Work->Galleryt1->name ? ' / ' . $Work->Galleryt1->name : "") . $Work->Galleryt1->name_en . ' / ' . $Work->Galleryt1->birthyear . ' / ' . $Work->Galleryt1->country;?></span>
                                        <span class="titl"><?=$Work->workname_en;?> <?=$Work->workname;?></span>
                                        <span class="details">
                                            <span class="size"><?=$Work->datasize;?></span>
                                            <span class="meterialCh"><?=$Work->media;?></span>
                                            <span class="meterialEn"><?=$Work->media_en;?></span>
                                            <span class="workYear"><?=$Work->year;?></span>
                                            <span class="workDes"><?=nl2br($Work->content1);?></span>
                                            <span class="workLink">
                                                link︰<a target="_blank" href="<?=$Work->link;?>">連結網址</a>
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
                                    <h2>5. Selected Artwork for Catalogue</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/print/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
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
                                        <span class="artist">File Name：<?=$model->spissue_pic;?></span>
                                        <span class="workDes"><?=$model->spissue_text;?></span>
                                        <span class="workLink">
                                            link︰<a target="_blank" href="<?=$model->spissue_link;?>">連結網址</a>
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
                                    <h2>6. VIP Card Mailing List</h2>
                                </th>
                                <th>
                                    <a class="edit-btn" href="<?=$this->createUrl('/apply2/vip/',array('language'=>Yii::app()->language));?>">
                                        <div class="fa fa-pencil">Edit</div>
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
                                    <span class="ticketTtl">VVIP Card  <span class="txt-sm">OAT committee will send out 1 VVIP card to the guest  you provided below</span></span>
                                    <?php }?>
                                    <?php if ($item->type == 2 && !$showVIP){
                                        $showVIP = true;
                                    ?>
                                    <span class="ticketTtl">VIP Card  <span class="txt-sm">OAT committee will send out 5 VIP cards to the guest list you provided below</span></span>
                                    <?php }?>
                                    <span class="ticketCont">
                                        <table>
                                            <tr>
                                                <th>Company/Title</th>
                                                <td><?=$item->company;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Guest Name</th>
                                                <td><?=$item->name;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Contact Number</th>
                                                <td><?=$item->tel;?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>Zip code & Address</th>
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
                    <div class="btn-group"><button class="inlin-blk btn-green" type="sumbit">Confirm</button></div>
                </form>
            </div>
        </div>
    <script>
        $('#apply6').parsley();
    </script>