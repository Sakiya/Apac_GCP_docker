<!--menu-->
		<?php $this->renderPartial('/layouts/menu_data'); ?> 
        <!--登出時間-->
		<?=$loginInfo;?>
<!--內文-->
        <div class="right page_done">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">繳費成功，完成報名！</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好</h3>
                            <div class="discription">恭喜您繳費完成，並完成此次 ONE ART Taipei <?=$this->Year->Yearm1_year;?> 報名!<br>我們有任何訊息將主動與您聯繫。</div>
                            <!--
                            <div class="discription">提醒您於<?=(new DateTime($this->Year->Yearm1_open1ed))->format('Y/m/d');?>日前您都可以登入報名表進行修改！</div>
                            -->
                            <div class="btn-black"><a target="_blank" onclick="openWin();" href="<?php echo $this->createUrl('/fill/apply1_print/',array('language'=>Yii::app()->language));?>">瀏覽報名資料或列印</a></div>
                            <div class="discription"><br>ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
  function openWin()
  {
	  /*
    var myWindow=window.open('/zh/fill/apply1_pdf','','width=200,height=100');
    myWindow.document.write("<p>This is 'myWindow'</p>");
    
    myWindow.document.close();
	myWindow.focus();
	myWindow.print();
	myWindow.close();  
		*/
  }
        </script>