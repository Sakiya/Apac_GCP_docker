<?php

/**
 * This is the model class for table "{{User}}".
 *
 * The followings are the available columns in table '{{User}}':
 * @property string $id
 * @property string $role_id
 * @property string $account
 * @property string $password
 * @property string $password_salt
 * @property string $name
 * @property string $email
 * @property integer $active
 * @property integer $freezed
 * @property integer $developer
 */
class User extends CActiveRecord
{
	public $passwd;  
	public $repassword;
	public $permAry;

	public function init(){
		parent::init();
		//初始值
        $this->role_id = 3; //一般使用者，對應資料庫role id
        $this->developer = 0; //系統開發者
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{User}}';
	}


	public function scopes()
    {
        $alias = self::getTableAlias();
        
        return array(
            'actived'=> array(
                'condition' => "{$alias}.active = :active AND {$alias}.freezed <> :freezed",
                'params' => array(':active' => 1, ':freezed'=>1),
            ),
            'unactived'=> array(
                'condition' => "{$alias}.active = :active AND {$alias}.freezed <> :freezed",
                'params' => array(':active' => 0, ':freezed'=>1),
            ),
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('account', 'required', 'on'=>array('adminadd', 'adminedit')),
			array('passwd, repassword', 'required', 'on'=>array('adminadd')),
			array('account, passwd', 'match', 'pattern'=>'/^[A-Za-z0-9_\-!@#$%^&*()+=?.,]+$/u'),

			array('account', 'unique'),
			array('passwd', 'length', 'min'=>6, 'max'=>20),
			array('account', 'length', 'min'=>6, 'max'=>20),
			
			array('freezed, active', 'numerical', 'integerOnly'=>true),
			array('role_id', 'length', 'max'=>10),
			array('account, password, password_salt, name, email, passwd', 'length', 'max'=>255),
			array('email', 'email'),						
			array('createDateTime, updateDateTime', 'safe'),
			array('repassword', 'compare', 'compareAttribute'=>'passwd', 'on'=>array('adminadd' , 'adminedit')),

			//CHtmlPurifier
			array('name','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),			

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, role_id, account, password, password_salt, name, email, active, freezed, developer', 'safe', 'on'=>'search'),


		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'role' => array(self::BELONGS_TO, 'Role', 'role_id', 'condition' => ''),
			'permission'=>array(self::MANY_MANY, 'Permission', YII::app()->db->tablePrefix.'User_Permission(user_id, permission_id)'),
			'backend_permission'=>array(
				self::MANY_MANY, 'Permission', YII::app()->db->tablePrefix.'User_Permission(user_id, permission_id)',
				'condition'=>"backend_permission.showon='backend'",
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role_id' => '角色',
			'account' => '帳號',
			'password' => '密碼',
			'password_salt' => 'Password Salt',
			'name' => '姓名',
			'email' => 'Email',
			'active' => '狀態',
			'freezed' => '停權',
			'developer' => 'Developer',
			'repassword' => '確認密碼',
			'passwd' => '密碼',
			'permAry' => '使用者模組權限',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('password_salt',$this->password_salt,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('freezed',$this->freezed);
		$criteria->compare('developer',$this->developer);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * rules function
	 * 
	 */

    //避免帳號跟 controller 重複，使用短網址時發生錯誤。短網址ex. http://www/lexars.com/nick
    //若是有使用會員短網址，可使用此方法檢驗 ex. array('account', 'controllerExist'),
    public function controllerExist($attribute, $params){
		$controllerFile = strtolower($this->$attribute."Controller.php");
		
		if ($handle = opendir(Yii::getPathOfAlias('application.controllers'))) {
		    while (false !== ($file = readdir($handle))) {
		        if (strtolower($file) == $controllerFile) {
                	$attributeName = $this->getAttributeLabel($attribute);
                	$this->addError($attribute, "{$attributeName} 內不得含有 {$this->$attribute}, 請選擇其他".$this->getAttributeLabel($attribute));
                	break;
		        }
		    }
		    closedir($handle);
		}
    }

	//舊密碼	
	public function oldrule($attribute, $params)
	{		
		$oldpass = $this->$attribute;
		
		if (!$this->passwordMatch($oldpass)){
			$this->addError($attribute, '密碼有誤！');
		}
		return true;		
	}
		

	//長度檢查
	public function strwidthRule($attribute, $params){
		$limit = array('nickname'=>16);
		
		if (mb_strwidth($this->$attribute, 'UTF-8') > $limit[$attribute]){
			$this->addError($attribute, "長度超過限制");
		}
	}



	/**
	 * 登入
	 * 
	 */
	
	// 比對密碼
	public function passwordMatch($password){
		if ($this->password == md5($this->password_salt.$password)){
			return true;
		}
		
		return false;
	}
	
	
	/**
	 * 權限
	 * 
	 */
	
	// 是否允許進入後台。使用：admin controller
	public function allowBackend(){
		//super user 或 有後台任一權限
		if ($this->role->superpower || $this->role->backend_permission || $this->backend_permission){
			return true;
		}
		
		return false;
	}
	
	// 全部權限id
	public function allPermissionIds(){
		$ids = array();
		$rolePermissions = $this->role->permission;
		while(list($k,$permission) = each($rolePermissions)){
			$ids[$permission->id] = $permission->id;
		}
		
		$userPermissions = $this->permission;
		while(list($k,$permission) = each($userPermissions)){
			$ids[$permission->id] = $permission->id;
		}
		
		return array_values($ids);
	}
	
	// backend 權限。使用：後台選單
	public function backendPermissionTree(){
		$criteria = new CDbCriteria;
	    $criteria->with = array(
			'module'=>array('joinType'=>'inner join'),
			'module.permission'=>array('joinType'=>'inner join')
		);
		$criteria->addCondition("permission.showon = 'backend'");
		$criteria->order = "t.sort, module.sort, module.id, permission.type, permission.sort ASC";
		
		//非超級管理角色
		if (!$this->role->superpower){
			$criteria->addInCondition('permission.id', $this->allPermissionIds());
		}

		//非系統開發者
		if ($this->developer <> 1){
			$criteria->addCondition("permission.developer != 1", "AND");
		}
		
		$permissionTree = ModuleCat::model()->findall($criteria);
		
		return $permissionTree;
	}
	
	// 全部權限，依 controller 分類。使用：controller filter
	public function allPermissionByController(){
		$criteria = new CDbCriteria;
	    $criteria->with = array(
			'module'=>array('joinType'=>'inner join'),
		);
		$criteria->order = "t.sort,t.id ASC";
		
		//非超級管理角色
		if (!$this->role->superpower){
			$criteria->addInCondition('t.id', $this->allPermissionIds());
		}
		
		//非系統開發者
		if ($this->developer <> 1){
			$criteria->addCondition("t.developer != 1", "AND");
		}
		
		$permissions = Permission::model()->findall($criteria);

		$permissionsByController = array();

		foreach(($permissions) as $permission) {
			$permissionsByController[strtolower($permission->module->controller)][$permission->id] = $permission;
		}
		//PHP 5.6
		// while(list($k,$permission) = each($permissions)){
		// 	$permissionsByController[strtolower($permission->module->controller)][$permission->id] = $permission;
		// }
		
		return $permissionsByController;
	}
	
	//取user勾選權限	
	public function getUserPermission(){		
		if($this->permission){
			foreach ($this->permission as $perm){
				$perms[] = $perm->id;
			}
		}
		
		return $perms;
	}
	
    //發mail
    public function sendMail($mailInfo)
    {		
		try {
			Yii::app()->mailer->ClearAddresses();
			Yii::app()->mailer->AddAddress($mailInfo['AddAddress'], $mailInfo['toName']);    //收件人email
			Yii::app()->mailer->Subject = $mailInfo['Subject'];
			if($mailInfo['view']){
				Yii::app()->mailer->render($mailInfo['view'], $mailInfo['data']);
			} 
			if($mailInfo['body']){
				Yii::app()->mailer->Body = $mailInfo['body'];
			}
			
			Yii::app()->mailer->Send();
			$result = true;
		} catch (Exception $e) {
			$masg = $e->getMessage(); //Boring error messages from anything else!

			$result = false;
		}

        if (!$result){
			$today = date('Y-m-d H:i:s');
			$sql = "INSERT INTO mailLog (email,sendDateTime,message) values ('". $mailInfo['AddAddress'] ."', '$today', '$masg') ON DUPLICATE KEY UPDATE sendDateTime='{$today}', message='{$masg}'";			
			$this->dbConnection->createCommand($sql)->execute();          
        }
        
        return ($masg) ? $masg : false;
        
    }
		
	protected function beforeSave(){
		//$now = date('Y-m-d H:i:s');
		//$this->updateDateTime = $now;
		
		if($this->passwd){
			$pass = $this->makeSalt($this->passwd);
			$this->password_salt = $pass['salt'];
			$this->password = $pass['pwd'];
		}
        
        //if ($this->isNewRecord){
        //    $this->createDateTime = $now;
		//}		
		return true;
	}
	
	
	protected function afterSave(){
		
		//後台		
		if($this->scenario == "permadmin"){
			$this->dbConnection->createCommand("DELETE FROM zx_User_Permission WHERE user_id={$this->id}")->execute();
		
			if($this->permAry){				
				foreach($this->permAry as $perm){
					$this->dbConnection->createCommand("INSERT INTO zx_User_Permission (user_id, permission_id) VALUES ({$this->id},{$perm})")->execute();
				}
			}		
		}
    	
    	return parent::afterSave();		
	}
	
	
	// pass加密
	public function makeSalt($pwd){
		$pass['salt'] = md5(mt_rand(10000000, 9999999999));
		$pass['pwd'] = md5($pass['salt'].$pwd);
		
		return $pass;
	}
	public function getController(){
		$list= Yii::app()->db->createCommand("SELECT name FROM `zx_Module` where controller = '" . Yii::app()->controller->id . "' ")->queryAll();

		return $list[0]['name'];
	}	
}