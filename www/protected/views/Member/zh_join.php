<!--menu-->
	<?php $this->renderPartial('/layouts/menu_member'); ?> 
<!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="loginController">
				<?php echo CHtml::beginForm('/' . Yii::app()->language . '/Member/joinAyns/', 'post', array('role'=>'form','name'=>'myForm','id'=>'registred-form' ,'enableAjaxValidation'=>false, 'novalidate'=>true)) ; ?>
				<?php echo CHtml::activehiddenField($model, 'lang', array('value'=>'zh')); ?>
				<?php echo CHtml::activehiddenField($model, 'Yearm1_no', array('value'=>$this->Year['Yearm1_no'])); ?>
                <form id="registred-form" name="myForm" ng-submit="register()" novalidate>
                    <div class="title">帳號註冊</div>
                    <table class="table">
                        <!--登入Email-->
                        <tbody>
                            <tr>
                                <th>登入Email</th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'email'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[email]'].$error && submitChecked}">
										<?php echo CHtml::activeEmailField($model, 'email', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.email",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- Email驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[email]'].$error.required && submitChecked">此欄爲必填</span>
                                            <span class="error validationerror" ng-show="myForm['{{model}}[email]'].$error.email && submitChecked">格式不正確</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>登入密碼</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'pwd'); ?></label>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[pwd]'].$error.required && submitChecked}">
	                                    <?php echo CHtml::activePasswordField($model, 'pwd', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.pwd",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                                    </div>
                                    <!-- 密碼驗證 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[pwd]'].$error.required && submitChecked">此欄爲必填</span>
                                        <span class="error validationerror" ng-if="myForm['{{model}}[pwd]'].$error.minlength">至少要４碼</span>
                                    </div>
                                </td>
                                <td class="control-group"><label>請再次輸入密碼<span>*</span></label>
                                    <div class="controls" ng-class="{'errorshow':myForm.confirm.$error.required && submitChecked}">
	                                    <input class="form" name="confirm" type="password" ng-model="user.confirm" parsley-trigger="change" ng-required="true" data-parsley-required-message="此欄爲必填">
	                                    </div>
                                    <!-- 密碼驗證 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.confirm.$error.required && submitChecked">此欄爲必填</span>
                                        <span class="error validationerror" ng-if="(user.confirm != user.pwd)" >請跟密碼一樣</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--單位名稱-->
                        <tbody>
                            <tr>
                                <th>畫廊名稱</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[name]'].$error.required && submitChecked}">
	                                    <?php echo CHtml::activeTextField($model, 'name', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.name",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 中文名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name_en'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[name_en]'].$error.required && submitChecked}">
	                                    <?php echo CHtml::activeTextField($model, 'name_en', array('class'=>'form','ng-model'=>"user.name_en")); ?>
                                        <!-- 英文名驗證 -->
                                        
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && myForm['{{model}}[name_en]'].$touched">此欄爲必填</span>
                                        </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>  
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tr class="border-none">
                            <th>驗證碼
                                <td class="control-group">
									<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdQlTQUAAAAANV44eXWOK0EPzH7Vu57wk8ekoSz"></div>  
                                </td>
                            </th>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button class="btn-green inlin-blk error-event" type="button" ng-click="register(myForm.$valid);" >完成送出</button>
                    </div>
                    <div class="text text-center">
                        <div class="checkbox checkbox-custom">
                            <?=CHtml::activeCheckBox($model, 'checkRead', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.checkRead",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                            <!-- <input type="checkbox" id="Gallerym1[checkRead]" name="Gallerym1[checkRead]"/> -->
                            <label for="checkbox-signup" class="text-center">我已詳閱<span class="jq-lightbox">隱私權政策</label>
                        </div>
                        <div class="parsley-errors-list filled" style="color:#ff5b5b;">
                            <span class="error validationerror" ng-show="myForm['{{model}}[checkRead]'].$error.required && submitChecked">此欄爲必填</span>
                        </div>  
                    </div>
                <!--</form>-->
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
	    <script>
	        $('#registred-form').parsley();
	        //form validator
	        (function() {
				$('.jq-lightbox').click(function() {
				    $('body').append('<div class="popUp popUpscript">\
				        <div class="whiteScreen"></div>\
				        <div class="white-popUp">\
				            <div class="close-lightbox">X</div>\
				            <div class="new-lightbox">\
				                <h2>活動聲明</h2>\
				                <div class="lightbox-container">\
				                <p>報名展商須同意提供畫廊資訊及後續相關藝術家資訊及圖檔的完整性、正確性和即時性。如有違反，願意依法究責，並接受主辦單位取消其參展資格，繳交相關費用恕不退款。另同意主辦單位基於執行與本展相關印刷、出版、研究、文宣及行銷等之需要，得蒐集、處理、利用本人於本表所填之個人及畫廊相關資料。</p>\
				                <p>本網站所取得的個人資料，僅供活動報名依據、文宣行銷及事後活動成效分析之用，並不做其他用途。主辦單位絕不會將報名展商的個人資料提供予任何與本網站服務無關之第三人。報名展商應妥善保密自己的網路密碼及個人資料，不要將任何個人資料，尤其是網路密碼提供給任何人。</p>\
				                <p>ONE  ART Taipei <?php echo $this->Year['Yearm1_year'];?> 執委會</p>\
				                </div>\
				            </div>\
				        </div>\
				    </div>\
				    ');
				});
				$('body').on('click','.close-lightbox',function(){
				    $('.popUpscript').remove();
				});
	
	            var validator = angular.module('validator', []);
	
	            validator.controller('loginController', ['$scope', '$http', function ($scope, $http) {
					$scope.model = "Gallerym1",
					$scope.submitChecked = false,
                    $scope.runSubmit = false;
	                $scope.register = function(validation) {
						if (validation && !$scope.runSubmit){
						    $scope.select2Options = {
						        'tags': ['Jan', 'Feb', 'Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']  // Can be empty list.
						    };
			                //if (grecaptcha.getResponse() !== ''){
                                $scope.runSubmit = true;
                                // $('#registred-form').submit()
				            	$.post(
					            	$('#registred-form').attr('action'),
					            	$('#registred-form').serialize(),
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
			                //}else{
				            //    alert("請輸入驗證碼.");
			                //}
		                }else{
			                $scope.submitChecked = true;
		                }
	                };
	            }]);
	
	        })();
	    </script>