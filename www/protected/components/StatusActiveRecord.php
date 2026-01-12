<?php
class StatusActiveRecord extends CActiveRecord
{

	//scopes
	public function alived()
	{
	    $this->getDbCriteria()->mergeWith(array(
	        'condition' => 't.status != :status',
	        'params' => array(':status' => 'x'),
	    ));
	    return $this;
	}
	
	    
    /***
	 *  刪除
	 *  刪除後要執行的程式寫到 afterDeleteForStatus 裡
	 *
	 */
    public function deleteForStatus(){
	    $this->status = 'x';
	    
	    if ($this->saveAttributes(array('status'))){
		    $this->onAfterDeleteForStatus(new CEvent($this, array()));
		    $this->updateLastDateTime();
		    
		    return true;
	    }
	    return false;
    }
	
	//自訂 event
	public function onAfterDeleteForStatus($event)
    {
        $this->raiseEvent('onAfterDeleteForStatus', $event);
    }


	protected function beforeSave()
	{
		$now = date('Y-m-d H:i:s');
		$this->updateDateTime = $now;
				            
        if ($this->isNewRecord){
            $this->createDateTime = $now;
            $this->status = 'y';
		}
		return parent::beforeSave();				
	}

	protected function updateLastDateTime()
	{
		$this->updateDateTime = date('Y-m-d H:i:s');
		$this->saveAttributes(array('updateDateTime'));
	}
	
}
