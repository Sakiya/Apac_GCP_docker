	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="/" target="_blank"><?php echo Yii::app()->name; ?></a></h1>
			<h2 class="section_title" style="font-size: 15px;"><?php echo $_GET['controller']; ?></h2><div class="btn_view_site"><a href="<?php echo Yii::app()->createUrl('site/logout'); ?>" target="_top"><!--<img src="<?php echo Html::adminImageUrl('icn_jump_back.png'); ?>" width="12" height="12">-->Logout</a></div>
		</hgroup>
	</header> <!-- end of header bar -->