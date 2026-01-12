<?php

/**
 * This is the model class for table "Gallery_M1".
 *
 * The followings are the available columns in table 'Gallery_M1':
 * @property integer $no
 * @property integer $Yearm1_no
 * @property string $lang
 * @property string $email
 * @property string $pwd
 * @property string $createDateTime
 * @property string $lastloginDate
 * @property string $loginDate
 * @property string $name
 * @property string $name_en
 * @property string $galleryyear
 * @property string $gallerymonth
 * @property string $bossname
 * @property string $bossname_en
 * @property string $tel
 * @property string $fax
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $contactname
 * @property string $contactphone
 * @property string $contactemail
 * @property string $emailcheck
 * @property string $experienceoneyear
 * @property string $experiencetwoyear
 */
class Gallerym1 extends CActiveRecord{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Gallery_M1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		switch (Yii::app()->language){
			case 'en':
				return array(
					array('Yearm1_no, lang, email, pwd, checkRead', 'required'),
					array('city, tel, galleryyear', 'safe'),
					//array('contactname, contactphone, contactemail ', 'required'),
					array('contactname, contactphone, contactemail ', 'safe'),
					array('address, name, name_en, bossname, Gallerym1_email','safe'),
					//array('Yearm1_no, lang, email, pwd, city, address, tel, name_en, bossname_en, galleryyear', 'required'),
					//array('experienceoneyear,experiencetwoyear', 'required'),
					array('Yearm1_no, sort, pay_total', 'numerical', 'integerOnly'=>true),
					array('lang', 'length', 'max'=>3),
					array('galleryyear', 'length', 'max'=>4),
					array('gallerymonth', 'length', 'max'=>5),
					array('tel, fax, contactphone, paydate', 'length', 'max'=>30),
					array('country, city', 'length', 'max'=>20),
					array('emailcheck', 'length', 'max'=>1),
					array('websiteurl,bossname, bossname_en, name, country','safe'),
					array('id', 'length', 'max'=>50),
					array('experienceoneyear,experiencetwoyear','safe'),
					array('exhibition1name,exhibition2name','safe'),
					array('exhibition1date, exhibition2date', 'length', 'max'=>20),
					array('exhibition1pic1,exhibition1pic2,exhibition2pic1,exhibition2pic2', 'length', 'max'=>30),
					array('program','safe'),
					array('paybank_account,paybank_name,paybank_bank', 'length', 'max'=>50),
					array('returnbank_account,returnbank_name,returnbank_bank', 'length', 'max'=>50),
					array('status,pay_status, pay_status2,shortlisted,pay_return,finishroom', 'length', 'max'=>5),
					array('paydate, paydate2', 'length', 'max'=>10),
					array('remark,authorizecode','safe'),
					array('email_shortlisted', 'length', 'max'=>2),
					array('actingartist,exhibitionartist, address_en','safe'),
					array('companyname', 'length', 'max'=>100),
					array('companyid', 'length', 'max'=>20),
					array('Facebook,Twitter,Instagram,weibo,Youtube','safe'),
					array('paybank_account2,paybank_name2,paybank_bank2', 'length', 'max'=>50),
					array('returnbank_account2,returnbank_name2,returnbank_bank2', 'length', 'max'=>50),
					array('lineid, wechat, whatapp, country','safe'),
					array('pay_method', 'length', 'max'=>2),
					array('pwd', 'length', 'min'=>4),
					// The following rule is used by search().
					// @todo Please remove those attributes that should not be searched.
					array('Gallerym1_no, Yearm1_no, lang, email, pwd, createDateTime, lastloginDate, loginDate, name, name_en, galleryyear, gallerymonth, bossname, bossname_en, tel, fax, country, city, address, contactname, contactphone, contactemail, emailcheck, experienceoneyear, experiencetwoyear', 'safe', 'on'=>'search')
				);
				break;
			default:
				return array(
					array('Yearm1_no, lang, email, pwd, checkRead', 'required'),
					array('city, tel, galleryyear', 'safe'),
					//array('contactname, contactphone, contactemail ', 'required'),
					array('contactname, contactphone, contactemail ', 'safe'),
					array('address, name, name_en, bossname, Gallerym1_email','safe'),
					//array('Yearm1_no, lang, email, pwd, city, address, tel, name, name_en, bossname, galleryyear', 'required'),
					//array('experienceoneyear,experiencetwoyear', 'required'),
					array('Yearm1_no, pay_total', 'numerical', 'integerOnly'=>true),
					array('lang', 'length', 'max'=>3),
					array('galleryyear', 'length', 'max'=>4),
					array('gallerymonth', 'length', 'max'=>5),
					array('tel, fax, contactphone, paydate', 'length', 'max'=>30),
					array('country, city', 'length', 'max'=>20),
					array('emailcheck', 'length', 'max'=>1),
					array('websiteurl,bossname,bossname_en,name_en','safe'),
					array('id', 'length', 'max'=>50),
					array('experienceoneyear,experiencetwoyear','safe'),
					array('exhibition1name,exhibition2name','safe'),
					array('exhibition1date, exhibition2date', 'length', 'max'=>20),
					array('exhibition1pic1,exhibition1pic2,exhibition2pic1,exhibition2pic2', 'length', 'max'=>30),
					array('program','safe'),
					array('paybank_account,paybank_name,paybank_bank', 'length', 'max'=>50),
					array('returnbank_account,returnbank_name,returnbank_bank', 'length', 'max'=>50),							
					array('status,pay_status,pay_status2,shortlisted,pay_return,finishroom', 'length', 'max'=>5),
					array('paydate, paydate2', 'length', 'max'=>10),
					array('remark,authorizecode','safe'),
					array('email_shortlisted', 'length', 'max'=>2),
					array('actingartist,exhibitionartist, address_en','safe'),
					array('companyname', 'length', 'max'=>100),
					array('companyid', 'length', 'max'=>20),
					array('Facebook,Twitter,Instagram,weibo,Youtube','safe'),
					array('spissue_pic', 'length', 'max'=>50),
					array('spissue_link,spissue_text','safe'),	
					array('paybank_account2,paybank_name2,paybank_bank2', 'length', 'max'=>50),
					array('returnbank_account2,returnbank_name2,returnbank_bank2', 'length', 'max'=>50),
					array('lineid, wechat, whatapp, country','safe'),
					array('pay_method', 'length', 'max'=>2),
					array('pwd', 'length', 'min'=>4),
					// The following rule is used by search().
					// @todo Please remove those attributes that should not be searched.
					array('Gallerym1_no, Yearm1_no, lang, email, pwd, createDateTime, lastloginDate, loginDate, name, name_en, galleryyear, gallerymonth, bossname, bossname_en, tel, fax, country, city, address, contactname, contactphone, contactemail, emailcheck, experienceoneyear, experiencetwoyear', 'safe', 'on'=>'search')
				);
				break;
		}
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
        	'Galleryt1' => array(self::HAS_MANY, 'Galleryt1', 'Gallerym1_no','order'=>'Galleryt1_no ','on' => ''),
			'Yearm1' => array(self::BELONGS_TO, 'Yearm1', 'Yearm1_no'),
			'Recordt1' => array(self::HAS_ONE, 'Recordt1', 'Gallerym1_no','order'=>'Recordt1_no desc'),
			'Recordt1Count' => array(self::HAS_MANY, 'Recordt1', 'Gallerym1_no'),
			'Award' => array(self::HAS_ONE, 'Award', 'Gallerym1_no'),
			'WorkUsd' => array(self::HAS_MANY, 'Work', 'Gallerym1_no', 'condition'=>"type = '1'"),
			'WorkMarket' => array(self::HAS_MANY, 'Work', 'Gallerym1_no', 'condition'=>"type = '2'"),
			'Vipcard' => array(self::HAS_MANY, 'Vipcard', 'Gallerym1_no','order'=>'type '),
			'Roomm1' => array(self::BELONGS_TO, 'Roomm1', 'finishroom'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		switch (Yii::app()->language){
			case 'en':
				return array(
					'Gallerym1_no' => '序號',
					'Yearm1_no' => '年度序號',
					'id' => '報名序號',
					'authorizecode'=>'驗證代號',
					'lang' => '語言版本',
					'email' => 'Email',
					'Gallerym1_email' => '畫廊Email',
					'pwd' => 'Password',
					'createDateTime' => '建立日期',
					'lastloginDate' => '最後登入日期',
					'loginDate' => '登入日期',
					'name' => 'Gallery Name',
					'name_en' => 'Gallery English Name',
					'galleryyear' => 'Year',
					'gallerymonth' => 'Month',
					'bossname' => 'Name',
					'bossname_en' => 'English Name',
					'tel' => 'Phone(Note: country code and area code)',
					'fax' => 'Fax(Note: country code and area code)',
					'country' => 'Country',
					'country_en' => 'Country',
					'city' => 'City',
					'city_en' => 'City',
					'address' => 'Address',
					'address_en' => 'Address',
					'websiteurl' => 'Website',
					'lineid' => 'Line',
					'wechat' => 'WeChat',
					'whatapp' => 'Whatsapp',
					'Facebook' => 'Facebook',
					'Twitter' => 'Twitter',
					'Instagram' => 'Instagram',
					'weibo' => 'weibo',
					'Youtube' => 'Youtube',
					'contactname' => 'Contact Name',
					'contactphone' => 'Mobile(Note: country code and area code)',
					'contactemail' => 'Email',
					'emailcheck' => '是否驗證信箱',
					'experienceoneyear' => '參展前一年經歷',
					'experiencetwoyear' => '參展前兩年經歷',
					'exhibition1name' => '展覽紀錄名稱1',
					'exhibition1date' => '展覽紀錄展出日期1',
					'exhibition1pic1' => '展覽紀錄圖片1-1',
					'exhibition1pic2' => '展覽紀錄圖片1-2',
					'exhibition2name' => '展覽紀錄名稱2',
					'exhibition2date' => '展覽紀錄展出日期2',
					'exhibition2pic1' => '展覽紀錄圖片2-1',
					'exhibition2pic2' => '展覽紀錄圖片2-2',
					'finishStep8'=> '是否完成',
					'finishStep1'=> '是否完成',
					'finishStep2'=> '是否完成',
					'finishStep3'=> '是否完成',
					'finishStep4'=> '是否完成',
					'finishStep5'=> '是否完成',
					'finishStep6'=> '是否完成',
					'finishStep7'=> '是否完成',
					'finishStep2_1'=> '是否完成',
					'finishStep2_2'=> '是否完成',
					'finishStep2_3'=> '是否完成',
					'finishStep2_4'=> '是否完成',
					'finishStep2_5'=> '是否完成',
					'finishStep2_6'=> '是否完成',
					'finishStep2_7'=> '是否完成',
					'finishStep2_8'=> '是否完成',
					'finishStep2_9'=> '是否完成',
					'finishStep2_10'=> '是否完成',
					'showtitle' => '參展主題',
					'showscript' => '參展描述',
					'shortlisted' => '是否入圍',
					'status'=>'狀態',
					'pay_status'=>'繳款狀況',
					'paydate'=>'付款日期',
					'payYN'=>'是否付款',
					'pay_return'=>'是否退款',
					'remark'=>'備註',
					'finishroom'=>'確定房型',
					'email_shortlisted'=>'入圍Email通知',
					//'summary'=>'',
					'sort'=>'排序',
					'paybank_account'=>'匯款帳號',
					'paybank_name'=>'匯款戶名',
					'paybank_bank'=>'匯款銀行',
					'returnbank_account'=>'退款帳號',
					'returnbank_name'=>'退款戶名',
					'returnbank_bank'=>'退款銀行',
					'companyname'=>'公司名稱',
					'companyid'=>'統一編號',
					'actingartist'=>'代理藝術家',
					'exhibitionartist'=>'展出藝術家',
					'spissue_pic'=>'專刊圖片',
					'spissue_link'=>'代理藝術家',
					'spissue_text'=>'展出藝術家',
					'paybank_account2'=>'匯款帳號',
					'paybank_name2'=>'匯款戶名',
					'paybank_bank2'=>'匯款銀行',
					'returnbank_account2'=>'退款帳號',
					'returnbank_name2'=>'退款戶名',
					'returnbank_bank2'=>'退款銀行',
					'pay_total'=>'餘款',
					'pay_status2' => '付款狀態',
					'paydate2' => '付款日期',
					'pay_method' => '付款方式'
				);
			default:
				return array(
					'Gallerym1_no' => '序號',
					'Yearm1_no' => '年度序號',
					'id' => '報名序號',
					'authorizecode'=>'驗證代號',
					'lang' => '語言版本',
					'email' => '登入Email',
					'Gallerym1_email' => '畫廊Email',
					'pwd' => '登入密碼',
					'createDateTime' => '建立日期',
					'lastloginDate' => '最後登入日期',
					'loginDate' => '登入日期',
					'name' => '畫廊中文名稱',
					'name_en' => '畫廊英文名稱',
					'galleryyear' => '成立年份',
					'gallerymonth' => '成立月份',
					'bossname' => '負責人姓名(中)',
					'bossname_en' => '負責人姓名(英)',
					'tel' => '電話號碼(例:+886-2-2325-9390)',
					'fax' => '傳真(例:+886-2-2325-9390)',
					'country' => '國家',
					'country_en' => '國家',
					'city' => '城市',
					'city_en' => '城市(英)',
					'address' => '畫廊地址',
					'address_en' => '畫廊地址',
					'websiteurl' => '畫廊網址',
					'lineid' => 'Line',
					'wechat' => 'WeChat',
					'whatapp' => 'Whatsapp',
					'Facebook' => 'Facebook',
					'Twitter' => 'Twitter',
					'Instagram' => 'Instagram',
					'weibo' => 'weibo',
					'Youtube' => 'Youtube',
					'contactname' => '展務人姓名',
					'contactphone' => '展務人行動電話(例:+886-900-000-000)',
					'contactemail' => '展務人Email',
					'emailcheck' => '是否驗證信箱',
					'experienceoneyear' => '參展前一年經歷',
					'experiencetwoyear' => '參展前兩年經歷',
					'exhibition1name' => '展覽紀錄名稱1',
					'exhibition1date' => '展覽紀錄展出日期1',
					'exhibition1pic1' => '展覽紀錄圖片1-1',
					'exhibition1pic2' => '展覽紀錄圖片1-2',
					'exhibition2name' => '展覽紀錄名稱2',
					'exhibition2date' => '展覽紀錄展出日期2',
					'exhibition2pic1' => '展覽紀錄圖片2-1',
					'exhibition2pic2' => '展覽紀錄圖片2-2',
					'finishStep8'=> '是否完成',
					'finishStep1'=> '是否完成',
					'finishStep2'=> '是否完成',
					'finishStep3'=> '是否完成',
					'finishStep4'=> '是否完成',
					'finishStep5'=> '是否完成',
					'finishStep6'=> '是否完成',
					'finishStep7'=> '是否完成',
					'finishStep2_1'=> '是否完成',
					'finishStep2_2'=> '是否完成',
					'finishStep2_3'=> '是否完成',
					'finishStep2_4'=> '是否完成',
					'finishStep2_5'=> '是否完成',
					'finishStep2_6'=> '是否完成',
					'finishStep2_7'=> '是否完成',
					'finishStep2_8'=> '是否完成',
					'finishStep2_9'=> '是否完成',
					'finishStep2_10'=> '是否完成',
					'showtitle' => '參展主題',
					'showscript' => '參展描述',
					'shortlisted' => '是否入圍',
					'status'=>'狀態',
					'pay_status'=>'繳款狀況',
					'paydate'=>'付款日期',
					'payYN'=>'是否付款',
					'pay_return'=>'是否退款',
					'remark'=>'備註',
					'finishroom'=>'確定房型',
					'email_shortlisted'=>'入圍Email通知',
					'sort'=>'排序',
					//'summary'=>'',
					'paybank_account'=>'匯款帳號',
					'paybank_name'=>'匯款戶名',
					'paybank_bank'=>'匯款銀行',
					'returnbank_account'=>'退款帳號',
					'returnbank_name'=>'退款戶名',
					'returnbank_bank'=>'退款銀行',
					'companyname'=>'公司名稱',
					'companyid'=>'統一編號',
					'actingartist'=>'代理藝術家',
					'exhibitionartist'=>'展出藝術家',
					'spissue_pic'=>'專刊圖片',
					'spissue_link'=>'作品原始檔連結',
					'spissue_text'=>'畫冊露出作品文字資料',
					'paybank_account2'=>'匯款帳號',
					'paybank_name2'=>'匯款戶名',
					'paybank_bank2'=>'匯款銀行',
					'returnbank_account2'=>'退款帳號',
					'returnbank_name2'=>'退款戶名',
					'returnbank_bank2'=>'退款銀行',
					'pay_total'=>'餘款',
					'pay_status2' => '付款狀態',
					'paydate2' => '付款日期',
					'pay_method' => '付款方式'
				);
		}
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->compare('Gallerym1_no',$this->Gallerym1_no);
		$criteria->compare('Yearm1_no',$this->Yearm1_no);
		$criteria->compare('id',$this->id);
		$criteria->compare('authorizecode',$this->authorizecode);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('Gallerym1_email',$this->Gallerym1_email,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('lastloginDate',$this->lastloginDate,true);
		$criteria->compare('loginDate',$this->loginDate,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('galleryyear',$this->galleryyear,true);
		$criteria->compare('gallerymonth',$this->gallerymonth,true);
		$criteria->compare('bossname',$this->bossname,true);
		$criteria->compare('bossname_en',$this->bossname_en,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('contactname',$this->contactname,true);
		$criteria->compare('contactphone',$this->contactphone,true);
		$criteria->compare('contactemail',$this->contactemail,true);
		$criteria->compare('emailcheck',$this->emailcheck,true);
		$criteria->compare('experienceoneyear',$this->experienceoneyear,true);
		$criteria->compare('experiencetwoyear',$this->experiencetwoyear,true);
		$criteria->compare('coutryCount',$this->coutryCount,false);
		$criteria->compare('pay_method',$this->pay_method,false);
		$criteria->compare('sort',$this->sort,false);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gallerym1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getNextOrPrevId($currentId, $nextOrPrev, $country)
	{
	    $records=NULL;
	    if($nextOrPrev == "prev")
	       $order="Gallerym1_no DESC";
	    if($nextOrPrev == "next")
	       $order="Gallerym1_no ASC";
	
	    $records=Gallerym1::model()->findAll(
			array('select'=>'Gallerym1_no', 'order'=>$order, 'condition' => " country = '$country' and Yearm1_no = '".Yii::app()->user->getState('bgYear')."' and status = 3 ")
		);
		
	    foreach($records as $i=>$r)
	       if($r->Gallerym1_no == $currentId)
	          return isset($records[$i+1]->Gallerym1_no) ? $records[$i+1]->Gallerym1_no : NULL;
	
	    return NULL;
	}
	public static function getRowrun($currentId, $country)
	{
	    $records=NULL;
		$order="Gallerym1_no ASC";
	    $records=Gallerym1::model()->findAll(
			array('select'=>'Gallerym1_no', 'order'=>$order, 'condition' => " country = '$country' and Yearm1_no = '".Yii::app()->user->getState('bgYear')."' and status = 3 ")
		);
		
	    foreach($records as $i=>$r)
	       if($r->Gallerym1_no == $currentId)
	          return $i + 1;
	
	    return NULL;
	}
    protected function beforeSave(){
		//客戶編號
        if ($this->isNewRecord){
			$this->sort = count($this->Yearm1->Gallerym1) + 1;
			$this->lastloginDate = date('Y-m-d H:i:s');
			$this->loginDate = date('Y-m-d H:i:s');
			$this->id = "";
			$this->Gallerym1_email = $this->email;
			$this->shortlisted = "3";
		}
		//更新資料
		return parent::beforeSave();
	}
    protected function afterSave(){
		//客戶編號
        if ($this->isNewRecord){
		}else{
			if ($this->id == '' & ($this->pay_status == '2' || $this->pay_status == '3')){
				$id = 'OAT' . substr($this->Yearm1->Yearm1_year,2,2) . str_pad($this->Yearm1->Yearm1_usernumber,3,'0',STR_PAD_LEFT);
				$this->id = $id;
				$this->pay_status = '2';
				$this->finishStep7 = '1';
				$this->lineid = '';

				if ($this->save()){
					$Year = Yearm1::model()->findbyPk($this->Yearm1->Yearm1_no);
					if ($Year){
						$Year->Yearm1_usernumber = $Year->Yearm1_usernumber + 1;
						$Year->save();
					}
				}
			}

			if ($this->pay_status2 == ''){
				$this->pay_status2 = 2;
			}

		}
		//更新資料
		return parent::afterSave();
	}
}
