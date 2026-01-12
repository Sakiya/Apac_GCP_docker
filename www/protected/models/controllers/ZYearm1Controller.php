<?php

class ZYearm1Controller extends Controller
{
	public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }
    public function actionAdminindex()
    {
	    //取出需要使用的欄位
	    
        $selectColumns = ' Yearm1_no, Yearm1_year, Yearm1_open1st, Yearm1_open1ed, Yearm1_open2st, Yearm1_open2ed';
        
        //列表欄位設定
        $fields[] = array();
        $fields[] = array( "name" => "編號", "width" => "50" , "align" => "center", "sort" => "id", "class" => "hidden-767", "search" => false);
        $fields[] = array( "name" => "功能", "width" => "70" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "年度", "width" => "100" , "align" => "left", "sort" => "", "search" => false ,"defaultsearch" => false, "class" => "");
        $fields[] = array( "name" => "第一階段", "width" => "" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
        $fields[] = array( "name" => "第二階段", "width" => "", "align" => "center", "sort" => "", "search" => false, "class" =>"");
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
        $criteria->select = $selectColumns;

        $total = Yearm1::model()->count($criteria);

        //排序
        $sort = new CSort('Yearm1');
        $sort->defaultOrder = 'Yearm1_year ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Yearm1::model()->findAll($criteria);

        //重整資料,顯示列表
        $newRow = array();
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->Yearm1_no;
	        $newRow[$i][] = ($i + 1);
            $newRow[$i][] = $this->getRowPermission($row->Yearm1_no);
            $newRow[$i][] = $row->Yearm1_year; 
            $newRow[$i][] = $row->Yearm1_open1st . ' - ' . $row->Yearm1_open1ed; 
            $newRow[$i][] = $row->Yearm1_open2st . ' - ' . $row->Yearm1_open2ed;    
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


     public function actionAdminsetyear()
    {
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		
		if ($id != ''){
			Yii::app()->user->setState('bgYear',$id);
		}
		
		$this->redirect('/admin/index/');
	}
     public function actionAdminadd()
    {
        $Model = new Yearm1;

        if(isset($_POST['Yearm1'])){       	
            $Model->attributes = $_POST['Yearm1'];
            if ($Model->validate()){
                $filepath_img = "." . Yii::app()->params['customerfile']['year'];
                 
				if (CUploadedFile::getInstance($Model,'Yearm1_pic')){
			        $Model->Yearm1_pic=CUploadedFile::getInstance($Model,'Yearm1_pic');
					$newimg = Yii::app()->myClass->renameFile($Model->Yearm1_pic);
					$Model->Yearm1_pic->saveAs($filepath_img . $newimg);
					$Model->Yearm1_pic = $newimg;
				}
                if (CUploadedFile::getInstance($Model,'Yearm1_picmb')){
			        $Model->Yearm1_picmb=CUploadedFile::getInstance($Model,'Yearm1_picmb');
					$newimg = Yii::app()->myClass->renameFile($Model->Yearm1_picmb);
					$Model->Yearm1_picmb->saveAs($filepath_img . $newimg);
					$Model->Yearm1_picmb = $newimg;
				}
                
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
            $data = array('model' => $Model,'action' => 'add','GalleryCount'=>0),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }
    
//入圍信件    
    public function actionAdminshortlistAlert(){
	    $id = $_POST['id'];

		$criteria=new CDbCriteria;
		//$criteria1->order = " Yearm1_year ";
		$criteria->condition = " Yearm1_no = '" . $id . "' and shortlisted = '2' and email_shortlisted != '1'  ";
		//$criteria->limit = 3;
        $Gallerym1 = Gallerym1::model()->findAll($criteria);
                
        foreach ($Gallerym1 as $row){
	        Yii::import('application.controllers.ZEmailController');
		    $controller = new ZEmailController("");
		    $controller->AdminFirstshortlisted($row->Gallerym1_no);
        }
        
		echo CJSON::encode(array('status'=>'success','message'=>'已送出信件'));
		Yii::app()->end();
    }
    
    public function actionAdminedit(){
        $id = $_GET['id'];
        $Model = Yearm1::model()->findbyPk($id);
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Yearm1'])){  
            $Yearm1_pic_old = (isset($_POST['Yearm1']['Yearm1_pic_old']) ? $_POST['Yearm1']['Yearm1_pic_old'] : "");
            $Yearm1_picmb_old = (isset($_POST['Yearm1']['Yearm1_picmb_old']) ? $_POST['Yearm1']['Yearm1_picmb_old'] : "");
	        $oldFile = $Model->Yearm1_pic;  
            $oldFileMb = $Model->Yearm1_picmb;
            
            $Model->attributes = $_POST['Yearm1'];  

            $filedir = Yii::app()->params['baseUrl'];
			$filepath_img = "." . Yii::app()->params['customerfile']['year'];

            if ($Model->validate()){
	            
	            //＊＊＊刪除檔案 開始
	            if ($Yearm1_pic_old == '' & $oldFile != ''){
					$Model->Yearm1_pic = '';
					if (is_file($filepath_img . $oldFile)){
						unlink($filepath_img . $oldFile);
					}
				}
	 
				if (CUploadedFile::getInstance($Model,'Yearm1_pic')){
		            $Model->Yearm1_pic=CUploadedFile::getInstance($Model,'Yearm1_pic');
					$newimg = Yii::app()->myClass->renameFile($Model->Yearm1_pic);
					$Model->Yearm1_pic->saveAs($filepath_img . $newimg);
					$Model->Yearm1_pic = $newimg;

					if (is_file($filepath_img . $oldFile)){
						unlink($filepath_img . $oldFile);
					}
				} 
	            //＊＊＊刪除檔案 結束   
                //＊＊＊刪除檔案 開始  
	            if ($Yearm1_picmb_old == '' & $oldFileMb != ''){
					$Model->Yearm1_picmb = '';
					if (is_file($filepath_img . $oldFileMb)){
						unlink($filepath_img . $oldFileMb);
					}
				}
				if (CUploadedFile::getInstance($Model,'Yearm1_picmb')){
		            $Model->Yearm1_picmb=CUploadedFile::getInstance($Model,'Yearm1_picmb');
					$newimg1 = Yii::app()->myClass->renameFile($Model->Yearm1_picmb);
					$Model->Yearm1_picmb->saveAs($filepath_img . $newimg1);
					$Model->Yearm1_picmb = $newimg1;

					if (is_file($filepath_img . $oldFileMb)){
						unlink($filepath_img . $oldFileMb);
					}
				} else{
                    $Model->Yearm1_picmb = $oldFileMb;
                }
	            //＊＊＊刪除檔案 結束    
	            
	            if($Model->save()){
	                Yii::app()->user->setFlash('success', '資料已儲存 !');
	                $this->redirect(Yii::app()->user->returnUrl);
	            }else{
		            //print_r($Model->errors);
	            }
            }        
        }
        
		$criteria1=new CDbCriteria;
		$criteria1->condition = " Yearm1_no = '" . $id . "' and shortlisted = '2' and email_shortlisted != '1' ";
        $GalleryCount = Gallerym1::model()->count($criteria1); 


        
        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model,'action' => 'edit','GalleryCount'=>$GalleryCount),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = Yearm1::model()->findByPk($id);
        
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
        	$rows = Yearm1::model()->findByPk($row);
        	$rows->Yearm1_sort = $i ;
        	$rows->save();
        }
	    
    }
    
    public function actionProt2changeorder(){
	    $ids = $_POST['ids'];

        $ids_ary = mb_split(",",$ids);
        foreach ($ids_ary as $i => $row){
        	$rows = Prot2::model()->findByPk($row);
        	$rows->prot2_sort = $i ;
        	$rows->save();
        }
	    
    }
}