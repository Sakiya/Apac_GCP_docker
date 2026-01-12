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
					//'ng-submit'=>"newArticle()",
					'enctype'=>'multipart/form-data',
				),
			)); ?>
                    <div class="title">Selected Artwork for Catalogue (Required)</div>
                    <h5 class="printDetails clearfix">
                        <div class="pull-left photo">
                            <img src="/main/img/0001.png" alt="">
                            <p>1 FREE FULL DOUBLE PAGE SPREAD</p>
                        </div>
                        <div class="pull-right">
                            <p>Each exhibitor receives 1 free full double page spread (2 pages) in the catalogue.</p>
                            <br>
                            <p>(A) GALLERY INFORMATION WITH LIST OF REPRESENTED ARTISTS AND EXHIBTING ARTISTS. <br>ex: Yasuhide Fuji、Jennifer Thomas </p>
                            <p>(B)ONE SELECTED ARTWORK IMAGE AND INFORMATION<br>
                                Image should be sent to us as a JPEG accompanied by a CMYK proof. All images must be no less than 300 dpi.
                        </div>
                    </h5>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Selected Artwork for Catalogue<span style="color:red;">*<span></th>
                                <td class="control-group">
                                    <label>Upload Selected Artwork for Catalogue<span>*</span></label>
                                    <div class="img-format img-wrapper"></div>
                                    <div class="preview img-wrapper" ng-style="getbg(data.spissue_pic)"></div>
                                    <div class="upload">
                                        <div class="file-upload-wrapper">
			                                <?php echo $form->fileField($model,'spissue_pic',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'上傳照片','ng-model'=>'data.spissue_pic','onchange'=>'angular.element(this).scope().file_changed(this)')); ?> 
                                            <div class="file-upload-text">Upload Image</div>
                                        </div>
                                        <div class="delete-img" ng-show="data.spissue_pic" ng-click="deletefile(data.spissue_pic,'spissue_pic','data.spissue_pic')" >Delet Image</div>
                                    </div>
                                    <input type="hidden" id="spissue_pic_input" name="spissue_pic_input" ng-model="data.spissue_pic_input" ng-required="true"/>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.spissue_pic_input.$error.required && submitChecked">This field is required. </span>
                                    </div> 
                                </td>
                                <td style="width:268px;">
                                </td>   
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2" class="control-group">
                                    <label>Original File for Selected Artwork (Please provide a direct link to your file on Google Drive,Dropbox or OneDrive..etc.)<span>*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'spissue_link', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.spissue_link",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[spissue_link]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2" class="control-group">
                                    <label>
                                        Selected artwork's Caption<span>*</span>
                                        <p class="text-grey">Please find example below<br>Artist Name | Artwork Title | Material | Size(cm) | year</p>
                                    </label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextArea($model, 'spissue_text', array('class'=>'form','ng-model'=>"data.spissue_text",'style'=>'width: 100%;','ng-required'=> true,'data-parsley-required-message'=>"This field is required. ",'style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>'草間彌生 Yayoi Kusama | Pumpkin | Screenprint | 70x55cm | 1982'));?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[spissue_text]'].$error.required && submitChecked">This field is required. </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/Marketing/',array('language'=>Yii::app()->language));?>">Go back to previous page</a>
                        <button class="btn-green inlin-blk" type="button" ng-click="register(myForm.$valid);" >Save and Next</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    <script type="text/javascript">
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('applyController', ['$scope', '$http', function ($scope, $http) {
                $scope.model = "Gallerym1",
				$scope.submitChecked = false,
                $scope.URLpath = '<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['print'];?>'
                $http.get('<?=$this->createUrl('/data2/Ajax_print/',array('language'=>Yii::app()->language))?>')
					.success(function(response){
						var data = response;
						$scope.data = data;

                        if ($scope.data != null){
					        $scope.data.spissue_pic_input = data.spissue_pic;
                        }
						console.log($scope.data);
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
						return {'background-image' : 'URL(' + $scope.URLpath + filename + ')'}
					}else{
						return {};
					}
				}
				$scope.deletefile = function(filename,name,element){
                    console.log(filename,name,element);
                    $scope.data.spissue_pic_input = "";
                    $scope.data.spissue_pic = "";
                    $scope.$apply();
				}
				$scope.file_changed = function(element) {
					var model = $(element).attr('ng-model');
					var size = element.files[0].size / 1024 / 1024;
					var _type = element.files[0].type;
                    var error = false;
					if (_type.indexOf('jpg') || _type.indexOf('png')){
						if (size < 1){
							$scope.data.spissue_pic_input = element.files[0].name;
							$scope.$apply();
						}else{
                            error = true;
							alert("您上傳的圖片超過1M或非規定檔案，請壓縮後再上傳。");
						}
					}else{
                        error = true;
						alert("您上傳的圖片超過1M或非規定檔案，請壓縮後再上傳。");
					}
				};
            }]);
        })();
    </script>