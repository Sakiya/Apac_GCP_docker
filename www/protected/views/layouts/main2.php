<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" user-scalable="1">
<meta http-equiv="Cache-Control" content="no-cache"> 
<!--<meta http-equiv="X-UA-Compatible" content="IE=10;IE=8">-->
<title><?php //echo Yii::app()->name; ?>OAT 台管理系統</title>
	<!--<link rel="stylesheet" href="/admin/css/layout.css" type="text/css" media="screen" />-->
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('bootstrap.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('bootstrap-theme.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('font-awesome/4.2.0/css/font-awesome.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('fullcalendar.min.css', 'screen'));?>	
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('ace.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('select2.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('datepicker.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('jquery.dataTables.min.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('jquery.timepicker.css', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('ekko-lightbox.css', 'screen'));?>	
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('style.css?v=20171101v2', 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('project.css', 'screen'));?>
	<?php //Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('admin_review-min.css?v=20171211', 'screen'));?>
</head>
<body>
	<?php
		if (strtolower(Yii::app()->controller->id) == 'zuser' && strtolower($this->action->id) == 'adminedit'){
			echo '<link rel="stylesheet" type="text/css" href="/admin/css/admin_review-min.css?v=20171211">';
		}
		if (strtolower(Yii::app()->controller->id) == 'zlist' && strtolower($this->action->id) == 'adminedit'){
			echo '<link rel="stylesheet" type="text/css" href="/admin/css/admin_review-min.css?v=20171211v3">';
		}
	?>
	<div class="no-skin">
		<div id="navbar" class="navbar navbar-default">
			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>
			    	<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small><?php echo Yii::app()->name; ?></small>
					</a>
				</div>
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					
					<ul class="nav ace-nav">
                    <!--
						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important"></span>
							</a>
							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									提醒
								</li>
								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-pink">
									</ul>
								</li>

							</ul>
						</li>
					-->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
			                    <span class="user-info">
			                        <small>Welcome,</small><?php echo Yii::app()->user->name; ?></span>
			                    <i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
			    
								<li>
									<a href="/site/logout"><i class="ace-icon fa fa-power-off"></i>Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>		

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
				<ul class="nav nav-list">
					<li class="active">
						<a >
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>
						<b class="arrow"></b>
					</li>
				 <?php 
                //取得年份
                if (Yii::app()->user->getState('bgYear') == ''){
                    $Year = Yearm1::model()->find(
                        array(
                            'order'=>' Yearm1_open1st desc ',
                            'limit'=>1
                        ));
                    Yii::app()->user->setState('bgYear',$Year->Yearm1_no);
                }
                ?> 
				<li class="text-center">年度:<?=CHtml::dropDownList('setYear',Yii::app()->user->getState('bgYear'),Yearm1::model()->listData(),array("onchange"=>"setyear(this)"));?><li>
				<?php
					$permissionTree = Yii::app()->user->model->backendPermissionTree();
					//主選單
					$isOpen = false;
					foreach($permissionTree as $cat)
					{		            
			            //$subModuleTopUrl = Yii::app()->createUrl('admin/top', array('controller' => $cat->name . ' - ' . $module->name));
			            //$subModuleFuncUrl = Yii::app()->createUrl('admin/funcbar', array('module_ID' => $module->id));	
					?>
                    <li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa <?=$cat->icon?>" ></i>
							<span class="menu-text">
								<?=$cat->name?><span class="badge badge-primary"><?=count($cat->module)?></span>
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu nav-show" <?=$cat->open == 'Y' ? 'style="display: block;"' : '';?>>
							<?php 
								foreach($cat->module as $module) { 
						            $permission = $module->permission[0];
						            $subModuleContentUrl = Yii::app()->createUrl($module->controller .'/'. $permission->action);
						            //$subModuleTopUrl = Yii::app()->createUrl('admin/top', array('controller' => $cat->name . ' - ' . $module->name));
						            //$subModuleFuncUrl = Yii::app()->createUrl('admin/funcbar', array('module_ID' => $module->id));
							?>
							<li <?= ('/' . Yii::app()->getRequest()->getPathInfo() == $subModuleContentUrl ? 'class="active"':'')?>>
								<a href="<?php echo $subModuleContentUrl; ?>"><i class="menu-icon fa fa-caret-right"></i><?=$module->name;?></a>
								<b class="arrow"></b>
							</li>
							<?php } ?>
						</ul>
					</li>	
					<?php } ?>
                    <li>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa " ></i>
							<span class="menu-text">報名資料匯出<span class="badge badge-primary">8</span>
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu nav-show" style="display: block1;">
							<li><?=CHtml::link('藝廊聯絡資料',array('zimport/Adminstep1gallery')); ?></li>
							<li><?=CHtml::link('匯款資料',array('zimport/Adminstep1bank')); ?></li>
							<li><?=CHtml::link('藝術家作品資料',array('zimport/Adminstep2award')); ?></li>
							<li><?=CHtml::link('USD3,000',array('zimport/Adminstep2work', 'key'=>1)); ?></li>
							<li><?=CHtml::link('行銷可用圖檔',array('zimport/Adminstep2work', 'key'=>2)); ?></li>
							<li><?=CHtml::link('專刊使用圖檔',array('zimport/Adminstep2print')); ?></li>
							<li><?=CHtml::link('貴賓卡郵寄名單',array('zimport/Adminstep2vip')); ?></li>
							<li><?=CHtml::link('匯款資料',array('zimport/Adminstep2bank')); ?></li>
						</ul>
					</li>                         
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					//try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>			
			</div>
			<!--內容新增在此-->
			<!--主要內容-->
            <div class="main-content">
				<?php $this->renderPartial('/admin/common/alertMessage'); ?>   
				<?php echo $content;?>
			</div>
			<!--
            <footer class="footer" id="footer">
            	<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder"></span>
							Application &copy; 2016
						</span>&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>
							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>
							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
						
					</div>
				</div>
			</footer>
			-->
		</div><!--main contain-->	
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
	</div>

	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('moment.min.js'));?>	
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('bootstrap.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery-ui.min.js'));?>
	
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('fullcalendar.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('select2.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('bootstrap-datepicker.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('ace-elements.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('ace.min.js'));?>	
	
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.dataTables.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.dataTables.bootstrap.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.timepicker.min.js'));?>	
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('dataTables.tableTools.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('dataTables.colVis.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.twzipcode.min.js'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('ekko-lightbox.min.js'));?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
	<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('/ckeditor/ckeditor.js?v=20171101v1'));?>
	<?php //Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('/ckfinder/ckfinder.js'));?>
	<script>
		$(function(){
			$('.submenu.nav-show').each(function(){

				//if($(this).find('li.active').length != 0){
				//	$(this).show();
				//}

			});
			
			if ($('#twzipcode').length != 0){
				$('#twzipcode').twzipcode({
				    'countyName'   : 'county[]',
				    'districtName' : 'district[]',
				    //'zipcodeName'  : 'zipcode[]',
				});
			}
	    //autocomplete
	    	if ($(".NameAutocomplete").length > 0){
	    		$(".NameAutocomplete").select2();
	    	}
	    	
	    	if ($('.date-time').length > 0){
				$('.date-time').timepicker({ 
					'timeFormat': 'H:i',
					'minTime': '7:00am',
					'maxTime': '17:00pm',
				});
			}
			
			$(document).on('click', '[data-toggle="lightbox"]', function(event) {
			    event.preventDefault();
			    $(this).ekkoLightbox();
			    
			});
		});
	    function Deletefile(Dcols){
				$('#file_' + Dcols).val('');
				$('#box_' + Dcols).remove();
		}
		function setyear(obj){
			window.location = '/ZYearm1/adminsetyear?id=' + $(obj).val();
		}
	</script>	
</body>
</html>