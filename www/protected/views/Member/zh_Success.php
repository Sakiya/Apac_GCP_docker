        <!--menu-->
        <div class="left-menu">
            <div class="menu-top">
                <div class="menu-logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>"></div>
                <h4>註冊帳號</h4>
            </div>
            <div class="menu-container">
				<!--menu-list-->
                <ul class="menu">
                    <li class="menu-list done">
                        <a>
                            <h3>1.填寫基本資料</h3>
                            <div class="icon fa fa-check"></div>
                        </a>
                    </li>
                    <li class="menu-list done">
                        <a>
                            <h3>2.帳號驗證</h3>
                            <div class="icon fa fa-check"></div>
                        </a>
                    </li>
                    <li class="menu-list done">
                        <a>
                            <h3>3.註冊成功</h3>
                            <div class="icon fa fa-check"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
       <!--內文-->
        <div class="right">
            <div class="container">
                <!--greenScreen-->
                <div class="green-container">
                    <div class="title">註冊成功</div>
                    <div class="greenScreen">
                        <div class="text-group">
                            <h3> <?=$model->name;?>您好</h3>
                            <div class="discription">恭喜您已完成帳號註冊程序！日後您可使用此E-mail帳號登入線上報名系統。</div>
                            <div class="discription">ONE ART Taipei <?=$this->Year->Yearm1_year;?> 執委會 敬上</div>
                            <div class="btn-black" onclick="window.location='<?php echo $this->createUrl('/Member/index',array('language'=>Yii::app()->language));?>'">立即前往報名ONE ART Taipei <?=$this->Year->Yearm1_year;?>！</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>