<?php
 
/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class zTheme extends CFormModel
{
    public $showtitle;
    public $showscript;

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
            array('showtitle,showscript', 'required'),
            array('showtitle,showscript', 'safe'),
        );
    }
 
    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
	        'showtitle'=>'',
	        'showscript'=>'',
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
		    $Gallery->showtitle = $this->showtitle;
		    $Gallery->showscript = $this->showscript;
		    $Gallery->finishStep5 = 1;

			if($Gallery->save() && $Gallery->validate()){
				return true;
			}
	    }
	    return false;

    }
}