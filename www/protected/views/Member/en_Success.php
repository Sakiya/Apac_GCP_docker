        <!--menu-->
		<?php $this->renderPartial('/layouts/menu_member'); ?> 
       <!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">Registration Completed</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> Dear <?=$model->name_en;?></h3>
                            <div class="discription">Congratulations! Your ONE ART Taipei account has been activated successfully.</div>
                            <div class="discription">You can now start your application of ONE ART Taipei <?=$this->Year->Yearm1_year;?> online.</div>
                            <div class="btn-black" onclick="window.location='<?php echo $this->createUrl('/Member/index',array('language'=>Yii::app()->language));?>'">Apply Now</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>