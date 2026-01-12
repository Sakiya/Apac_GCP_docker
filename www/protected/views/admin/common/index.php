<section id="main" class="column">	
	<div class="sectionContent">
		<?php $this->renderPartial('/admin/common/alertMessage'); ?>
		<?php echo $listTable; ?>
		<?php 
			if (isset($permissionTree)){
				echo $permissionTree; 	
			}			
		?>
	</div>
</section>
<div class="secondary_bar_shadow">
