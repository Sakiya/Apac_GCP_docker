<?php
class CheckedSet extends CWidget
{
    private $_prefix;
    private $_controllerAction;
    private $_otherData;
    
    public function run()
    {   
		if(!$this->_prefix || !$this->_controllerAction){
			return false;
		}
		$this->_controllerAction = Yii::app()->createUrl($this->_controllerAction);
		if(is_array($this->_otherData)){
			$this->_otherData = json_encode($this->_otherData);
		}		
        $this->render('checkedSet', array(
        							'prefix'=>$this->_prefix, 
        							'url'=>$this->_controllerAction,
        							'other'=>$this->_otherData
        							)
        			);
    }


    public function setPrefix($prefix)
    {
        $this->_prefix = $prefix;
    }
    
    public function getPrefix()
    {
        return $this->_prefix;
    }
    
    public function setControllerAction($controllerAction)
    {
        $this->_controllerAction = $controllerAction;
    }
    
    public function getControllerAction()
    {
        return $this->_controllerAction;
    }
    
    public function setOtherData($otherData)
    {
        $this->_otherData = $otherData;
    }
    
    public function getOtherData()
    {
        return $this->_otherData;
    }

    
}
?>