<?php
class AdminController extends Controller{
    public function init(){
        parent::init();
        $this->layout = 'admin';
    }

    public function filters(){
        return array(
            'allowBackend',
        );
    }

	public function FilterAllowBackend($filterChain) {
		//echo "begin";
		if (Yii::app()->user->isGuest){
			Yii::app()->user->returnUrl = Yii::app()->createUrl('admin/index');
			$this->redirect(array('site/top2login'));
		}
		/*
		if (!Yii::app()->user->allowBackend){
			$this->redirect(array('site/index'));
		}
		*/
		$filterChain->run();
	}
    
	/**
	 * actions
	 * 
	 */

    public function actionIndex(){
	    /*
        $frameSetSrc = array(
            'top' =>  Yii::app()->createUrl('admin/top'),
            'menutitle' => Yii::app()->createUrl('admin/menutitle'),
            'menu' => Yii::app()->createUrl('admin/menu'),
            'funcbar' => Yii::app()->createUrl('admin/funcbar'),
            'content' => Yii::app()->createUrl('admin/content'),
            'tail' => Yii::app()->createUrl('admin/tail'),
        );
*/
        // 清掉所有的 layout
        //Yii::app()->layout = '';
        //$this->layout = '';
/*
		$this->render('/admin/common/index');
        $this->render('default', array('frameSetSrc' => $frameSetSrc));
*/


        $listTable = $this->renderPartial(
            $view = Yii::app()->createUrl('admin/default'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
            'permissionTree' => null
        ));

	}

    public function actionTop(){
        $title = '';
        $this->render('top', array('title' => $title));
    }

    public function actionMenuTitle(){
        $title = '';
        $this->render('menutitle', array('title' => $title));
    }

    public function actionMenu(){
        $permissionTree = Yii::app()->user->model->backendPermissionTree();

        $this->render('menu', array('permissionTree' => $permissionTree));
    }

    public function actionFuncBar(){
        $permissionTree = Yii::app()->user->model->backendPermissionTree();
        
        while(list($k, $moduleCat) = each($permissionTree)){
        	$modules = $moduleCat->module;
        	while(list($k, $module) = each($modules)){
        		if ($module->id == $_GET['module_ID']){
        			$theModule = $module;
        			break; 
        		}
        	}
        	if ($theModule){ break;}
        }
        $this->render('funcbar', array('module'=>$theModule));
    }

    public function actionContent(){
        $title = '';
        $this->render('common/index', array('title' => $title, 'listTable'=>''));
    }

    public function actionTail(){
        $this->render('tail');
    }
}
?>