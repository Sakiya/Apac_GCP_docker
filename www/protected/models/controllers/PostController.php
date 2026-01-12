<?php
class PostController extends Controller{

    public function init(){
        parent::init();
        $this->layout = '';
    }
    public function actionCredit($type2){
        $Data = Array(
            "OrderNO" => isset($_POST['OrderNO']) ? $_POST['OrderNO'] : "",
            "ShopNO" => isset($_POST['ShopNO']) ? $_POST['ShopNO'] : "",
            "KeyNum" => isset($_POST['KeyNum']) ? $_POST['KeyNum'] : "",
            "TSNO" => isset($_POST['TSNO']) ? $_POST['TSNO'] : "",
            "PayType" => isset($_POST['PayType']) ? $_POST['PayType'] : "",
            "Amount" => isset($_POST['Amount']) ? $_POST['Amount'] : "",
            "Status" => isset($_POST['Status']) ? $_POST['Status'] : "",
            "Description" => isset($_POST['Description']) ? $_POST['Description'] : "",
            "Digest" => isset($_POST['Digest']) ? $_POST['Digest'] : "",
            "VerifyCode" => isset($_POST['VerifyCode']) ? $_POST['VerifyCode'] : "",
        );
        switch ($type2){
            case 'success':
                break;
            case 'fail':
                break;
        }
    }
    public function actionCreditPayment(){
    //信用卡支付 
        $targetUrl = "https://sandbox.sinopac.com/WebAPI/Service.svc/CreateATMorIBonTrans";
        $Data = Array(
            "PrdtName" => "畫廊訂金",
            "ShopNO" => "AB0440",
            "CurrencyID" => "NTD",
            "ExpireDate" => date('Ymd',strtotime(date('Ymd') . "+30 days")),
            //"AutoBilling" => "Y",
            "PayType" => "A",
            "KeyNum" => isset($_POST['KeyNum']) ? $_POST['KeyNum'] : "",
            "OrderNO" => isset($_POST['OrderNO']) ? $_POST['OrderNO'] : "",
            "Amount" => isset($_POST['Amount']) ? $_POST['Amount'] . '00' : "",
        );

        foreach($Data as $k=>$v) {
        //檢查資料是否完整
            if ($Data[$k] == ''){
                $this->redirect(Yii::app()->createUrl('/post/credit/',array('language'=>Yii::app()->language,'type2'=>'error')));
            }
        }

        $Digest=hash("sha256", "POST:".$Data['OrderNO'].":".$Data['ShopNO'].":".$Data['Amount'].":".$keyData[$Data['KeyNum']]);

        $content = $this->renderPartial(
            $view = '/post/index',
            $data = array('Digest' => $Digest, 'Data' => $Data, 'targetUrl' => $targetUrl),
            $return = true
        );
        $this->render('/layouts/column1', array(
            'content' => $content,
        ));
    }
    public function actionATMPayment_en(){
        $no = isset($_POST['no']) ? $_POST['no']: "";
        $Recordt1 = new Recordt1();

        //$Recordt1->orderid = $xmlParse->OrderNO;
        $Recordt1->Gallerym1_no = $no;
        $Recordt1->bankaccount = "009-008-0009355-1";
        $Recordt1->price = "750";
        $Recordt1->createdate = date('Ymd');
        //$Recordt1->enddate = $Data['ExpireDate'];

        if ($Recordt1->save()){
            Yii::import('application.controllers.ZEmailController');
            $controller = new ZEmailController("");
            $controller->AdminPayAccount($Recordt1->Gallerym1_no);
            echo CJSON::encode(array('status'=>'success','message'=>''));
            Yii::app()->end(); 
        }  
        echo CJSON::encode(array('status'=>'error','message'=>''));
        Yii::app()->end();
    }
    public function actionATMPayment(){
        //信用卡支付
            $targetUrl = "https://sandbox.sinopac.com/WebAPI/Service.svc/CreateATMorIBonTrans";
            $Data = Array(
                "PrdtName" => "畫廊訂金",
                "ShopNO" => "AB0440",
                "CurrencyID" => "NTD",
                "ExpireDate" => date('Ymd',strtotime(date('Ymd') . "+0 days")),
                //"AutoBilling" => "Y",
                "PayType" => "A",
                "KeyNum" => rand(1, 3),
                "OrderNO" => isset($_POST['OrderNO']) ? $_POST['OrderNO'] : "", 
                "Amount" => isset($_POST['Amount']) ? $_POST['Amount'] : "",
                "no" => isset($_POST['no']) ? $_POST['no']: "",
            );
    
            foreach($Data as $k=>$v) {
            //檢查資料是否完整
                if ($Data[$k] == ''){
                    //$this->redirect(Yii::app()->createUrl('/post/credit/',array('language'=>Yii::app()->language,'type2'=>'error')));
                    echo CJSON::encode(array('status'=>'error','message'=>'資料不完全，請洽客服人員'));
                    Yii::app()->end();
                }
            }

            $xmlContext = '<ATMOrIBonClientRequest xmlns="http://schemas.datacontract.org/2004/07/SinoPacWebAPI.Contract">
            <ShopNO>'.$Data['ShopNO'].'</ShopNO>
            <KeyNum>'.$Data['KeyNum'].'</KeyNum>
            <OrderNO>'.$Data['OrderNO'].'</OrderNO>
            <Amount>'.$Data['Amount'] . '00' .'</Amount>
            <CurrencyID>'.$Data['CurrencyID'].'</CurrencyID>
            <ExpireDate>'.$Data['ExpireDate'].'</ExpireDate>
            <PayType>'.$Data['PayType'].'</PayType>
            <PrdtName>'.$Data['PrdtName'].'</PrdtName>
            <Memo></Memo>
            <PayerName></PayerName> <PayerMobile></PayerMobile> <PayerAddress></PayerAddress> <PayerEmail></PayerEmail> 
            <ReceiverName></ReceiverName> <ReceiverMobile></ReceiverMobile> <ReceiverAddress></ReceiverAddress> 
            <ReceiverEmail></ReceiverEmail> <Param1></Param1>
            <Param2></Param2> <Param3></Param3></ATMOrIBonClientRequest>';
            //$output = Yii::app()->curl->get($targetUrl, $xml_data);
         
            $xmlreturn = $this->sendXmlOverPost($targetUrl, $xmlContext, $Data);
            $xmlParse = simplexml_load_string($xmlreturn);

            if($xmlParse->Status == "S"){
            //成功取得帳號
                $Recordt1 = new Recordt1();

                $Recordt1->orderid = $xmlParse->OrderNO;
                $Recordt1->Gallerym1_no = $Data['no'];
                $Recordt1->bankaccount = $xmlParse->PayNO;
                $Recordt1->price = $Data['Amount'];
                $Recordt1->createdate = date('Ymd');
                $Recordt1->enddate = $Data['ExpireDate'];

                if ($Recordt1->save()){
                    Yii::import('application.controllers.ZEmailController');
                    $controller = new ZEmailController("");
                    $controller->AdminPayAccount($Recordt1->Gallerym1_no);
                }
                echo CJSON::encode(array('status'=>'success','message'=>''));
                Yii::app()->end();
            }else{
                echo CJSON::encode(array('status'=>'error','message'=>$xmlParse->Description.'錯誤'));
                Yii::app()->end();
            }
            echo CJSON::encode(array('status'=>'error','message'=>'發生錯誤'));
            Yii::app()->end();
            //$this->redirect(Yii::app()->createUrl('/fill/apply1_payment/',array('language'=>Yii::app()->language)));
        }
        function sendXmlOverPost($targetUrl, $xmlContext, $Data) {    
                $keyData = Array(
                    '1'=>'75a551b4-c26e-406a-9bb3-33b5810c7579',
                    '2'=>'a87f8127-8f76-4497-a327-e95747f21ea8',
                    '3'=>'938be505-d0f0-48ab-a91f-1106330d9bb9'
                );
                //第一次取得網易收截記資料 
                $ch=curl_init($targetUrl);
                $options=Array(
                        CURLOPT_HEADER=> 1,
                        CURLOPT_NOBODY => 1,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSLVERSION => 6
                );
                curl_setopt_array($ch, $options);
                $result=curl_exec($ch);
                $curlinfo=curl_getinfo ($ch);
                curl_close($ch);

                $DigestHeader = "";
                if($curlinfo['http_code']=="401"){ //初次伺服器傳回狀態代碼401(尚未授權)以及各項戳記 $tmpArr=explode("\n", $result);
                    $tmpArr=explode("\n", $result);
                    $resultArr=Array();
                    foreach($tmpArr as $value){
                        $value=trim($value);
                        if ($value!="" && strpos($value, ':')){//多加一個if條件，判斷字串中是否有:號
                            list($k, $v)=explode(":", $value);
                                if($k=="WWW-Authenticate"){
                                    $tmpArr2=explode(",", substr($v, 7));
                                    foreach($tmpArr2 as $value2){
                                        $value2=trim($value2);
                                        if ($value2!="" && strpos($value2, '=')){//多加一個if條件，判斷字串中是否
                                            list($k2, $v2)=explode("=", $value2);
                                            $resultArr[$k][$k2]=str_replace("\"", "", $v2);
                                        }
                                    } 
                                }else{
                                    $resultArr[$k]=$v;
                                }
                        }
                    }
                    $authString=$resultArr['WWW-Authenticate'];
                    $DigestHeader=$this->GenAuthDigest($targetUrl, "POST", $authString, $Data['ShopNO'], $keyData[$Data['KeyNum']],$xmlContext);
                }
                //用戶端根據伺服器傳回的戳記建立一次性的簽章，並重新進行要求。 
                $header=Array("Authorization: ".$DigestHeader, "Content-type: text/xml"); 
                $ch=curl_init($targetUrl);
                $options=Array(
                    CURLOPT_HEADER => 0,
                    CURLOPT_HTTPHEADER=> $header,
                    CURLOPT_NOBODY => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_POST=> 1,
                    CURLOPT_POSTFIELDS=> $xmlContext ,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSLVERSION => 6
                );
                curl_setopt_array($ch, $options);
                $result=curl_exec($ch);
                curl_close($ch); 
                //只印出xml，，以\n----------\n分割 
                //echo $xmlContext."\n----------\n"; 
                return $result;
            }

