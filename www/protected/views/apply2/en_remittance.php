        <div class="left-menu">
            <?php $this->renderPartial('/layouts/menu_data2'); ?> 
        </div>
<!--登出時間-->
        <?=$loginInfo;?>
<!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="loginController">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply5',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'id'=>'apply7',
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					//'ng-submit'=>"newArticle()",
					'enctype'=>'multipart/form-data',
				),
			)); ?>
                    <div class="title">Confirmation of Account Information</div>
                    <h5></h5>
                    <!--
                    <div class="paymentList">
                        <h4>Deposit Payment Options</h4>
                        <div class="greenbox longStyle">
                            <div class="whiteTitle">Payment by ATM</div>
                            <div class="discrition">Note: The international transaction fee should be added onto the payment by exhibitors.</div>
                            <h2> USD <?=number_format($model->pay_total);?></h2>
                        </div>
                    </div>
                    -->
                    <table class="table">
                        <!--填寫退款資訊-->
                        <tbody>
                            <tr>
                                <th>
                                    Fill in account details you use for Remittance All fields are required<!-- <span style="color:red;">*<span><br>
                                    <div class="small-text">Required</div> -->
                                </th>
                                <td class="control-group">
                                    <label>Account Name</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'paybank_name2',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_name2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 姓名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_name]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
                                    <label>Bank Name</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'paybank_bank2',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_bank2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_bank]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>Account Number</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'paybank_account2',$htmlOptions = array('class'=>'form','ng-model'=>'data.paybank_account2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[paybank_account]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th>Fill in account details for refund request if needed<!-- <span style="color:red;">*<span><br>
                                    <div class="small-text">所有欄位爲必填</div> -->
                                </th>
                                <td class="control-group">
                                    <label>Account Name</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'returnbank_name2',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_name2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 姓名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_name]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
                                    <label>Bank Name</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'returnbank_bank2',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_bank2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_bank]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>Account Number</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model,'returnbank_account2',$htmlOptions = array('class'=>'form','ng-model'=>'data.returnbank_account2','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 銀行驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[returnbank_account]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- <tr>
                               <th></th>
                               <td>
                                    <div class="checkbox checkbox-custom">
                                        <input type="checkbox" ng-click="copy();" ng-checked="checkSame();"/>
                                        <label for="checkbox-signup" class="text-center" >同付款資訊</label>
                                    </div>
                                </td>
                           </tr> -->
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <button class="btn-green inlin-blk" type="button" ng-click="submitted(myForm.$valid);" >Confirm</button>
                    </div>
            <?php $this->endWidget(); ?>
        </div>
    <script>
        $('#apply7').parsley();
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('loginController', ['$scope', '$http', function ($scope, $http) {
                $scope.submitChecked = false;
                $http.get('<?=$this->createUrl('/data2/ajax_remittance/',array('language'=>Yii::app()->language))?>').success(function(response){
				    var data = response;
				    $scope.data = data;
                    console.log($scope.data);
				});
                $scope.submitted = function(validation){
					if (validation){
                        $.post(
					        $('#apply7').attr('action'),
					        $('#apply7').serialize(),
					        function(xml){
						        var data = JSON.parse(xml);
                                $scope.runSubmit = false;
						        console.log(data);
						        if (data.status == 'success'){
							        window.location = data.url;
						        }else{
							        alert(data.message);
                                }
					        }
				        )
					}else{
						$scope.submitChecked = true;
					}
				}; 
                $scope.copy = function(){
                    $scope.data.returnbank_account2 = $scope.data.paybank_account2;
                    $scope.data.returnbank_name2 = $scope.data.paybank_name2;
                    $scope.data.returnbank_bank2 = $scope.data.paybank_bank2;
                }
                $scope.checkSame = function(){
                    if ($scope.data.returnbank_account2 == $scope.data.paybank_account2 &&
                    $scope.data.returnbank_name2 == $scope.data.paybank_name2 &&
                    $scope.data.returnbank_bank2 == $scope.data.paybank_bank2){
                        return true;
                    }
                    return false;
                }
            }]);

        })();
    </script>