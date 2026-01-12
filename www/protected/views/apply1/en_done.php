<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">Success！</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> Dear <?=$model->name_en;?></h3>
                              
                            <div class="discription">Your application and deposit of ONE ART Taipei <?=$this->Year->Yearm1_year;?>  have been received. We will contact you directly if there is any updates.</div>
                            <!--
                            <div class="discription">Kindly Reminder that you are able to revisit the link below to edit submitted application until <?=(new DateTime($this->Year->Yearm1_open1ed))->format('d, M Y');?>.</div>
                            -->
                            <div class="btn-black"><a target="_blank" href="<?php echo $this->createUrl('/fill/apply1_print/',array('language'=>Yii::app()->language));?>">Preview submitted application or print</a></div>
                            <div class="discription">Regards,<br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> Committee</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>