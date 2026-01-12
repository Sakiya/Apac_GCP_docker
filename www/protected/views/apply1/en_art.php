<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="OATapp" ng-controller="artController">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply5',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'id'=>'apply5',
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					'ng-submit'=>"newArticle()",
					'enctype'=>'multipart/form-data',
				),
			)); ?>
			<?php echo $form->hiddenField($model,'Galleryt1_no'); ?>
			<input type="hidden" id="backurl" name="backurl" />
                    <div class="title">Fill in OAT Artist Information</div>
                    <h5>Please fill in the form below for each participating artist completely.</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th> Artist Information</th>
                                  <td class="control-group"><label>Artist Name</label>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[name]'].$error.required && submitChecked}">
	                                    <?php echo $form->textField($model,'name',$htmlOptions = array('class'=>'form','ng-model'=>'data.name','parsley-trigger'=>"change")); ?>
                                        <!-- 中文名驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                    </td>
                                    <td class="control-group">
                                        <label>English Name<span>*</span></label>
                                        <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[name_en]'].$error && submitChecked}">
	                                        <?php echo $form->textField($model,'name_en',$htmlOptions = array('class'=>'form','ng-required'=>'true','data-parsley-required-message'=>"This field is required",'ng-model'=>'data.name_en','ng-required'=>true)); ?>
                                        </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[name_en]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
                                    <label>Nationality<span>*</span></label>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[country]'].$error && submitChecked}">
									<?php 
										echo $form->DropDownList($model, 'country', array(), array('class'=>'minimal countrySelector','ng-model'=>'data.country','empty'=>'','style'=>'margin-bottom:10px;','ng-required'=>true)); 
									?>
                                        </select>					
                                        <!-- 國家驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[country]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="control-group">
                                    <label>Birth Year<span>*</span></label>
	                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[birthyear]'].$error && submitChecked}">
		                                <?php 
											echo $form->DropDownList($model, 'birthyear', array(), array('class'=>'minimal yearpicker','ng-model'=>'data.birthyear','style'=>'margin-bottom:10px;','ng-required'=>'true','ng-change'=>'selectedmethod()')); 
										?>
                                        <!-- 出生驗證 -->
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[birthyear]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> Please Select Sector(s)<span style="color:red;">*</span>
                                    <br>
                                    <div class="small-text">Please select at least one sector for this participating artist.</div>
                                </th>	                            
                                <td class="control-group" colspan="2">
                                    <ul>
	                                <?php
		                                foreach($Method as $i => $row){
	                                ?>
                                        <li style="display: none;">
                                        	<input id="program<?=$row->MethodM1_no;?>" name="Galleryt1[program][program<?=$row->MethodM1_no;?>]" class="program<?=$row->MethodM1_no;?>" type="checkbox" ng-model="data.program<?=$row->MethodM1_no;?>" value="true" box="item<?=$i + 1;?>" disabled="true" ng-change="selectedmethod();" nglimit="<?=$row->MethodM1_yearlimit;?>" value="<?=$row->MethodM1_no;?>">
                                            <label for="program<?=$row->MethodM1_no;?>"><?=$row->MethodM1_title_en;?></label>
                                            <div class="project-info"><?=$row->MethodM1_script_en;?></div>
                                            <?php if ($row->MethodM1_yearlimit){?>
                                            <span ng-class="{'hidden': !InputMethod}" >
                                            	<span class="error validationerror" ng-class="{'hidden': MustMethod}" >The sector you selected has age restriction.</span>
                                            </span>
                                            <?php }?> 
                                        </li>
                                    <?php }?>
                                    </ul>
                                    <span class="error validationerror" ng-class="{'hidden': InputMethod}" >This field is required</span>  
                                </td>
                            </tr>
                            <tr>
                                <th> Education<br><div class="small-text">Limit 200 characters max.</div>
                                </th>
                                <td class="control-group" colspan="2" >
	                                <?php echo $form->TextArea($model,'jointex',$htmlOptions = array('class'=>'form','ng-model'=>'data.jointex','style'=>'width: 100%;','ng-maxlength'=>220)); ?>
	                                <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="!myForm['{{model}}[jointex]'].$valid && submitChecked">You have exceeded the character limit.
</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> Solo Exhibition / Group Exhibition
                                    <br>
                                    <div class="small-text">Limit 400 characters max.</div>
                                </th>
                                <td class="control-group" colspan="2">
	                                <?php echo $form->TextArea($model,'personalex',$htmlOptions = array('class'=>'form','ng-model'=>'data.personalex','style'=>'width: 100%;','ng-maxlength'=>600)); ?>
									<div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="!myForm['{{model}}[personalex]'].$valid && submitChecked">You have exceeded the character limit.
