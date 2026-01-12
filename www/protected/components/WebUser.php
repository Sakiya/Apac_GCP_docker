<?php

// you must edit protected/config/config.php
// and find the application components part
// you should have other components defined there
// just add the user component or if you 
// already have it only add 'class' => 'WebUser',
 
// application components
/*
'components'=>array(
    'user'=>array(
        'class' => 'WebUser',
        ),
),
*/


class WebUser extends CWebUser {
	private $_model; //暫存 model user
	private $_allowBackend; //從 model user 取來暫存
	private $_permissionsByController; //從 model user 取來暫存
	/*
	* 覆寫
	*/

	public function init(){
        //code

		parent::init();		
	}
    
    
    /* override isGuest 另外檢查 */
/*
    public function getIsGuest(){		
    	
    	// site 登入 
    	if (!parent::getIsGuest()){
			//echo "<< site 登入>>";
    		return false;
    	}
    	
    	if(!$_SESSION['login']){
    		//echo "<< 沒有 SESSION[login]>>";
    		// 強制登出
    		parent::logout();
    		
    		return true;
    	
    	}
		return true;
	}
*/
	/*
	* getter
	*/

	//
	public function getAccount(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $user->account;
	}
	
	//example : call Yii::app()->user->model->posts
	public function getModel(){
		$user = $this->loadUser(Yii::app()->user->id);
		return $user;
	}

	// Load user model.
	protected function loadUser($id=null){
		if($this->_model === null){
			if($id !== null){
				$this->_model = User::model()->findByPk($id);
			}
		}
		return $this->_model;
	}
	
	// 暫存是否能夠進入後台
	public function getAllowBackend(){
		if($this->_allowBackend === null){
			$user = $this->loadUser(Yii::app()->user->id);
			$this->_allowBackend = $user->allowBackend();
		}
		return $this->_allowBackend;
	}

	// 暫存給 controller accessControl 使用
	public function getPermissionsByController(){
		if($this->_permissionsByController === null){
			$user = $this->loadUser(Yii::app()->user->id);
			$this->_permissionsByController = $user->allPermissionByController();
		}
		return $this->_permissionsByController;
	}
	
	//查詢action 是否顯示
	public function getController(){
		$_permissionArray = array();
		$controller = strtolower(Yii::app()->controller->id);
		$permissionsByController = Yii::app()->user->permissionsByController;
		$permissions = $permissionsByController[$controller];
		
		foreach ($permissions as $row){
			array_push($_permissionArray, $row->action);
		}
		
		return $_permissionArray;
	}
}

?>