<?php
class SmodeBehavior extends CActiveRecordBehavior
{
	public $modeAttribute = 'status';
/*
public function afterConstruct(){
	
	$this->attachEventHandler('onAfterDeleteForStatus');
}
*/	
	/**
	 * 宣告 events
	 */
/*
	public function events()
    {
        return array_merge(parent::events(), array(
           'onAfterDeleteForStatus' => 'afterDeleteForStatus'
        )); 
    }

*/
	//scopes
	public function alived()
	{	    
	    $this->getOwner()->getDbCriteria()->mergeWith(array(
	        'condition' => "{$this->modeAttribute} != :status",
	        'params' => array(':status' => 'x'),
	    ));
	    return $this->getOwner();
	}

	
	public function beforeSave()
	{
        $owner = $this->getOwner();

		$now = date('Y-m-d H:i:s');
		$owner->updateDateTime = $now;
				            
        if ($owner->getIsNewRecord()){
            $owner->createDateTime = $now;
            $owner->{$this->modeAttribute} = 'y';
		}
						
	}
    
    /***
	 *  刪除
	 *  刪除後要執行的程式寫到 afterDeleteForStatus 裡
	 *
	 */
    public function deleteForStatus(){
	    
	    $owner = $this->getOwner();
	    $owner->{$this->modeAttribute} = 'x';
	    
	    if ($this->getOwner()->saveAttributes(array($this->modeAttribute))){
		    $this->onAfterDeleteForStatus(new CEvent($owner, array()));
			$this->afterDeleteForStatus();
		    
		    return true;
	    }
	    return false;
    }
	
	//自訂 event
	public function onAfterDeleteForStatus($event)
    {
        $this->raiseEvent('onAfterDeleteForStatus', $event);
    }

	
	protected function afterDeleteForStatus()
	{
		$owner = $this->getOwner();
		$owner->updateDateTime = date('Y-m-d H:i:s');
		$owner->saveAttributes(array('updateDateTime'));
	}

}
?>