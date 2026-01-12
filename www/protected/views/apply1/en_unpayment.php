<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">Submit Your Deposit!</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> Dear <?=$model->name_en;?></h3>
                            <div class="discription">
                                Your application is still incomplete. Please submit your payment by <?=(new DateTime($this->Year->Yearm1_open1ed))->format('Y/m/d');?> to complete the application of ONE ART Taipei <?=$this->Year->Yearm1_year;?> !
                            <br/>
                            </div>
                            <div class="discription">
                            The account information is provided below:<br/>
                            Bank Name:BANK SINOPAC<br/>
                            Bank Address:9F., No.36, Sec.3, Nanjing E. Rd., Taipei, Taiwan<br/>
                            Swift Code:SINOTWTP<br/>
                            Account Name:Asia Pacific Artlink Co., Ltd.<br/>
                            Account Number:009-008-0009355-1<br/><br/>
                            Payment by credit :<br/>
                            Please fill out the credit card authorization form and send a scanned copy to info@onearttaipei.com
                            </div>
                            <div class="discription">
                            The international transaction fee should be added onto the payment by exhibitors. ONE ART Taipei Committee will be receiving the exact amount of US$500 or US$1000 as indicated.
Please note down the name of your gallery on the electronic funds transfer (EFT) information sheet.<br/><br/>

                            Please send your remittance files to  info@onearttaipei.com. Once both your deposit and application are submitted, you will receive confirmation email from ONE ART Taipei Committee. 
                            </div>
                            
                            <div class="discription">
                                Thank you for applying for ONE ART Taipei <?=$this->Year->Yearm1_year;?>!
                                <br><br>
                                Best Regards,<br>
                                ONE ART Taipei <?=$this->Year->Yearm1_year;?> Committee</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>