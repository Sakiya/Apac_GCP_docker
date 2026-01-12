		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="OATapp" ng-controller="applyController">
	            <?php echo CHtml::beginForm('', 'post', array('role'=>'form','name'=>'myForm','id'=>'apply','novalidate'=>'novalidate','ng-submit'=>'register();')) ; ?>
                    <div class="title">Introduction</div>
                    <h5>Please read the introduction thoroughly.</h5>
                    <!--徵件簡章-->
                    <div class="info">
                        <div class="info-container"><p><?php echo $this->Year['Yearm1_script_en'];?></p></div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" type="checkbox" value="true" ng-checked="data.finishStep1" ng-model="data.finishStep1">
                        <label for="read">I have read the introduction.</label>
                    </div>
                    <button type="button" class="text-center btn-green start-registreted" ng-disabled="!data.finishStep1" ng-click="register()">Start Application</button>
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
    <script type="text/javascript">
        //form validator
        (function() {
			var OATapp = angular.module('OATapp', []);
            OATapp.controller('applyController', ['$scope', '$http', function ($scope, $http) {
					$http.get('/en/fill/ajax_agree').success(function(response){
				            var data = response;
				            //console.log(data);
				            $scope.data = data;
							if ($scope.data.finishStep1 == '1'){
								$scope.data.finishStep1 = true;
							}else{
								$scope.data.finishStep1 = '';
							}
				        });
	                $scope.register = function() {
	                    $.post(
		                    '/en/fill/apply1_agree',
		                    $('#apply').serialize(),
		                    function(xml){
			                    var _xml = JSON.parse(xml);
			                    if (_xml.resu){
				                    window.location = _xml.url;
			                    }
			                    //alert($('resu',xml).text());
		                    }
	                    )
	                };
            }]);
        })();
    </script>