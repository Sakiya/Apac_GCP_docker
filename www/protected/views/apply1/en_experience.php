	<script>
        //form validator
		var OATapp = angular.module('OATapp', []);
            OATapp.controller('experienceController', ['$scope', '$http', function ($scope, $http) {
				$scope.init = function () {
					console.log($http);
				}
				$scope.model = "zExperience";
				$scope.URLpath = '<?=Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['experience'];?>';
				$scope.submitChecked = false;
				$http.get('/en/fill/ajax_experience')
			        .success(function(response){
			            var data = response;//JSON.parse(response);
			            $scope.data = data;
			            $scope.data.exhibition1pic1_input = data.exhibition1pic1;
			            $scope.data.exhibition2pic1_input = data.exhibition2pic1;
			            $scope.data.URLpath = '<?=Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['experience'];?>';
			            //$scope.data.exhibition1date = new Date(data.exhibition1date);
			            //$scope.data.exhibition2date = new Date(data.exhibition2date);
			        });
				
				$scope.getbg = function(filename){
					console.log(filename);
					if (filename !== '' & filename != undefined){
						return {'background-image' : 'URL(' + $scope.URLpath + filename + ')'}
					}else{
						return {};
					}

				}
				$scope.submitted = function(validation){
					if (validation){
						$('#login-form').submit();
					}else{
						$scope.submitChecked = true;
					}
				};
				$scope.deletefile = function(filename,name,element){					
					$.post(
						'/zh/fill/ajax_experience_delete',
						{
							filename:filename,
							name:name,
							YII_CSRF_TOKEN: '<?=Yii::app()->request->csrfToken?>'
						},
						function(xml){
							//console.log(xml);
							var model = element;//;$(element).attr('ng-model');
							console.log(model);
							switch(model){
								case 'data.exhibition1pic1':
									$scope.data.exhibition1pic1_input = "";	
									break;
								case 'data.exhibition2pic1':
									$scope.data.exhibition2pic1_input = "";	
									break;
							}
							$scope.$apply();
						}
					)
				}
				$scope.file_changed = function(element) {
					var model = $(element).attr('ng-model');
					var size = element.files[0].size / 1024 / 1024;
					var _type = element.files[0].type;
						
					if (_type== 'image/jpg' || _type== 'image/jpeg' || _type== 'image/png'){
						if (size < 1){
							switch(model){
								case 'data.exhibition1pic1':
									$scope.data.exhibition1pic1_input = element.files[0].name;	
									break;
								case 'data.exhibition2pic1':
									$scope.data.exhibition2pic1_input = element.files[0].name;	
									break;
							}
							$scope.$apply();
						}else{
							alert("The image you uploaded is not in the right format or has exceeded 1M. Please compress your file prior to upload.");
						}
					}else{
						alert("The image you uploaded is not in the right format or has exceeded 1M. Please compress your file prior to upload.");
					}

				};
            }]);
        (function() {


        })();
        
        $(document).ready(function(){
			//$(".delete-img").hide();
			$(".delete-img").click(function() { 
				console.log($(this).parents(".upload").siblings().css("background-image"));
				$(this).parents(".upload").siblings().css("background-image", "").siblings().attr("value", "");
				$(this).siblings().find(".file-upload-text").text("Upload Image");
				$(this).hide(); 
			});
		});
	</script>
