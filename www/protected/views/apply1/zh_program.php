<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>  
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="validator" ng-controller="applyController">
	            <?php //echo CHtml::beginForm('/' . Yii::app()->language . '/fill/apply1_program/', 'post', array('role'=>'form','name'=>'myForm','id'=>'apply3' ,'enableAjaxValidation'=>false, 'novalidate'=>true, 'class'=>'applyTable')) ; ?>
				<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'apply3',
				'enableClientValidation'=>true,
				'htmlOptions'=>array(
					'class'=>'applyTable',
					'name'=>'myForm',
					'novalidate'=>'novalidate'
				),
			)); ?>
                    <div class="title">預定參展方案</div>
                    <h5>註︰以下方案僅供預約不需立即付費</h5>
                    <div class="step">Step1 <span>請選擇參展方案(可複選)</span></div>
                    <div class="step1-container">
	                    <?php 
		                    foreach ($Methodm1 as $i => $row){
	                    ?>
                        <div class="greenbox">
                            <h2><?=$row->MethodM1_title;?></h2>
                            <h6><?=$row->MethodM1_script;?></h6>
                            <div class="checkbox checkbox-custom"><input id="program<?=$row->MethodM1_no;?>" name="program[program<?=$row->MethodM1_no;?>]" class="program<?=$i + 1;?>" type="checkbox" ng-model="program<?=$i + 1;?>" ng-change="modelCheck(program<?=$i + 1;?>,<?=$row->MethodM1_no;?>);" value="true" box="item<?=$i + 1;?>" ><label></label></div>
                        </div>
                        <?php }?>
                    </div>
					<div class="parsley-errors-list filled text-center">
						<span class="error validationerror" ng-show="!program1&&!program2&&!program3">此欄爲必填</span>
					</div>
                    <div class="step">Step2<span>預訂空間規模，並挑選優先順序</span>
                        <!--藝術無限-->
	                    <?php 
		                    foreach ($Methodm1 as $i => $rows){
			                    /*為了驗證任一輸入*/
			                    $roomValidation = '(';
			                    foreach($rows->Roomm1 as $j => $row){
									//擇一填入數字
				                    // if ($roomValidation != '('){
					                //     $roomValidation .= " && ";
				                    // }
				                    // $roomValidation .= "!user.item" . $rows->MethodM1_no . "_" . $row->RoomM1_no;
									//要求全部填入2021
				                    if ($roomValidation != '('){
					                    $roomValidation .= " || ";
				                    }
				                    $roomValidation .= "!user.item" . $rows->MethodM1_no . "_" . $row->RoomM1_no;	
				                }
				                $roomValidation .= " )";
								
	                    ?>
                        <div class="step2 item<?=$i + 1;?>  ">
                            <div class="step2-container" ng-class="{errorshow:program<?=$i+1;?>}">
                                <h2> <?=$rows->MethodM1_title;?></h2>
                                <div class="big-container">
	                                <?php foreach($rows->Roomm1 as $j => $row){?>
                                    <div class="whitebox">
                                        <h3> <?=$row->RoomM1_nm;?></h3>
                                        <h6><?=$row->RoomM1_size;?></h6>
                                        <div class="price">NTD <?=number_format($row->RoomM1_price);?></div>
                                        <?php if (count($rows->Roomm1) > 1){?>
                                        <div class="chose">請選擇房型順位</div>
                                        <!--ng-required="!program<?=$i + 1;?>"-->
                                        <input type="text" method="1" name="program[art<?=$rows->MethodM1_no;?>][<?=$row->RoomM1_no;?>]" ng-model="user.item<?=$rows->MethodM1_no;?>_<?=$row->RoomM1_no;?>" max="<?=count($rows->Roomm1);?>" ng-change="changeOnPrimary('item<?=$rows->MethodM1_no;?>_<?=$row->RoomM1_no;?>','')" ng-pattern="/^[1-<?=count($rows->Roomm1);?>]{1}$/" placeholder="以數字1-2志願排序" ng-required="program<?=$i + 1;?>&&<?='item'.$rows->MethodM1_no .'_'. $row->RoomM1_no;?> != ''" ng-class="{'ng-invalid': item<?=$rows->MethodM1_no;?>_<?=$row->RoomM1_no;?>.$error && submitChecked}"/>
                                        <span class="error validationerror" ng-show="myForm['program[art<?=$rows->MethodM1_no;?>][<?=$row->RoomM1_no;?>]'].$error.pattern">請輸入1-<?=count($rows->Roomm1);?>數字</span>
										<span class="error validationerror" ng-show="myForm['program[art<?=$rows->MethodM1_no;?>][<?=$row->RoomM1_no;?>]'].$error.required && submitChecked">請輸入數字</span>
                                        <?php }else{ ?>
	                                        <input type="hidden" name="program[art<?=$rows->MethodM1_no;?>][<?=$row->RoomM1_no;?>]" value="1">
                                        <?php }?>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                            <div class="info"><?=nl2br($rows->MethodM1_remarker);?></div>
                        </div>
                        <?php }?>
        			</div>
					<div class="btn-group">
						<a class="btn-green-border" href="<?=$this->createUrl('/fill/apply1_experience/',array('language'=>Yii::app()->language));?>">回上一步修改資料</a>
						<!-- <button class="btn-green" type="sumbit" ng-disabled="myForm.$invalid || !program1&&!program2&&!program3">完成送出</button> -->
						<button class="btn-green inlin-blk error-event" type="button" ng-click="submitted(myForm.$invalid || !program1&&!program2&&!program3)">完成送出</button>
					</div>
                <?php //echo CHtml::endForm() ; ?>
				<?php $this->endWidget(); ?>
    		</div>
    	</div>
    <script>
		(function() {
            var validator = angular.module('validator', []);
            validator.controller('applyController', ['$scope', function($scope) {
	        
	        var programdata = '<?=$model->program;?>';
			var JSON_program = (programdata ? JSON.parse(programdata) : '');
			
                $scope.program1 = false;
                $scope.program2 = false;
                $scope.program3 = false;
				$scope.user = {};
				$scope.submitChecked = false;
                $scope.changeOnPrimary = function(x, v) {
                    angular.forEach($scope.user, function(value, key) {
	                    //console.log(x.indexOf("_"),x.substr(0, x.indexOf("_")));
	                    if (x.substr(0, x.indexOf("_")) == key.substr(0, key.indexOf("_")) ){
	                        if (x != key){
		                        if (value == $scope.user[x]) {
	                                $scope.user[key] = "";
	                            }
	                        }
                        }
                        
                    });
                }
				$scope.submitted = function(validation){
					console.log('validation', validation )
					if (validation){
						$scope.submitChecked = true;
					}else{
						$('#apply3').submit();
						
					}
				};
            if (JSON_program){
				for (var i = 0; i < JSON_program.length; i++) {
					var program = JSON_program[i]['program'];
					var value = JSON_program[i]['value'];
					var room = JSON_program[i]['room'];
					var getname = '[name="program[program' + program + ']"]';
					$scope[$(getname).attr('ng-model')] = true;
					$('.'+ $(getname).attr('box')).show();
					for (var j = 0; j < value.length; j++) {
						var value_getname = '[name="program[art' + program + '][' + room[j] + ']"]';
						$(value_getname).val(value[j]);
						
						if ($(value_getname).attr('ng-model')){							
							var x = $(value_getname).attr('ng-model').indexOf(".");
							var l = $(value_getname).attr('ng-model').substring(x + 1, $(value_getname).attr('ng-model').length);
							$scope.user[l] = parseInt(value[j]);
						}
					}
	
				}
			}
            }]);

        })();
		$(document).ready(function() {
		    $(".program1").change(function() {
		        //$(this).prop("checked") ? $(".item1").show();$(".item1 input").attr('required','required'); : $(".item1").hide() 
		        if ($(this).prop("checked")){
			        $(".item1").show();$(".item1 input").attr('required','required');
		        }else{
			        $(".item1").hide();
		        }
		    }),
		    $(".program2").change(function() {
		        //$(this).prop("checked") ? $(".item2").show() : $(".item2").hide()
		        if ($(this).prop("checked")){
			        $(".item2").show();$(".item2 input").attr('required','required');
		        }else{
			        $(".item2").hide();
		        }
		    }),
		    $(".program3").change(function() {
		        $(this).prop("checked") ? $(".item3").show() : $(".item3").hide()
		    }),
		    $(".first,.second,.third").click(function() {
		        $(".step2-container input").each(function() {
		            1 == $(this).prop("checked") ? $(this).parent("label").addClass("active") : $(this).parent("label").removeClass("active")
		        }),
		        $(this).siblings().find("input").prop("checked", !1)
		    })
		});
    </script>