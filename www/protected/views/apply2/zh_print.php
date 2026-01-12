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
                    <div class="title">上傳專刊使用圖檔（必填）</div>
                    <h5 class="printDetails clearfix">
                        <div class="pull-left photo">
                            <img src="/main/img/0001.png" alt="">
                            <p>免費一整面(兩頁)版面</p>
                        </div>
                        <div class="pull-right">
                            <p>每一間參展畫廊免費一整面(兩頁)的版面 <br/>請提供資料如下:</p>
                            <br>
                            <p>(A) 作品圖檔與圖說<br>檔案格式: JPEG圖檔，顏色格式為CMYK，且解析度需達300 dpi，檔案尺寸:  25cm x 25cm <br>請依順序註明藝術家中英文姓名、作品中英文名稱、尺寸、媒材(中英文)及作品年份。</p>
                            <br>
                            <p>(B) 詳細畫廊資訊<br>代理藝術家與將於OAT展出藝術家的中英文名單<br>例: 陳偉凱 Wei-Kai Chen、王貞妮 Jenny Wong</p>
                        </div>
                    </h5>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>作品預覽圖檔上傳<span style="color:red;">*<span></th>
                                <td class="control-group">
                                    <label>作品預覽圖上傳<span>*</span></label>
                                    <div class="img-format img-wrapper"></div>
                                    <div class="preview img-wrapper" ng-style="getbg(data.spissue_pic)"></div>
                                    <div class="upload">
                                        <div class="file-upload-wrapper">
			                                <?php echo $form->fileField($model,'spissue_pic',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'上傳照片','ng-model'=>'data.spissue_pic','onchange'=>'angular.element(this).scope().file_changed(this)')); ?> 
                                            <div class="file-upload-text">上傳作品</div>
                                        </div>
                                        <div class="delete-img" ng-show="data.spissue_pic" ng-click="deletefile(data.spissue_pic,'spissue_pic','data.spissue_pic')" >刪除照片</div>
                                    </div>
                                    <input type="hidden" id="spissue_pic_input" name="spissue_pic_input" ng-model="data.spissue_pic_input" ng-required="true"/>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.spissue_pic_input.$error.required && submitChecked">此欄爲必填</span>
                                    </div> 
                                </td>
                                <td style="width:268px;">
                                </td>   
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2" class="control-group">
                                    <label>作品原始檔連結（請提供Google Drive、Dropbox、百度雲等雲端檔案連結）<span>*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'spissue_link', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.spissue_link",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[spissue_link]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td colspan="2" class="control-group">
                                    <label>
                                        畫冊露出作品文字資料<span>*</span>
                                        <p class="text-grey">Please find below example 請照此範例依序填寫<br>Artist Name | Artwork Title | Material | Size(cm) | year</p>
                                    </label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextArea($model, 'spissue_text', array('class'=>'form','ng-model'=>"data.spissue_text",'style'=>'width: 100%;','ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填",'style'=>'width: 100%;','maxlength'=>1200,'placeholder'=>'草間彌生 Yayoi Kusama | Pumpkin | Screenprint | 70x55cm | 1982'));?>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[spissue_text]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <a class="btn-green-border" href="<?=$this->createUrl('/apply2/Marketing/',array('language'=>Yii::app()->language));?>">回上一單元修改資料</a>
                        <button class="btn-green inlin-blk" type="button" ng-click="register(myForm.$valid);" >下一步</button>
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