<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
		<!--登出時間-->
		<?=$loginInfo;?>
		<!--內文-->
		<div class="right">
			<div class="container" ng-app="OATapp" ng-controller="experienceController">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'htmlOptions'=>array(
						'class'=>'applyTable',
						'name'=>'myForm',
						'novalidate'=>'novalidate',
						'enctype'=>'multipart/form-data'
					),
				)); ?>
					<div class="title">Past Experience with Art Fairs / Exhibitions</div>
					<h5>Please list out art fairs participated in the past two years. </h5>
					<table class="table">
						<tbody>	
							<tr>
								<th><?php echo $this->Year['Yearm1_year'] - 1;?>
									<span style="color:red;">*<span><br>
									<div class="small-text">Limit 1000 characters</div>
								</th>
								<td class="control-group" ng-init="init();" ng-class="{'errorshow':myForm['{{model}}[experienceoneyear]'].$error && submitChecked}">
									<?php echo $form->TextArea($model, 'experienceoneyear', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.experienceoneyear",'ng-required'=> true,'data-parsley-required-message'=>"This field is required",'style'=>'width: 100%;','maxlength'=>1000)); ?>
									<!-- 經驗驗證 -->
									<div class="parsley-errors-list filled">
										<span class="error validationerror" ng-show="myForm['{{model}}[experienceoneyear]'].$error.required && submitChecked">This field is required</span>
										<span class="error validationerror" ng-if="myForm['{{model}}[experienceoneyear]'].maxlength && submitChecked">Limit 300 Words</span></div>
								</td>
							</tr>
							<tr>
								<th><?php echo $this->Year['Yearm1_year'] - 2;?>
									<span style="color:red;">*<span><br>
									<div class="small-text">Limit 1000 characters</div>
								</th>
								<td class="control-group" ng-class="{'errorshow':myForm['{{model}}[experiencetwoyear]'].$error && submitChecked}">
									<?php echo $form->TextArea($model, 'experiencetwoyear', array('class'=>'form','ng-model'=>"data.experiencetwoyear",'style'=>'width: 100%;','ng-required'=> true,'data-parsley-required-message'=>"This field is required",'style'=>'width: 100%;','maxlength'=>1000)); ?>
									<!-- 經驗驗證 -->
									<div class="parsley-errors-list filled">
										<span class="error validationerror" ng-show="myForm['{{model}}[experienceoneyear]'].$error.required && submitChecked">This field is required</span>
										<span class="error validationerror" ng-if="myForm['{{model}}[experiencetwoyear]'].$error.maxlength && submitChecked">Limit 300 Words</span></div>
								</td>
							</tr>
						</tbody>
					</table>
			<h5>Please list out two exhibitions held within the past one year.<span>*</span></h5>
			<table class="table">
				<!--Exhibitions History1-->
				<tbody>
					<tr>
						<th>Exhibition History1<span style="color:red;">*<span></th>
						<td class="control-group">
							<label>Exhibition Title</label>
							<div class="controls" ng-class="{'errorshow':myForm['{{model}}[exhibition1name]'].$error && submitChecked}">
								<?php echo $form->textField($model,'exhibition1name',$htmlOptions = array('class'=>'form','ng-model'=>'data.exhibition1name','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
								<!-- 記錄1驗證 -->
								<div class="parsley-errors-list filled">
									<span class="error validationerror" ng-show="myForm['{{model}}[exhibition1name]'].$error.required && submitChecked">This field is required</span>
								</div>
							</div>
						</td>
						<td class="control-group">
							<label>Exhibition Date （YYYY/MM）</label>
							<div class="controls" ng-class="{'errorshow':myForm['{{model}}[exhibition1date]'].$error && submitChecked}">
								<?php echo $form->textField($model,'exhibition1date',$htmlOptions = array('class'=>'form','ng-pattern'=>'/^([0-9]{4}[/][0-1]{1}[0-9]{1})/','ng-model'=>'data.exhibition1date','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
								<!-- 記錄1驗證 -->
								<div class="parsley-errors-list filled">
									<span class="error validationerror" ng-show="myForm['{{model}}[exhibition1date]'].$error.required && submitChecked">This field is required</span>
								</div>
							</div>
						</td>
					</tr>
				<!--Upload Image-->
					<tr>
						<th>
							<td>
								<div class="img-format img-wrapper"></div>
								<div class="preview img-wrapper" ng-style="getbg(data.exhibition1pic1)" ></div>
								<div class="upload">
									<div class="file-upload-wrapper">
										<?php echo $form->fileField($model,'exhibition1pic1',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','onChange'=>'angular.element(this).scope().file_changed(this)','ng-model'=>'data.exhibition1pic1' ,'ngf-max-size'=>'1MB')); ?>
										<div class="file-upload-text">Upload Image</div>
										<!--
											<input class="file-upload-text" type="text" disabled="" placeholder="Upload Image" value="{{data.exhibition1pic1}}">
											 ng-click="deleteimg($event)"
											-->
									</div>
									<div class="delete-img" ng-show="data.exhibition1pic1" ng-click="deletefile(data.exhibition1pic1,'exhibition1pic1','data.exhibition1pic1')">Delete Image</div>
								</div>
								<input type="hidden" id="exhibition1pic1_input" name="exhibition1pic1_input" ng-model="data.exhibition1pic1_input" ng-required="true"/>
								<div class="parsley-errors-list filled">
									<span class="error validationerror" ng-show="myForm.exhibition2pic1_input.$error.required && submitChecked">This image is required</span>
								</div>
							</td>
							<td>
								<div class="img-format img-wrapper"></div>
								<div class="preview img-wrapper" ng-style="getbg(data.exhibition1pic2)"></div>					
                        		<div class="upload">
									<div class="file-upload-wrapper">
										<?php echo $form->fileField($model,'exhibition1pic2',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image')); ?>
										<div class="file-upload-text">Upload Image</div>
									</div>
									<div class="delete-img" ng-show="data.exhibition1pic2" ng-click="deletefile(data.exhibition1pic2,'exhibition1pic2','data.exhibition1pic2')">Delete Image</div>
								</div>
							</td>
						</th>
					</tr>
				</tbody>
			<!--Exhibitions History2-->
			<tr class="border-none">
				<th>Exhibition History 2<span style="color:red;">*<span>
			</th>
			<td class="control-group">
				<label>Exhibition Title</label>
				<div class="controls" ng-class="{'errorshow':myForm['{{model}}[exhibition2name]'].$error && submitChecked}">
					<?php echo $form->textField($model,'exhibition2name',$htmlOptions = array('class'=>'form','ng-model'=>'data.exhibition2name','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
					<!-- 記錄2驗證 -->
					<div class="parsley-errors-list filled">
						<span class="error validationerror" ng-show="myForm['{{model}}[exhibition2name]'].$error.required && submitChecked">This field is required</span>
					</div>
				</div>
			</td>
			<td class="control-group">
				<label>Exhibition Date （YYYY/MM）</label>
				<div class="controls" ng-class="{'errorshow':myForm['{{model}}[exhibition2date]'].$error && submitChecked}">
					<?php echo $form->textField($model,'exhibition2date',$htmlOptions = array('class'=>'form','ng-pattern'=>'/^([0-9]{4}[/][0-1]{1}[0-9]{1})/','ng-model'=>'data.exhibition2date','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
					<!-- 記錄1驗證 -->
					<div class="parsley-errors-list filled">
						<span class="error validationerror" ng-show="myForm['{{model}}[exhibition2date]'].$error.required && submitChecked">This field is required</span>
					</div>
				</div>
			</td>
			<!--Upload Image-->
			<tr>
				<th>
					<td>
						<div class="img-format img-wrapper"></div>
						<div class="preview img-wrapper" ng-style="getbg(data.exhibition2pic1)"></div>
						<div class="upload">
							<div class="file-upload-wrapper">
								<!--<input class="file-upload-native" type="file" name="file" accept="image/*">-->
								<?php echo $form->fileField($model,'exhibition2pic1',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','ng-model'=>'data.exhibition2pic1','onChange'=>'angular.element(this).scope().file_changed(this)','ng-model'=>'data.exhibition2pic1' ,'ngf-max-size'=>'1MB')); ?>
								<div class="file-upload-text">Upload Image</div>
							</div>
							<div class="delete-img" ng-show="data.exhibition2pic1" ng-click="deletefile(data.exhibition2pic1,'exhibition2pic1','data.exhibition2pic1')">Delete Image</div>
						</div>
						<input type="hidden" id="exhibition2pic1_input" name="exhibition2pic1_input" ng-model="data.exhibition2pic1_input" ng-required="true"/>
						<div class="parsley-errors-list filled">
							<span class="error validationerror" ng-show="myForm.exhibition2pic1_input.$error.required && submitChecked">This image is required</span>
						</div>
					</td>
					<td>
						<div class="img-format img-wrapper"></div>
						<div class="preview img-wrapper" ng-style="getbg(data.exhibition2pic2)"></div>
						<div class="upload">
							<div class="file-upload-wrapper">
								<?php echo $form->fileField($model,'exhibition2pic2',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','','placeholder'=>'Upload Image','onChange'=>'angular.element(this).scope().file_changed(this)','ng-model'=>'data.exhibition2pic2' )); ?>
								<div class="file-upload-text">Upload Image</div>
							</div>
							<div class="delete-img" ng-show="data.exhibition2pic2" ng-click="deletefile(data.exhibition2pic2,'exhibition2pic2','data.exhibition2pic2')">Delete Image</div>
						</div>
					</td>
				</th>
			</tr>
		</tr>
	</table>
	<div class="btn-group">
		<a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_agree/',array('language'=>Yii::app()->language));?>">Edit last page</a>
		<button class="btn-green inlin-blk error-event" type="button" ng-click="submitted(myForm.$valid)">Save</button>
	</div>
	<?php $this->endWidget(); ?>
	</div>
	</div>