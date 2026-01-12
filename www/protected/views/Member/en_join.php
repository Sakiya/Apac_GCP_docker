<!--menu-->
	<?php $this->renderPartial('/layouts/menu_member'); ?> 
<!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="loginController">
				<?php echo CHtml::beginForm('/' . Yii::app()->language . '/Member/joinAyns/', 'post', array('role'=>'form','name'=>'myForm','id'=>'registred-form' ,'enableAjaxValidation'=>false, 'novalidate'=>true)) ; ?>
				<?php echo CHtml::activehiddenField($model, 'lang', array('value'=>'en')); ?>
				<?php echo CHtml::activehiddenField($model, 'Yearm1_no', array('value'=>$this->Year['Yearm1_no'])); ?>
                <form id="registred-form" name="myForm" ng-submit="register()" novalidate>
                    <div class="title">Sign up</div>
                    <table class="table">
                        <!--登入Email-->
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'email'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[email]'].$error && submitChecked}">
										<?php echo CHtml::activeEmailField($model, 'email', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.email",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- Email驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[email]'].$error.required && submitChecked">This field is required</span>
                                            <span class="error validationerror" ng-if="myForm['{{model}}[email]'].$error.email && submitChecked">Incorrect format.</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'pwd'); ?></label>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[pwd]'].$error && submitChecked}">
	                                    <?php echo CHtml::activePasswordField($model, 'pwd', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.pwd",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                    </div>
                                    <!-- 密碼驗證 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[pwd]'].$error.required && submitChecked">This field is required</span>
                                        <span class="error validationerror" ng-if="myForm['{{model}}[pwd]'].$error.minlength && submitChecked">Minimum 4 words</span>
                                    </div>
                                </td>
                                <td class="control-group"><label>Please type password again<span>*</span></label>
                                    <div class="controls" ng-class="{'errorshow':myForm.confirm.$error && submitChecked}">
	                                    <input class="form" name="confirm" type="password" ng-model="user.confirm" parsley-trigger="change" ng-required="true" data-parsley-required-message="This field is required">
	                                    </div>
                                    <!-- 密碼驗證 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.confirm.$error.required && submitChecked">This field is required</span>
                                        <span class="error validationerror" ng-show="(user.confirm != user.pwd)">Please enter the same password again</span>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--單位名稱-->
                        <tbody>
                            <tr>
                                <th>Gallery Information</th>
                                <!--
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'name', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.name")); ?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && myForm['{{model}}[name]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                -->
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[name]'].$error && submitChecked}">
	                                    <?php echo CHtml::activeTextField($model, 'name', array('class'=>'form','ng-model'=>"user.name",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && submitChecked">This field is required</span>
                                    </div> 
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name_en'); ?>
                                    <div class="controls" ng-class="{'errorshow':myForm['{{model}}[name_en]'].$error && submitChecked}">
	                                    <?php echo CHtml::activeTextField($model, 'name_en', array('class'=>'form','ng-model'=>"user.name_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && submitChecked">This field is required</span>
                                    </div> 
                                </td>
                            </tr>
                            <tr class="border-none">
                            <th>Recaptcha
                                <td class="control-group">
									<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdQlTQUAAAAANV44eXWOK0EPzH7Vu57wk8ekoSz"></div>  
                                </td>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button class="btn-green inlin-blk error-event" type="button" ng-click="register(myForm.$valid);" >Send</button>
                    </div>
                    <div class="text text-center">
                        <div class="checkbox checkbox-custom">
                        <?=CHtml::activeCheckBox($model, 'checkRead', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.checkRead",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                            <label for="checkbox-signup" class="text-center">I have read the <span class="jq-lightbox">privacy policy</label>
                        </div> 
                    </div>
                </form>
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
				                <h2>Statement of Activity</h2>\
				                <div class="lightbox-container">\
				                <p>Applicant must agree to provide the information given (such as information of Gallery, information of participated artists, or image of artworks) in this application is true, complete, and accurate. The organizer, ONE ART Taipei Team reserves the right to decline any applications with incorrect information provided. The deposit is non-refundable in this case.<br/>Applicant also agrees the organizer to collect, process and use the information contained in this application for the use of printing, publishing, research, promotion, publicity and marketing of the exhibition.</p>\
				                <p>All the given information collected by the organizer is for exhibition-related purpose only. We will never provide your information to any third party unrelated to the service of this exhibition. Applicant should also be safeguarding your own password and personal information. </p>\
				                <p>ONE ART Taipei <?php echo $this->Year['Yearm1_year'];?> Committee</p>\
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