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
					'novalidate'=>'novalidate',
					'ng-submit'=>"register()"
				),
			)); ?>
				<div class="title">Exhibition Concpet in OAT</div>
				<h5>Please write down your exhibition concept of OAT <?=$this->Year->Yearm1_year;?> completely.</h5>
				<table class="table">
					<tbody>
						<tr>
							<th> Exhibition Title<span style="color:red;">*<span></th>
							<td class="control-group" ng-class="{'errorshow':myForm['{{model}}[showtitle]'].$error && submitChecked}">
								<?php echo $form->textField($model,'showtitle',$htmlOptions = array('class'=>'form','ng-model'=>'data.showtitle','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required",'style'=>'width: 100%')); ?>
								<div class="parsley-errors-list filled">
									<span class="error validationerror" ng-show="myForm['{{model}}[showtitle]'].$error.required && submitChecked">This field is required</span>
								</div>
							</td>
						</tr>
						<tr>
							<th> 
								Statement<span style="color:red;">*<span><br>
								<div class="small-text">Limit 50-600 characters max.</div>
							</th>
							<td class="control-group" ng-class="{'errorshow':myForm['{{model}}[showscript]'].$error && submitChecked}">
								<?php echo $form->TextArea($model,'showscript',$htmlOptions = array('class'=>'form','ng-model'=>'data.showscript','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required",'style'=>'width: 100%;height:300px;','ng-minlength'=>50,'ng-maxlength'=>1000)); ?>
								<!-- 說明驗證 -->
								<div class="parsley-errors-list filled">
								<span class="error validationerror" ng-show="myForm['{{model}}[showscript]'].$error.required && submitChecked">This field is required</span>
								<span class="error validationerror" ng-if="!myForm['{{model}}[showscript]'].$valid && submitChecked">This field is required, characters need to be within the limitation.</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="btn-group">
					<a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_program/',array('language'=>Yii::app()->language));?>">Edit last page</a>
					<button class="btn-green inlin-blk error-event" type="button" ng-click="submitted(myForm.$valid)">Save</button>
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
					$http.get('/en/fill/ajax_theme')
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