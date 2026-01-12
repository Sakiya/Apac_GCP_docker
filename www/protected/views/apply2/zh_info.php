<!--menu-->
    <div class="left-menu">
        <?php $this->renderPartial('/layouts/menu_data2'); ?> 
    </div>
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="infoController"  ng-class="{'sumbitchecked': submitChecked}">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply5',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'id'=>'apply2_info',
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					//'ng-submit'=>"newArticle()",
					'enctype'=>'multipart/form-data',
				),
			)); ?>

                    <div class="title">畫廊資料確認</div>
                    <h5>您所提供的畫廊資料將使用於專刊及所有宣傳內容，請確認資料是否無誤並詳細填寫所有空缺的欄位。</h5>
                    <table class="table">
                        <!--畫廊名稱-->
                        <tbody>
                            <tr>
                                <th>畫廊名稱<span style="color:red;">*</span></th>
                                <td class="control-group"><label for="Gallerym1_name_en">畫廊名稱 <span style="color:red;">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'name', array('class'=>'form','ng-model'=>"data.name",'parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'ng-required'=>'true')); ?>
                                        <!-- 畫廊中文名 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="control-group"><label for="Gallerym1_name_en">Gallery English Name <span style="color:red;">*</span></label>
                                    <div class="controls" style="margin-bottom: 30px;">
                                        <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'name_en', array('class'=>'form','ng-model'=>"data.name_en",'parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'ng-required'=>'true')); ?>
                                            <!-- 畫廊英文名 -->
                                            <div class="parsley-errors-list filled">
                                                <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && submitChecked">此欄爲必填</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                        <!--成立日期-->
                        <tbody>
                            <tr>
                                <th>成立日期<span style="color:red;">*</span></th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'galleryyear'); ?>
                                    <div class="controls">
	                                <?php 
										echo CHtml::activeDropDownList($model, 'galleryyear', array(), array('class'=>'minimal yearpicker','ng-model'=>'data.galleryyear')); 
									?>
                                        <!-- 日期驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[galleryyear]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'gallerymonth'); ?>
                                    <div class="controls" style="margin-bottom: 30px;">
                                    <?php 
										echo CHtml::activeDropDownList($model, 'gallerymonth', array(), array('class'=>'minimal monthsPicker','ng-model'=>'data.gallerymonth')); 
									?>
                                        <!-- 日期驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[gallerymonth]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--負責人-->
                        <tbody>
                            <tr>
                                <th>負責人<span style="color:red;">*</span></th>
                                <td class="control-group"><label>中文名<span class="red">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'bossname', array('class'=>'form','ng-model'=>"data.bossname",'parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'ng-required'=>'true')); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[bossname]'].$error.required && submitChecked">此欄爲必填</span>
                                    </div>
                                </td>
                                <td class="control-group"><label>English Name</label>
                                    <div class="controls" style="margin-bottom: 30px;">
                                        <?php echo CHtml::activeTextField($model, 'bossname_en', array('class'=>'form','ng-model'=>"data.bossname_en",'parsley-trigger'=>"change")); ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                      
                        <!--聯絡資訊-->
                        <tbody>
                            <tr class="border-none">
                                <th>畫廊公開通訊資料<span style="color:red;">*</span></th>
                                <td class="control-group"><label>電話<span style="color:red;">*</span>(例:+886-2-2325-9390) </label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'tel', array('class'=>'form','ng-model'=>"data.tel",'parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'ng-required'=>'true')); ?>
                                        <!-- 聯絡資訊驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[tel]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><label>傳真(例:+886-2-2325-9380)</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'fax', array('class'=>'form','ng-model'=>"data.fax")); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><label>Email<span class="red">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeEmailField($model, 'Gallerym1_email', array('class'=>'form','ng-model'=>"data.Gallerym1_email",'parsley-trigger'=>"change",'data-parsley-required-message'=>"此欄爲必填",'ng-required'=>'true')); ?>
                                        <!-- Email驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[Gallerym1_email]'].$error.required && submitChecked">此欄爲必填</span>
                                            <span class="error validationerror" ng-if="myForm['{{model}}[Gallerym1_email]'].$error.email && submitChecked">格式不正確</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><label>Website</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'websiteurl', array('class'=>'form','ng-model'=>"data.websiteurl")); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><label>國家<span class="red">*</span></label>
                                    <div class="controls">
									<?php 
										echo CHtml::activeDropDownList($model, 'country', array('Taiwan'=>'台灣'), array('class'=>'minimal')); 
									?>
                                    </div>
                                </td>
                                <td class="control-group"><label>城市<span class="red">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'city', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.city",'ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 城市驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[city]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group" colspan="2"><label>畫廊地址（中）<span class="red">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'address', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.address",'ng-required'=> true,'style'=>'width: 100%;','data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 地址驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[address]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group" colspan="2"><label>畫廊地址（英）<span class="red">*</span></label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'address_en', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.address_en",'ng-required'=> true,'style'=>'width: 100%; margin-bottom: 30px;','data-parsley-required-message'=>"此欄爲必填")); ?>
                                        <!-- 地址驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[address_en]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                        <!--社群帳號-->
                        <tbody>
                            <tr class="border-none">
                                <th>社群帳號</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'Facebook'); ?>
                                    <div class="controls">
                                    <?php echo CHtml::activeTextField($model, 'Facebook', array('class'=>'form','ng-model'=>"data.Facebook")); ?>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'Twitter'); ?>
                                    <div class="controls">
                                    <?php echo CHtml::activeTextField($model, 'Twitter', array('class'=>'form','ng-model'=>"data.Twitter")); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'Instagram'); ?>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'Instagram', array('class'=>'form','ng-model'=>"data.Instagram")); ?>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'weibo'); ?>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'weibo', array('class'=>'form','ng-model'=>"data.weibo")); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'Youtube'); ?>
                                    <div class="controls"  style="margin-bottom: 30px;">
                                        <?php echo CHtml::activeTextField($model, 'Youtube', array('class'=>'form','ng-model'=>"data.Youtube")); ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--展務人聯絡-->
                        <tbody>
                            <tr class="border-none">
                                <th>公司名稱及統一編號</th>
                                <td class="control-group"><label>公司名稱</label>
                                    <div class="controls">
                                        <?php echo CHtml::activeTextField($model, 'companyname', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.companyname",'style'=>'width: 100%;')); ?>
                                        <!-- 公司名稱及統一編號 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[companyname]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div> 
                                    </div>
                                </td>
                                <td class="control-group"><label>統一編號</label>
                                    <div class="controls" style="margin-bottom: 30px;">
                                        <?php echo CHtml::activeTextField($model, 'companyid', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.companyid",'style'=>'width: 100%;')); ?>
                                        <!-- 統一編號 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[companyid]'].$error.required && submitChecked">此欄爲必填</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th> 代理藝術家<span style="color:red;">*</span></th>
                                <td class="control-group" colspan="2">
                                    <?php echo $form->TextArea($model, 'actingartist', array('class'=>'form','ng-model'=>"data.actingartist",'style'=>'width: 100%;','ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填",'style'=>'width: 100%;','maxlength'=>2000,'placeholder'=>'Ex. Damien HIRST | 陳一封 I-Feng Chen | 王小明 Xio-Meng Wang')); ?>
                                     <!-- 代理藝術家 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[actingartist]'].$error.required && submitChecked">此欄爲必填</span>
                                        <span class="error validationerror" ng-if="myForm['{{model}}[actingartist]'].$error.maxlength && submitChecked">已經超過2000個字囉！</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <th> 展出藝術家<span style="color:red;">*</span></th>
                                <td class="control-group" colspan="2"  style="margin-bottom: 30px;">
                                    <?php echo $form->TextArea($model, 'exhibitionartist', array('class'=>'form','ng-model'=>"data.exhibitionartist",'style'=>'width: 100%;','ng-required'=> true,'data-parsley-required-message'=>"此欄爲必填",'style'=>'width: 100%;','maxlength'=>2000,'placeholder'=>'Ex. Damien HIRST | 陳一封 I-Feng Chen | 王小明 Xio-Meng Wang')); ?>
                                     <!-- 說明驗證 -->
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[exhibitionartist]'].$error.required && submitChecked">此欄爲必填</span>
                                        <span class="error validationerror" ng-if="myForm['{{model}}[exhibitionartist]'].$error.maxlength && myForm['{{model}}[exhibitionartist]'].$touched">已經超過2000個字囉！</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <button class="text-center btn-green next-page-btn inlin-blk error-event" type="button" ng-click="register(myForm.$valid);" >下一步</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    <script>
        $('#apply2_info').parsley();

        //form validator
        (function() {
            var validator = angular.module('validator', []);
            validator.controller('infoController', ['$scope', '$http', function ($scope, $http) {
                $scope.model = "Gallerym1",
				$scope.submitChecked = false,
                $scope.runSubmit = false,
                $http.get('<?=$this->createUrl('/data2/Ajax_info/',array('language'=>Yii::app()->language))?>')
						.success(function(response){
							var data = response;
							$scope.data = data;
							
							console.log($scope.data);
						});
                    $scope.register = function(validation) {
						if (validation && !$scope.runSubmit){
                                $scope.runSubmit = true;
				            	$.post(
					            	$('#apply2_info').attr('action'),
					            	$('#apply2_info').serialize(),
					            	function(xml){
						                var data = JSON.parse(xml);
                                        $scope.runSubmit = false;
						                //console.log(data);
						                if (data.status == 'success'){
							                window.location = data.url;
						                }else{
							                alert(data.message);
						                }
					            	}
				            	)
		                }else{
			                $scope.submitChecked = true;
		                }
	                };

            }]);
        })();
    </script>