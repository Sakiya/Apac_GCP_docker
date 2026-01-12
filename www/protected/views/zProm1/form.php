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
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prom1_dsp'); ?></label>
							<div class="col-sm-5 controls">
								<?php echo CHtml::activeCheckBox($model, 'prom1_dsp',array('Y'=>'顯示'), array('class'=>'form-control')); ?>
								<span class="note"><?php echo CHtml::error($model, 'prom1_dsp'); ?></span>
							</div>
                        </div>	                        
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prot1_no'); ?></label>
								<div class="col-sm-5 controls">
                                    <?php 
										echo CHtml::activeDropDownList($model, 'prot1_no', Prot1::model()->listData(), array('class'=>'Select_1'));
                                    ?>									
									<span class="note"><?php echo CHtml::error($model, 'prot1_no'); ?></span>
								</div>
                        </div>											
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prom1_title'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'prom1_title', array('class'=>'form-control')); ?>
									<span class="note"><?php echo CHtml::error($model, 'prom1_title'); ?></span>
								</div>		
                        </div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prom1_script'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'prom1_script', array('class'=>'form-control','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'prom1_script'); ?></span>
								</div>
						</div>
                        
                        <div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prom1_title_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activeTextField($model, 'prom1_title_en', array('class'=>'form-control')); ?>
									<span class="note"><?php echo CHtml::error($model, 'prom1_title_en'); ?></span>
								</div>		
                        </div>
                        <div class="form-group">
							<label for="level" class="col-sm-2 control-label"><?php echo CHtml::activeLabelEx($model,'prom1_script_en'); ?></label>
								<div class="col-sm-5 controls">
									<?php echo CHtml::activetextArea($model, 'prom1_script_en', array('class'=>'form-control','rows' => '12')); ?>
									<span class="note"><?php echo CHtml::error($model, 'prom1_script_en'); ?></span>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label">增加產品圖片</label>
								<div class="col-sm-5 controls">
                                <span class="btn btn-default btn-file">
								<?php
								  $this->widget('CMultiFileUpload', array(
								     'model'=>new Prot2(),
								     'attribute'=>'prot2_img',
								     'accept'=>'jpg|gif|png',
								     'options'=>array(
								         'onFileSelect'=>'function(e, v, m){ alert("onFileSelect - "+v) }',
								         'afterFileSelect'=>'function(e, v, m){ alert("afterFileSelect - "+v) }',
								         'onFileAppend'=>'function(e, v, m){ alert("onFileAppend - "+v) }',
								         'afterFileAppend'=>'function(e, v, m){ alert("afterFileAppend - "+v) }',
								         'onFileRemove'=>'function(e, v, m){ alert("onFileRemove - "+v) }',
								         'afterFileRemove'=>'function(e, v, m){ alert("afterFileRemove - "+v) }',
								     ),
								     'denied'=>'File is not allowed',
								     'max'=>10, // max 10 files
									 'htmlOptions' => array('multiple' => 'multiple', 'size' => 25)
								  ));
								?>	
                                </span>                                
                                <br/>
                                    <ul class="small bg-warning">
                                        <li>1. 請上傳 JPG 格式圖片，圖片檔名不可包含中文，空白及特殊符號</li>
                                        <li>2. 按「選擇檔案」按鈕即可增加更多圖片</li>
                                        <li>3. 上傳新圖片後請先儲存，再進入此頁即可進行圖片排序</li>
                                        <li>4. 上下拖移圖片列即可進行排序圖片</li>
                                        <li>5. 在選擇檔案時按 command(mac) 或 control(windows) 即可複選檔案上傳</li>
                                    </ul>
								</div>
						</div>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label"></label>
							<div class="gallery col-sm-9" ></div>
						</div>
                        <?php if (count($Prot2) > 0){?>
						<div class="form-group">
							<label for="level" class="col-sm-2 control-label">產品圖片</label>
								<div class="col-sm-9 controls">
									<ul class="list-inline" id="sortable">
									<?php 
										foreach ($Prot2 as $row){
									?>
										<li class="col-sm-9 controls id_<?=$row->prot2_no;?>" style="padding: 5px;" id="<?=$row->prot2_no;?>">
											<div class="row">
												<button type="button" class="btn btn-danger" onclick="deleteImgBox('<?=$row->prot2_no;?>')">刪除</button>
                                                <img class="img-rounded" style="max-height: 100px;" src="<?=Yii::app()->params['customerfile']['Prot2_img'] . $row->prot2_img;?>" >
											</div>
											
										</li>
									<?php
										}
									?>
									</ul>
								</div>
						</div>
                        <?php }?>
                        <input type="hidden" id="DeleteImg" name="DeleteImg" />
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
	    // Multiple images preview in browser
	    var imagesPreview = function(input, placeToInsertImagePreview) {
	
	        if (input.files) {
	            var filesAmount = input.files.length;
	
	            for (i = 0; i < filesAmount; i++) {
	                var reader = new FileReader();
	
	                reader.onload = function(event) {
	                    $($.parseHTML('<img>')).attr('src', event.target.result).css('max-width','100px').appendTo(placeToInsertImagePreview);
	                }
	
	                reader.readAsDataURL(input.files[i]);
	            }
	        }
	
	    };
	
	    $('#Prot2_prot2_img').on('change', function() {
	        imagesPreview(this, 'div.gallery');
	    });
		
		$(".date-picker").datepicker({
			autoclose: true,
			todayHighlight: true,
			minDate: new Date()
		})
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
		
		<?php if ($action == 'edit'){?>
		$( "#sortable" ).sortable({
			update: function (event, ui) {
				var sortedIds = $("#sortable").sortable("toArray").toString();
				console.log(sortedIds);
				console.log($(this).sortable('toArray'));

				$.post("/<?php echo Yii::app()->controller->id;?>/Prot2changeorder", $.param({ ids: sortedIds , YII_CSRF_TOKEN: '<?=Yii::app()->request->csrfToken?>'}, true))
				.done(function (data) {
					console.log(data);
				}).fail(function () {
					$("#error-message").show().delay(800).fadeOut("slow");
				});
			}
		});
		<?php }?>
	});
		function Deletefile(Dcols){
			$('#file_' + Dcols).val('');
			$('#box_' + Dcols).remove();
		}
		
		function deleteImgBox(id){
			$('#DeleteImg').val($('#DeleteImg').val() + ',' + id);
			$('.id_' + id).remove();
		}
</script>
