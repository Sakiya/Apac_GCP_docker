<?php

class ZimportController extends Controller{
	public function init(){
        parent::init();
        $this->layout = 'admin';
        Yii::app()->language = 'zh';
    }

//產生excel
    function excel($header, $column, $rows, $filename, $callback=null){
        Yii::import('application.extensions.ExportExcel.exportData', false);
		$excel = new ExportDataExcel('browser', $filename.'.xls');
		$excel->initialize();
        //$excel->createSheet(array('title'=>'members'));

		$excel->addRow($header);

        while(($row=$rows->read())!==false) {
			$valAry = array();
			for($i=0; $i<count($column); $i++){
                $val = $row[$column[$i]];
                //closure使用        
                if ($callback) {
                    $cl = $callback($column[$i], $val);
                    if ($cl)$val = $cl;
                }
                $valAry[] = $val;
            }
			$excel->addRow($valAry);
        }
		//$excel->closeSheet();
        $excel->finalize();
    }
//第一階段基本資料
    //zimport/Adminstep1gallery
    public function actionAdminstep1gallery(){
	    //取出需要使用的欄位
		$attrs = array('Gallerym1_no', 'id' ,'email', 'name', 'name_en', 'galleryyear', 'gallerymonth', 'bossname', 'bossname_en', 'tel', 'fax', 'country', 'city', 'address', 'contactname', 'contactphone', 'contactemail', 'lineid', 'wechat', 'whatapp', 'status');
        $attrLab = Gallerym1::model()->attributeLabels();
		foreach($attrs as $attr){
			$headerVal[] = $attrLab[$attr];
		}
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
   
        $selectColumns = " * ";
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' ";
        $criteria->select = $selectColumns;

        $Gallery = Gallerym1::model()->findAll($criteria);
        
        $rows = Gallerym1::model()->getCommandBuilder()->createFindCommand(Gallerym1::model()->getTableSchema(), $criteria)->query();

        $this->excel($headerVal, $attrs, $rows, 'OAT藝廊聯絡資料'. date('Ymd'), function($column, $val) {
            switch ($column){
                case 'status':
                    return Yii::app()->params['galler_status'][$val];
                    break;
            }
        });
    }
//第一階段匯款銀行資料
    //zimport/Adminstep1bank
    public function actionAdminstep1bank(){
	    //取出需要使用的欄位
		$attrs = array('Gallerym1_no', 'id' ,'email', 'name' , 'name_en', 'paybank_account', 'paybank_name', 'paybank_bank', 'returnbank_account', 'returnbank_name', 'returnbank_bank');
        $attrLab = Gallerym1::model()->attributeLabels();
		foreach($attrs as $attr){
			$headerVal[] = $attrLab[$attr];
		}
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " * ";
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' ";
        $criteria->select = $selectColumns;
        $criteria->order = " Gallerym1_no ";

        $Gallery = Gallerym1::model()->findAll($criteria);
        $rows = Gallerym1::model()->getCommandBuilder()->createFindCommand(Gallerym1::model()->getTableSchema(), $criteria)->query();
        $this->excel($headerVal, $attrs, $rows, 'OAT第一階段匯款資料'. date('Ymd'));
    }
//第二階段One Art Award 藝術家作品資料
    //zimport/Adminstep2award
    public function actionAdminstep2award(){
	    //取出需要使用的欄位
		$attrs = array('Award_no', 'g_name', 't1_name', 'workname', 'workname_en', 'media', 'media_en', 'datasize', 'year', 'pic1', 'content1', 'pic2', 'content2', 'workpic1','description');
        $attrLab = Award::model()->attributeLabels();
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " t.* 
        , concat(g.name, ' ' ,  g.name_en) as g_name  
        , concat(t1.name, ' ' ,  t1.name_en) as t1_name  
        , concat('".Yii::app()->getBaseUrl(true)."','".Yii::app()->params['folder']['def']."', g.Yearm1_no , '".Yii::app()->params['sub_folder']['award']."' ,  t.pic1) as pic1
        , concat('".Yii::app()->getBaseUrl(true)."','".Yii::app()->params['folder']['def']."', g.Yearm1_no , '".Yii::app()->params['sub_folder']['award']."' ,  t.pic2) as pic2
        , concat('".Yii::app()->getBaseUrl(true)."','".Yii::app()->params['folder']['def']."', g.Yearm1_no , '".Yii::app()->params['sub_folder']['award']."' ,  t.workpic1) as workpic1
        ";
        $criteria->join =' LEFT JOIN Gallery_M1 g ON g.Gallerym1_no = t.Gallerym1_no ';
        $criteria->join .=' LEFT JOIN Gallery_T1 t1 ON t1.Galleryt1_no = t.Galleryt1_no and t1.Gallerym1_no = g.Gallerym1_no ';
        $criteria->condition = " g.Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' ";
        $criteria->select = $selectColumns;
        $criteria->order = " g.Gallerym1_no ";

        $Gallery = Award::model()->findAll($criteria);
		foreach($attrs as $attr){
            $_val = '';
            switch ($attr){
                case 'g_name':
                    $_val = '藝廊名稱';break;
                case 't1_name':
                    $_val = '藝廊家名稱';break;
                default:
                    $_val = $attrLab[$attr];break;
            }
			$headerVal[] = $_val;
        }
        
        $rows = Award::model()->getCommandBuilder()->createFindCommand(Award::model()->getTableSchema(), $criteria)->query();
        $this->excel($headerVal, $attrs, $rows, 'OneArtAward藝術家作品資料'. date('Ymd'));
    }
//第二階段USD 3000 key = 1
//第二階段行銷可用圖檔資料 key = 2
    //zimport/Adminstep2work?key
    public function actionAdminstep2work(){
        $type = isset($_GET['key']) ? $_GET['key'] : 3;
        //取出需要使用的欄位
        //'type' ,
        $attrs = array('Work_no', 'g_name', 't1_name', 'pic' ,'link', 'workname', 'workname_en', 'media', 'media_en', 'datasize' ,'year' ,'content1' ,'updateDateTime');
        $attrLab = Work::model()->attributeLabels();
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " t.* 
        , concat(g.name, ' ' ,  g.name_en) as g_name  
        , concat(t1.name, ' ' ,  t1.name_en) as t1_name  
        , concat('".Yii::app()->getBaseUrl(true)."','".Yii::app()->params['folder']['def']."', g.Yearm1_no , '".Yii::app()->params['sub_folder']['usd300']."' ,  t.pic) as pic
        ";
        $criteria->join =' LEFT JOIN Gallery_M1 g ON g.Gallerym1_no = t.Gallerym1_no ';
        $criteria->join .=' LEFT JOIN Gallery_T1 t1 ON t1.Gallerym1_no = g.Gallerym1_no and t1.Galleryt1_no = t.Galleryt1_no ';
        $criteria->condition = " g.Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and t.type = $type ";
        $criteria->select = $selectColumns;
        $criteria->order = " g.Gallerym1_no ";

        $Gallery = Work::model()->findAll($criteria);
        foreach($attrs as $attr){
            $_val = '';
            switch ($attr){
                case 'g_name':
                    $_val = '藝廊名稱';break;
                case 't1_name':
                    $_val = '藝廊家名稱';break;
                default:
                    $_val = $attrLab[$attr];break;
            }
            $headerVal[] = $_val;
        }
        
        $rows = Work::model()->getCommandBuilder()->createFindCommand(Work::model()->getTableSchema(), $criteria)->query();

        $filename = "";
        switch ($type){
            case '1':
                $filename = "USD3,000";
                break;
            case '2':
                $filename = "行銷可用圖檔";
                break;
        }
        $this->excel($headerVal, $attrs, $rows, "OAT".$filename . date('Ymd'));
    }
//第二階段出版物資料
    //zimport/Adminstep2print
    public function actionAdminstep2print(){
        //取出需要使用的欄位
        $attrs = array('Gallerym1_no', 'name', 'name_en', 'bossname', 'bossname_en', 'actingartist', 'exhibitionartist', 'country', 'city', 'address', 'country_en', 'city_en', 'address_en', 'tel', 'fax', 'websiteurl', 'Gallerym1_email', 'spissue_link', 'spissue_text', 'spissue_pic','Facebook','Instagram','weibo','Youtube');
        $attrLab = Gallerym1::model()->attributeLabels();
        foreach($attrs as $attr){
            $headerVal[] = $attrLab[$attr];
        }
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " t.* ,
        IF(spissue_pic = '', '',concat('".Yii::app()->getBaseUrl(true)."','".Yii::app()->params['folder']['def']."', t.Yearm1_no , '".Yii::app()->params['sub_folder']['print']."' ,  t.spissue_pic) ) as spissue_pic ";
        $criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and shortlisted = 2 ";
        $criteria->select = $selectColumns;
        $criteria->order = " Gallerym1_no ";

        $Gallery = Gallerym1::model()->findAll($criteria);
        $rows = Gallerym1::model()->getCommandBuilder()->createFindCommand(Gallerym1::model()->getTableSchema(), $criteria)->query();
        $this->excel($headerVal, $attrs, $rows, 'OAT專刊使用圖檔'. date('Ymd'));
    }
//第二階段貴賓卡郵寄名單
    //zimport/Adminstep2vip
    public function actionAdminstep2vip(){
	    //取出需要使用的欄位
		$attrs = array('g_name', 'company', 'name', 'tel', 'address');
        $attrLab = Vipcard::model()->attributeLabels();
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " t.* , concat(g.name, ' ' ,  g.name_en) as g_name";
        $criteria->join='LEFT JOIN Gallery_M1 g ON g.Gallerym1_no = t.Gallerym1_no';
        $criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and (company != '' || t.name != '' || t.tel != '' || t.address != '') ";
        $criteria->select = $selectColumns;

        $Gallery = Vipcard::model()->findAll($criteria);

		foreach($attrs as $attr){
            $_val = '';
            switch ($attr){
                case 'g_name':
                    $_val = '藝廊名稱';
                    break;
                default:
                    $_val = $attrLab[$attr];
                    break;
            }
			$headerVal[] = $_val;
        }
        
        $rows = Vipcard::model()->getCommandBuilder()->createFindCommand(Vipcard::model()->getTableSchema(), $criteria)->query();
        $this->excel($headerVal, $attrs, $rows, 'OAT貴賓卡郵寄名單'. date('Ymd'));
    }
//第二階段匯款資料
    //zimport/Adminstep1bank
    public function actionAdminstep2bank(){
	    //取出需要使用的欄位
		$attrs = array('Gallerym1_no', 'id' ,'email', 'name' , 'name_en', 'pay_total', 'paybank_account2', 'paybank_name2', 'paybank_bank2', 'returnbank_account2', 'returnbank_name2', 'returnbank_bank2');
        $attrLab = Gallerym1::model()->attributeLabels();
		foreach($attrs as $attr){
			$headerVal[] = $attrLab[$attr];
		}
        //組合 DbCriteria 條件
        $criteria = new CDbCriteria;
        $selectColumns = " * ";
   		$criteria->condition = " Yearm1_no = '" . Yii::app()->user->getState('bgYear') . "' and shortlisted = 2 ";
        $criteria->select = $selectColumns;
        $criteria->order = " Gallerym1_no ";

        $Gallery = Gallerym1::model()->findAll($criteria);
        $rows = Gallerym1::model()->getCommandBuilder()->createFindCommand(Gallerym1::model()->getTableSchema(), $criteria)->query();
        $this->excel($headerVal, $attrs, $rows, 'OAT第二階段匯款資料'. date('Ymd'));
    }
}