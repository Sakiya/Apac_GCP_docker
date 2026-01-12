<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Login</title>

<?php //Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('login.css', 'screen'));?>
<?php //Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php ////Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('custom_jquery.js'));?>
<?php //Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('jquery.pngFix.pack.js'));?>
<!--<link rel="stylesheet" href="/admin/css/layout.css" type="text/css" media="screen" />-->
<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('bootstrap.css', 'screen'));?>
<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('bootstrap-theme.css', 'screen'));?>
<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('ace.min.css', 'screen'));?>
<?php Yii::app()->clientScript->registerCssFile(Html::adminCssUrl('style.css', 'screen'));?>

<script type="text/javascript">
$(document).ready(function(){
//$(document).pngFix( );
});
</script>
</head>
	<body>
	<div class="no-skin">
		<div class="logInPage">
			<div class="main-container" id="main-container">
	            <div class="main-content">
	                <div class="main-content-inner">
						<div class="login-layout light-login">
							<div class="main-container">
<div class="login-container">
								<div class="center">
									<h1>
										<div class="logo success"><?=Yii::app()->name?></div>
										<span class="red"></span>
										<span class="white" id="id-text2"></span>
									</h1>
									<!--<h4 class="blue" id="id-company-text">&copy; Company Name</h4>-->
								</div>
								<div class="space-6"></div>
									<div class="position-relative">
										<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
											<h4 class="header blue lighter bigger">登入Login</h4>
											<div class="space-6"></div>
											<?php $form=$this->beginWidget('CActiveForm', array(
												'id'=>'login-form',
												'enableClientValidation'=>true,
												'clientOptions'=>array(
													'validateOnSubmit'=>true,
												),
											)); ?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<?php echo $form->textField($model,'username', array('class'=>'form-control login-inp','required'=>'required','placeholder'=>'帳號')); ?>
															<i class="ace-icon fa fa-user"></i>
															<?php echo $form->error($model,'username', array('style'=>'padding-top:4px')); ?>  
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<?php echo $form->passwordField($model,'password', array('class'=>'form-control login-inp','required'=>'required','placeholder'=>'密碼','autocomplete'=>'off')); ?>
															<?php echo $form->error($model,'password', array('style'=>'padding-top:4px')); ?>
															<i class="ace-icon fa fa-user"></i>                  
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right ">
															<?php echo $form->textField($model,'captchaCode', array('class'=>'form-control login-inp_s pull-right ','required'=>'required','placeholder'=>'驗證碼','autocomplete'=>'off')); ?>														

															<?php echo $form->error($model,'captchaCode', array('style'=>'padding-top:4px')); ?>
															<i class="ace-icon fa fa-user"></i>                  
														</span>
														<span>
															<?php $this->widget('CCaptcha', array('captchaAction'=>'site/captcha', 'imageOptions'=>array('id'=>'captchaImage', 'style'=>'cursor: pointer;'), 'clickableImage'=>true, 'showRefreshButton'=>false, 'buttonLabel'=>'', 'buttonOptions'=>array())); ?>
															<?php echo $form->error($model,'captchaCode', array('style'=>'clear:both;padding-top:4px')); ?>
														</span>
													</label>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right ">
															<?php echo $form->checkBox($model,'rememberMe', array('class'=>'checkbox-size')); ?>
															<?php echo $form->label($model,'rememberMe', array('style'=>'padding-left:0px')); ?>
														</span>
													</label>														
							    										<div class="space"></div>
																		<div class="clearfix">
																			<?php echo CHtml::submitButton('Login', array('class'=>'width-35 pull-right btn btn-sm btn-primary')); ?>	
																		</div>
																		<div class="space-4"></div>
																	</fieldset>
<?php $this->endWidget(); ?>	
																<div class="social-or-login center">
																	<span class="bigger-110"></span>
																</div>

																<div class="space-6"></div>
															</div><!-- /.login-box -->
														</div><!-- /.position-relative -->
													</div>
												</div><!-- /.col -->
											</div><!-- /.row -->              
							</div>
		            	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('bootstrap.min.js'));?>

</html>