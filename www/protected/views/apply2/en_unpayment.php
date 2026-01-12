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
                    <div class="title">Submit Your Deposit!</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> Dear <?=$model->name;?></h3>
                            <div class="discription">
                                 Your application is still incomplete. Please submit your payment by <?=(new DateTime($this->Year->Yearm1_payed2))->format('Y/m/d');?>  to complete the application of ONE ART Taipei <?=$this->Year->Yearm1_year;?>  !<br>
                            </div>


                            <div class="discription">
                                The account information is provided below:<br>
                                Bank Name:  BANK SINOPAC<br>
                                Bank Address:  9F., No.36, Sec.3, Nanjing E. Rd., Taipei, Taiwan<br>
                                Swift Code:  SINOTWTP<br>
                                Account Name:  Asia Pacific Artlink Co., Ltd.<br>
                                Account Number:  009-008-0009355-1<br>
                                Account Address :  No.191, Sec. 1, Da’an Rd., Da’an Dist., Taipei City 10684<br>
                                Company Telephone Number:  +886-2-2325-9390<br>
                                <!-- 保證金金額：USD $<?=number_format($model->pay_total);?> -->
                            </div>
                            <div class="discription font13">
                                ＊The international transaction fee should be added onto the payment by exhibitors. ONE ART Taipei Committee will be receiving the exact same amount of exhibit booth fee as indicated.。<br>
                                ＊Please note down the name of your gallery on the electronic funds transfer (EFT) information sheet.
                            </div>
                            <div class="discription font13">
                                Please email your remittance files <a href="mailto:info@onearttaipei.com">info@onearttaipei.com</a>. Once both your deposit and application are submitted, you will receive confirmation email from ONE ART Taipei Committee. 

                            </div>
                            <div class="discription">Regards,<br>Thank you for applying ONE ART Taipei <?=$this->Year->Yearm1_year;?> and your cooperation!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>