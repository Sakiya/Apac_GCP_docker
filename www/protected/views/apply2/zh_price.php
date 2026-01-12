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
                    <div class="title">參展方案及費用確認</div>
                    <h5>請確認下列報名房型及展位費金額，並麻煩您於 <?=(new DateTime($this->Year->Yearm1_payed2))->format('Y/m/d');?> 前完成展位費用匯款，
                        若您已完成匯款，請將匯款單掃描後e-mail至 <a href="mailto:info@onearttaipei.com">info@onearttaipei.com</a>。<br>                        
                        <div class="transformBox">
                            匯款資訊<br>
                            銀行： 永豐銀行 敦南分行 (807)<br>
                            戶名： 亞太連線藝術有限公司<br>
                            帳號： 009-018-0032523-3<br>
                            <br>
                            請確保匯出款項已另加上銀行轉帳匯費，匯款入帳金額應為以下實際相同金額。
                        </div>
                    </h5>
                    <!--確認方案及費用-->
                    <div class="checkTable">
                        <table class="tableList">
                            <tr>
                                <th>參展方案</th>
                                <th>報名房型</th>
                                <th>房型尺寸</th>
                                <th>數量</th>
                                <th class="text-right">費用</th>
                            </tr>
                            <?php foreach ($Room as $item){?>
                            <tr>
                                <td><?=$item->Methodm1->MethodM1_title;?></td>
                                <td><?=$item->RoomM1_nm;?></td>
                                <td><?=$item->RoomM1_size;?></td>
                                <td>1</td>
                                <td class="text-right">NTD <?=number_format($item->RoomM1_price);?></td>
                            </tr>
                            <?php }?>
                        </table>
                        <div class="payTotal">
                            <div class="font18">
                                <span>總計</span> <span class="payMoney">NTD <?=number_format($item->RoomM1_price);?></span>
                            </div>
                            <div class="font18">
                                <span>扣除保證金</span> <span class="payMoney">NTD 10,000</span>
                            </div>
                            <div class="font18">
                                <span>實際支付</span> <span class="payMoney">NTD <?=number_format($item->RoomM1_price-10000);?></span>
                            </div>
                        </div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" value="1" type="checkbox" ng-model="agree">
                        <label for="read">我已確認參展方案、報名房型及繳費金額無誤</label>
                    </div>
                    <div class="btn-group">
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/info/',array('language'=>Yii::app()->language))?>">回上一單元修改資料</a>
                        <button class="btn-green inlin-blk" ng-disabled="!agree" type="button" ng-click="register()">下一步</button>
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