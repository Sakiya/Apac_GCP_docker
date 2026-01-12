	<div class="main-content mb4">
		<div class="main-content-inner">
			<div class="page-header col-lg-12">
				<h4><?=User::model()->getController();?></h4>					
			</div>
			<div class="container">
				<div class="addMember">
					<?php echo CHtml::beginForm('', 'post', array('class' => 'form-horizontal','enctype'=>'multipart/form-data')); ?>
					<div class="step1">  
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_no'); ?></label>
								<div class="col-sm-5 controls">
									<?php 
										echo CHtml::activeDropDownList($model, 'MethodM1_no', Methodm1::model()->listData(), array('class'=>'Select_1')); 
									?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_no'); ?></span>
								</div>
                        </div>              
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_nm'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_nm', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_nm'); ?></span>
								</div>
						</div>	
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_nm_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_nm_en', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_nm_en'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_size'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_size', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_size'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_size_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_size_en', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_size_en'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_price'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_price', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_price'); ?></span>
								</div>
						</div>	
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'RoomM1_price_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'RoomM1_price_en', array('class'=>'col-sm-8')); ?>
									<span class="note"><?php echo CHtml::error($model, 'RoomM1_price_en'); ?></span>
								</div>
						</div>
						
						<?php if ($action != 'add'){?>	
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'資料更新'); ?></label>
							<div class="col-sm-2 controls"><?=$model->updateuser;?></div></div>								
						</div>	
						<?php }?>				
						<div class="btnBox center col-lg-9">
							<?php echo CHtml::tag('button',array('class' => 'btn btn-default btn-lg', 'onClick' => "window.location='/" . Yii::app()->controller->id . "/adminindex/';return false;"),'取消');?>
							<?php echo CHtml::tag('button',array('class' => 'btn btn-primary btn-lg','type' => 'submit'),('add' == $action) ? '新　　增' : '儲　　存');?>
						</div>
					</div>
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
		</div>
	</div>
<script>
	function Deletefile(Dcols){
		$('#file_' + Dcols).val('');
		$('#box_' + Dcols).remove();
	}
</script>
