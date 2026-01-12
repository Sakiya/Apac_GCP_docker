<?php //Yii::app()->clientScript->registerScriptFile(Html::extensionsUrl('jgrowl/jquery-1.4.2.js')); ?>
<?php Yii::app()->clientScript->registerScriptFile(Html::extensionsUrl('jgrowl/jquery.jgrowl.js')); ?>
<?php Yii::app()->clientScript->registerCssFile(Html::extensionsUrl('jgrowl/jquery.jgrowl.css')); ?>
<?php Yii::app()->clientScript->registerScriptFile(Html::adminScriptUrl('checkedset.js')); ?>
<script type="text/javascript">
jQuery(document).ready(function(){	
	checkaction('<?=$prefix?>', '<?=$url?>', '<?=$other?>');
});
</script>