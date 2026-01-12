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
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'YearM1_no'); ?></label>
								<div class="col-sm-5 controls">
                                    <?php 
										echo CHtml::activeDropDownList($model, 'YearM1_no', $Yearm1, array('class'=>'Select_1'));
                                    ?>									
									<span class="note"><?php echo CHtml::error($model, 'YearM1_no'); ?></span>
								</div>
                        </div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_yearlimit'); ?></label>
							<div class="col-sm-5 controls">
								<?php echo CHtml::activeCheckBox($model, 'MethodM1_yearlimit', array('class'=>'form-control')); ?>
								<span class="note"><?php echo CHtml::error($model, 'MethodM1_yearlimit'); ?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_title'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'MethodM1_title', array('class'=>'col-sm-4')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_title'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_title_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'MethodM1_title_en', array('class'=>'col-sm-4')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_title_en'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_script'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'MethodM1_script', array('class'=>'form-control','rows' => '3')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_script'); ?></span>
								</div>
						</div>   
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_script_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'MethodM1_script_en', array('class'=>'form-control','rows' => '3')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_script_en'); ?></span>
								</div>
						</div>
						
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_remarker'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'MethodM1_remarker', array('class'=>'form-control','rows' => '3')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_remarker'); ?></span>
								</div>
						</div>   
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'MethodM1_remarker_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'MethodM1_remarker_en', array('class'=>'form-control','rows' => '3')); ?>
									<span class="note"><?php echo CHtml::error($model, 'MethodM1_remarker_en'); ?></span>
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
	$(function(){
		$("#Yearm1_YearM1_open1st").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		$("#Yearm1_YearM1_open1ed").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		$("#Yearm1_YearM1_open2st").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		$("#Yearm1_YearM1_open2ed").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	});
	function Deletefile(Dcols){
		$('#file_' + Dcols).val('');
		$('#box_' + Dcols).remove();
	}
</script>
