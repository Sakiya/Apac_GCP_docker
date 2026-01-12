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
                    <div class="title">繳交參展費用！</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好,</h3>
                            <div class="discription">感謝您撥冗完成 ONE ART Taipei <?=$this->Year->Yearm1_year;?> 行銷資料!<br>提醒您，您的報名尚未完成，請於報名截止日 <?=(new DateTime($this->Year->Yearm1_payed2))->format('Y/m/d');?> 前完成保證金匯款，匯款程序完成後才會算完成報名喔！若您已完成匯款，請將匯款單掃描後e-mail至info@onearttaipei.com</div>
                            <div class="discription">
                                匯款資訊如下：<br>
                                銀行：永豐銀行(807)<br>
                                戶名：亞太連線藝術有限公司<br>
                                帳號：009-018-0032523-3<br>
                                保證金金額：NTD $<?=number_format($model->pay_total);?>
                            </div>
                            <div class="discription font13">
                                ＊請確保匯出款項已另加上銀行轉帳匯費，匯款入帳金額應為以上實際相同金額。<br>
                                ＊匯款單上請註明須開立發票之 公司名稱 與統一編號。
                            </div>
                            <div class="discription font13">
                                請於匯款完成後將匯款單掃描後e-mail至<a href="mailto:info@onearttaipei.com">info@onearttaipei.com</a>。報名完成後將會收到ONE ART Taipei執行委員會的報名成功通知信件，若於三日內未收到任何確認郵件，請儘速向委員會確認。
                            </div>
                            <div class="discription"><br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>