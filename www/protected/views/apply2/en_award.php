    <div class="left-menu">
        <?php $this->renderPartial('/layouts/menu_data2'); ?> 
    </div>
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="applyController">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply5',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'id'=>'apply5',
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					'enctype'=>'multipart/form-data'
				),
			)); ?>
                    <div class="title">Campaign Activity - ONE ART Award (Not Compulsory)</div>
                    <h5><!-- 「新賞獎ONE ART Award」為OAT引薦年輕藝術家至藝術市場的重要管道，每一間參展畫廊可推薦一位藝術家參加新潮賞（附一件平面藝術創作為參賽作品）。為配合媒體行銷宣傳，請您務必於<?=(new DateTime($this->Year->Yearm1_open2ed))->format('Y/m/d');?>前回覆畫廊推薦的藝術家及作品之相關資訊。（若不需要可直接略過） -->
                        ONE ART Award is a fundamental campaign for recognizing and honoring young artists aged 35 or under. Every participated gallery is able to nominate one work in any medium from selected artist. (Skip if you are not interested in this campaign)
                    </h5>
                    <!--OAA-->
                    <div class="applyOAA">
                 
                        <table class="table" ng-show="show">
                            <tbody>
                                <tr>
                                    <th>Selected work<span style="color:red;">*<span>
                                    </th>
                                    <td colspan="2" class="control-group">
                                        <label>Please select one participating artist</label>
                                        <div class="controls" style="margin-bottom: 10px">
                                            <?php 
                                                echo CHtml::activeDropDownList($Award, 'Galleryt1_no', CHtml::listData($model->Galleryt1,'Galleryt1_no','name_en'), array('empty' => 'Please select one participating artist', 'class'=>'minimal ', 'style'=>"width: 100%;",'ng-model'=>'data.Galleryt1_no')); 
                                            ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[Galleryt1_no]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colson="2">
                                        <label>Upload Selected Competition Work<span>*</span></label>
                                        <div class="img-format img-wrapper"></div>
                                        <div class="preview img-wrapper" ng-style="getbg(data.workpic1)"></div>
                                        <div class="upload">
                                            <div class="file-upload-wrapper">
                                                <?php echo $form->fileField($Award,'workpic1',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','ng-model'=>'data.workpic1','onchange'=>'angular.element(this).scope().file_changed(this)')); ?> 
                                                <div class="file-upload-text">Upload Image</div>
                                            </div>
                                            <div class="delete-img" ng-show="data.workpic1" ng-click="deletefile(data.workpic1,'workpic1','data.workpic1')" >Delet Image</div>
                                        </div>
                                        <input type="hidden" id="workpic1_input" name="workpic1_input" ng-model="data.workpic1_input" ng-required="true"/>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm.workpic1_input.$error.required && submitChecked">This field is required. </span>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    
                                    <td class="control-group"><label>Work Name</label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextField($Award, 'workname', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.workname")); ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[workname]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="control-group"><label>Work English Name<span>*</span></label>
                                        <?php echo CHtml::activeTextField($Award, 'workname_en', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.workname_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[workname_en]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td class="control-group"><label>Medium <span>*</span></label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextField($Award, 'media', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.media",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[media]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="control-group"><label>Medium (English) <span>*</span></label>
                                        <?php echo CHtml::activeTextField($Award, 'media_en', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.media_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[media_en]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td class="control-group"><label>Size<span>*</span>（L x W x H cm）</label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextField($Award, 'datasize', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.datasize",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[datasize]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="control-group"><label>Year<span>*</span></label>
                                        <div class="contorls" ng-class="{ 'has-error': myForm.workYear.$invalid && myForm.workYear.$touched }">
                                            <?php 
                                                echo CHtml::activeDropDownList($Award, 'year', array(), array('class'=>'minimal yearpicker', 'style'=>"margin-bottom: 10px",'ng-model'=>'data.year','ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); 
                                            ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[year]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colspan="2" class="control-group">
                                        <label>Artist Statement :</label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextArea($Award, 'description', array('class'=>'form','ng-model'=>"data.description",'style'=>'width: 100%;','style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>''));?>
                                        </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[description]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody> 
                            <tbody>
                                <tr>
                                    <th>Upload Reference Work 1<span style="color:red;">*</span><br>
                                    </th>
                                    <td class="control-group">
                                        <div class="img-format img-wrapper"></div>
                                        <div class="preview img-wrapper" ng-style="getbg(data.pic1)"></div>
                                        <div class="upload">
                                            <div class="file-upload-wrapper">
			                                    <?php echo $form->fileField($Award,'pic1',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'上傳照片','ng-model'=>'data.pic1','onchange'=>'angular.element(this).scope().file_changed(this)')); ?> 
                                                <div class="file-upload-text">Upload Image</div>
                                            </div>
                                            <div class="delete-img" ng-show="data.pic1" ng-click="deletefile(data.pic1,'pic1','data.pic1')" >Delet Image</div>
                                        </div>
                                        <input type="hidden" id="pic1_input" name="pic1_input" ng-model="data.pic1_input" ng-required="true"/>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm.pic1_input.$error.required && submitChecked">This field is required. </span>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colspan="2" class="control-group">
                                        <label>Please follow instuction below :</label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextArea($Award, 'content1', array('class'=>'form','ng-model'=>"data.content1",'style'=>'width: 100%;','style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>'Artwork Title | Material |Size(cm) | Year'));?>
                                        </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[content1]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <th>Upload Reference Work 2<span style="color:red;">*</span><br></th>
                                    <td class="control-group">
                                        <div class="img-format img-wrapper"></div>
                                        <div class="preview img-wrapper" ng-style="getbg(data.pic2)"></div>
                                        <div class="upload">
                                            <div class="file-upload-wrapper">
                                                <?php echo $form->fileField($Award,'pic2',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'上傳照片','ng-model'=>'data.pic2','onchange'=>'angular.element(this).scope().file_changed(this)')); ?> 
                                                <div class="file-upload-text">Upload Image</div>
                                            </div>
                                            <div class="delete-img" ng-show="data.pic2" ng-click="deletefile(data.pic2,'pic2','data.pic2')" >Delet Image</div>
                                        </div>
                                        <input type="hidden" id="pic2_input" name="pic2_input" ng-model="data.pic2_input" ng-required="true"/>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm.pic2_input.$error.required && submitChecked">This field is required. </span>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td colspan="2" class="control-group">
                                        <label>Please follow instuction below :</label>
                                        <div class="controls">
                                            <?php echo CHtml::activeTextArea($Award, 'content2', array('class'=>'form','ng-model'=>"data.content2",'style'=>'width: 100%;','style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>'Artwork Title | Material |Size(cm) | Year'));?>
                                        </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[content2]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
             
                        <div class="addAppyBox" ng-click="add()" ng-class="{'noShow': show }">
                            <div>
                                <div class="icon fa fa-plus"></div>
                                <div class="text">Join ONE ART Award</div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group"> 
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/price/',array('language'=>Yii::app()->language))?>">Go back to previous page</a>
                        <a ng-show="!show" class="btn-green-bg" href="<?=$this->createUrl('/apply2/Award_next/',array('language'=>Yii::app()->language))?>">Skip</a>
                        <button ng-show="show" ng-show="myForm.$valid" class="btn-green inlin-blk" type="button" ng-click="register(myForm.$valid);">Next</button>
                    </div>
                    <div class="btn-group" ng-show="show">
                        <button class="btn-grey-cancel inlin-blk" type="button" onclick="window.location='<?=$this->createUrl('/apply2/Award_next/',array('language'=>Yii::app()->language))?>'">Cancel ONE ART Award</button>
                    </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function(){
           
        });
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('applyController', ['$scope', '$http', function ($scope, $http) {
                $scope.submitChecked = false;
                $scope.model = 'Award';
                $scope.show = false;
                $scope.URLpath = '<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['award'];?>'
                $scope.add = function() {
                    $scope.show = true;
                };
                $http.get('<?=$this->createUrl('/data2/Ajax_award/',array('language'=>Yii::app()->language))?>')
					.success(function(response){
						var data = response;
						$scope.data = data;
                        if ($scope.data.Award_no != null){
					        $scope.data.workpic1_input = data.workpic1;
					        $scope.data.pic1_input = data.pic1;
					        $scope.data.pic2_input = data.pic2;
                            $scope.show = true;
                            //console.log($scope.data);
                        }
					});
                $scope.register = function(validation) {
                    if (validation){
                        $('#apply5').submit();
                    }else{
                        $scope.submitChecked = true;
                    }
                };
				$scope.getbg = function(filename){
					if (filename !== '' & filename != 'undefined'){
						return {'background' : 'URL(' + $scope.URLpath + filename + ') center center / contain no-repeat'}
					}else{
						return {};
					}
				}	
				$scope.deletefile = function(filename,name,element){
                    switch(element){
						case 'data.workpic1':
							$scope.data.workpic1_input = "";
                            $scope.data.workpic1 = "";
							break;
						case 'data.pic1':
							$scope.data.pic1_input = "";
                            $scope.data.pic1 = "";	
							break;
						case 'data.pic2':
							$scope.data.pic2_input = "";
                            $scope.data.pic2 = "";
							break;
					}
                    //$scope.$apply();
				}
				$scope.file_changed = function(element) {
					var model = $(element).attr('ng-model');
					var size = element.files[0].size / 1024 / 1024;
					var _type = element.files[0].type;
                    var error = false;
					if (_type.indexOf('jpg') || _type.indexOf('png')){
						if (size < 1){
							switch(model){
								case 'data.workpic1':
									$scope.data.workpic1_input = element.files[0].name;	
									break;
								case 'data.pic1':
									$scope.data.pic1_input = element.files[0].name;	
									break;
								case 'data.pic2':
									$scope.data.pic2_input = element.files[0].name;	
									break;
							}
							$scope.$apply();
						}else{
                            error = true;
							alert("您上傳的圖片超過1M或非規定檔案，請壓縮後再上傳。");
						}
					}else{
                        error = true;
						alert("您上傳的圖片超過1M或非規定檔案，請壓縮後再上傳。");
					}

                    if (error){
                        switch(model){
							case 'data.workpic1':
								$scope.data.workpic1_input = "";$scope.data.workpic1 = "";
								break;
							case 'data.pic1':
								$scope.data.pic1_input = "";$scope.data.pic1 = "";
								break;
							case 'data.pic2':
								$scope.data.pic2_input = "";$scope.data.pic2 = "";
								break;
						}  
                    }
				};
            }]);
        })();
    </script>