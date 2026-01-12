<?php

class zUSERController extends Controller
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
        $fields[] = array( "name" => "下載", "width" => "50" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "功能", "width" => "50" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "入圍", "width" => "50" , "align" => "center", "sort" => "", "search" => false, "class" =>"");
		$fields[] = array( "name" => "報名序號", "width" => "70" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "畫廊名稱", "width" => "" , "align" => "left", "sort" => "", "search" => false ,"defaultsearch" => false, "class" => "");
        $fields[] = array( "name" => "國家", "width" => "" , "align" => "left", "sort" => "", "search" => true ,"defaultsearch" => false, "class" => "");
		$fields[] = array( "name" => "建立日期", "width" => "50" , "align" => "left", "sort" => "", "search" => true, "class" =>"");
		$fields[] = array( "name" => "成立年", "width" => "50" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
		$fields[] = array( "name" => "付款日期", "width" => "50" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
        $fields[] = array( "name" => "狀態", "width" => "50" , "align" => "left", "sort" => "", "search" => true, "class" =>"");
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "'";
        $criteria->select = $selectColumns;

        $total = Gallerym1::model()->count($criteria);

        //排序
        $sort = new CSort('Gallerym1');
        $sort->defaultOrder = 'Gallerym1_no ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Gallerym1::model()->findAll($criteria);

        //重整資料,顯示列表
        $newRow = array();
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->Gallerym1_no;
	        $newRow[$i][] = ($i + 1);
	        $newRow[$i][] = '<a target="_blank" href="' . Yii::app()->createUrl("/zUser/AdmindPdf/",array("id"=>$row->Gallerym1_no)) . '">連結</a>';
            $newRow[$i][] = $this->getRowPermission($row->Gallerym1_no);
            $newRow[$i][] = isset(Yii::app()->params['galler_short'][$row->shortlisted]) ? Yii::app()->params['galler_short'][$row->shortlisted]: '未審核';
			//$newRow[$i][] = $row->shortlisted == '2' ? '<div class="fa fa-check green"></div>' : '';
			$newRow[$i][] = $row->id; 
            $newRow[$i][] = ($row->lang == 'en' ? $row->name_en : $row->name); 
            $newRow[$i][] = $row->country;
			$newRow[$i][] = substr($row->createDateTime,0,10);
			$newRow[$i][] = $row->galleryyear;
			$newRow[$i][] = $row->paydate;
            $newRow[$i][] = Yii::app()->params['galler_status'][$row->status];   
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
    public function actionAdmindPdf()
    {
	    $this->layout="";
	    $id = $_GET['id'];
        $Gallery = Gallerym1::model()->findbyPk($id);
        			
        $this->layout = 'empty';

        if (!$Gallery){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

	    $Methodm1 = Methodm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> $Gallery->Yearm1->Yearm1_no),
				'order'=>'sort'
			));

		$Method = Methodm1::model()->choose($Methodm1, $Gallery);	
        $content = $this->renderPartial(
            $view = '/apply1/zh_print',
            $data = array('model' => $Gallery,'Method' => $Method, 'MethodMain' => $Methodm1),
            $return = true
        );

        $this->render('/layouts/empty', array(
            'content' => $content,
        ));

	}
     public function actionAdminadd()
    {
        $Model = new Gallerym1;

        if(isset($_POST['Gallerym1'])){       	
        
             $Model->attributes = $_POST['Gallerym1'];

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
        $Model = Gallerym1::model()->findbyPk($id);
        if (!$Model){
            Yii::app()->user->setFlash('warning', '很抱歉, 找不到您要的資料!');
            $this->redirect(Yii::app()->user->returnUrl);
            return ;
        }

        if(isset($_POST['Gallerym1'])){   
            //$Model->attributes = $_POST['Gallerym1'];

			$Model->status = $_POST['Gallerym1']['status'];
			$Model->shortlisted = $_POST['Gallerym1']['shortlisted'];
			$Model->pay_status = $_POST['Gallerym1']['pay_status'];
			$Model->paydate = $_POST['Gallerym1']['paydate'];
			$Model->pay_return = $_POST['Gallerym1']['pay_return'];
			$Model->finishroom = $_POST['Gallerym1']['finishroom'];
			$Model->remark = $_POST['Gallerym1']['remark'];
            if ($Model->validate()){
	            if($Model->save()){
	                Yii::app()->user->setFlash('success', '資料已儲存 !');
	                $this->redirect(Yii::app()->user->returnUrl);
	            }else{
		            print_r($Model->errors);
	            }
            } 
            print_r($Model->validate());      
        }
        
	    $Methodm1 = Methodm1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no ",
				'params'=>array(':Yearm1_no'=> Yii::app()->user->getState('bgYear')),
				'order'=>'sort'
			));

		$Method = Methodm1::model()->choose($Methodm1, $Model);	
        $listTable = $this->renderPartial(
            $view = 'form',
            $data = array('model' => $Model, 'Method' => $Method, 'MethodMain' => $Methodm1,'action' => 'edit'),
            $return = true
        );

        $this->render('/admin/common/index', array(
            'listTable' => $listTable,
        ));
    }

    public function actionAdmindelete()
    {
        $id = $_GET['id'];
        $Model = Gallerym1::model()->findByPk($id);
        
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
        	$rows = Gallerym1::model()->findByPk($row);
        	$rows->sort = $i ;
        	$rows->save();
        }
	    
    }
    public function actionAdminlist(){
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        $location = isset($_GET['YourLocation']) ? $_GET['YourLocation'] : "";
        $gpage = isset($_GET['gpage']) ? $_GET['gpage'] : "1";
        $shortlisted = isset($_GET['shortlisted']) ? $_GET['shortlisted'] : "3";
        $Gallery = NULL;
        $Method = NULL;
        $Methodm1 = NULL;
        $prevGallery = NULL;
        $nextGallery = NULL;
        $rowRun = NULL;
	//取得每個國家
        $EveryCountry=Yii::app()->db->createCommand("
            SELECT count(*) as coutryCount, country, COALESCE(sum(abc),0) as galleryCount 
            FROM `Gallery_M1` GM1 
            Left join ( 
                SELECT count(*) as abc, GalleryM1_no 
                From Gallery_T1 group by GalleryM1_no 
            )as T1 on T1.GalleryM1_no = GM1.GalleryM1_no 
            where Yearm1_no = " . Yii::app()->user->getState('bgYear') . " and status = 3 group by country
        ")
        ->queryAll();



		if ($location == ""){
            if ($EveryCountry){
                $location = $EveryCountry[0]['country'];
            }else{
                //$this->redirect('/admin/index');
            }
		}
	//國家全部畫廊	
		$country = Gallerym1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and country = :country and status = 3 and shortlisted = :shortlisted ",
				'params'=>array(':Yearm1_no'=> Yii::app()->user->getState('bgYear'),':country' => $location, ':shortlisted'=>$shortlisted)
            ));

		if ($id == ""){
            if ($country){
                $this->redirect('/zUser/adminlist/?id=' . ($country ? $country[$gpage-1]->Gallerym1_no : '') . '&YourLocation='.$location . '&shortlisted=' . $shortlisted);
            }else{
                //$this->redirect('/admin/index');
            }
		}else{
			$Gallery = Gallerym1::model()->find(
				array(
					'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no and status = 3 and shortlisted = :shortlisted ",
					'params'=>array(':Yearm1_no'=> Yii::app()->user->getState('bgYear'),':Gallerym1_no' => $id, ':shortlisted'=>$shortlisted )
				));
        }
		if (!$Gallery){
			if (count($country) > 0){
				$this->redirect('/zUser/adminlist/?id=' . $country[0]->Gallerym1_no . '&YourLocation='.$location . '&shortlisted=' . $shortlisted);
			}else{
			//	$this->redirect('/zUser/adminindex');
			}
		}else{
            $prevGallery = Gallerym1::getNextOrPrevId($id,'prev',$location);
            $nextGallery = Gallerym1::getNextOrPrevId($id,'next',$location);
            
            $rowRun = Gallerym1::getRowrun($id,$location);

            $Methodm1 = Methodm1::model()->findAll(
                array(
                    'condition'=>"Yearm1_no =:Yearm1_no ",
                    'params'=>array(':Yearm1_no'=> $Gallery->Yearm1_no),
                    'order'=>'sort'
                ));

            $Method = Methodm1::model()->choose($Methodm1, $Gallery);
            //$this->layout = 'empty';
        }

            $listTable = $this->renderPartial(
                $view = '/zUser/list',
                $data = array(
                    'model' => $Gallery,'Method' => $Method, 'MethodMain' => $Methodm1,
                    'prevGallery'=>$prevGallery,'nextGallery'=>$nextGallery, 'EveryCountry' =>$EveryCountry,
                    'location' => $location,'action' => 'edit','countryCount'=>count($country),'rowRun'=>$rowRun,
                    'shortlisted' => $shortlisted
                ),
                $return = true
            );
            $this->layout = 'empty';
            $this->render('/layouts/empty', array(
                'content' => $listTable,
            ));
    }
}