</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> Awards / Collections<br>
                                    <div class="small-text">Limit 200 characters max.</div>
                                </th>
                                <td class="control-group" colspan="2">
	                                <?php echo $form->TextArea($model,'prize',$htmlOptions = array('class'=>'form','ng-model'=>'data.prize','style'=>'width: 100%;','ng-maxlength'=>220)); ?>
									<div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="!myForm['{{model}}[prize]'].$valid && submitChecked">You have exceeded the character limit.
</span>
                                    </div>
                            </tr>
                        </tbody>
                        <!--作品1上傳（必填）-->
                        <tbody>
                            <tr>
                                <th> Upload Work<span style="color:red;">*<span></th>
                                <td colson="2">
	                                <div class="img-format img-wrapper"></div>
	                                <div class="preview img-wrapper" ng-style="getbg(data.datafile1)"></div>
	                                <div class="upload">
		                                <div class="file-upload-wrapper">
			                                <?php echo $form->fileField($model,'datafile1',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','ng-model'=>'data.datafile1','onchange'=>'angular.element(this).scope().file_changed(this)')); ?>
			                                <div class="file-upload-text">Upload Image</div>
		                                </div>
		                                <div class="delete-img" ng-show="data.datafile1" ng-click="deletefile(data.datafile1,'datafile1','data.datafile1')">Delete Image</div>
	                                </div>
	                                <input type="hidden" id="datafile1_input" name="datafile1_input" ng-model="data.datafile1_input" ng-required="true"/>
	                                <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.datafile1_input.$error.required && submitChecked">This field is required</span>
                                    </div>
		                        </td>
		                    </tr>
		                    <tr>
			                    <th></th>
			                    <td class="control-group">
				                    <?php echo CHtml::activeLabelEx($model,'dataname1'); ?>
                                    <div class="contorls" >
	                                    <?php echo $form->textField($model,'dataname1',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname1','parsley-trigger'=>"change")); ?>
	                                    </div>
                                    </td>
                                    <td class="control-group">
	                                    <?php echo CHtml::activeLabelEx($model,'dataname_en1'); ?>
                                        <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[dataname_en1]'].$error && submitChecked}">
	                                        <?php echo $form->textField($model,'dataname_en1',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname_en1','ng-required'=>'true')); ?>
	                                    </div>
                                        <div class="parsley-errors-list filled">
                                            <span class="error validationerror" ng-show="myForm['{{model}}[dataname_en1]'].$error.required && submitChecked">This field is required</span>
                                        </div>
                                    </td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td class="control-group">
				                    <?php echo CHtml::activeLabelEx($model,'datayear1'); ?>
                                    <div class="contorls" >
	                                <?php 
										echo $form->DropDownList($model, 'datayear1', array(), array('class'=>'minimal yearpicker','ng-model'=>'data.datayear1')); 
									?>
                                    </div>
                                </td>
                                <td class="control-group">
	                                <?php echo CHtml::activeLabelEx($model,'datamedia1'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[dataname_en1]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datamedia1',$htmlOptions = array('class'=>'form','ng-model'=>'data.datamedia1','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
	                                </div>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[datamedia1]'].$error.required && submitChecked">This field is required</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td class="control-group" colspan="2">
	                                <?php echo CHtml::activeLabelEx($model,'datasize1'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datasize1]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datasize1',$htmlOptions = array('class'=>'form','ng-model'=>'data.datasize1','ng-required'=>'true','parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required")); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm['{{model}}[datasize1]'].$error.required && submitChecked">This field is required</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--作品2上傳-->
                        <tbody>
                            <tr>
                                <th> Upload Work<span style="color:red;">*<span></th>
                                <td colson="2">
	                                <div class="img-format img-wrapper"></div>
	                                <div class="preview img-wrapper" ng-style="getbg(data.datafile2)"></div>
	                                <div class="upload">
		                                <div class="file-upload-wrapper">
			                                <?php echo $form->fileField($model,'datafile2',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','ng-model'=>'data.datafile2','onchange'=>'angular.element(this).scope().file_changed(this)')); ?>
			                                <div class="file-upload-text">Upload Image</div>
		                                </div>
		                                <div class="delete-img" ng-show="data.datafile2" ng-click="deletefile(data.datafile2,'datafile2','data.datafile2')">Delete Image</div>
	                                </div>
	                                <input type="hidden" id="datafile2_input" name="datafile2_input" ng-model="data.datafile2_input" ng-required="true"/>
	                                <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.datafile2_input.$error.required && submitChecked">This field is required</span>
                                    </div>
		                        </td>
		                    </tr>
		                    <tr>
			                    <th></th>
			                    <td class="control-group">
				                    <?php echo CHtml::activeLabelEx($model,'dataname2'); ?>
                                    <div class="contorls">
	                                    <?php echo $form->textField($model,'dataname2',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname2')); ?>
	                                    </div>
                                    </td>
                                    <td class="control-group">
	                                    <?php echo CHtml::activeLabelEx($model,'dataname_en2'); ?>
                                        <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[dataname_en2]'].$error && submitChecked}">
	                                        <?php echo $form->textField($model,'dataname_en2',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname_en2','ng-required'=>'true')); ?>
	                                    </div>
	                                    <div class="parsley-errors-list filled">
	                                        <span class="error validationerror" ng-show="myForm['{{model}}[dataname_en2]'].$error.required && submitChecked">This field is required</span>
	                                    </div>
                                    </td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td class="control-group">
				                    <?php echo CHtml::activeLabelEx($model,'datayear2'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datayear2]'].$error && submitChecked}">
	                                <?php 
										echo $form->DropDownList($model, 'datayear2', array(), array('class'=>'minimal yearpicker','ng-required'=>'true','ng-model'=>'data.datayear2')); 
									?>
                                    </div>
                                    <div class="parsley-errors-list filled">
	                                    <span class="error validationerror" ng-show="myForm['{{model}}[datayear2]'].$error.required && myForm['{{model}}[datayear2]'].$touched">This field is required</span>
	                                </div>
                                </td>
                                <td class="control-group">
	                                <?php echo CHtml::activeLabelEx($model,'datamedia2'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datamedia2]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datamedia2',$htmlOptions = array('class'=>'form','ng-model'=>'data.datamedia2','ng-required'=>'true')); ?>
	                                </div>
	                                <div class="parsley-errors-list filled">
	                                    <span class="error validationerror" ng-show="myForm['{{model}}[datamedia2]'].$error.required && submitChecked">This field is required</span>
	                                </div>
                                </td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td class="control-group" colspan="2">
				                    <?php echo CHtml::activeLabelEx($model,'datasize2'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datasize2]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datasize2',$htmlOptions = array('class'=>'form','ng-model'=>'data.datasize2','ng-required'=>'true')); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
	                                    <span class="error validationerror" ng-show="myForm['{{model}}[datasize2]'].$error.required && submitChecked">This field is required</span>
	                                </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--作品3上傳-->
                        <tbody>
                            <tr>
                                <th> Upload Work<span style="color:red;">*<span></th>
                                <td colson="2">
	                                <div class="img-format img-wrapper"></div>
	                                <div class="preview img-wrapper" ng-style="getbg(data.datafile3)"></div>
	                                <div class="upload">
		                                <div class="file-upload-wrapper">
			                                <?php echo $form->fileField($model,'datafile3',array('id'=>'file','class'=>'file-upload-native','accept'=>'image/*','placeholder'=>'Upload Image','ng-model'=>'data.datafile3','onchange'=>'angular.element(this).scope().file_changed(this)')); ?>
			                                <div class="file-upload-text">Upload Image</div>
		                                </div>
		                                <div class="delete-img" ng-show="data.datafile3" ng-click="deletefile(data.datafile3,'datafile3','data.datafile3')">Delete Image</div>
	                                </div>
	                                <input type="hidden" id="datafile3_input" name="datafile3_input" ng-model="data.datafile3_input" ng-required="true"/>
	                                <div class="parsley-errors-list filled">
                                        <span class="error validationerror" ng-show="myForm.datafile3_input.$error.required && submitChecked">This field is required</span>
                                    </div>
		                        </td>
		                    </tr>
		                    <tr>
			                    <th></th>
			                    <td class="control-group">
				                    <?php echo CHtml::activeLabelEx($model,'dataname3'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[dataname3]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'dataname3',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname3')); ?>
	                                    </div>
	                                    <div class="parsley-errors-list filled">
		                                    <span class="error validationerror" ng-show="myForm['{{model}}[dataname3]'].$error.required && submitChecked">This field is required</span>
		                                </div>
                                    </td>
                                    <td class="control-group">
	                                    <?php echo CHtml::activeLabelEx($model,'dataname_en3'); ?>
                                        <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[dataname3]'].$error && submitChecked}">
	                                        <?php echo $form->textField($model,'dataname_en3',$htmlOptions = array('class'=>'form','ng-model'=>'data.dataname_en3','ng-required'=>'true')); ?>
	                                    </div>
	                                    <div class="parsley-errors-list filled">
		                                    <span class="error validationerror" ng-show="myForm['{{model}}[dataname_en3]'].$error.required && submitChecked">This field is required</span>
		                                </div>
                                    </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="control-group">
	                                <?php echo CHtml::activeLabelEx($model,'datayear3'); ?>
                                    <div class="contorls">
	                                <?php 
										echo $form->DropDownList($model, 'datayear3', array(), array('class'=>'minimal yearpicker','ng-required'=>'true','ng-model'=>'data.datayear3')); 
									?>
                                    </div>
	                                <div class="parsley-errors-list filled">
		                                <span class="error validationerror" ng-show="myForm['{{model}}[datayear3]'].$error.required && myForm['{{model}}[datayear3]'].$touched">This field is required</span>
		                            </div>
                                </td>
                                <td class="control-group">
	                                <?php echo CHtml::activeLabelEx($model,'datamedia3'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datamedia3]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datamedia3',$htmlOptions = array('class'=>'form','ng-model'=>'data.datamedia3','ng-required'=>'true')); ?>
	                                </div>
	                                <div class="parsley-errors-list filled">
		                                <span class="error validationerror" ng-show="myForm['{{model}}[datamedia3]'].$error.required && submitChecked">This field is required</span>
		                            </div>
                                </td>
                            </tr>
                            <tr>
                                <th> </th>
                                <td class="control-group" colspan="2">
	                                <?php echo CHtml::activeLabelEx($model,'datasize3'); ?>
                                    <div class="contorls" ng-class="{'errorshow':myForm['{{model}}[datamedia3]'].$error && submitChecked}">
	                                    <?php echo $form->textField($model,'datasize3',$htmlOptions = array('class'=>'form','ng-model'=>'data.datasize3','ng-required'=>'true')); ?>
                                    </div>
                                    <div class="parsley-errors-list filled">
		                                <span class="error validationerror" ng-show="myForm['{{model}}[datasize3]'].$error.required && submitChecked">This field is required</span>
		                            </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group"><a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_theme/',array('language'=>Yii::app()->language));?>">Edit last page</a>
                        <button class="btn-green inlin-blk error-event" type="button" ng-click="submitted(!myForm.$invalid && MustMethod && InputMethod);" >Save</button>
                    </div>
			<?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
    <script>
        $('#apply5').parsley();

        function newArticle() {
            var i = 0;
            //當input是有資料的時候，彈跳
            $("#apply5 input").each(function() {
                if ($(this).val() == '') {
                    i++;
                }
            });
            //當input是有資料的時候，彈跳
            if (i == 0) {
                $('body').append('\
				<div class="popUp"> \
					<div class="whiteScreen"></div> \
					<div class="white-popUp">\
						<div class="container"> \
							<h3 style="margin-bottom:30px; margin-top: 20px;">是否刪除XXX藝術家資料？</h3> \
							<div class="btn-green-border pull-left popUp-cancel"><h5>否</h5></div> \
							<div class="btn-green pull-right"><h5> 是</h5></div> \
						</div> \
					</div> \
				</div>')
                return false;
            }
        }
	        function seturl(_chose){
		        $('#backurl').val(_chose);
		        $('#apply5').submit();
	        }
        //form validator
        (function() {

            var OATapp = angular.module('OATapp', []);
	            OATapp.controller('artController', ['$scope', '$http', function ($scope, $http) {
					var _no = '<?=$model->Galleryt1_no;?>';
			        var programdata = '<?=$program;?>';
					var JSON_program = (programdata ? JSON.parse(programdata) : '');
					
					$scope.data = {};
					$scope.model = 'Galleryt1';
					$scope.MustMethod = false;
					$scope.InputMethod = false;
					$scope.submitChecked = false;
					
					for (var i = 0; i < JSON_program.length; i++) {
						var program = JSON_program[i]['program'];
						$('[name="Galleryt1[program][program' + program + ']"]').removeAttr('disabled');
						$('[name="Galleryt1[program][program' + program + ']"]').closest('li').removeAttr('style');
						//$('[name="Galleryt1[program][program' + program + ']"]').attr('required','required');	
					}
					if (_no != ''){
					$http.get('/en/fill/ajax_art/<?=$model->Galleryt1_no;?>')
				        .success(function(response){
				            var data = response;
							console.log(data);
					            $scope.data = data;
					            $scope.data.datafile1_input = data.datafile1;
					            $scope.data.datafile2_input = data.datafile2;
					            $scope.data.datafile3_input = data.datafile3;

                    var _artProgram = '<?=$model->Program;?>';
                        _artProgram = (_artProgram ? JSON.parse(_artProgram) : '');
                        for (var i = 0; i < _artProgram.length; i++) {
                            $scope.data['program'+_artProgram[i]] = true;
                            //$('[name="Galleryt1[program][program' + _artProgram[i] + ']"]').prop('checked',true);
                        }
                        $scope.selectedmethod();
				        });
					}else{
						$scope.data.country = 'Taiwan';
					}
					//選方案
					$scope.selectedmethod = function(){
						$scope.MustMethod = false;
						$scope.InputMethod = false;
						for (var i = 0; i < JSON_program.length; i++) {
							var program = JSON_program[i]['program'];
							var limitYN = $('[name="Galleryt1[program][program' + program + ']"]').attr('nglimit');
							//if($('[name="Galleryt1[program][program' + program + ']"]').prop('checked')){

							if ($scope.data['program'+program]){
								$scope.InputMethod = true;
								if (limitYN & ((new Date().getFullYear()) - $scope.data.birthyear) > 35){
									$scope.MustMethod = false;
									break;
								}
								$scope.MustMethod = true;
							}	
						}
					};
	                //Year select
	                $scope.artworkSelection = "";
	                $scope.URLpath = '<?=Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['art'];?>';
	                //表格填寫完
	                $scope.submitted = function(validation) {
						if (validation){
			                if ('<?=Yii::app()->language;?>' == 'en'){
								$("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3 style="margin-bottom:30px; margin-top: 20px;">Would you like to add more participating artists?</h3><a class="btn-green-border pull-left " onclick="seturl(\'next\')"><h5>No, I\'m done</h5></a><a class="btn-green pull-right" onclick="seturl(\'add\')"><h5> Yes, I want to add more.</h5></a></div></div></div>');      
			                }else{
								$("body").append('<div class="popUp"><div class="whiteScreen"></div><div class="white-popUp"><div class="container"><h3 style="margin-bottom:30px; margin-top: 20px;">您還要繼續新增其他藝術家嗎？</h3><a class="btn-green-border pull-left " onclick="seturl(\'next\')"><h5>進行下一步驟</h5></a><a class="btn-green pull-right" onclick="seturl(\'add\')"><h5> 新增其他藝術家</h5></a></div></div></div>');   
			                }
						}else{
							$scope.submitChecked = true;
						} 
	                };
	                
					$scope.getbg = function(filename){
						//console.log(filename);
						if (filename !== '' & filename != 'undefined'){
							return {'background-image' : 'URL(' + $scope.URLpath + filename + ')'}
						}else{
							return {};
						}
					}
					
					$scope.deletefile = function(filename,name,element){
						alert('123')
						console.log(filename,name,element);
						$.post(
							'/zh/fill/ajax_art_filedelete/<?=$model->Galleryt1_no;?>',
							{
								filename:filename,
								name:name,
								YII_CSRF_TOKEN: '<?=Yii::app()->request->csrfToken?>'
							},
							function(xml){
								var model = element;//;$(element).attr('ng-model');
								console.log(model);
								switch(model){
									case 'data.datafile1':
										$scope.data.datafile1_input = "";	
										break;
									case 'data.datafile2':
										$scope.data.datafile2_input = "";	
										break;
									case 'data.datafile3':
										$scope.data.datafile3_input = "";	
										break;
								}
								$scope.$apply();
								//console.log(xml);
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
									case 'data.datafile1':
										$scope.data.datafile1_input = element.files[0].name;	
										break;
									case 'data.datafile2':
										$scope.data.datafile2_input = element.files[0].name;	
										break;
									case 'data.datafile3':
										$scope.data.datafile3_input = element.files[0].name;	
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
        })();
        $(document).ready(function(){
			//$(".delete-img").hide();
			$(".delete-img").click(function() { 
				$(this).parents(".upload").siblings().css("background-image", "").siblings().attr("value", "");
				$(this).siblings().find(".file-upload-text").text("Upload Image");
				$(this).hide(); 
			});
		});
    </script>