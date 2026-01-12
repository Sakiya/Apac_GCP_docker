<?php
 
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class zExperience extends CFormModel
{
    public $experienceoneyear;
    public $experiencetwoyear;
    public $exhibition1name;
    public $exhibition2name;
    
    public $exhibition1date;
    public $exhibition2date;
    public $exhibition1pic1,$exhibition1pic2,$exhibition2pic1,$exhibition2pic2;
    //private 
 
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('experienceoneyear', 'required'),
            array('experienceoneyear ,experiencetwoyear','safe'),
			array('exhibition1name ,exhibition2name','safe'),
			array('exhibition1date, exhibition2date', 'length', 'max'=>20),
			array('exhibition1pic1,exhibition1pic2,exhibition2pic1,exhibition2pic2', 'file','types'=>'jpg,jpeg,png,svg','maxSize'=>1024 * 1024 * 1 ,'safe'=>false,'allowEmpty'=>true),
			
            // rememberMe needs to be a boolean
            //array('rememberMe', 'boolean'),
            // password needs to be authenticated
            //array('password', 'authenticate'),
        );
    }
 
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
	        'experienceoneyear'=>'',
	        'experiencetwoyear'=>'',
	        'exhibition1name'=>'',
	        'exhibition2name'=>'',
	        'exhibition1date'=>'',
	        'exhibition2date'=>'',
	        'exhibition1pic1'=>'',
	        'exhibition1pic2'=>'',
	        'exhibition2pic1'=>'',
	        'exhibition2pic2'=>'',
        );
    }
 
    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
    }
    
    public function upload()
    {
	    $Gallery = Gallerym1::model()->findbyPk(Yii::app()->user->getState('accID'));
		$filepath_img = "." . Yii::app()->params['folder']['def'] . $Gallery->Yearm1_no . Yii::app()->params['sub_folder']['experience'];
		
	    if ($Gallery){
		    $Gallery->experienceoneyear = $this->experienceoneyear;
		    $Gallery->experiencetwoyear = $this->experiencetwoyear;
		    $Gallery->exhibition1name = $this->exhibition1name;
		    $Gallery->exhibition2name = $this->exhibition2name;
		    $Gallery->exhibition1date = $this->exhibition1date;
		    $Gallery->exhibition2date = $this->exhibition2date;
		    $Gallery->finishStep3 = 1;
			if (CUploadedFile::getInstance($this,'exhibition1pic1')){
				$this->exhibition1pic1=CUploadedFile::getInstance($this,'exhibition1pic1');
				$newimg = Yii::app()->myClass->renameFile($this->exhibition1pic1);
				$this->exhibition1pic1->saveAs($filepath_img . $newimg);
				$Gallery->exhibition1pic1 = $newimg;
			} 
			if (CUploadedFile::getInstance($this,'exhibition1pic2')){
				$this->exhibition1pic2=CUploadedFile::getInstance($this,'exhibition1pic2');
				$newimg = Yii::app()->myClass->renameFile($this->exhibition1pic2);
				$this->exhibition1pic2->saveAs($filepath_img . $newimg);
				$Gallery->exhibition1pic2 = $newimg;
			}
			
			if (CUploadedFile::getInstance($this,'exhibition2pic1')){
				$this->exhibition2pic1=CUploadedFile::getInstance($this,'exhibition2pic1');
				$newimg = Yii::app()->myClass->renameFile($this->exhibition2pic1);
				$this->exhibition2pic1->saveAs($filepath_img . $newimg);
				$Gallery->exhibition2pic1 = $newimg;
			} 
			if (CUploadedFile::getInstance($this,'exhibition2pic2')){
				$this->exhibition2pic2=CUploadedFile::getInstance($this,'exhibition2pic2');
				$newimg = Yii::app()->myClass->renameFile($this->exhibition2pic2);
				$this->exhibition2pic2->saveAs($filepath_img . $newimg);
				$Gallery->exhibition2pic2 = $newimg;
			}

			if($Gallery->save() && $Gallery->validate()){
				return true;
			}
	    }
	    $this->addError('password','error');
	    return false;
    }
}