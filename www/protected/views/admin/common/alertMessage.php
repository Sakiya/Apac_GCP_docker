<?php if (Yii::app()->user->hasFlash('info')): ?>
<h4 class="alert_info"><?=Yii::app()->user->getFlash('info')?></h4>
<?php elseif (Yii::app()->user->hasFlash('warning')): ?>
<h4 class="alert_warning"><?=Yii::app()->user->getFlash('warning')?></h4>
<?php elseif (Yii::app()->user->hasFlash('error')): ?>
<h4 class="alert_error"><?=Yii::app()->user->getFlash('error')?></h4>
<?php elseif (Yii::app()->user->hasFlash('success')): ?>
<h4 class="alert_success"><?=Yii::app()->user->getFlash('success')?></h4>
<?php endif; ?>