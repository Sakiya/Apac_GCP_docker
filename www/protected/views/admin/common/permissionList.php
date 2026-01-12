	<table border="0" cellspacing="10" cellpadding="5">
		<tr>
			<td width="120">&nbsp;</td>
			<td width="200"> Frontend </td>
			<td width="200"> Backend </td>
		</tr>

<?php foreach ($modules as $module){ ?>
		<tr class="form_row">
			<td style="border-top:dashed 1px #aaa" align="right"><?=$module->name?></td>
			<td style="border-top:dashed 1px #aaa">
			<?php
			    $tmpPerms = $module->frontpermission_excludeDeveloper;
			    if($tmpPerms){
			    	foreach ($tmpPerms as $permission){
			            $isChecked = ($model->permAry && in_array($permission->id, $model->permAry))? ' checked="checked"' : '';
			            echo '<input value="'.$permission->id.'" type="checkbox" name="permAry[]"'.$isChecked.' /> <label for="roleAction_'.$permission->id.'">'.$permission->name.' ('.$permission->action.')</label> <br />';
			        }
			    }
			?>
			&nbsp;
			</td>
			<td style="border-top:dashed 1px #aaa">
			<?php
			    $tmpPerms = $module->backpermission_excludeDeveloper;
			    if($tmpPerms){
			    	foreach ($tmpPerms as $permission){
			            $isChecked = ($model->permAry && in_array($permission->id, $model->permAry))? ' checked="checked"' : '';
			           	echo '<input value="'.$permission->id.'" type="checkbox" name="permAry[]"'.$isChecked.' /> <label for="roleAction_'.$permission->id.'">'.$permission->name.' ('.$permission->action.')</label> <br />';			        	
			    	}
			    }
			?>
			&nbsp;
			</td>
		</tr>
<?php }?>

	</table>

