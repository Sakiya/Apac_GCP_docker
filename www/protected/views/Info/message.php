
    <div class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="left col-sm-6">
                    <div class="logo" style="height:350px"><img src="/main/img/_sample/logo_noyear.svg " alt=" "></div>
                </div>
                <div class="right col-sm-6 ">
                    <div class="login-box error404 ">
                        <img src="/main/img/select2/np_surprised_44101_000000.png " alt=" ">
                        <div class="oops ">Oops!</div>
                        <div class="error404_info "> <?=$id;?>.</div>
                        <br><br>
                        <a class="back" href="<?=$this->createUrl('/Member/index/',array('language'=>Yii::app()->language))?>"><i class="fa fa-chevron-left"></i> Return</a>

                    </div>
                </div>
            </div>
        </div>
    </div>