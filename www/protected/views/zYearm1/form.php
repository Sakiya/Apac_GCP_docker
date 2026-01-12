	<div class="main-content mb4">
		<div class="main-content-inner">
			<div class="page-header col-lg-12">
				<h4><?=User::model()->getController();?></h4>					
			</div>
			<div class="container">
				<div class="addMember">
					<div class="step1"> 
						<div class="form-group col-sm-12">
							<label for="level" class="col-sm-2 control-label"></label>
							<?php 
								$openFirst = true;
								if (strtotime($model->Yearm1_open1ed) >= strtotime(date('Ymd'))) {
									$openFirst = false;
								}
								if (strtotime($model->Yearm1_open2st) <= strtotime(date('Ymd')) && $model->Yearm1_open2st != '') {
									$openFirst = false;
								}
							?>
							<div class="col-sm-5 controls"><button <?=!$openFirst || $GalleryCount <= 0 ? 'disabled' : '';?> onclick="sendFirstLevel('<?=$model->Yearm1_no;?>');">發送第一階段入圍通知</button></div>
                        </div>  
					</div>
					<?php echo CHtml::beginForm('', 'post', array('class' => 'form-horizontal','enctype'=>'multipart/form-data')); ?>
					<div class="step1">                       
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_year'); ?></label>
								<div class="col-sm-5 controls">
                                	<?php echo CHtml::activeNumberField($model, 'Yearm1_year', array('class'=>'col-sm-4','min'=>'2017','max'=> date('Y') + 3)); ?>
                                    <?php 
										//echo CHtml::activeDropDownList($model, 'Yearm1_year', array('2018'=>'2018','2017'=>'2017'), array('class'=>'Select_1'));
                                    ?>									
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_year'); ?></span>
								</div>
                        </div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_open1st'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'Yearm1_open1st', array('class'=>'col-sm-4 date-picker_1','data-date-format'=>'yyyymmdd', 'autocomplete' => 'off')); ?>
									<?php echo CHtml::activeTextField($model, 'Yearm1_open1ed', array('class'=>'col-sm-4 date-picker_2','data-date-format'=>'yyyymmdd', 'autocomplete' => 'off')); ?>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-2"></div>
									<div class="col-sm-10">
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_open1st'); ?></span>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_open1ed'); ?></span>
									</div>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_open2st'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'Yearm1_open2st', array('class'=>'col-sm-4 date-picker','data-date-format'=>'yyyymmdd', 'autocomplete' => 'off')); ?>
									<?php echo CHtml::activeTextField($model, 'Yearm1_open2ed', array('class'=>'col-sm-4 date-picker','data-date-format'=>'yyyymmdd', 'autocomplete' => 'off')); ?>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-2"></div>
									<div class="col-sm-10">
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_open2st'); ?></span>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_open2ed'); ?></span>
									</div>
								</div>	
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_payed2'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'Yearm1_payed2', array('class'=>'col-sm-4 date-picker','data-date-format'=>'yyyymmdd')); ?>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_payed2'); ?></span>
								</div>
						</div>
						
						
                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_pic'); ?></label>
                            <div class="col-sm-5 controls">
                                <span class="btn btn-default btn-file">
                                    <?php echo CHtml::activeFileField($model,'Yearm1_pic');?>
                                </span>
                                <input type="hidden" id="file_Yearm1_pic" name="Yearm1[Yearm1_pic_old]" value="<?=$model->Yearm1_pic;?>"/>
                                <?php if ($model->Yearm1_pic != ''){?>
                                    <span id="box_Yearm1_pic" class="imgbox">
                                        <img src="<?=Yii::app()->params['customerfile']['year'];?><?=$model->Yearm1_pic;?>" style="max-width: 200px" />
                                        <button type="button" class="btn btn-danger" onclick="Deletefile('Yearm1_pic');">刪除</button>
                                    </span>
                                <?php }?>
                                <br/><small class="small bg-warning">請上傳 JPG 格式圖片，圖片檔名不可包含中文、空白及特殊符號。最小尺吋︰1000px x 1000px</small>
                                <span class="note"><?php echo CHtml::error($model, 'Yearm1_pic'); ?></span>
                            </div>
                        </div>	
                        <div class="form-group">
                            <label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_picmb'); ?></label>
                            <div class="col-sm-5 controls">
                                <span class="btn btn-default btn-file">
                                    <?php echo CHtml::activeFileField($model,'Yearm1_picmb');?>
                                </span>
                                <input type="hidden" id="file_Yearm1_picmb" name="Yearm1[Yearm1_picmb_old]" value="<?=$model->Yearm1_picmb;?>"/>
                                <?php if ($model->Yearm1_picmb != ''){?>
                                    <span id="box_Yearm1_picmb" class="imgbox">
                                        <img src="<?=Yii::app()->params['customerfile']['year'];?><?=$model->Yearm1_picmb;?>" style="max-width: 200px" />
                                        <button type="button" class="btn btn-danger" onclick="Deletefile('Yearm1_picmb');">刪除</button>
                                    </span>
                                <?php }?>
                                <br/><small class="small bg-warning">請上傳 JPG 格式圖片，圖片檔名不可包含中文、空白及特殊符號。最小尺吋︰1000px x 1000px</small>
                                <span class="note"><?php echo CHtml::error($model, 'Yearm1_picmb'); ?></span>
                            </div>
                        </div>	
						
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_script'); ?></label>
								<div class="col-sm-8 controls">
									<?php echo CHtml::activetextArea($model, 'Yearm1_script', array('class'=>'form-control ckeditor','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_script'); ?></span>
								</div>
						</div>   
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_script_en'); ?></label>
								<div class="col-sm-8 controls">
									<?php echo CHtml::activetextArea($model, 'Yearm1_script_en', array('class'=>'form-control ckeditor','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_script_en'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_script2'); ?></label>
								<div class="col-sm-8 controls">
									<?php echo CHtml::activetextArea($model, 'Yearm1_script2', array('class'=>'form-control ckeditor','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_script2'); ?></span>
								</div>
						</div>   
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'Yearm1_script2_en'); ?></label>
								<div class="col-sm-8 controls">
									<?php echo CHtml::activetextArea($model, 'Yearm1_script2_en', array('class'=>'form-control ckeditor','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'Yearm1_script2_en'); ?></span>
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
	function sendFirstLevel(id){
		$.post(
			'/zYearm1/AdminshortlistAlert/',
			{YII_CSRF_TOKEN:'<?=Yii::app()->request->csrfToken?>',id: id},
			function(xml){
				var _xml = JSON.parse(xml);
				if (_xml.status == 'success'){
					alert(_xml.message)
				}else{
					alert(_xml.message)
				}
			}
		)
	}
	
	$(function(){
		$("#Yearm1_Yearm1_open1st").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		});
		$("#Yearm1_Yearm1_open1ed").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: $("#Yearm1_Yearm1_open1st").val()
		});
		$("#Yearm1_Yearm1_open2st").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: '20190101'
		})

		$("#Yearm1_Yearm1_open2ed").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: $("#Yearm1_Yearm1_open2st").val()
		});

		$("#Yearm1_Yearm1_payed2").datepicker({
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
