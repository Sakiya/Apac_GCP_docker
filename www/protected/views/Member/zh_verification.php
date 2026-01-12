        <!--menu-->
		<?php $this->renderPartial('/layouts/menu_member'); ?> 
        <!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">帳號驗證</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好</h3>
                            <div class="discription">爲確保您的聯絡Email無誤，我們將寄發驗證Email至您提供的Email信箱，請至您的聯絡信箱收取信件，並完成<br>Email驗證！</div>
                            <div class="discription">ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>