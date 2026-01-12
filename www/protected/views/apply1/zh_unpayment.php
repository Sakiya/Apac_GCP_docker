<!--menu-->
<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right page_done">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">立即繳費！</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好</h3>
                            <div class="discription">
                                感謝您申請 ONE ART Taipei <?=$this->Year->Yearm1_year;?> ! <br/>
                                提醒您，您的報名尚未完成。請於報名截止日 <?=(new DateTime($this->Year->Yearm1_open1ed))->format('Y/m/d');?> 前完成保證金繳交(一個展位需繳交保證金NTD10,000)，保證金付款完成後才算報名完成喔！若您已完成匯款，
                                請將匯款單掃描後e-mail至info@onearttaipei.com。<br/>
                                匯款資訊如下：<br>
                                銀行：永豐銀行 敦南分行(807)<br>
                                戶名：亞太連線藝術有限公司<br>
                                帳號：009-018-0032523-3<br><br>
                                信用卡刷卡如下：<br>
                                完成信用卡授權書後，掃描並e-mail至info@onearttaipei.com。
                            </div>
                            <div class="discription">
                                ATM匯款如下:<br>
                                請確保匯出款項已另加上銀行轉帳匯費，匯款入帳金額應為以上實際相同金額。
                                匯款單上請註明須開立發票之 公司名稱 與 統一編號。
                            </div>
                            <div class="discription">
                                報名及繳款完成後將會收到ONE ART Taipei執行委員會的報名成功通知信件，
                                若於三日內未收到任何確認郵件，請儘速向執委會確認。
                            </div>
                            <div class="discription"><br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>