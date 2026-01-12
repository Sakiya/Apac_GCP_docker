        <!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
        <?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="payController">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply7',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'name'=>'myForm',
					'novalidate'=>'novalidate'
				),
            )); ?>
            <input type="hidden" id="no" name="no" value="<?=$model->Gallerym1_no;?>">
                    <div class="title">Deposit Payment Options</div>
                    <h5>
                    A US$500 deposit is required for each booth along with your application materials. 
                    If you’re applying for two booths, the booth deposit will be US$1000.  If admitted, 
                    the deposit will be deducted directly from the booth fee. 
                    If rejected, the ONE ART Taipei Committee will refund full payment after deducting additional expenses (such as Bank transaction fee). 
                    The deposit is non-refundable for the case of cancelled participation raised by gallery regardless of any reason.
                    </h5>
                    <div class="paymentList">
                        <h4>Payment Options<span style="color:red;">*<span></h4>
                        <div class="greenbox">
                            <div class="whiteTitle">Payment by Remittance</div>
                            <div class="discrition">Note: The international transaction fee should be added onto the payment by exhibitors.</div>
                            <!--<h2> USD $700</h2>-->
                            <div class="checkbox checkbox-custom">
                                <?=$form->checkBox($zPay,'pay_method',$htmlOptions = array('ng-true-value'=>"'AT'", 'value'=>'AT','class'=>'onlyOne-check','ng-model'=>'data.pay_method','ng-required'=>'isOptionsRequired()','data-parsley-required-message'=>"此欄爲必填")); ?>
                                <label></label>
                            </div>
                        </div>
                        <div class="greenbox">
                            <div class="whiteTitle">Payment by Credit card</div>
                            <div class="discrition">Please fill out the Credit Card Payment Authorization Form and email back</div>
                            <!--
                            <h2> NTD 20,000</h2>
                            -->
                            <div class="checkbox checkbox-custom">
                                <?=$form->checkBox($zPay,'pay_method',$htmlOptions = array('ng-true-value'=>"'CR'", 'value'=>'CR','class'=>'onlyOne-check','ng-model'=>'data.pay_method','ng-required'=>'isOptionsRequired()','data-parsley-required-message'=>"此欄爲必填")); ?>
                                <label></label>
                            </div>
                        </div>
                    </div>
                    <table class="table" ng-show="data.pay_method == 'AT'">
                        <!--填寫付款資訊-->
                        <tbody>
                            <tr>
                                <th>Fill in payment information (All fields are required for accounting purpose)
                                    <!--<br><div class="small-text">所有欄位爲必填</div>-->
                                </th>
                                <td class="control-group">
                                    <label>Account Name<span style="color:red;">*<span></label>
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
                                    <label>Bank Name<span style="color:red;">*<span></label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'paybank_bank',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_bank','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_bank]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>Account Number<span style="color:red;">*<span></label>
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
                                <th>Fill in refund information (All fields are required for the refund)</th>
                                <td class="control-group">
                                    <label>Account Name<span style="color:red;">*<span></label>
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
                                    <label>Bank Name<span style="color:red;">*<span></label>
                                    <div class="controls">
                                        <?php echo $form->textField($zPay,'returnbank_bank',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_bank','ng-required'=>'data.pay_method=="AT"','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_bank]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>Account Number<span style="color:red;">*<span></label>
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
                            <tr><td>Note: Please fill out the Credit Card Payment Authorization Form and send an scanned copy to info@onearttaipei.com</td></tr>
                            <tr><td class="center"><a href="/main/Credit Card Payment Authorization Form.pdf" download type="button">Download Credit Card Payment Authorization Form</a></td></tr>
                        </tbody>
                    </table>
                <div class="btn-group">
                    <button class="btn-green" type="button" ng-click="submitted(myForm.$valid)" >Save</button>
                </div>
			<?php $this->endWidget(); ?>
        </div>
    <script>
        $('#apply7').parsley();

        //form validator
        (function() {

            var validator = angular.module('validator', []);

            validator.controller('payController', ['$scope', '$http', function ($scope, $http) {
                $scope.model = "zPay",
                $scope.submitChecked = false,
                $http.get('/<?=Yii::app()->language;?>/fill/ajax_pay')
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
                    //console.log($('#apply7').serialize());
                    $.post(
                        '/<?=Yii::app()->language;?>/post/ATMPayment_en/',
                        $('#apply7').serialize(),
                        function(xml){
                            var _xml = JSON.parse(xml);
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