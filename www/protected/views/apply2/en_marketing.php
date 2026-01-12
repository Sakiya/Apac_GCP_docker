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
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					'enctype'=>'multipart/form-data'
				),
			)); ?>
                    <div class="title">Images for Marketing Campaign(Required)</div>
                    <h5>The provided images must be exhibited for ONE ART Taipei <?php echo $this->Year['Yearm1_year'];?> and  will be used for website and social media marketing. All participated galleries can provide up to 10 artworks. </h5>
                    <div class="applyOAA">
                        <div class="table-wrapper" ng-repeat="item in model.campuses">
                            <?php echo CHtml::activeTextField($Work, '[{{$index}}]Work_no', array('ng-model'=>"item.Work_no",'style'=>'height:0px;width:0px;border:none;')); ?>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="text-align: left;padding-left: 0;">
                                            <button ng-click="removeItem(item)" class="btn btn-small btn-grey inline-blk" type="button" style="margin: -7px 8px 0 0;border-radius: 10px;">
                                                <i class="icon-trash fa fa-trash"></i>Delete
                                            </button> Work {{$index+1}}
                                        </th>
                                        <td colspan="2" class="control-group">
                                            <label>Please select one participating artist<span>*</span></label>
                                            <div class="controls" style="margin-bottom: 10px">
                                            <?php 
                                                echo CHtml::activeDropDownList($Work, '[{{$index}}]Galleryt1_no', CHtml::listData($model->Galleryt1,'Galleryt1_no','name_en'), array('empty' => 'Please select one participating artist', 'class'=>'minimal ', 'style'=>"width: 100%;",'ng-model'=>'item.Galleryt1_no','required'=>true,'data-parsley-required-message'=>"This field is required.")); 
                                            ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][Galleryt1_no]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colson="2">
                                            <label>Upload Selected Competition Work<span>*</span></label>
                                            <div class="img-format img-wrapper"></div>
                                            <div class="preview img-wrapper" ng-style="getbg(item.pic)"></div>
                                            <div class="upload">
                                                <div class="file-upload-wrapper">
                                                    <?php echo $form->fileField($Work,'[{{$index}}]pic',array('id'=>'file','sort'=>'{{$index}}','ng-model'=>'item.pic','class'=>'file-upload-native','onchange'=>'angular.element(this).scope().file_changed(this)','accept'=>'image/*','ng-click'=>"uploadFile()")); ?>
                                                    <div class="file-upload-text">Upload Image</div>
                                                </div>
                                                <div class="delete-img" ng-show="item.pic" ng-click="deletefile(item.pic,'[{{$index}}]pic',item)" >Delet Image</div>
                                            </div>
                                            <input type="hidden" id="pic{{$index}}_input" name="pic{{$index}}_input" ng-model="item.pic_input" ng-required="true"/>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm.pic{{$index}}_input.$error.required && submitChecked">This field is required. </span>
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td colspan="2" class="control-group">
                                            <label>Original File for Selected Competition Work (Please provide a direct link to your file on Google Drive,Dropbox or OneDrive..etc.)*<span>*</span></label>
                                            <div class="controls">
                                                <?php echo CHtml::activeTextField($Work, '[{{$index}}]link', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.link",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][link]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th></th>
                                        <td class="control-group"><label>Work Name</label>
                                            <div class="controls">
                                                <?php echo CHtml::activeTextField($Work, '[{{$index}}]workname', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.workname")); ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][workname]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="control-group"><label>Work English Name<span>*</span></label>
                                            <?php echo CHtml::activeTextField($Work, '[{{$index}}]workname_en', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.workname_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][workname_en]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td class="control-group"><label>Medium <span>*</span></label>
                                            <div class="controls">
                                                <?php echo CHtml::activeTextField($Work, '[{{$index}}]media', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.media",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][media]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="control-group"><label>Medium (English) <span>*</span></label>
                                            <?php echo CHtml::activeTextField($Work, '[{{$index}}]media_en', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.media_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][media_en]'].$error.required && submitChecked">This field is required. </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td class="control-group"><label>Size<span>*</span>(L x W x H cm)</label>
                                            <div class="controls">
                                                <?php echo CHtml::activeTextField($Work, '[{{$index}}]datasize', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"item.datasize",'ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][datasize]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="control-group"><label>Year<span>*</span></label>
                                            <div class="contorls" ng-class="{ 'has-error': myForm.workYear.$invalid && myForm.workYear.$touched }">
                                                <?php 
                                                    echo CHtml::activeDropDownList($Work, '[{{$index}}]year', array(), array('empty' => 'Please Select','class'=>'minimal yearpicker', 'style'=>"margin-bottom: 10px",'ng-model'=>'item.year','ng-required'=> true,'data-parsley-required-message'=>"This field is required. ")); 
                                                ?>
                                                <div class="parsley-errors-list filled">
                                                    <span class="error validationerror" ng-show="myForm['{{model1}}[{{$index}}][year]'].$error.required && submitChecked">This field is required. </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Rachel 新增欄位 非必填 -->
                                    <tr>
                                        <th></th>
                                        <td colspan="2" class="control-group">
                                            <label>Special Instruction</label>
                                            <div class="controls">
                                                <?php echo CHtml::activeTextArea($Work, '[{{$index}}]content1', array('class'=>'form','ng-model'=>"item.content1",'style'=>'width: 100%;','style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>'For example, you can note down sentences like limited edition prints, small-scaled artworks from established artists, the artist has been on auctions, ..etc. '));?>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Rachel 新增欄位  end -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="addAppyBox" ng-click="model.campuses.add()" ng-hide="model.campuses.length >= 10">
                            <div>
                                <div class="icon fa fa-plus"></div>
                                <div class="text">Add More Artworks</div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group"> 
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/usd300/',array('language'=>Yii::app()->language))?>">Go back to previous page</a>
                        <!-- <a ng-show="model.campuses.length <= 0" class="btn-green-bg" href="<?=$this->createUrl('/apply2/Marketing_next/',array('language'=>Yii::app()->language))?>">Save and Next</a> -->
                        <button ng-show="model.campuses.length > 0" class="btn-green inlin-blk" type="button" ng-click="register(model.campuses.length > 0 && myForm.$valid);">Save and Next</button>
                    </div>
                    
                <?php $this->endWidget(); ?>         
            </div>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function(){
        });
        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('applyController', ['$scope', '$http', function ($scope, $http) {
                $scope.URLpath = '<?=Yii::app()->params['folder']['def'] . $model->Yearm1_no . Yii::app()->params['sub_folder']['usd300'];?>'
                $scope.model1 = 'Work';
                $scope.model = {};
                $scope.model.campuses = [];
                $scope.model.campuses.add = function() {
                    $scope.model.campuses.push({});
                };
                $scope.show = false;
                $scope.add = function() {
                    $scope.show = true;
                };
                $scope.register = function(validation) {
                    if (validation){
                        $('#apply5').submit();
                    }else{
                        $scope.submitChecked = true;
                    }
                };
                $scope.removeItem = function(item) {
                    swal({
                        title: 'Would you like to delete this work?',
                        icon: "warning",
                        buttons: ["NO", 'YES']
                    }).then((value) => {
                        if(value){
                            var index = $scope.model.campuses.indexOf(item);
                            $scope.model.campuses.splice(index, 1); 
                            $scope.$apply();
                        }
                    });
                };
                $http.get('<?=$this->createUrl('/data2/Ajax_usd300/',array('language'=>Yii::app()->language,'id'=>2))?>')
					.success(function(response){
                        var data = response;
                        
                        data.forEach(function(item, index, array){
                            $scope.model.campuses[index] = item;
                            $scope.model.campuses[index].pic_input = item.pic;
                        })

					});
                $scope.getbg = function(filename){
					if (filename !== '' & filename != 'undefined'){
						return {'background' : 'URL(' + $scope.URLpath + filename + ') center center / contain no-repeat'}
					}else{
						return {};
					}
				}
				$scope.file_changed = function(element) {
                    var model = $(element).attr('ng-model');
                    var sort = $(element).attr('sort');
					var size = element.files[0].size / 1024 / 1024;
					var _type = element.files[0].type;
                    var error = false;
					if (_type.indexOf('jpg') || _type.indexOf('png')){
						if (size < 1){
                            $scope.model.campuses[sort].pic_input = element.files[0].name;
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
				$scope.deletefile = function(filename,name,element){
                    element.pic = '';
                    element.pic_input = '';
                    $scope.$apply();
                }
                //uploadFiles
                $scope.uploadFile = function(element) {
                   dropifyFiles();
                };
            }]);
        })();
    </script>