            function GenAuthDigest($targetUrl, $method, $authString, $ShopNO, $keyData, $message){
                $nonce=$authString['nonce'];
                $realm = $authString['realm'];
                $qop = $authString['qop'];
                $cnonce = rand(123400,9999999);
                $Resp = $this->GenResp($targetUrl, $ShopNO, $realm, $keyData, $nonce, $cnonce, $qop, $method,
      $message);
                $GenAuthDigest="Digest realm=\"".$realm."\", nonce=\"".$nonce."\", uri=\"".$targetUrl."\",
                verifycode=\"$Resp\", qop=\"$qop\", cnonce=\"$cnonce\"";
                return "Digest realm=\"".$realm."\", nonce=\"".$nonce."\", uri=\"".$targetUrl."\",
                verifycode=\"".$Resp."\", qop=\"".$qop."\", cnonce=\"".$cnonce."\""; 
            }
            function GenResp($url, $user, $realm, $keydata, $nonce, $cnonce, $qop, $method, $message){ 
                $ha1 = $this->doHa1($url, $user, $realm, $keydata);
                $ha2 = $this->doHa2($method, $url);
                return hash("sha256", $ha1.":".$nonce.":".$cnonce.":".$qop.":".str_replace(" ","",str_replace("\r", "",str_replace("\n", "",$message))).":".$ha2); 
            }
            function doHa1($url, $user, $realm, $keydata){
                return hash("sha256", $user.":".$realm.":".$keydata);
            }
            function doHa2($method, $url){
                return hash("sha256", $method.":".$url);
            }
}
?>