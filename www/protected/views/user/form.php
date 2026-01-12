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
<?php 
	if (($model->role->superpower == 1 && Yii::app()->user->model->role->superpower <> 1) || ($model->id == Yii::app()->user->id)){ 
		echo $model->role->name;
	} else {
?>
<?php echo CHtml::activeDropDownList($model, 'role_id', Role::model()->listData(), array('class'=>'Select_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'role_id'); ?></span>

<?php } ?>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'account'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'account', array('class'=>'Text_1')); ?>
&nbsp;6-20字元英數符號【 _-!@#$%^&*()+=?., 】
<span class="note"><?php echo CHtml::error($model, 'account'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"><?php echo CHtml::activeLabelEx($model,'passwd'); ?> </td>
<td>
<?php echo CHtml::activePasswordField($model,'passwd', array('class'=>'Text_1')); ?>
&nbsp;6-20字元英數符號【 _-!@#$%^&*()+=?., 】
<span class="note"><?=(CHtml::error($model, 'password'))? CHtml::error($model, 'password') : CHtml::error($model, 'passwd')?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"><?php echo CHtml::activeLabelEx($model,'repassword'); ?> </td>
<td>
<?php echo CHtml::activePasswordField($model,'repassword', array('class'=>'Text_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'repassword'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'name'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'name', array('class'=>'Text_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'name'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'email'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'email', array('class'=>'Text_1', 'size'=>40)); ?>
<span class="note"><?php echo CHtml::error($model, 'email'); ?></span>
</td>
</tr>


<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'active'); ?> </td>
<td >
<?php echo CHtml::activeRadioButtonList($model, 'active', array('未啟用', '啟用'), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'active'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'freezed'); ?> </td>
<td >
<?php echo CHtml::activeRadioButtonList($model, 'freezed', array('否', '停權'), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'freezed'); ?></span>
</td>
</tr>



</table>
</div>

<div style="width:100%;text-align:center;padding-top:7px;">
<span>
<input type="button" class="btn" name="ACTION" value="取　　消" onClick="javascript:history.go(-1);">
<?php echo CHtml::submitButton(('add' == $action) ? '新　　增' : '儲　　存', $htmlOption = array('class'=>'btn')); ?>
</span>
</div>

<?php echo CHtml::endForm(); ?>