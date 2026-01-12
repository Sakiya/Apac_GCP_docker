<?php
class PermissionController extends Controller
{

    public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }

    public function actionAdminindex()
    {
        $selectColumns = 'id, module_id, name, action, sort, showon, developer';

        //列表欄位設定
        $fields[] = array( "name" => "功    能"  , "width" => "100" , "align" => "center", "sort" => "");
        $fields[] = array( "name" => "序號", "width" => "70" , "align" => "center", "sort" => "id");
        $fields[] = array( "name" => "模組", "width" => "" , "align" => "left", "sort" => "cat_id");
        $fields[] = array( "name" => "名稱", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "action", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "執行環境", "width" => "60" , "align" => "center", "sort" => "showon");
        $fields[] = array( "name" => "開發者專屬", "width" => "70" , "align" => "center", "sort" => "developer");
        $fields[] = array( "name" => "排序"  , "width" => "60", "align" => "center", "sort" => "sort");

        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $criteria->select = $selectColumns;

        $total = Permission::model()->count($criteria);
        //分頁
        $pages = new CPagination($total);
        //$pages->pageSize = Yii::app()->params['backendPageSize'];
        $pages->applyLimit($criteria);

        //排序
        $sort = new CSort('Permission');
        $sort->defaultOrder = 'id';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Permission::model()->findAll($criteria);

        //重整資料
        foreach ($rows as $i => $row){
            $newRow[$i][] = $this->getRowPermission($row->id);
            $newRow[$i][] = $row->id;
            $newRow[$i][] = $row->module->name;
            $newRow[$i][] = $row->name;
            $newRow[$i][] = $row->action;
            $newRow[$i][] = ($row->showon == 'backend')? '後台' : '前台';
            $newRow[$i][] = ($row->developer == 1)? '是' : '&nbsp;';
            $newRow[$i][] = $row->sort;
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
        $Model = new Permission;
        
        if(isset($_POST['Permission'])){       	
            $Model->attributes = $_POST['Permission'];
            
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
        $Model = Permission::model()->findbyPk($id);

        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Permission'])){
            $Model->attributes = $_POST['Permission'];

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
        $Model = Permission::model()->findbyPk($id);

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