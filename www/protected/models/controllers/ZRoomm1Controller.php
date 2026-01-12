<?php

class ZRoomm1Controller extends Controller
{
	public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }
    public function actionAdminindex()
    {
	    //取出需要使用的欄位
	    
        $selectColumns = ' * ';
        
        //列表欄位設定
        $fields[] = array();
        $fields[] = array( "name" => "編號", "width" => "50" , "align" => "center", "sort" => "id", "class" => "hidden-767", "search" => false);
        $fields[] = array( "name" => "功能", "width" => "70" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "方案", "width" => "100" , "align" => "left", "sort" => "", "search" => true ,"defaultsearch" => false, "class" => "");
        $fields[] = array( "name" => "名稱", "width" => "100" , "align" => "left", "sort" => "", "search" => false ,"defaultsearch" => false, "class" => "");
        $fields[] = array( "name" => "坪數", "width" => "" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "'";
        $criteria->select = $selectColumns;

        $total = Roomm1::model()->count($criteria);

        //排序
        $sort = new CSort('Roomm1');
        $sort->defaultOrder = 'sort ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Roomm1::model()->findAll($criteria);

        //重整資料,顯示列表
        $newRow = array();
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->RoomM1_no;
	        $newRow[$i][] = ($i + 1);
            $newRow[$i][] = $this->getRowPermission($row->RoomM1_no);
            $newRow[$i][] = $row->Methodm1->MethodM1_title;
            $newRow[$i][] = $row->RoomM1_nm; 
            $newRow[$i][] = $row->RoomM1_size;    
        }
        
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array('fields' => $fields, 'data' => $newRow, 'sort'=>$sort, 'total'=>$total, 'PAGE_SIZE'=>Yii::app()->params['backendPageSize'], 'CanSort' => true),
            $return = true
        );
        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    }

     public function actionAdminadd()
    {
        $Model = new Roomm1;
		$criteria1=new CDbCriteria;
		$criteria1->order = " Yearm1_year ";
		$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and (Yearm1_open1st = ''  or Yearm1_open1st > CURDATE() ) ";
        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');
		if (!$Yearm1){
			Yii::app()->user->setFlash('error', '目前房型已開始報名,故無法新增方案'); 
			$this->redirect(Yii::app()->user->returnUrl);
		}
		
        if(isset($_POST['Roomm1'])){       	
        
			$Model->attributes = $_POST['Roomm1'];
			$Model->YearM1_no = Yii::app()->user->getState('bgYear');
            if ($Model->validate()){

	            if ($Model->save()){  
					Yii::app()->user->setFlash('success', '資料新增完成 !'); 
					$this->redirect(Yii::app()->user->returnUrl);
	            } else  {
		            print_r($Model->errors); 
	            }
            }               	
        }
			
        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model, 'Yearm1' => $Yearm1,'action' => 'add'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }
    public function actionAdminedit()
    {
        $id = $_GET['id'];
        $Model = Roomm1::model()->findbyPk($id);
        //確認是否可以刪除
			$criteria1=new CDbCriteria;
			$criteria1->order = " Yearm1_year ";
			$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' ";
	        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');
			if (!$Yearm1){
				Yii::app()->user->setFlash('error', '目前房型已開始報名,故無法新增方案'); 
				$this->redirect(Yii::app()->user->returnUrl);
			}
        
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Roomm1'])){  
            $Model->attributes = $_POST['Roomm1'];  
			//$Model->Yearm1_no = Yii::app()->user->getState('bgYear');
            if ($Model->validate()){

	            if($Model->save()){
	                Yii::app()->user->setFlash('success', '資料已儲存 !');
	                $this->redirect(Yii::app()->user->returnUrl);
	            }else{
		            print_r($Model->errors);
	            }
            }        
        }
        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model, 'Yearm1' => $Yearm1,'action' => 'edit'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = Roomm1::model()->findByPk($id);
        //確認是否可以刪除
			$criteria1=new CDbCriteria;
			$criteria1->order = " Yearm1_year ";
			$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and (Yearm1_open1st = ''  or Yearm1_open1st > CURDATE() ) ";
	        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');
			if (!$Yearm1){
				Yii::app()->user->setFlash('error', '目前房型已開始報名,故無法刪除房型'); 
				$this->redirect(Yii::app()->user->returnUrl);
			}
		
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        } else  {
			//print_r($Model->errors); 
        } 
		
        // 使用自訂method deleteForStatus 進行刪除
        if ($Model->delete() ){	
            Yii::app()->user->setFlash('success', '資料已刪除 !');
        	$this->redirect(Yii::app()->user->returnUrl);	   
              
       
        }
    }
    public function actionAdminchangeorder(){
	    $ids = $_POST['ids'];

        $ids_ary = mb_split(",",$ids);
        foreach ($ids_ary as $i => $row){
        	$rows = Roomm1::model()->findByPk($row);
        	$rows->sort = $i ;
        	$rows->save();
        }
	    
    }

}