<?php
class InfoController extends Controller{
    public function init(){
        parent::init();
        $this->layout = '';
    }

    public function actionClosemessage(){
     	$Year = Yearm1::model()->find(
		array(
			'condition'=>"Yearm1_open1st >=:open1st ",
			'params'=>array(':open1st'=> date('Ymd')),
			'order'=>' Yearm1_open1st ',
			'limit'=>1
		));

		if ($this->Year){
			$this->redirect("/member/index");
		}
		if ($Year){
			$this->redirect("/info/noStarted");
		}
		
        $content = $this->renderPartial(
	        // . Yii::app()->params['LlangText'][Yii::app()->language]
            $view = '/Info/closemessage',
            $data = array('model' => ''),
            $return = true
        );

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionnoStarted(){
		if ($this->Year){
			$this->redirect("/member/index");
		}
		
        $content = $this->renderPartial(
            $view = '/Info/noStarted',
            $data = array('model' => ''),
            $return = true
        );

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionMessage(){
		$id = (isset($_GET['i']) ? $_GET['i'] : '');
		
        $content = $this->renderPartial(
            $view = '/Info/message',
            $data = array('model' => '','id'=>$id),
            $return = true
        );
		
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    

}
?>