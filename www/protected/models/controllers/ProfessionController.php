<?php
class ProfessionController extends Controller{
    public function init(){
        parent::init();
        $this->layout = '';
        $this->MenuBg = "Brown"; 

	//breadcrumbs
		switch (Yii::app()->language){
			case 'en':
				$this->breadcrumbs["SERVICE"] = "";
				break;
			default:
				$this->breadcrumbs["專業服務"] = "";
			
		}
    }

    public function actionService(){
	//Title
		$this->PageTitle = "服務流程";
		$this->PageTitleEN = "Service Flow";
    //SEO
    //-- zh
        $this->MetaTag_Ary['zh']["description"] = "奇華廣告的服務流程：接單(門市、電聯、傳真、Email)→客戶提供設計圖or奇華提供繪製設計圖→圖面確認→壓克力精密加工→品質檢驗→包裝→聯絡客戶取件or貨運物流出貨。";
        $this->MetaTag_Ary['zh']["og:description"] = $this->MetaTag_Ary['zh']["description"];
        $this->MetaTag_Ary['zh']["og:title"] = $this->MetaTag_Ary['zh']["og:title"] . " - " . $this->PageTitle ;
        
    //-- en
        $this->MetaTag_Ary['en']["description"] = "Chi Hwa service flow: Order processing (store, phone, fax and email) → Customer or CHI HWA provides design drawing → Drawing confirmation → Acrylic precision machining → Quality inspection → Packaging → Contact customer for delivery or shipment.";
        $this->MetaTag_Ary['en']["og:description"] = $this->MetaTag_Ary['en']["description"];
        $this->MetaTag_Ary['en']["og:title"] = $this->MetaTag_Ary['en']["og:title"] . " - " . $this->PageTitleEN ;
	    
	//breadcrumbs
		switch (Yii::app()->language){
			case 'en':
				$this->breadcrumbs["  >	SERVICE FLOW"] = "";
				break;
			default:
				$this->breadcrumbs["  >	服務流程"] = "";
			
		}

        $content = $this->renderPartial(
            $view = '/profession/service' . Yii::app()->params['langText'][Yii::app()->language],
            $data = array('model' => $Model),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionAcrylic(){
	//Title
		$this->PageTitle = "壓克力特性";
		$this->PageTitleEN = "Physical properties of acrylic";
    //SEO
    //-- zh
        $this->MetaTag_Ary['zh']["description"] = "奇華廣告從諮詢、設計、製作、組裝、包裝到出貨，以系統式的規劃，給予客戶最專業的服務。";
        $this->MetaTag_Ary['zh']["og:description"] = $this->MetaTag_Ary['zh']["description"];
        $this->MetaTag_Ary['zh']["og:title"] = $this->MetaTag_Ary['zh']["og:title"] . " - " . $this->PageTitle ;
        
    //-- en
        $this->MetaTag_Ary['en']["og:title"] = $this->MetaTag_Ary['en']["og:title"] . " - " . $this->PageTitleEN ;   
	    
	//breadcrumbs
		switch (Yii::app()->language){
			case 'en':
				$this->breadcrumbs["  > Acrylic Characteristics"] = "";
				break;
			default:
				$this->breadcrumbs["  >	壓克力特性"] = "";
			
		}

        $content = $this->renderPartial(
            $view = '/profession/acrylic' . Yii::app()->params['langText'][Yii::app()->language],
            $data = array('model' => $Model),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    
    public function actionEquipments(){
	//Title
		$this->PageTitle = "製程設備";
		$this->PageTitleEN = "Process and Equipment";
		
	//breadcrumbs
		switch (Yii::app()->language){
			case 'en':
				$this->breadcrumbs["  >	Process and Equipment"] = "";
				break;
			default:
				$this->breadcrumbs["  >	製程設備"] = "";
			
		}
		
    //SEO
    //-- zh
        $this->MetaTag_Ary['zh']["description"] = "奇華廣告從諮詢、設計、製作、組裝、包裝到出貨，以系統式的規劃，給予客戶最專業的服務。";
        $this->MetaTag_Ary['zh']["og:description"] = $this->MetaTag_Ary['zh']["description"];
        $this->MetaTag_Ary['zh']["og:title"] = $this->MetaTag_Ary['zh']["og:title"] . " - " . $this->PageTitle ;
        
    //-- en
        $this->MetaTag_Ary['en']["og:title"] = $this->MetaTag_Ary['en']["og:title"] . " - " . $this->PageTitleEN ;

        $content = $this->renderPartial(
            $view = '/profession/equipments' . Yii::app()->params['langText'][Yii::app()->language],
            $data = array('model' => $Model),
            $return = true
        );
		

        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }

}
?>