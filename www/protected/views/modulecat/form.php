<?php echo CHtml::beginForm('', 'post'); ?>

<div style="width:100%;text-align:right;padding-top:7px;">
<input type="button" class="btn" name="ACTION" value="取　　消" onClick="javascript:history.go(-1);">
<?php echo CHtml::submitButton(('add' == $action) ? '新　　增' : '儲　　存', $htmlOption = array('class'=>'btn')); ?>
</div>

<div class="form_style">                     
<span class="legend"> </span>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
                                            
<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'name'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'name', array('class'=>'Text_1')); ?>

<span class="note"><?php echo CHtml::error($model, 'name'); ?></span>
</td>
</tr>

<tr class="form_row">
<td class="form_label"> <?php echo CHtml::activeLabelEx($model,'sort'); ?> </td>
<td>
<?php echo CHtml::activeTextField($model, 'sort', array('class'=>'Text_1')); ?>
<span class="note"><?php echo CHtml::error($model, 'sort'); ?></span>
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