<!--
    <div style="">
       <div style="float:right; margin: 0 0 0 10px; padding: 0 0 3px 0; line-height: 10px;">
       <?php
	   /*
            $controller = $this->getController();
            $targetUrl = $this->createPageUrl($controller->id,'');
            echo CHtml::beginForm($targetUrl, 'get');
		*/
       ?>
       到第&nbsp;<input style="width:35px; height:13px; padding:0px; margin:0px;" name="page" type="text" maxlength="9" />&nbsp;/<?php echo $pageCount; ?>頁
       <?php
            //echo  CHtml::endForm();
       ?>
       </div>
-->       
       <div class="pager">
       <ul class="pager">
            <?php
                foreach ($buttons as $button)
                {
                    if ('' !== trim($button))
                    {
                        echo $button."\r\n";
                    }
                }
            ?>
       </ul>
       </div>
    </div>
