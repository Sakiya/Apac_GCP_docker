<div class="left-menu">
            <?php $this->renderPartial('/layouts/menu_data2'); ?> 
        </div>
<!--登出時間-->
        <?=$loginInfo;?>
    <!--內文-->
    <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">Confirmation of Campaign Information</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> Dear <?=$model->name_en;?>,</h3>
                            <div class="discription">
                                Thank you for submitting the required campaign information! If you have any further question about the fair, please don't hesitate to contact us. 
                            </div>
                            <div class="discription">
                                Thank you for supporting ONE ART Taipei <?=$this->Year->Yearm1_year;?>!
                            </div>
                            <div class="discription"><br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> Committee</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>