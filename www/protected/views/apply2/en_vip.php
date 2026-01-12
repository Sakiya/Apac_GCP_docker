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
					'id'=>'apply2_info',
					'name'=>'myForm',
					'novalidate'=>'novalidate',
					//'ng-submit'=>"newArticle()",
					'enctype'=>'multipart/form-data',
				),
			)); ?>
                    <div class="title">VIP Card Mailing List (Required)</div>
                    <h5>
                        <!-- <p>請務必完整填寫此表格所有欄目！</p> -->
                        <br>
                        <p>1.OAT committee is going to send 1 VVIP card and 5 VIP cards to guests on the name list. The rest amount of cards will be sent to your gallery.</p>
                        <br>
                        <p>2.Due to the limited quantity of VIP cards, VIP cards should be provided to collectors only. We suggest you to offer one-day pass or exhibitor's pass to your staff or participating artists.</p>
                    </h5>
            
                    <div class="vipTicketBox">
                        <ul>
                            <li class="vipTicket-item" ng-repeat="item in data.vip track by $index">
                                <span class="ticketTtl" ng-show="$index == 0">VVIP Card</span>
                                <span class="ticketTtl" ng-show="$index == 1">VIP Card</span>
                                <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]type', array('style'=>'width:0px;height:0px;opacity:0;','value'=>'{{$index === 0 ? 1 : 2}}')); ?>
                                <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]card_no', array('ng-model'=>"item.card_no",'style'=>'width:0px;height:0px;opacity:0;')); ?>
                                <span class="ticketCont">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="control-group" >
                                                    <label>Company/Title<span class="red" ng-show="$index < 2">*</span></label>
                                                    <div class="controls">
                                                        <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]company', array('class'=>'form','ng-model'=>"item.company",'parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required. ",'style'=>"width:100%",'ng-required'=>'test(item)')); ?>
                                                        <div class="parsley-errors-list filled">
                                                            <span class="error validationerror" ng-show="myForm['{{model}}[{{$index}}][company]'].$error.required && submitChecked">This field is required. </span>
                                                        </div> 
                                                    </div>
                                                </td>
                                                <td class="control-group"><label>Guest Name<span class="red" ng-show="$index < 2">*</span></label>
                                                    <div class="controls" style="margin-bottom: 10px;">
                                                        <div class="controls">
                                                            <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]name', array('class'=>'form','ng-model'=>"item.name",'parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required. ",'style'=>"width:100%",'ng-required'=>'test(item)')); ?>
                                                            <div class="parsley-errors-list filled">
                                                                <span class="error validationerror" ng-show="myForm['{{model}}[{{$index}}][name]'].$error.required && submitChecked">This field is required. </span>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="control-group"><label>Contact Number<span class="red" ng-show="$index < 2">*</span></label>
                                                    <div class="controls" style="margin-bottom: 10px;">
                                                        <div class="controls">
                                                            <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]tel', array('class'=>'form','ng-model'=>"item.tel",'parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required. ",'style'=>"width:100%",'ng-required'=>'test(item)')); ?>
                                                            <div class="parsley-errors-list filled">
                                                                <span class="error validationerror" ng-show="myForm['{{model}}[{{$index}}][tel]'].$error.required && submitChecked">This field is required. </span>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="control-group" colspan="3"><label>Zip code & Address<span class="red" ng-show="$index < 2">*</span></label>
                                                    <div class="controls" style="margin-bottom: 10px;">
                                                        <div class="controls">
                                                            <?php echo CHtml::activeTextField($Vipcard, '[{{$index}}]address', array('class'=>'form','ng-model'=>"item.address",'parsley-trigger'=>"change",'data-parsley-required-message'=>"This field is required. ",'style'=>"width:100%",'ng-required'=>'test(item)')); ?>
                                                            <div class="parsley-errors-list filled">
                                                                <span class="error validationerror" ng-show="myForm['{{model}}[{{$index}}][address]'].$error.required && submitChecked">This field is required. </span>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a class="btn-green-border" href="stage02_Check_info.html">Go back to previous page</a>
                        <button class="btn-green inlin-blk" type="button" ng-click="register(myForm.$valid);">Save and Next</button>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    <script type="text/javascript">
      //form validator
      (function() {
          var validator = angular.module('validator', []);
          validator.controller('applyController', ['$scope', '$http', function ($scope, $http) {
            $scope.data = [];
            $scope.model = 'Vipcard';
            $scope.vip = {
                company : "",
                name : "",
                tel : "",
                address : "",
                type: "",
                card_no: ""
            };
              $scope.data.vip = Array(6);
              $scope.submitChecked = false;
              //console.log($scope.data.vip);
              $http.get('<?=$this->createUrl('/data2/Ajax_Vip/',array('language'=>Yii::app()->language))?>')
					.success(function(response){
						var data = response;
                        var _current = 1;

                        data.forEach(function(item, index, array){
                            if (item.type == "1"){
                                $scope.data.vip[0] = item;
                            }
                            if (item.type == "2"){
                                $scope.data.vip[_current] = item;
                                _current ++;
                            }
                        });
					});
                $scope.register = function(validation) {
                    if (validation){
                        $('#apply2_info').submit();
                    }else{
                        $scope.submitChecked = true;
                    }
                };
                $scope.test = function(_item){
                    //var _vip = $scope.data.vip[_index];
                    /*
                    if (_item){
                        if (_item.company == undefined){_item.company = ''};
                        if (_item.name == undefined){_item.name = ''};
                        if (_item.tel == undefined){_item.tel = ''};
                        if (_item.address == undefined){_item.address = ''};
                        if (_item.company != '' || _item.name != '' || _item.tel != "" || _item.address != ""){
                            return true;
                        }
                    }
                    */
                    return false;
                }
          }]);
      })();
    </script>