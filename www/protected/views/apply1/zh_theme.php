<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
	<!--內文-->
	<div class="right">
		<div class="container" ng-app="OATapp" ng-controller="themeController">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply4',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'name'=>'myForm',
					'novalidate'=>'novalidate'
				),
			)); ?>
				<div class="title">OAT策展主題</div>
				<h5>請完整填寫OAT<?=$this->Year->Yearm1_year;?>策展主題</h5>
				<table class="table">
					<tbody>
						<tr>
							<th> 策展主題<span style="color:red;">*<span></th>
							<td class="control-group" ng-class="{'errorshow':myForm['{{model}}[showtitle]'].$error && submitChecked}">
								<?php echo $form->textField($model,'showtitle',$htmlOptions = array('class'=>'form','ng-model'=>'data.showtitle','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'style'=>'width: 100%')); ?>
								<div class="parsley-errors-list filled">
									<span class="error validationerror" ng-show="myForm['{{model}}[showtitle]'].$error.required && submitChecked">此欄爲必填</span>
								</div>
							</td>
						</tr>
						<tr>
							<th> 
								策展說明<span style="color:red;">*<span><br>
								<div class="small-text">限50-600字</div>
							</th>
							<td class="control-group" ng-class="{'errorshow':myForm['{{model}}[showscript]'].$error && submitChecked}">
								<?php echo $form->TextArea($model,'showscript',$htmlOptions = array('class'=>'form','ng-model'=>'data.showscript','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'style'=>'width: 100%;height:300px;','ng-minlength'=>50,'ng-maxlength'=>650)); ?>
								<!-- 說明驗證 -->
								<div class="parsley-errors-list filled">
								<span class="error validationerror" ng-show="myForm['{{model}}[showscript]'].$error.required && submitChecked">此欄爲必填</span>
								<span class="error validationerror" ng-if="!myForm['{{model}}[showscript]'].$valid && submitChecked">此欄爲必填，且數字限制內</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="btn-group">
					<a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_program/',array('language'=>Yii::app()->language));?>">回上一步修改資料</a>
					<button class="btn-green inlin-blk error-event" type="button" ng-click="submitted(myForm.$valid)">完成</button>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
    <script>
        $('#apply4').parsley();
        (function() {
			var OATapp = angular.module('OATapp', []);
	            OATapp.controller('themeController', ['$scope', '$http', function ($scope, $http) {
					$scope.model = "zTheme",
					$scope.submitChecked = false,
					$http.get('/zh/fill/ajax_theme')
				        .success(function(response){
				            var data = response;
				            $scope.data = data;
				        });
					$scope.submitted = function(validation){
						if (validation){
							$('#apply4').submit();
						}else{
							$scope.submitChecked = true;
						}
					}; 
	            }]);
        })();
	</script>