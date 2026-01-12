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
                    <div class="title">行銷活動資料完成</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?> 您好,</h3>
                            <div class="discription">
                                感謝您撥冗完成 ONE ART Taipei <?=$this->Year->Yearm1_year;?> 行銷活動資料!<br>若您對於藝博有任何問題，也請不吝與我們聯繫，謝謝。
                            </div>
                            <div class="discription">
                                謝謝您對 ONE ART Taipei <?=$this->Year->Yearm1_year;?> 的支持!
                            </div>
                            <div class="discription"><br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>