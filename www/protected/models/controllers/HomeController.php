<?php
class HomeController extends Controller{
    public function init(){
        parent::init();
        $this->layout = '';
    }

    public function actionIndex(){
		
        $content = $this->renderPartial(
            $view = '/Home/index' . Yii::app()->params['LlangText'][Yii::app()->language],
            $data = array('model' => ''),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }

}
?>