<?php echo CHtml::beginForm('', 'post'); ?>

<div style="width:100%;text-align:right;padding-top:7px;">
<input type="button" class="btn" name="ACTION" value="取　　消" onClick="javascript:history.go(-1);">
<?php echo CHtml::submitButton(('add' == $action) ? '新　　增' : '儲　　存', $htmlOption = array('class'=>'btn')); ?>
</div>

<div class="form_style">                     
<span class="legend"> </span>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
                                            

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'role_id'); ?> </td>
<td>
<?=$model->role->name?>

</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'account'); ?> </td>
<td>
<?=$model->account?>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'name'); ?> </td>
<td>
<?=$model->name?>
</td>
</tr>


<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'active'); ?> </td>
<td >
<?=($model->active==1)?'啓用':'未啟用'?>

</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'freezed'); ?> </td>
<td >
<?=($model->freezed==1)?'停權':'否'?>
</td>
</tr>


<!-- 模組權限列表 -->
<tr class="form_row" id="pblock">
<td class="form_label"><?php echo CHtml::activeLabelEx($model,'permAry'); ?></td>
<td align="left">
<?php 
$this->renderPartial('/admin/common/permissionList', array('model' => $model, 'modules'=> $modules));
?>

<span class="note"></span>
</td>
</tr>
<!-- /模組權限列表 -->

</table>
</div>

<div style="width:100%;text-align:center;padding-top:7px;">
<span>
<input type="button" class="btn" name="ACTION" value="取　　消" onClick="javascript:history.go(-1);">
<?php echo CHtml::submitButton(('add' == $action) ? '新　　增' : '儲　　存', $htmlOption = array('class'=>'btn')); ?>
</span>
</div>
<?php echo CHtml::hiddenField('act',1); ?>
<?php echo CHtml::endForm(); ?>