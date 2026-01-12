    <div class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="left col-sm-6">
                    <div class="logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>" alt=""></div>
                </div>
                <div class="right col-sm-6">
                    <div class="login-box" ng-app="validator" ng-controller="forgetController">
                        <h2>Forget Password?</h2>
                        <p>Please Enter Your Email</p>
                        <?php echo CHtml::beginForm('/' . Yii::app()->language . '/member/forgetAsyn/', 'post', array('role'=>'form','name'=>'myForm','id'=>'myForm', 'novalidate'=>true)) ; ?>
                            <fieldset>
                            <?php echo CHtml::activeTextField($model, 'email', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.email",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填",'placeholder'=>'Email')); ?>
                                <span class="error validationerror" ng-show="myForm.email.$error.required && myForm.email.$touched">Type your Email</span>
                                <span class="error validationerror" ng-if="myForm.email.$error.email && myForm.email.$touched">Not in the correct format</span>

                                <div style="display:inline-box;">
                                    <?php echo CHtml::activeTextField($model, 'captchaCode', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"user.captchaCode",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填",'style'=>'width:150px;','placeholder'=>'captcha','autocomplete'=>'off')); ?>
                                    <?php $this->widget('CCaptcha', array('captchaAction'=>'member/captcha', 'imageOptions'=>array('id'=>'captchaImage','style'=>'vertical-align: middle;margin-right: 5px;'), 'buttonLabel'=>'Reload', 'buttonOptions'=>array('class'=>'font11'))); ?>
                                </div>
                                <button class="btn-green hiderefresh" ng-class="{'showrefresh':disSubmitBtnrefresh}" type="button" ng-click="register()" id="submitBtn();" ng-disabled="disSubmitBtn">Submit<i class="fa fa-refresh fa-spin" style="padding:5px;"></i></button>
                                <a class="back" href="<?=$this->createUrl('/member/index/',array('language'=>Yii::app()->language));?>"><i class="fa fa-chevron-left"></i> Return to Login</a>  
                            </fieldset>
                        <?php echo CHtml::endForm() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .hiderefresh i.fa-refresh{
            display:none;
        }
        .showrefresh i.fa-refresh{
            display:block !important;
            color:black;
        }
    </style>
    <script type="text/javascript">
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('forgetController', ['$scope', function($scope) {
                $scope.disSubmitBtn = false;
                $scope.disSubmitBtnrefresh = false;
                $scope.register = function() {
                    // $('#myForm').submit()
                    if(!$scope.disSubmitBtn){
                        $scope.disSubmitBtn = true;
                        $scope.disSubmitBtnrefresh = true;
                        $.post(
                            '/en/member/forgetAsyn',
                            $('#myForm').serialize(),
                            function(xml){
                                var data = JSON.parse(xml);
                                if (data.status == 'success'){
                                    alert(data.message);
                                    window.location.href = '/en/Member/index';
                                }else{
                                    alert(data.message);
                                }
                                // $scope.disSubmitBtn = false;
                                // $scope.$apply();
                            }
                        )
                    }
                    setTimeout( ()=>{
                        $scope.disSubmitBtn = false;
                        $scope.disSubmitBtnrefresh = false;
                        $('#captchaImage_button').click();
                        $scope.$apply();
                    }, 4000)
                    //alert("Success");
                };

            }]);

        })();
    </script>