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
                    <div class="title">Campaign Announcement and Schedule</div>
                    <h5>Please read through all the campaign details and important schedule.</h5>
                    <!--徵件簡章-->
                    <div class="info">
                        <div class="info-container"><p><?php echo $this->Year['Yearm1_script2_en'];?></p></div>
                    </div>
                    <div class="checkbox checkbox-custom">
                        <input id="read" name="read" type="checkbox" value="true" ng-checked="data.finishStep2_1" ng-model="data.finishStep2_1">
                        <label for="read">I've read the Campaign Announcement and Schedule thoroughly, and also agreed to provide fair required information for marketing uses.</label>
                    </div>
                    <button type="button" class="text-center btn-green start-registreted" ng-disabled="!data.finishStep2_1" ng-click="register()">Start</button>
                <?php echo CHtml::endForm() ; ?>
            </div>
        </div>
    <script type="text/javascript">
        //form validator
        (function() {
			var OATapp = angular.module('OATapp', []);
            OATapp.controller('applyController', ['$scope', '$http', function ($scope, $http) {
					$http.get('<?=$this->createUrl('/en/data2/ajax_agree/',array('language'=>Yii::app()->language))?>').success(function(response){
				            var data = response;
				            console.log(data);
				            $scope.data = data;
                            $scope.data.finishStep2_1 = false;
							if ($scope.data.finishStep2_1 == '1'){
								$scope.data.finishStep2_1 = true;
							}
				        });
                    $scope.register = function() {
	                    $.post(
		                    '<?=$this->createUrl('/apply2/agree/',array('language'=>Yii::app()->language))?>',
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