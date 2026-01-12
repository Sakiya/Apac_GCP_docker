<!--menu-->
    <div class="left-menu">
        <?php $this->renderPartial('/layouts/menu_data2'); ?> 
    </div>
        <!--登出時間-->
        <?=$loginInfo;?>
        <!--內文-->
        <div class="right">
            <div class="container" ng-app="OATapp" ng-controller="applyController">
	            <?php echo CHtml::beginForm('/', 'post', array('role'=>'form','name'=>'myForm','id'=>'apply','novalidate'=>'novalidate','ng-submit'=>'register();')) ; ?>
                    <div class="title">行銷配合事項及時程公告</div>
                    <h5>請詳閱以下各項行銷活動的細節及藝博會重要時程之說明</h5>
                    <!--徵件簡章-->
                    <div class="info">
                        <div class="info-container"><p><?php echo $this->Year['Yearm1_script2'];?></p></div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" type="checkbox" value="true" ng-checked="data.finishStep2_1" ng-model="data.finishStep2_1">
                        <label for="read">我已詳閱行銷配合事項及時程公告並同意提供相關資料配合藝博行銷宣傳</label>
                    </div>
                    <button type="button" class="text-center btn-green start-registreted" ng-disabled="!data.finishStep2_1" ng-click="register()">開始資料填寫</button>
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
    <script type="text/javascript">
        //form validator
        (function() {
			var OATapp = angular.module('OATapp', []);
            OATapp.controller('applyController', ['$scope', '$http', function ($scope, $http) {
					$http.get('/zh/data2/ajax_agree').success(function(response){
				            var data = response;
				            //console.log(data);
				            $scope.data = data;
							if ($scope.data.finishStep2_1 == '1'){
								$scope.data.finishStep2_1 = true;
							}else{
								$scope.data.finishStep2_1 = '';
							}
				        });
                    $scope.register = function() {
	                    $.post(
		                    '/zh/apply2/agree',
		                    $('#apply').serialize(),
		                    function(xml){
			                    var _xml = JSON.parse(xml);
			                    console.log(_xml)
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