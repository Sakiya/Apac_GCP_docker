<?php
	$expire = $this->expireDate;
?>
<!DOCTYPE html>
<html>
<html lang="<?=Yii::app()->language;?>" xml:lang="<?=Yii::app()->language;?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-language" content="zh-tw">
    <link rel="apple-touch-icon" sizes="152x152" href="/main/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/main/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/main/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="/main/img/favicons/manifest.json">
    <link rel="mask-icon" href="/main/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">
	<meta name="copyright" content="Copyright c <?=date("Y")?>">

	<!--  Desktop Favicons  -->
    <title><?=Yii::app()->name;//=(Yii::app()->language == 'en' ? Yii::app()->params['titleEN'] . ' - ' .  $this->PageTitleEN: Yii::app()->params['title'] . ' - ' .  $this->PageTitle); ?></title>
	<?php
		$this->DisplayMetaTag();
	?>
    <!--============================== css start ==============================-->
	<?php Yii::app()->clientScript->registerCssFile(Html::cssUrl('style.css?' . $expire, 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::cssUrl('en_style.css?' . $expire, 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::cssUrl('font-awesome/font-awesome.min.css?' . $expire, 'screen'));?>
	<?php Yii::app()->clientScript->registerCssFile(Html::cssUrl('dropify/dropify.min.css?' . $expire, 'screen'));?>
    <?php //Yii::app()->clientScript->registerCssFile("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");?>
    <?php //Yii::app()->clientScript->registerCssFile("https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css");?>
	<?php Yii::app()->clientScript->registerCssFile(Html::cssUrl('formVarify.css?' . $expire, 'screen'));?>
	<?php Yii::app()->clientScript->registerScriptFile(Html::scriptUrl('app.js?' . $expire), CClientScript::POS_HEAD);?>
	<?php //Yii::app()->clientScript->registerScriptFile("https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js", CClientScript::POS_HEAD);?> 
	<?php Yii::app()->clientScript->registerScriptFile("https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js", CClientScript::POS_HEAD);?> 
	<?php Yii::app()->clientScript->registerScriptFile("https://www.google.com/recaptcha/api.js?hl=" .Yii::app()->params['langrecaptcha'][Yii::app()->language], CClientScript::POS_HEAD);?> 
	<?php Yii::app()->clientScript->registerScriptFile(Html::scriptUrl('sweetalert.js'));?>
    <!--============================== css close ==============================-->
    <!--============================== script start ==============================-->
	<meta http-equiv="Content-Security-Policy" content="Content-Security-Policy: default-src 'self';script-src 'self' *.ajax.googleapis.com *.googletagmanager.com *.google-analytics.com 'unsafe-inline' 'unsafe-eval';connect-src 'self' *.google-analytics.com 'unsafe-inline';style-src 'self' 'unsafe-inline';style-src-elem 'self' 'unsafe-inline' data:;img-src 'self' 'unsafe-inline' *.google-analytics.com blob: data:;font-src 'self' 'unsafe-inline' data:;
frame-ancestors 'none'; 
block-all-mixed-content; 
upgrade-insecure-requests;">
	<?php $this->renderPartial('/layouts/Analytics'); ?> 
</head>

<body class="<?=Yii::app()->language;?>">
    <div class="art-container <?=$this->LayoutClass;?>">
	<?php //$this->renderPartial('/layouts/menu'); ?> 
	
	<?=$content;?>

	<?php //$this->renderPartial('/layouts/footer'); ?> 
    <!-- Footer - Default Style -->

</body>
</html>
