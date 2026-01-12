<!--
<div class="errorpage" style="text-align: center">
	<h2 style="font-size: 50px;margin-top: 10%;">Error <?php echo $code; ?></h2>
	
	<div class="error">
	<?php echo CHtml::encode($message); ?>
	</div>
</div>

-->
<?php echo CHtml::encode($message); ?>
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
                        <div class="error404_info "> We can't seem to find the page you're looking for.</div>
                        <p>Error code: 404</p>
                        <br><br>
                        <a class="back" href="<?=$this->createUrl('/member/index/',array('language'=>Yii::app()->language));?>"><i class="fa fa-chevron-left"></i> Return</a>

                    </div>
                </div>
            </div>
        </div>
    </div>