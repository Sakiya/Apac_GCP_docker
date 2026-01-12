<?php
class ModuleController extends Controller
{

    public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }

    public function actionAdminindex()
    {
        $selectColumns = 'id, cat_id, name, controller, option_search, sort';

        //列表欄位設定
        $fields[] = array( "name" => "功    能"  , "width" => "100" , "align" => "center", "sort" => "");
        $fields[] = array( "name" => "序號", "width" => "70" , "align" => "center", "sort" => "id");
        $fields[] = array( "name" => "分類", "width" => "" , "align" => "left", "sort" => "cat_id");
        $fields[] = array( "name" => "模組名稱", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "controller", "width" => "" , "align" => "left", "sort" => "");
        $fields[] = array( "name" => "快速搜尋", "width" => "60" , "align" => "center", "sort" => "");
        $fields[] = array( "name" => "排序"  , "width" => "60", "align" => "center", "sort" => "sort");

        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $criteria->select = $selectColumns;

        $total = Module::model()->count($criteria);
        //分頁
        /*
        $pages = new CPagination($total);
        $pages->pageSize = Yii::app()->params['backendPageSize'];
        $pages->applyLimit($criteria);
		*/
        //排序
        $sort = new CSort('Module');
        $sort->defaultOrder = 'id';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Module::model()->findAll($criteria);

        //重整資料
        foreach ($rows as $i => $row){
            $newRow[$i][] = $this->getRowPermission($row->id);
            $newRow[$i][] = $row->id;
            $newRow[$i][] = $row->cat->name;
            $newRow[$i][] = $row->name;
            $newRow[$i][] = $row->controller;
            //$newRow[$i][] = ($row->option_search == 1)? '開啓' : '';
            $newRow[$i][] = CHtml::activeCheckBox($row, 'option_search', array('id'=>"search_{$row->id}"));
            $newRow[$i][] = $row->sort;
        }
        
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array(
            	'fields' => $fields, 
            	'data' => $newRow, 
            	'pages'=>$pages, 
            	'sort'=>$sort,
            	'total'=>$total, 
            	'PAGE_SIZE'=>Yii::app()->params['backendPageSize'],
            	'checkedData'=>array(
            		array('prefix'=>'search_', 'controllerAction'=>'module/checkset','otherData'=>'')
            	)

            ),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    }


    //顯示設定
    public function actionCheckset(){
        if (!Yii::app()->request->isAjaxRequest){
            Yii::app()->end();
        }
    	$id = $_POST['id'];
    	$ck = $_POST['ck'];
    	
        if (!$id){
        	$message = array('status'=>'fail', 'message'=>'找不到資料');        	
        	echo CJSON::encode($message);
        	Yii::app()->end();
        }
        
        $Model = Module::model()->findByPk($id);
        
        $Model->option_search = ($ck == 'true' || $ck == 'checked')? 1 : 0;
        if(!$Model->saveAttributes(array('option_search'))){
        	$message = array('status'=>'fail', 'message'=>$Model->getError('option_search'));        	
        	echo CJSON::encode($message);
        	Yii::app()->end();
        }
                       
    	$message = array('status'=>'success', 'message'=>"序號 {$Model->id}： 修改完成");
    	echo CJSON::encode($message);
    	Yii::app()->end();
   
    }

    public function actionAdminadd()
    {
        $Model = new Module;
        
        if(isset($_POST['Module'])){       	
            $Model->attributes = $_POST['Module'];
            
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
        $Model = Module::model()->findbyPk($id);

        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Module'])){
            $Model->attributes = $_POST['Module'];

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
        $Model = Module::model()->findbyPk($id);

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