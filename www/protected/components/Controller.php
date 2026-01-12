<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $LayoutClass = "";
	public $MenuBg = "";
	public $MetaTag_Ary = array('zh'=>array(),'en'=>array());
	
	public $Year = null;
	public $languages = "";
	public $expireDate = "202401011v1";
	public $memberId = "";
	public $joinLv = "";
	public $curStep = [];//目前開啟階段
	public $memberStep = "";

	public function init(){
	    
	    parent::init();

		if (Yii::app()->language == '' || Yii::app()->language == 'zh_tw'){
			Yii::app()->language = 'zh';
    	}
    	
    	$this->Year = Yearm1::model()->find(
		array(
			'condition'=>"Yearm1_open1st <=:open1st and Yearm1_open1ed >=:pen1ed ",
			'params'=>array(':open1st'=> date('Ymd'),':pen1ed'=> date('Ymd')),
			'order'=>' Yearm1_open1st '
		));

		if ($this->Year){
			array_push($this->curStep,1);
			$this->joinLv = 1;
		}

		$Year = Yearm1::model()->find(
			array(
				'condition'=>"Yearm1_open2st <=:open1st and Yearm1_open2ed >=:pen1ed ",
				'params'=>array(':open1st'=> date('Ymd'),':pen1ed'=> date('Ymd')),
				'order'=>' Yearm1_open2st '
			));
			array_push($this->curStep,2);
			
		if ($Year && !$this->Year){
			$this->Year = $Year;
			$this->joinLv = 2;
		}
		if ($memberStep = Yii::app()->user->getState('memberStep')){
			$checkerStep = array_search($memberStep,$this->curStep);
			if ($checkerStep){
				$this->joinLv = Yii::app()->user->getState('memberStep');
			}
		}
		
		$this->memberId = "";
		if (!Yii::app()->user->hasState('accID')){
			Yii::app()->user->setState('accID',"");
		}else{
			$this->memberId = Yii::app()->user->getState('accID',NULL);
		}
	}

	public function filters()
	{
		return array(
			'accessControl',
		);
	}
	
	public function accessRules()
	{
		return $this->getAccessActions();
		
		/*
		return array(
			array('allow',
				'actions'=>$accessActions,
				'users'=>array('@'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
		*/
	}
	
	private function getAccessActions(){
		$controller = strtolower(Yii::app()->controller->id);
		$action = strtolower($this->action->id);

		// 一個動作包含數個 action 的判斷。例如 adminadd_step2

		if(preg_match("/^([^_]+).*$/i",$action,$tmp_ary)){
			$keyAction = $tmp_ary[1];
		} else {
			$keyAction = $action;
		}
		
		// 檢查是否需要權限
		$criteria = new CDbCriteria;
	    $criteria->with = array(
			'module'=>array('joinType'=>'inner join'),
		);
		$criteria->addCondition("t.action=:action AND module.controller=:controller");
		$criteria->params = array(':action'=>$keyAction, ':controller'=>$controller);
		
		$permission = Permission::model()->find($criteria);

        // 空的表示目前 controller 以及 action 無須控管
        if (!$permission){
	        //檢查前端登入
	        if (preg_match("/apply/", $action,$tmp_ary)){
		        if (Yii::app()->user->getState('accID') == ""){
					$this->redirect(array('/zh/Member/index/'));
		        }
			}
	        if (preg_match("/apply2/", $action,$tmp_ary)){
		        if (Yii::app()->user->getState('accID') == ""){
					$this->redirect(array('/zh/Member/index/'));
		        }
	        }
            $accessRules = array(
            	array('allow','actions' => array($action),'users' => array('*'),)
            );
            return $accessRules;
        }

        // 未登入
		if (Yii::app()->user->isGuest){
	        //導回網址
	        Yii::app()->user->returnUrl = ($permission->showon == "backend") ? Yii::app()->createUrl('admin/index') : Yii::app()->request->url;

	        /* 改用自行導去登入的方式，否則 returnUrl 會被覆寫，導回 backend 時會直接顯示 frame 中的內容，無法顯示 frameset
	        $accessRules = array(
	            array('deny','users' => array('*'),)
	        );

            return $accessRules;
            */
            
            $this->redirect(array('site/top2login'));
		}
		
		// 已登入，檢查權限
		$permissionsByController = Yii::app()->user->permissionsByController;
		$permissions = $permissionsByController[$controller];
		foreach(($permissions) as $permission) {
			if (strtolower($permission->action) == $keyAction){
                $accessRules = array(
                    array('allow','actions' => array($action),'users' => array('@'),),
                    array('deny','users'=>array('*'),),
                );
				return $accessRules;
			}
		}		

        $accessRules = array(
            array('deny','users' => array('*'),)
        );
		
		return $accessRules;
	}
	
	//取得該 controller 對於 row 層級的操作權限
	//id => 該 row 的 id
	public function getRowPermission($id){
		$tmpStr = '';
		$tmpMobileStr = '';
		$controller = strtolower(Yii::app()->controller->id);
		$permissionsByController = Yii::app()->user->permissionsByController;
		$permissions = $permissionsByController[$controller];
		//print_r($permissions);
		if($controller == "role"){
			$role = Role::model()->findByPk($id);
			$bulitin = $role->bulitin;
		}
		foreach(($permissions) as $permission) {
		//while(list($k,$permission) = @each($permissions)){
			if ($permission->type <> 3){
				continue;
			}
			if($controller == "role" && $permission->action == "admindelete" && $bulitin){
				continue;
			}
			//echo $permission->action;
			
			$tmpStr .= '

				<a class="blue" title="'.$permission->name.'" href="'.Yii::app()->createUrl($permission->module->controller.'/'.$permission->action, array('id'=>$id)).'" '.$permission->option.'>
					<i class="ace-icon fa bigger-130 ' . $permission->icon . '"></i>
				</a>
			';
			$tmpMobileStr .= '
				<li>
					<a class="tooltip-info" data-rel="tooltip" title="" data-original-title="View" title="'.$permission->name.'" href="'.Yii::app()->createUrl($permission->module->controller.'/'.$permission->action, array('id'=>$id)).'" '.$permission->option.'>
						<span class="blue">
							<i class="ace-icon fa bigger-120 ' . $permission->icon . '"></i>
						</span>
					</a>
				</li>
			';				
		}
		
		($tmpStr ) ? $tmpStr = '<div class="hidden-sm hidden-xs action-buttons">' . $tmpStr . '</div>' : false;
		if ($tmpMobileStr){
			$tmpMobileStr = '
				<div class="hidden-md hidden-lg">
					<div class="inline pos-rel">
					<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
						<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
					</button>
						<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
			' . $tmpMobileStr . '
						</ul>
					</div>
				</div>
			';
		}
		return ($tmpStr) ? $tmpStr . $tmpMobileStr : false;
	}



	public function delTree($dir) { 
		if (is_dir($dir)) {
			$files = array_diff(scandir($dir), array('.','..')); 
			foreach ($files as $file) { 
			  (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file"); 
			} 
			return rmdir($dir); 
		}
	} 
	
	public function __construct($id,$module=null){
	    parent::__construct($id,$module);
	    // If there is a post-request, redirect the application to the provided url of the selected language 
	    
		if (isset($_POST['language']) == 'zh_tw'){
			$_POST['language'] = 'zh';
    	}  
	    if(isset($_POST['language'])) {
	        $lang = $_POST['language'];
	        $MultilangReturnUrl = $_POST[$lang];
	        $this->redirect($MultilangReturnUrl);
	    }
	    // Set the application language if provided by GET, session or cookie
	    if(isset($_GET['language'])) {
	        Yii::app()->language = $_GET['language'];
	        Yii::app()->user->setState('language', $_GET['language']); 
	        $cookie = new CHttpCookie('language', $_GET['language']);
	        $cookie->expire = time() + (60*60*24*365); // (1 year)
	        Yii::app()->request->cookies['language'] = $cookie; 
	    }
	    else if (Yii::app()->user->hasState('language'))
	        Yii::app()->language = Yii::app()->user->getState('language');
	    else if(isset(Yii::app()->request->cookies['language']))
	        Yii::app()->language = Yii::app()->request->cookies['language']->value;
	}
	
	public function createMultilanguageReturnUrl($lang='en'){
	    if (count($_GET)>0){
	        $arr = $_GET;
	        $arr['language']= $lang;
	    }
	    else 
	        $arr = array('language'=>$lang);
	    return $this->createUrl('', $arr);
	}
	
	public function DisplayMetaTag(){

		foreach ($this->MetaTag_Ary[Yii::app()->params['langCode'][Yii::app()->language]] as $key => $val){
			if (preg_match("/og/i", $key)){
				Yii::app()->clientScript->registerMetaTag($val, '', null, array('property' => $key));
			}else{
				Yii::app()->clientScript->registerMetaTag($val, $key, null, null);
			}

		}

		Yii::app()->clientScript->registerMetaTag('website', '', null, array('property' => 'og:type'));
		Yii::app()->clientScript->registerMetaTag(Yii::app()->params['SSL'] . Yii::app()->request->requestUri, '', null, array('property' => 'og:url'));
	}
	
	
	public function loginInfo(){
		$Gallery = Gallerym1::model()->findbyPk($this->memberId);
		
		switch(Yii::app()->language){
			case 'en':	
				return '<div class="logoutTime"><div class="logout-time">Last Login time : <span>' . $Gallery->lastloginDate . '</span></div><a class="logout-btn" href="' . $this->createUrl('/member/applylogout',array('language'=>Yii::app()->language)) . '"></a></div>';
				break;
			default:
				return '<div class="logoutTime"><div class="logout-time">上次登入時間 : <span>' . $Gallery->lastloginDate . '</span></div><a class="logout-btn" href="' . $this->createUrl('/member/applylogout',array('language'=>Yii::app()->language)) . '"></a></div>';
				break;
		}
		
	}
}