<!--menu-->
<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right page_done">
            <div class="container" ng-app="validator" ng-controller="loginController">
                <!--greenScreen-->
                <div class="green-container">
                <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply7',
                'enableClientValidation'=>true,
                'action'=>'/'.Yii::app()->language.'/post/atmpayment/',
                //'action'=>'https://sandbox.sinopac.com/SinoPacWebCard/Pages/PageRedirect.aspx',
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'name'=>'myForm',
                    'novalidate'=>'novalidate'
				),
                )); ?>
                    <input type="hidden" id="no" name="no" value="<?=$model->Gallerym1_no;?>">
                    <input type="hidden" id="Amount" name="Amount" value="5">
                    <input type="hidden" id="OrderNO" name="OrderNO" value="<?=$orderid;?>">
                    <div class="title">繳費逾期！</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好</h3>
                            <div class="discription">由您的繳費帳號已逾期！請重新產生新的繳費帳號</div>
                            <div class="btn-black"><button type="button" class="reNew-Btn" ng-click="submit1();">重新產生繳費帳號</button></div>
                        </div>
                    </div>
                   <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
        <script>
        $('#apply7').parsley();
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('loginController', ['$scope', function($scope) {
                $scope.submit1 = function() {
                    console.log($('#apply7').serialize());
                    $.post(
                        '/<?=Yii::app()->language;?>/post/ATMPayment/',
                        $('#apply7').serialize(),
                        function(xml){
                            console.log(xml);
                            var _xml = JSON.parse(xml);
                            if (_xml.status = 'success'){
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