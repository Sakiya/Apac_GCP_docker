<?php

class ZMethodm1Controller extends Controller
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
        //$fields[] = array( "name" => "年度", "width" => "100" , "align" => "left", "sort" => "", "class" => "", "search" => false ,"defaultsearch" => false);
        $fields[] = array( "name" => "方案名稱", "width" => "" , "align" => "left", "sort" => "", "class" => "", "search" => false);
        
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "'";
        $criteria->select = $selectColumns;

        $total = Methodm1::model()->count($criteria);

        //排序
        $sort = new CSort('Methodm1');
        $sort->defaultOrder = 'sort ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Methodm1::model()->findAll($criteria);
        //重整資料,顯示列表
        $newRow = array();
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->MethodM1_no;
	        $newRow[$i][] = ($i + 1);
            $newRow[$i][] = $this->getRowPermission($row->MethodM1_no);
            //$newRow[$i][] = "";//$row->Yearm1->Yearm1_no;
            $newRow[$i][] = $row->MethodM1_title;
        }

        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array('fields' => $fields, 'data' => $newRow, 'sort'=>$sort, 'total'=>$total, 'PAGE_SIZE'=>Yii::app()->params['backendPageSize'], 'CanSort' => true),
            $return = true
        );
        $this->render('/admin/common/index', array(
            'listTable' => $listTable
			
        ));
    }

     public function actionAdminadd()
    {
        $Model = new Methodm1;
        
        
		$criteria1=new CDbCriteria;
		$criteria1->order = " Yearm1_year ";
		$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and (Yearm1_open1st = ''  or Yearm1_open1st > CURDATE() ) ";
        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');

		if (!$Yearm1){
			Yii::app()->user->setFlash('error', '目前年度已開始報名,故無法新增方案'); 
			$this->redirect(Yii::app()->user->returnUrl);
		}
        $Methodm1_count = Methodm1::model()->count(			
            array(
                'condition'=>"Yearm1_no = :Yearm1_no",
                'params'=>array(':Yearm1_no'=>Yii::app()->user->getState('bgYear'))
            ));

        if ($Methodm1_count >= 3){
            Yii::app()->user->setFlash('error', '每年度最多能開啟三個方案'); 
            $this->redirect(Yii::app()->user->returnUrl);
        }  

        if(isset($_POST['Methodm1'])){       	
        
             $Model->attributes = $_POST['Methodm1'];

            if ($Model->validate()){
	            
	            if ($Model->save()){ 
					Yii::app()->user->setFlash('success', '資料新增完成 !'); 
					$this->redirect(Yii::app()->user->returnUrl);
	            } else  {
		            //print_r($Model->errors); 
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
		$criteria1=new CDbCriteria;
		$criteria1->order = " Yearm1_year ";
		$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' ";
        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');
		  
        $Model = Methodm1::model()->findbyPk($id);
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Methodm1'])){  

            $Model->attributes = $_POST['Methodm1'];  

            if ($Model->validate()){

	            if($Model->save()){
	                Yii::app()->user->setFlash('success', '資料已儲存 !');
	                $this->redirect(Yii::app()->user->returnUrl);
	            }else{
		            //print_r($Model->errors);
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
        $Model = Methodm1::model()->findByPk($id);
	    //確認年度
			$criteria1=new CDbCriteria;
			$criteria1->order = " Yearm1_year ";
			$criteria1->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and (Yearm1_open1st = ''  or Yearm1_open1st > CURDATE() ) ";
	        $Yearm1 = CHtml::listData(Yearm1::model()->findAll($criteria1),'Yearm1_no','Yearm1_year');
			if (!$Yearm1){
				Yii::app()->user->setFlash('error', '目前年度已開始報名,故無法刪除方案'); 
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
        	$rows = Methodm1::model()->findByPk($row);
        	$rows->sort = $i ;
        	$rows->save();
        }
	    
    }
}