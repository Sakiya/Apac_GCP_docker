    <div class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="left col-sm-6">
                    <div class="logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>" alt=""></div>
                </div>
                <div class="right col-sm-6">
                    <div class="login-box" ng-app="validator" ng-controller="loginController">
                        <h2>Login</h2>
						<?php $form=$this->beginWidget('CActiveForm', array(
						    'id'=>'login-form',
						    'enableClientValidation'=>true,
						    'htmlOptions'=>array(
						        //'validateOnSubmit'=>true,
						        'name'=>'myForm',
							    'novalidate'=>'novalidate',
							    'ng-submit'=>"register()"
						    ),
						)); ?>
						<?php echo $form->hiddenField($model,'year',$htmlOptions = array('value'=>$this->Year->Yearm1_no)); ?>
                            <fieldset>
						        <?php echo $form->emailField($model,'email',$htmlOptions = array('class'=>'email form','placeholder'=>'Email','ng-model'=>'user.email','ng-required'=>'true','placeholder'=>'Email')); ?>
                                <!--<input type="email" class="email form" name="email" placeholder="Email" ng-model="user.email" ng-required="true" placeholder="Email">-->
                                <span class="error validationerror" ng-show="myForm['zLogin[email]'].$error.required && myForm['zLogin[email]'].$touched">Please type in your email<br/>請輸入Email</span>
                                <span class="error validationerror" ng-if="myForm['zLogin[email]'].$error.email && myForm['zLogin[email]'].$touched">Incorrect format<br/>格式不正確</span>

								<?php echo $form->passwordField($model,'password',$htmlOptions = array('class'=>'password form','placeholder'=>'Email','ng-model'=>'user.password','ng-required'=>'true','placeholder'=>'Password')); ?>
                                <span class="error validationerror" ng-show="myForm['zLogin[password]'].$error.required && myForm['zLogin[password]'].$touched">Please type in your password<br/>請輸入密碼</span>
                                <span class="error validationerror" ng-if="myForm['zLogin[password]'].$error.minlength && myForm['zLogin[password]'].$touched">Minimum 4 words<br/>至少要４碼</span>

                                <div class="checkbox checkbox-custom">
							        <?php echo $form->checkBox($model,'rememberMe',array('class'=>'checkbox-signup')); ?>
							        <?php echo $form->label($model,'rememberMe'); ?>
                                    <h4 class="pull-right"><a href="<?=$this->createUrl('/member/forget/',array('language'=>Yii::app()->language));?>">Forget Password?</a></h4>
                                </div>
                                <button class="btn-green" type="button" ng-click="register();">Login</button>
                                <!-- <h4>First Time?</h4> -->
                                <div class="alert-message">
                                    <span class="zh">新舊展商欲報名請先註冊帳號</span>
                                    <span class="en">All exhibitors please sign up to verify your email before login</span>
                                </div>
                                <div class="btn-green-border signUp">
                                    <h5>One Art Taipei <?=$this->Year->Yearm1_year;?> Sign up</h5>
                                </div>
                            </fieldset>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- overlay -->
    <div class="warn-overlay">
        <p>親愛的展商: 爲提升報名流暢性，本系統不支援手機、平板電腦等行動裝置，請使用PC或MAC系統的Google Chrome 瀏覽器來進行報名，謝謝您的配合!</p>
        <p>Dear exhibitors, <br>To ensure a smoother experience, this system doesn't support any mobile devices, such as mobile phones and tablets. Please use Google Chrome browser on PC or Mac to continue the registration for ONE ART Taipei <?=$this->Year['Yearm1_year'];?>. Thank you for your cooperation!</p>
    </div>

    <script type="text/javascript">
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('loginController', ['$scope', function($scope) {
                $scope.register = function(e) {
	                $.post(
		                '/en/member/index',
		                $('#login-form').serialize(),
		                function(xml){
			                //console.log(xml);
			                var data = JSON.parse(xml);
			                //console.log(data.status == 'success');
			                if (data.status == 'success'){
				                window.location = data.url;
			                }else{
				                alert(data.message);
			                }
		                }
	                )
                };

            }]);

        })();
    </script>