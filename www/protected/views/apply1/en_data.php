<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right" ng-app="OATapp" ng-controller="dataController">
            <div class="container" >
                <?php echo CHtml::beginForm('/' . Yii::app()->language . '/fill/apply1_data/', 'post', 
                array('role'=>'form','name'=>'myForm','id'=>'registred-form1' ,'class'=>'applyTable','enableAjaxValidation'=>false, 'novalidate'=>true, 'ng-submit'=>'register()')) ; ?>
				<?php echo CHtml::activehiddenField($model, 'lang', array('value'=>Yii::app()->language)); ?>
				<?php echo CHtml::activehiddenField($model, 'Yearm1_no', array('value'=>$this->Year['Yearm1_no'])); ?>
                <!--<form id="registred-form" name="myForm" ng-submit="register()" novalidate>-->
                    <div class="title">Edit Gallery information</div>
                    <table class="table">
                        <!--登入Email-->
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'email'); ?>
                                    <div class="controls">
										<?php echo CHtml::activeEmailField($model, 'email', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.email",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- Email驗證 -->
                                        <div class="parsley-errors-list filled">

                                            <span class="error validationerror" ng-show="myForm['{{model}}[email]'].$error.required && myForm['{{model}}[email]'].$touched">This field is required</span>
                                            <span class="error validationerror" ng-if="myForm['{{model}}[email]'].$error.email && myForm['{{model}}[email]'].$touched">Incorrect format.</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--單位名稱-->
                        <tbody>
                            <tr>
                                <th>Gallery Information</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'name', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.name")); ?>
                                        <!-- 中文名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && myForm['{{model}}[name]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'name_en'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'name_en', array('class'=>'form','ng-model'=>"data.name_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 英文名驗證 -->

                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && myForm['{{model}}[name_en]'].$touched">This field is required</span>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--成立日期-->
                        <tbody>
                            <tr>
                                <th>Gallery Established Year</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'galleryyear'); ?>
                                    <div class="controls">
	                                <?php 
										echo CHtml::activeDropDownList($model, 'galleryyear', array(), array('class'=>'minimal yearpicker','ng-model'=>'data.galleryyear')); 
									?>
                                        <!-- 日期驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm.yearpicker.$error.required && myForm.yearpicker.$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'gallerymonth'); ?>
                                    <div class="controls">
                                    <?php 
										echo CHtml::activeDropDownList($model, 'gallerymonth', array(), array('class'=>'minimal monthsPicker','ng-model'=>'data.gallerymonth')); 
									?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--負責人姓名-->
                        <tbody>
                            <tr>
                                <th>Gallery Director</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'bossname'); ?>
                                    <div class="controls">
                                    	<?php echo CHtml::activeTextField($model, 'bossname', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.bossname")); ?>
                                        <!-- 負責人驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[bossname]'].$error.required && myForm['{{model}}[bossname]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'bossname_en'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'bossname_en', array('class'=>'form','ng-model'=>"data.bossname_en",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
	                                    <!-- 負責人驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[bossname_en]'].$error.required && myForm['{{model}}[bossname_en]'].$touched">This field is required</span>
                                        </div>
	                                </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--聯絡資訊-->
                        <tbody>
                            <tr class="border-none">
                                <th>Contact Information</th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'tel'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'tel', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.tel",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 聯絡資訊驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[tel]'].$error.required && myForm['{{model}}[tel]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'fax'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'fax', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.fax")); ?>
                                        <!-- 傳真驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[fax]'].$error.required && myForm['{{model}}[fax]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'country'); ?>
                                    <div class="controls">
									<?php 
										echo CHtml::activeDropDownList($model, 'country', array(), array('class'=>'minimal countrySelector','ng-model'=>"data.country")); 
									?>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'city'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'city', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.city",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 城市驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[city]'].$error.required && myForm['{{model}}[city]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'address'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'address', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.address",'ng-required'=> true,'data-parsley-required-message'=>"This field is required","style"=>"width: 100%;")); ?>

                                        <!-- 地址驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[address]'].$error.required && myForm.address.$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'websiteurl'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'websiteurl', array('class'=>'form','ng-model'=>"data.websiteurl","style"=>"width: 100%; margin-bottom: 47px;")); ?>	                                    
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--展務人聯絡-->
                        <tbody>
                            <tr class="border-none">
                                <th>Contact</th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'contactname'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'contactname', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.contactname",'ng-required'=> true,'data-parsley-required-message'=>"This field is required",'style'=>"width: 100%;")); ?>
                                        <!-- 展務人驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[contactname]'].$error.required && myForm['{{model}}[contactname]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'contactphone'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'contactphone', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.contactphone",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 展務人驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[contactphone]'].$error.required && myForm['{{model}}[contactphone]'].$touched">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'contactemail'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeEmailField($model, 'contactemail', array('class'=>'form','parsley-trigger'=>'change','ng-model'=>"data.contactemail",'ng-required'=> true,'data-parsley-required-message'=>"This field is required")); ?>
                                        <!-- 展務人驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[contactemail]'].$error.required && myForm['{{model}}[contactemail]'].$touched">This field is required</span>
                                            <span class="error validationerror" ng-if="myForm['{{model}}[contactemail]'].$error.email && myForm['{{model}}[contactemail]'].$touched">Incorrect format.</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-none">
                                <th></th>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'lineid'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'lineid', array('class'=>'form','ng-model'=>"data.lineid")); ?>	                                    
                                    </div>
                                </td>
                                <td class="control-group"><?php echo CHtml::activeLabelEx($model,'wechat'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'wechat', array('class'=>'form','ng-model'=>"data.wechat")); ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group" colspan="2"><?php echo CHtml::activeLabelEx($model,'whatapp'); ?>
                                    <div class="controls">
	                                    <?php echo CHtml::activeTextField($model, 'whatapp', array('class'=>'form','ng-model'=>"data.whatapp")); ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group">
                        <a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_agree/',array('language'=>Yii::app()->language));?>">Edit last page</a>
                        <button class="btn-green inlin-blk error-event" type="sumbit">Save</button>
                    </div>
                    <!-- <button class="btn-green" type="sumbit">Save</button> -->
                <!--</form>-->
                <?php echo CHtml::endForm() ; ?>
            </div>
            <div class="popUp hidden">
                <div class="whiteScreen"></div><div class="white-popUp">         
                <div class="container">           
                    <h3 style="margin-bottom:30px; margin-top: 20px;">You used this e-mail address to apply before<?php //'OAT'.$this->Year->Yearm1_year;?>, would you like the system to import the gallery information automatically?</h3>           
                    <div class="btn-green-border pull-left popUp-cancel"><h5>NO</h5></div>           
                    <div class="btn-green pull-right" ng-click="alert('few');importdata()"><h5>YES</h5></div>
                </div>       
                </div>
            </div>
        </div>
	    <script>
	        $('#registred-form').parsley();
	        //form validator
	        (function() {
				var OATapp = angular.module('OATapp', []);
	            OATapp.controller('dataController', ['$scope', '$http', function ($scope, $http) {
					$scope.model = "Gallerym1",
                    $scope.finishStep2 = '<?=$finishStep2;?>',
                    $scope.isimport = false,
                    $scope.importData,
					$http.get('/en/fill/ajax_data')
						.success(function(response){
                            var data = response;
                            console.log(data);
							$scope.data = data;
                            $scope.data.galleryyear = ( $scope.data.galleryyear != "" ? $scope.data.galleryyear : "2021");;
                            $scope.data.gallerymonth = ( $scope.data.gallerymonth != "" ? $scope.data.gallerymonth : "Jan");
						});
                    if ($scope.finishStep2 != 1){
                    //$scope.importdata();
                    //$scope.importdata = function(){
                        $http.get('/en/fill/ajax_import_data')
						.success(function(response){
                            var data = response;
                            if (data != ''){
                                //console.log('$scope.data',data)
                                $('.popUp').removeClass('hidden');
                                $scope.importData = data;
                            }
                        });

                        $scope.importdata = function(){
                            //console.log('$scope.importData',$scope.importData)
                            $scope.data.galleryyear = $scope.importData.galleryyear;
                            $scope.data.gallerymonth = $scope.importData.gallerymonth;
                            $scope.data.bossname = $scope.importData.bossname;
                            $scope.data.bossname_en = $scope.importData.bossname_en;
                            $scope.data.tel = $scope.importData.tel;
                            $scope.data.fax = $scope.importData.fax;
                            $scope.data.country = $scope.importData.country;
                            $scope.data.city = $scope.importData.city;
                            $scope.data.address = $scope.importData.address;
                            $scope.data.websiteurl = $scope.importData.websiteurl;
                            $scope.data.contactname = $scope.importData.contactname;
                            $scope.data.contactphone = $scope.importData.contactphone;

                            $scope.data.contactemail = $scope.importData.contactemail;
                            $scope.data.lineid = $scope.importData.lineid;
                            $scope.data.wechat = $scope.importData.wechat;
                            $scope.data.whatapp = $scope.importData.whatapp;
                            $(".popUp").fadeOut()
                        }
                    }
	            }]);
	
	        })();
	    </script>