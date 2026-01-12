<?php
class UserController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'admin';        
    }
    
    public function actionAdminindex()
    {
    	$selectColumns = 'id, role_id, account, name, active , freezed';

    	//列表欄位設定
    	$fields[] = array( "name" => "功    能"  , "width" => "100" , "align" => "center", "sort" => "");
        $fields[] = array( "name" => "序號", "width" => "70" , "align" => "center", "sort" => "id");
        $fields[] = array( "name" => "角色", "width" => "100" , "align" => "center", "sort" => "role_id");
        $fields[] = array( "name" => "帳號", "width" => "" , "align" => "left", "sort" => "");	        
        $fields[] = array( "name" => "姓名", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "狀態", "width" => "60" , "align" => "center", "sort" => "active");
		$fields[] = array( "name" => "停權", "width" => "60" , "align" => "center", "sort" => "freezed");        
		
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $criteria->select = $selectColumns;
        
        
        //if (isset($_GET['keyword'])){
    	//	$criteria->addSearchCondition('name', $_GET['keyword'], $escape=true, $operator='OR');
        //}

        $total = User::model()->count($criteria);
        //分頁
        $pages = new CPagination($total);
        $pages->pageSize = Yii::app()->params['backendPageSize'];
        $pages->applyLimit($criteria);

        //排序
        $sort = new CSort('User');
        $sort->defaultOrder = 'id';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = User::model()->findAll($criteria);

        //重整資料
        
        foreach ($rows as $i => $row){
            $newRow[$i][] = $this->getRowPermission($row->id);
            $newRow[$i][] = $row->id;
            $newRow[$i][] = $row->role->name;
            $newRow[$i][] = $row->account;
            $newRow[$i][] = $row->name;
            $newRow[$i][] = ($row->active == 1)? '啓用' : '';
            $newRow[$i][] = ($row->freezed == 1)? '停權' : '';
        }
                
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array(
            	'fields' => $fields, 
            	'data' => $newRow, 
            	'pages'=>$pages, 
            	'sort'=>$sort,
            	'total'=>$total,
            	'PAGE_SIZE'=>Yii::app()->params['backendPageSize']),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    }

    public function actionAdminadd()
    {
        $Model = new User;                
        $Model->setScenario('adminadd');
        
        if(isset($_POST['User'])){    		
    		//先檢查角色是否合法
    		if (Yii::app()->user->model->role->superpower <> 1 && $_POST['User']['role_id']){
    			$role = Role::model()->findbyPk($_POST['User']['role_id']);
    			if (!$role || $role->superpower == 1){
    				$this->redirect(Yii::app()->user->returnUrl);
    				Yii::app()->end();
    			}
    		}    		
    		//設定場景
            $Model->attributes = $_POST['User'];
            
            if($Model->save()){ 
                Yii::app()->user->setFlash('success', '資料新增完成 !');
                $this->redirect(Yii::app()->user->returnUrl);
            }                       	
        }

        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model,'action' => 'add'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdminedit()
    {
        $id = $_GET['id'];
        $Model = User::model()->findbyPk($id);
		
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }
        
        $Model->setScenario('adminedit');	
        
        if(isset($_POST['User'])){
    		//先檢查角色是否合法
    		if (Yii::app()->user->model->role->superpower <> 1 && $_POST['User']['role_id']){
    			$role = Role::model()->findbyPk($_POST['User']['role_id']);
    			if (!$role || $role->superpower == 1 || (Yii::app()->user->id == $Model->id)){
    				$this->redirect(Yii::app()->user->returnUrl);
    				Yii::app()->end();
    			}
    		}    		                
        	
            $Model->attributes = $_POST['User'];
            
            if($Model->save()){
                Yii::app()->user->setFlash('success', '資料已儲存 !');
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model,'action' => 'edit'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = User::model()->findbyPk($id);

        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if($Model->delete()){
        	Yii::app()->user->setFlash('success', '資料已刪除 !');
        	$this->redirect(Yii::app()->user->returnUrl);
        }        
    }
    
    //修改權限
    public function actionAdmineditperm(){

        $id = $_GET['id'];
        $Model = User::model()->findbyPk($id);
        
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }
		$Model->permAry = $Model->userPermission;
    
        //所有模組列表
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.name';
        $criteria->with = array(
        	"permission:excludeDeveloper"=>array('joinType'=>'inner join'),
        );
        $modules = Module::model()->findAll($criteria);
		
		$Model->setScenario('permadmin');
        if(isset($_POST['act'])){
        	
			$Model->permAry = $_POST['permAry'];
			
            if($Model->save()){
                Yii::app()->user->setFlash('success', '資料已儲存 !');
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $listTable = $this->renderPartial(
            $view = 'permform',
            $data = array('model' => $Model,'modules'=> $modules,'action' => 'editperm'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    
    }    


	//匯出會員名單
	public function actionAdminexport(){
		$attrs = array('id', 'role_id', 'account', 'name', 'email', 'active', 'freezed', 'developer');
		
		$attrLab = User::model()->attributeLabels();
		
		$basNum = count($attrs);
		
		$roles = Role::model()->listData();
		
		foreach($attrs as $attr){
			$headerVal[] = $attrLab[$attr];
		}
		
		Yii::import('application.extensions.ExportExcel.exportData', true);
		
		$excel = new ExportDataExcel('browser', 'members.xls');
		
		$excel->initialize();
		$excel->createSheet(array('title'=>'members'));

		//The first Row (header)
		$excel->addRow($headerVal);

        $criteria = new CDbCriteria;
        $criteria->order = "id ASC";

		$rows = User::model()->getCommandBuilder()->createFindCommand(User::model()->getTableSchema(), $criteria)->query();

		while(($row=$rows->read())!==false) {
			$valAry = array();
			for($i=0; $i<$basNum; $i++){
				$val = $row[$attrs[$i]];
				if ($attrs[$i] == 'role_id'){
					$valAry[] = $roles[$val];
				} else {
					$valAry[] = $val;
				}
			}
			$excel->addRow($valAry);
		}
		$excel->closeSheet();
		$excel->finalize();

	}

}
?>