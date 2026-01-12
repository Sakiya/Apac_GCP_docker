<?php
class ZProm1Controller extends Controller
{
	public function init()
    {
        parent::init();
        $this->layout = 'admin';
    }
    public function actionAdminindex()
    {
	    //取出需要使用的欄位
	    
        $selectColumns = 'prom1_no, prom1_dsp, prot1_no, prom1_title, prom1_script';
        
        //列表欄位設定
        $fields[] = array();
        $fields[] = array( "name" => "編號", "width" => "50" , "align" => "center", "sort" => "id", "class" => "hidden-767", "search" => false);
        $fields[] = array( "name" => "功能", "width" => "70" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "類別", "width" => "100" , "align" => "left", "sort" => "", "search" => true ,"defaultsearch" => true);
        $fields[] = array( "name" => "項目名稱", "width" => "" , "align" => "left", "sort" => "", "search" => false);
        $fields[] = array( "name" => "顯示", "width" => "100", "align" => "center", "sort" => "", "search" => true);
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
        $criteria->select = $selectColumns;

        $total = Prom1::model()->count($criteria);

        //排序
        $sort = new CSort('Prom1');
        $sort->defaultOrder = 'prom1_sort ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Prom1::model()->findAll($criteria);

        //重整資料,顯示列表
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->prom1_no;
	        $newRow[$i][] = ($i + 1);
            $newRow[$i][] = $this->getRowPermission($row->prom1_no);
            $newRow[$i][] = $row->Prot1->prot1_title;
            $newRow[$i][] = $row->prom1_title;
            $newRow[$i][] = ($row->prom1_dsp == '1' ? '是' : '否');            
        }
        
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array('fields' => $fields, 'data' => $newRow, 'pages'=>$pages, 'sort'=>$sort, 'total'=>$total, 'PAGE_SIZE'=>Yii::app()->params['backendPageSize'], 'CanSort' => true),
            $return = true
        );
        $this->render('/admin/common/index', array(
            'listTable' => $listTable
			
        ));
    }
    
     public function actionAdminadd()
    {
        $Model = new Prom1;

        if(isset($_POST['Prom1'])){       	
        
             $Model->attributes = $_POST['Prom1'];

            if ($Model->validate()){
	            
	            if ($Model->save()){  
				
					if ($sfile=CUploadedFile::getInstancesByName('Prot2[prot2_img]')){
						foreach ($sfile as $i=>$file){  
							$d1 = new Prot2();
							$newimg = Yii::app()->myClass->renameFile($file->name);
							$d1->prot2_img = $newimg;
							$d1->prom1_no = $Model->prom1_no;
							$file->saveAs("." . Yii::app()->params['customerfile']['Prot2_img'].$newimg);
							
							$d1->save();
						}
					}
					Yii::app()->user->setFlash('success', '資料新增完成 !'); 
					$this->redirect(Yii::app()->user->returnUrl);
	            } else  {
		            //print_r($Model->errors); 
	            }
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
        $Model = Prom1::model()->findbyPk($id);
        
        $Prot2 = Prot2::model()->findAll(
		array(
			'condition'=>"prom1_no =:prom1_no",
			'params'=>array(':prom1_no'=>$id),
			'order'=>'prot2_sort '
		));

        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Prom1'])){   

            $Model->attributes = $_POST['Prom1'];            
           
            if ($Model->validate()){ 
			//
				//if (isset($_POST['DeleteImg'])){
					$Del_Ary = mb_split(",", $_POST['DeleteImg']);
					$filepath_img = "." . Yii::app()->params['customerfile']['Prot2_img'];
					if (count($Del_Ary) > 0) {
						foreach ($Del_Ary as $item){
							$eachProt2 = Prot2::model()->findbyPk($item);		
							if ($eachProt2){
								if ($eachProt2->prot2_img != ''){
									if(file_exists($filepath_img . $eachProt2->prot2_img)){
										unlink($filepath_img . $eachProt2->prot2_img); 
									}
								}
								$eachProt2->findbyPk($item)->delete();
							}
						}
					}
				//}
				if ($sfile=CUploadedFile::getInstancesByName('Prot2[prot2_img]')){
					foreach ($sfile as $i=>$file){  
						$d1 = new Prot2();
						$newimg = Yii::app()->myClass->renameFile($file->name);
						$d1->prot2_img = $newimg;
						$d1->prom1_no = $id;
						$file->saveAs("." . Yii::app()->params['customerfile']['Prot2_img'].$newimg);
						
						$d1->save();
					}
				}
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
            $data = array('model' => $Model,'action' => 'edit','Prot2' => $Prot2),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));

    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = Prom1::model()->findByPk($id);
        
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
        	$rows = Prom1::model()->findByPk($row);
        	$rows->prom1_sort = $i ;
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