<?php
class Data2Controller extends Controller{
	public $Gallery;
    public function init(){
        parent::init();
        $this->layout = '';
        
		Yii::import('application.controllers.MemberController');

		//若偷切換中英文版,則導到首頁
		if (Yii::app()->user->getState('acclang') != Yii::app()->language){
			$this->redirect(Yii::app()->createUrl('/member/index',array('language'=>Yii::app()->language)));
		}
	}
//取得畫廊
    public function actionAjax_agree(){

        $Gallery = Gallerym1::model()->find(
        array(
            "select"=>"finishStep2_1",
            'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
            'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
        ));
        
        $model = $Gallery;
        
        $json = CJSON::encode($model);
        echo $json;
    }
    public function actionAjax_info(){
        
		$Gallery = Gallerym1::model()->find(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no and shortlisted = '2' ",
				'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
			));
		
		$model = $Gallery;
		
		$json = CJSON::encode($model);
		echo $json;
    }
    public function actionAjax_price(){

        $Gallery = Gallerym1::model()->find(
        array(
            "select"=>"finishStep2_3",
            'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
            'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
        ));
        
        $model = $Gallery;
        
        $json = CJSON::encode($model);
        echo $json;
    }

    public function actionAjax_award(){

        $Gallerym1 = Gallerym1::model()->findbypk(Yii::app()->user->getState('accID'));
        $Award = $Gallerym1->Award;
        if ($Award){
            $json = CJSON::encode($Award);
        }else{
            $Award = new Award();
            $json = CJSON::encode($Award);
        }
        echo $json;
    }

    public function actionAjax_usd300(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $Work = Work::model()->findAll(
            array(
                'condition'=>"Gallerym1_no = :Gallerym1_no and type = :type ",
                'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'),':type'=>$id)
        ));
        $model = $Work;
        
        $json = CJSON::encode($model);
        echo $json;
    }

    public function actionAjax_print(){
        $Gallery = Gallerym1::model()->find(
            array(
                "select"=>"finishStep2_7, spissue_pic, spissue_link, spissue_text",
                'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
                'params'=>array(':Yearm1_no'=> $this->Year->Yearm1_no, ':Gallerym1_no'=>Yii::app()->user->getState('accID'))
            ));
            
            $model = $Gallery;
            
            $json = CJSON::encode($model);
            echo $json;
    }

    public function actionAjax_Vip(){
        $Vipcard = Vipcard::model()->findAll(
            array(
                //"select"=>"finishStep2_7, spissue_pic, spissue_link, spissue_text",
                'condition'=>"Gallerym1_no = :Gallerym1_no ",
                'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'))
            ));

        if ($Vipcard){
            $json = CJSON::encode($Vipcard);
            echo $json;
        }
    }

    public function actionAjax_remittance(){
        $Gallerym1 = Gallerym1::model()->find(
            array(
                "select"=>"paybank_account2,paybank_name2,paybank_bank2,returnbank_account2,returnbank_name2,returnbank_bank2",
                'condition'=>"Gallerym1_no = :Gallerym1_no and finishStep2_10 = true ",
                'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'))
            ));
        if (!$Gallerym1){
            $Gallerym1 = Gallerym1::model()->find(
                array(
                    "select"=>"paybank_account as paybank_account2,paybank_name as paybank_name2,paybank_bank as paybank_bank2,
                    returnbank_account as returnbank_account2,returnbank_name as returnbank_name2,returnbank_bank as returnbank_bank2 ",
                    'condition'=>"Gallerym1_no = :Gallerym1_no ",
                    'params'=>array(':Gallerym1_no'=>Yii::app()->user->getState('accID'))
                ));   
        }
        if ($Gallerym1){
            $json = CJSON::encode($Gallerym1);
            echo $json;
        }
    }
}
?>