<?php
 
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class zPay extends CFormModel
{
    public $pay_method;
    public $paybank_account;
    public $paybank_name;
    public $paybank_bank;
    public $returnbank_account;
    public $returnbank_name;
    public $returnbank_bank;
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
            //array('paybank_account,paybank_name,paybank_bank', 'required'),
            array('pay_method', 'required'),
            array('returnbank_account,returnbank_name,returnbank_bank', 'safe'),
            array('paybank_account,paybank_name,paybank_bank', 'length', 'max'=>50),
            array('returnbank_account,returnbank_name,returnbank_bank', 'length', 'max'=>50),
            array('pay_method', 'length', 'max'=>2),
            
        );
    }
 
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'paybank_account'=>'匯款帳號',
            'paybank_name'=>'匯款戶名',
            'paybank_bank'=>'匯款銀行',
            'returnbank_account'=>'退款帳號',
            'returnbank_name'=>'退款戶名',
            'returnbank_bank'=>'退款銀行',
            'pay_method'=>'付款方式'
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
		
	    if ($Gallery){
		    $Gallery->paybank_account = $this->paybank_account;
		    $Gallery->paybank_name = $this->paybank_name;
		    $Gallery->paybank_bank = $this->paybank_bank;
            $Gallery->returnbank_account = $this->returnbank_account;
		    $Gallery->returnbank_name = $this->returnbank_name;
            $Gallery->returnbank_bank = $this->returnbank_bank;
            $Gallery->pay_method = $this->pay_method;
            
		    $Gallery->finishStep8 = 1;

			if($Gallery->save() && $Gallery->validate()){
				return true;
			}
	    }
	    return false;

    }
}