        <!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
        <?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="payController">
            <?php 
            $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply7',
                'enableClientValidation'=>true,
                //'action'=>'/'.Yii::app()->language.'/post/atmpayment/',
                //'action'=>'https://sandbox.sinopac.com/SinoPacWebCard/Pages/PageRedirect.aspx',
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'name'=>'myForm',
                    'novalidate'=>'novalidate',
				),
            )); 
            ?>
            <?php //echo CHtml::beginForm('', 'post', array('role'=>'form','name'=>'myForm','id'=>'apply7', 'class'=>'applyTable','novalidate'=>'novalidate','enableAjaxValidation'=>false, 'novalidate'=>true,'ng-submit'=>'submit1();')) ; ?>
            <input type="hidden" id="no" name="no" value="<?=$model->Gallerym1_no;?>">
                    <div class="title">預繳保證金</div>
                    <h5>提交申請表的同時，申請畫廊報名一個展位需繳金交保證金費NTD10,000，兩個展位則須繳交NTD20,000，以此類推。未錄取畫廊將扣除相關手續費用後，退回保證金；入選畫廊之保證金將自展位費折抵，若因故退出，則不予退回。</h5>
                    <div class="paymentList">
                        <h4>選擇付款方式<span style="color:red;">*<span></h4>
                        <div class="greenbox">
                            <div class="whiteTitle">ATM匯款</div>
                            <div class="discrition">提醒: 請確保匯出款項已另加上銀行轉帳匯費，匯款入帳金額應為以上實際相同金額。</div>
                            <div class="checkbox checkbox-custom">
                                <?=$form->checkBox($zPay,'pay_method',$htmlOptions = array('ng-true-value'=>"'AT'", 'value'=>'AT','class'=>'onlyOne-check','ng-model'=>'data.pay_method','ng-required'=>'isOptionsRequired()','data-parsley-required-message'=>"此欄爲必填")); ?>
                                <label></label>
                            </div>
                            <!--
                            <h2> NTD 20,000</h2>
                            <div class="checkbox checkbox-custom">
                                <input class="onlyOne-check" id="pay2" type="checkbox" name="check2" ng-model="agree">
                                <label></label>
                            </div>
                            -->
                        </div>
                        <div class="greenbox">
                            <div class="whiteTitle">信用卡刷卡</div>
                            <div class="discrition">填寫信用卡授權同意書並e-mail回傳</div>
                            <!--
                            <h2> NTD 20,000</h2>
                            -->
                            <div class="checkbox checkbox-custom">
                                <?=$form->checkBox($zPay,'pay_method',$htmlOptions = array('ng-true-value'=>"'CR'", 'value'=>'CR', 'class'=>'onlyOne-check','ng-model'=>'data.pay_method','ng-required'=>'isOptionsRequired()','data-parsley-required-message'=>"此欄爲必填")); ?>
                                <label></label>
                            </div>
                        </div>
                        <div class="parsley-errors-list filled">
                            <span class="error validationerror" ng-show="myForm['{{model}}[pay_method]'].$error.required && submitChecked">此欄爲必填</span>
                        </div>
                    </div>
                    <table class="table" ng-show="data.pay_method == 'AT'">
                        <!--填寫付款資訊-->
                        <tbody>
                            <tr>
                                <th>預填付款資訊<span style="color:red;">*<span><br>
                                    <div class="small-text">所有欄位為必填，以方便對帳作業</div>
                                </th>
                                <td class="control-group">
                                    <label>姓名</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'paybank_name',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_name','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 姓名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_name]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
                                    <label>付款銀行</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'paybank_bank',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_bank','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_bank]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>帳戶號碼</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'paybank_account',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_account','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_account]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>   
                    <table class="table" ng-show="data.pay_method == 'AT'">
                        <!--填寫退款資訊-->
                        <tbody>
                            <tr>
                                <th>預填退款資訊<span style="color:red;">*<span><br>
                                    <div class="small-text">所有欄位為必填，以方便退款作業</div>
                                </th>
                                <td class="control-group">
                                    <label>姓名</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'returnbank_name',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_name','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 姓名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_name]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
                                    <label>退款銀行</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'returnbank_bank',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_bank','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_bank]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>帳戶號碼</label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'returnbank_account',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_account','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_account]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" ng-show="data.pay_method == 'CR'">
                        <!--填寫退款資訊-->
                        <tbody>
                            <tr><td>提醒:請詳填信用卡授權同意書並e-mail至info@onearttaipei.com。</td></tr>
                            <tr><td class="center"><a href="/main/信用卡授權同意書.pdf" download type="button">下載信用卡授權書</a></td></tr>
                        </tbody>
                    </table>
                <div class="btn-group">
                    <button class="btn-green" type="button" ng-click="submitted(myForm.$valid)" >取得匯款資訊</button>
                </div>
			    <?php $this->endWidget(); ?>
                <?php //echo CHtml::endForm() ; ?>
            </div>
    <script>
        $('#apply7').parsley();

        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('payController', ['$scope', '$http', function ($scope, $http) {
                $scope.model = "zPay",
                $scope.submitChecked = false,
                $http.get('/zh/fill/ajax_pay')
				        .success(function(response){
				            var data = response;
				            $scope.data = data;
				        });
                $scope.submitted = function(validation){
						if (validation){
							$('#apply7').submit();
						}else{
							$scope.submitChecked = true;
						}
					};
                $scope.isOptionsRequired = function(){
                    if ($scope.data.pay_method == 'AT' || $scope.data.pay_method == 'CR'){
                        return false;
                    }
                    return true;
                } 
                $scope.submit1 = function() {
                    $.post(
                        '/<?=Yii::app()->language;?>/post/ATMPayment/',
                        $('#apply7').serialize(),
                        function(xml){
                            var _xml = JSON.parse(xml);
                            //console.log(xml);
                            if (_xml.status == 'success'){
                                window.location.reload();
                            }else{
                                if (_xml.message != ""){
                                    alert("錯誤：" + _xml.message + " 請洽客服人員");
                                }else{
                                    alert("請洽客服人員");
                                }
                            }
                        }
                    )
                };
            }]);

        })();
    </script>
<style >
.applyTable .table tr td.center{
    display: flex;
    justify-content: unsafe;
    margin-top: 10px;
    margin-bottom: 20px;
    justify-content: center;
}
.applyTable .table tr td.center a{
    padding: 10px;
    background-color: #83DEC1;
    color:white;
}
</style>