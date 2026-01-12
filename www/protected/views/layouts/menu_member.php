<?php 
	$array = array();
	switch (strtolower($this->action->id)){
		case 'join':
			 $array = array(
				'step1'=> array("class"=> 'active' , 'status' => 'fa-pencil'),
				'step2'=> array("class"=> '' , 'status' => ''),
				'step3'=> array("class"=> '' , 'status' => ''),
			 );
			break;
		case 'verification':
			 $array = array(
				'step1'=> array("class"=> 'done' , 'status' => 'fa-check'),
				'step2'=> array("class"=> 'done' , 'status' => 'fa-check'),
				'step3'=> array("class"=> '' , 'status' => ''),
			 );
			break;
		case 'success':
			 $array = array(
				'step1'=> array("class"=> 'done' , 'status' => 'fa-check'),
				'step2'=> array("class"=> 'done' , 'status' => 'fa-check'),
				'step3'=> array("class"=> 'done' , 'status' => 'fa-check'),
			 );
			break;
	}
?>
<?php
	switch(Yii::app()->language){
		case 'en':
?>
        <div class="left-menu">
            <div class="menu-top">
                <div class="menu-logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>" alt=""></div>
                <h4>Sign up</h4>
            </div>
            <div class="menu-container">
                <!--menu-list-->
                <ul class="menu">
                    <li class="menu-list <?=$array['step1']['class'];?>">
                        <a>
                            <h3>1.Fill in basic information</h3>
                            <div class="icon fa <?=$array['step1']['status'];?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step2']['class'];?> ">
                        <a>
                            <h3>2.Validation</h3>
                            <div class="icon fa <?=$array['step2']['status'];?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step3']['class'];?> ">
                        <a>
                            <h3>3.Registration Completed</h3>
                            <div class="icon fa <?=$array['step3']['status'];?>"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
<?php
			break;
?>
<?php
		default:
?>
        <div class="left-menu">
            <div class="menu-top">
                <div class="menu-logo"><img src="<?=Yii::app()->params['customerfile']['year'] . $this->Year['Yearm1_pic'];?>" alt=""></div>
                <h4>註冊帳號</h4>
            </div>
            <div class="menu-container">
                <!--menu-list-->
                <ul class="menu">
                    <li class="menu-list <?=$array['step1']['class'];?>">
                        <a>
                            <h3>1.填寫基本資料</h3>
                            <div class="icon fa <?=$array['step1']['status'];?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step2']['class'];?> ">
                        <a>
                            <h3>2.帳號驗證</h3>
                            <div class="icon fa <?=$array['step2']['status'];?>"></div>
                        </a>
                    </li>
                    <li class="menu-list <?=$array['step3']['class'];?> ">
                        <a>
                            <h3>3.註冊成功</h3>
                            <div class="icon fa <?=$array['step3']['status'];?>"></div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
<?php
			break;
	}
?>
