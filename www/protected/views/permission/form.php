<?php echo CHtml::beginForm('', 'post'); ?>

<div style="width:100%;text-align:right;padding-top:7px;">
<input type="button" class="btn" name="ACTION" value="取　　消" onClick="javascript:history.go(-1);">
<?php echo CHtml::submitButton(('add' == $action) ? '新　　增' : '儲　　存', $htmlOption = array('class'=>'btn')); ?>
</div>

<div class="form_style">                     
<span class="legend"> </span>
<table border="0" cellspacing="0" cellpadding="5" width="100%">

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model, 'showon'); ?></td>
<td>
<?php echo CHtml::activeRadioButtonList($model, 'showon', $model->showonList(), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'showon'); ?></span>
</td>
</tr>


<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'module_id'); ?> </td>
<td>
<?php echo CHtml::activeDropDownList($model, 'module_id', Module::model()->listData(), array('class'=>'Select_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'module_id'); ?></span>
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
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'action'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'action', array('class'=>'Text_1')); ?>

<span class="note"><?php echo CHtml::error($model, 'action'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'type'); ?> </td>
<td>
<?php echo CHtml::activeRadioButtonList($model, 'type', $model->typeList(), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'type'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'icon'); ?> </td>
<td>
<?php echo CHtml::activeRadioButtonList($model, 'icon', $model->iconList(), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'icon'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'sort'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'sort', array('class'=>'Text_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'sort'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model, 'option'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'option', array('size'=>40, 'class'=>'Text_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'option'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'developer'); ?> </td>
<td >
<?php echo CHtml::activeRadioButtonList($model, 'developer', array('否', '是'), array('separator'=>'&nbsp;')); ?>
<span class="note"><?php echo CHtml::error($model, 'developer'); ?></span>
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