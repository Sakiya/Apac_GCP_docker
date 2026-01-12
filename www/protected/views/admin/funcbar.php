	<section id="secondary_bar">
		<div class="breadcrumbs_container">
	<!-- FuncBar -->
	<?php
		if ($module){
	        $permissions = $module->permission;
	        while(list($k, $permission) = each($permissions)){
	        	if ($permission->type <> 1 && $permission->type <> 2){
	        		continue;
	        	}
	?>
	<span style="width:40px; height:100%; padding: 1px 0 0 25px; text-align: center; float:left; ">
		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
		<tr align="center" valign="bottom">
		<td >
		<?php
		        $icon = ($permission->icon)? $permission->icon : "application.png";
		?>
		<a href="<?php echo Yii::app()->createUrl($module->controller .'/'. $permission->action );?>" <?=$permission->option?> target="content">
		<img border="0" src="<?php echo Html::adminImageUrl('spacer.gif'); ?>" style="width: 20px;  height: 20px; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo Html::adminImageUrl($icon); ?>', sizingMethod='crop');background:url('<?php echo Html::adminImageUrl($icon); ?>')!important;background:url('<?php echo Html::adminImageUrl('spacer.gif'); ?>');">
		</a>
		</td>
		</tr>
		<tr align="center" valign="top"><td nowrap> <?=$permission->name?> </td></tr>
		</table>
	</span>
	<?php
	        }
		}
	?>
	<!-- /FuncBar -->

	<!-- OptionSearch -->
	<?php
	    if ($module->option_search)
	    {
	        $target = $module->permission[0]->action;
	        
	?>
	<div style="width:200px; padding: 1px 20px 0 0; float: right;">
		<!--
		<form class="quick_search" id="quick_search" action="<?php echo Yii::app()->createUrl($module->controller . '/' . $target);?>" target="content" method="get">
			<input type="text" value="Quick Search" id="keyword" name="keyword" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		-->
		<form class="quick_search" action="<?php echo Yii::app()->createUrl($module->controller . '/' . $target);?>" target="content" method="get">
			<input type="text" value="" id="keyword" name="keyword" placeholder="快速搜尋">
		</form>
	</div>	
	<?php
	    }
	?>
	<!-- /OptionSearch -->

		</div>
		
		<div class="secondary_bar_line"/>
		
	</section><!-- end of secondary bar -->
