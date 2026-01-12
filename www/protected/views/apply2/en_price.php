    <div class="left-menu">
        <?php $this->renderPartial('/layouts/menu_data2'); ?> 
    </div>
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="applyController">
                <?php echo CHtml::beginForm('/', 'post', array('role'=>'form','class'=>'applyTable','name'=>'myForm','id'=>'apply','novalidate'=>'novalidate','ng-submit'=>'register();')) ; ?>
                <form action="" class="applyTable" name="myForm" novalidate>
                    <div class="title">Sector and Booth fee Confirmation (Required)</div>
                    <h5>
                        <!--Please confirm your sector/room type, and submit exhibit booth fee as indicated below by <?=(new DateTime($this->Year->Yearm1_payed2))->format('y/m/d');?>! If you have wired the payment, please fax your remittance files to +886-2-2325-9380, or email it to  <a href="mailto:info@onearttaipei.com">info@onearttaipei.com</a>. Thank you for your cooperation!-->
                        Please confirm below selected room type and booth fee amount. Friendly Reminder, the deadline for booth fee is on November 15th. If you have submitted the deposit, please email the remittance slip to<a href="mailto:info@onearttaipei.com">info@onearttaipei.com</a>
                        
                        <div class="transformBox">
                            <b>Bank Name:</b>  BANK SINOPAC<br>
                            <b>Bank Address:</b>  9F., No.36, Sec.3, Nanjing E. Rd., Taipei, Taiwan<br>
                            <b>Swift Code:</b>  SINOTWTP<br>
                            <b>Account Name:</b>  Asia Pacific Artlink Co., Ltd.<br>
                            <b>Account Number:</b>  009-008-0009355-1<br>
                            <b>Account Address:</b> 10F., No. 221, Sec. 4, Zhongxiao E. Rd., Da’an Dist., Taipei City 106448 , Taiwan<br>
                            <b>Company Telephone Number:</b>  +886-2-2325-9390<br>
                            <ul style="list-style: disc;padding-left: 20px;">
                                <li>The international transaction fee should be added onto the payment by exhibitors. ONE ART Taipei Committee will be receiving the exact same amount of exhibit booth fee as indicated.</li>
                                <li>Please note down the name of your gallery on the electronic funds transfer (EFT) information sheet.</li>
                                <li>The actual amount of received deposit  will be deducted. Please refer to the invoice in the admission notice sent by OAT through email.</li>
                            </ul>
                            
                        </div>
                    </h5>
                    <!--確認方案及費用-->
                    <div class="checkTable">
                        <table class="tableList">
                            <tr>
                                <th>Sector</th>
                                <th>Selected Room Type</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th class="text-right">Fee</th>
                            </tr>
                            <?php foreach ($Room as $item){?>
                            <tr>
                                <td><?=$item->Methodm1->MethodM1_title_en;?></td>
                                <td><?=$item->RoomM1_nm_en;?></td>
                                <td><?=$item->RoomM1_size_en;?></td>
                                <td>1</td>
                                <td class="text-right">USD <?=number_format($item->RoomM1_price_en);?></td>
                            </tr>
                            <?php }?>
                        </table>
                        <div class="payTotal">
                            <div class="font18">
                                <span>Subtotal</span> <span class="payMoney">USD <?=number_format($item->RoomM1_price_en);?></span>
                            </div>
                            <div class="font18">
                                <span>Deposit Received</span> <span class="payMoney">USD 500</span>
                            </div>
                            <div class="font18">
                                <span>Total</span> <span class="payMoney">USD <?=number_format($item->RoomM1_price_en-500);?></span>
                            </div>
                            <!-- <p class="font13">*One breakfast set will be provided for each exhibitor per day. If you would like to request additional breakfast, The Sherwood Taipei will charge the additional fee from you directly(One breakfast set is NT$400元(Original Price 700+10%) per person).<br/>Further arrangement will be announced at the next stage.</p> -->
                        </div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" value="1" type="checkbox" ng-model="agree">
                        <label for="read">I've confirmed the selected room type and exhibit booth fee are all correct.</label>
                    </div>
                    <div class="btn-group">
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/info/',array('language'=>Yii::app()->language))?>">Go back to previous page</a>
                        <button class="btn-green inlin-blk" ng-disabled="!agree" type="button" ng-click="register()">Save and Next</button>
                    </div>
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
        <script type="text/javascript">
        //form validator
        (function() {

            var validator = angular.module('validator', []);

            validator.controller('applyController', ['$scope', '$http', function ($scope, $http) {
                $http.get('<?=$this->createUrl('/data2/ajax_price/',array('language'=>Yii::app()->language))?>').success(function(response){
				            var data = response;
				            //console.log(data);
				            $scope.data = data;
							if ($scope.data.finishStep2_3 == '1'){
								$scope.agree = true;
							}else{
								$scope.agree = '';
							}
				        });
                        $scope.register = function() {
	                    $.post(
		                    '<?=$this->createUrl('/apply2/price/',array('language'=>Yii::app()->language))?>',
		                    $('#apply').serialize(),
		                    function(xml){
			                    var _xml = JSON.parse(xml);
			                    console.log(_xml)
			                    if (_xml.resu){
				                    window.location = _xml.url;
			                    }
		                    }
	                    )
	                };
            }]);

        })();
    </script>