<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="OATapp" ng-controller="applyController">
	            <?php echo CHtml::beginForm('', 'post', array('role'=>'form','name'=>'myForm','id'=>'apply','novalidate'=>'novalidate','ng-submit'=>'register();')) ; ?>
                    <div class="title">報名簡章</div>
                    <h5>請詳閱報名簡章</h5>
                    <!--徵件簡章-->
                    <div class="info">
                        <div class="info-container"><p><?php echo $this->Year['Yearm1_script'];?></p></div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" type="checkbox" value="true" ng-checked="data.finishStep1" ng-model="data.finishStep1">
                        <label for="read">我已詳閱報名簡章</label>
                    </div>
                    <button type="button" class="text-center btn-green start-registreted" ng-disabled="!data.finishStep1" ng-click="register()">開始報名</button>
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
    <script type="text/javascript">
        //form validator
        (function() {
			var OATapp = angular.module('OATapp', []);
            OATapp.controller('applyController', ['$scope', '$http', function ($scope, $http) {
					$http.get('/zh/fill/ajax_agree').success(function(response){
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
		                    '/zh/fill/apply1_agree',
		                    $('#apply').serialize(),
		                    function(xml){
			                    var _xml = JSON.parse(xml);
			                    //console.log(_xml)
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