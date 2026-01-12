<?php

class ZListController extends Controller
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
        $fields[] = array( "name" => "功能", "width" => "50" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
		$fields[] = array( "name" => "報名序號", "width" => "70" , "align" => "center", "sort" => "id", "class" => "", "search" => false);
        $fields[] = array( "name" => "畫廊名稱", "width" => "" , "align" => "left", "sort" => "", "search" => false ,"defaultsearch" => false, "class" => "");
        $fields[] = array( "name" => "國家", "width" => "" , "align" => "left", "sort" => "", "search" => true ,"defaultsearch" => false, "class" => "");
		$fields[] = array( "name" => "建立日期", "width" => "50" , "align" => "left", "sort" => "", "search" => true, "class" =>"");
		$fields[] = array( "name" => "成立年", "width" => "50" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
        $fields[] = array( "name" => "付款日期", "width" => "50" , "align" => "left", "sort" => "", "search" => false, "class" =>"");
        $fields[] = array( "name" => "付款", "width" => "50" , "align" => "left", "sort" => "", "search" => true, "class" =>"");
        $fields[] = array( "name" => "狀態", "width" => "50" , "align" => "left", "sort" => "", "search" => true, "class" =>"");
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and shortlisted = 2 ";
        $criteria->select = $selectColumns;

        $total = Gallerym1::model()->count($criteria);

        //排序
        $sort = new CSort('Gallerym1');
        $sort->defaultOrder = 'id ';
        $sort->applyOrder($criteria);

        //取得資料
        $rows = Gallerym1::model()->findAll($criteria);

        //重整資料,顯示列表
        $newRow = array();
        foreach ($rows as $i => $row){ 
	        $newRow[$i][] = $row->Gallerym1_no;
	        $newRow[$i][] = ($i + 1);
            $newRow[$i][] = $this->getRowPermission($row->Gallerym1_no);
			$newRow[$i][] = $row->id; 
            $newRow[$i][] = ($row->lang == 'en' ? $row->name_en : $row->name); 
            $newRow[$i][] = $row->country;
			$newRow[$i][] = substr($row->createDateTime,0,10);
			$newRow[$i][] = $row->galleryyear;
            $newRow[$i][] = $row->paydate2;
            $newRow[$i][] = $row->pay_status2 > 0 ? Yii::app()->params['galler_pay_status'][$row->pay_status2] : '';        
            $newRow[$i][] = ($row->finishStep2_9 ? '完成填寫 ' : '');
        }
        $listTable = $this->renderPartial(
            $view = '/admin/common/listTable',
            $data = array('fields' => $fields, 'data' => $newRow, 'sort'=>$sort, 'total'=>$total, 'PAGE_SIZE'=>Yii::app()->params['backendPageSize'], 'CanSort' => false),
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

			$Model->pay_status2 = $_POST['Gallerym1']['pay_status2'];
			$Model->paydate2 = $_POST['Gallerym1']['paydate2'];
			$Model->remark = $_POST['Gallerym1']['remark'];
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
        
	//取得每個國家
    	$EveryCountry=Yii::app()->db->createCommand("
                SELECT count(*) as coutryCount, country, sum(abc) as galleryCount FROM `Gallery_M1` GM1 Left join ( SELECT count(*) as abc, GalleryM1_no From Gallery_T1 group by GalleryM1_no )as T1 on T1.GalleryM1_no = GM1.GalleryM1_no group by country")
				->queryAll();
		
		if ($location == ""){
			$location = $EveryCountry[0]['country'];
		}
	//國家全部畫廊	
		$country = Gallerym1::model()->findAll(
			array(
				'condition'=>"Yearm1_no =:Yearm1_no and country = :country ",
				'params'=>array(':Yearm1_no'=> Yii::app()->user->getState('bgYear'),':country' => $location)
			));

		if ($id == ""){
			$this->redirect('/zUser/adminlist/?id=' . $country[$gpage-1]->Gallerym1_no . '&YourLocation='.$location);
		}else{
			$Gallery = Gallerym1::model()->find(
				array(
					'condition'=>"Yearm1_no =:Yearm1_no and Gallerym1_no = :Gallerym1_no ",
					'params'=>array(':Yearm1_no'=> Yii::app()->user->getState('bgYear'),':Gallerym1_no' => $id)
				));
		}

		if (!$Gallery){
			if (count($country) > 0){
				$this->redirect('/zUser/adminlist/?id=' . $country[0]->Gallerym1_no . '&YourLocation='.$location);
			}else{
				$this->redirect('/zUser/adminindex');
			}
		}

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
        $this->layout = 'empty';

        $listTable = $this->renderPartial(
            $view = '/zUser/list',
            $data = array('model' => $Gallery,'Method' => $Method, 'MethodMain' => $Methodm1,'prevGallery'=>$prevGallery,'nextGallery'=>$nextGallery, 'EveryCountry' =>$EveryCountry,'location' => $location,'action' => 'edit','countryCount'=>count($country),'rowRun'=>$rowRun),
            $return = true
		);
        $this->layout = 'empty';
        $this->render('/layouts/empty', array(
            'content' => $listTable,
		));
    }
}