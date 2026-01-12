<?php
class RoleController extends Controller
{

    public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }

    public function actionAdminindex()
    {
        $selectColumns = 'id, name, superpower, bulitin';

        //列表欄位設定
        $fields[] = array( "name" => "功    能"  , "width" => "100" , "align" => "center", "sort" => "");
        $fields[] = array( "name" => "序號", "width" => "70" , "align" => "center", "sort" => "id");
        $fields[] = array( "name" => "名稱", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "權限", "width" => "" , "align" => "left", "sort" => "superpower");
        $fields[] = array( "name" => "內建角色", "width" => "70" , "align" => "center", "sort" => "bulitin");

        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $criteria->select = $selectColumns;

        $total = Role::model()->count($criteria);
        //分頁
        $pages = new CPagination($total);
        $pages->pageSize = Yii::app()->params['backendPageSize'];
        $pages->applyLimit($criteria);

        //排序
        $sort = new CSort('Role');
        $sort->defaultOrder = 'id';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Role::model()->findAll($criteria);

        //重整資料
        foreach ($rows as $i => $row){
            $newRow[$i][] = $this->getRowPermission($row->id);
            $newRow[$i][] = $row->id;
            $newRow[$i][] = $row->name;
            $newRow[$i][] = ($row->superpower == 1)? '全部' : '依設定';
            $newRow[$i][] = ($row->bulitin == 1)? '是' : '';
        }
        
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array('fields' => $fields, 'data' => $newRow, 'pages'=>$pages, 'sort'=>$sort, 'total'=>$total, 'PAGE_SIZE'=>Yii::app()->params['backendPageSize']),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    }

    public function actionAdminadd()
    {
        $Model = new Role;
        
        //所有模組列表
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.name';
        $criteria->with = array(
        	"permission:excludeDeveloper"=>array('joinType'=>'inner join'),
        );
        $modules = Module::model()->findAll($criteria);
        
        if(isset($_POST['Role'])){   
        	$Model->setScenario('admin');    	
            $Model->attributes = $_POST['Role'];
            $Model->permAry = $_POST['permAry'];
            
            if($Model->save()){                
                Yii::app()->user->setFlash('success', '資料新增完成 !');
                $this->redirect(Yii::app()->user->returnUrl);
            }                       	
        }

        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model, 'modules'=> $modules, 'action' => 'add'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdminedit()
    {
        $id = $_GET['id'];
        $Model = Role::model()->findbyPk($id);
        $Model->permAry = $Model->rolePermission;
	
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        //所有模組列表
        $criteria = new CDbCriteria;
        $criteria->select = 't.id, t.name';
        $criteria->with = array(
        	"permission:excludeDeveloper"=>array('joinType'=>'inner join'),
        );
        $modules = Module::model()->findAll($criteria);

        if(isset($_POST['Role'])){
        //Yii::app()->end();
        	$Model->setScenario('admin');
            $Model->attributes = $_POST['Role'];
			$Model->permAry = $_POST['permAry'];
			
            if($Model->save()){
                Yii::app()->user->setFlash('success', '資料已儲存 !');
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model, 'modules'=> $modules, 'action' => 'edit'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = Role::model()->findbyPk($id);

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

}
?>