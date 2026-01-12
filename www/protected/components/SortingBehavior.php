<?php
class SortingBehavior extends CActiveRecordBehavior
{
	public $sortAttribute = 'sortID';
	public $prefillSort = true; //欄位填預設值
	public $statusMode = true;  //不真的刪除，用status標記的資料
	//
	private $sort_org;

	/**
	 * 宣告 events
	 */
	public function events()
    {
        return array_merge(parent::events(), array(
           'onAfterDeleteForStatus' => 'afterDeleteForStatus'
        )); 
    }
		
	/** 
	 * events callback
	 */
	// CActiveRecordBehavior default 
	public function afterConstruct()
	{
		if ($this->getOwner()->getIsNewRecord()){
			$this->sort_org = $this->defaultSort();
			
			if ($this->prefillSort){
				$this->getOwner()->{$this->sortAttribute} = $this->sort_org;
			}
		}
	}
	
	public function beforeSave()
	{
        $owner = $this->getOwner();
        
        if ($owner->getIsNewRecord() && $owner->{$this->sortAttribute} > $this->sort_org){
            $owner->{$this->sortAttribute} = $this->sort_org;
		}
						
	}

	public function afterSave()
    {
        if ($this->getOwner()->{$this->sortAttribute} != $this->sort_org){
    		$this->exchangeSort();
    	}    	
	}
	
	
	public function afterFind()
	{
		$this->sort_org = $this->getOwner()->{$this->sortAttribute};
	}

	public function afterDelete()
	{
		$this->exchangeSort(true);
	}
	
	//自定義
	public function afterDeleteForStatus()
	{
		$this->exchangeSort(true);
	}
	
	
	/***
	 *
	 * 排序
	 *
	 */	
	
	//預設排最後
	public function defaultSort(){
		
		$num = $this->owner->model()->alived()->count();	
		return $num+1;
	}

	//重新排序(新增 修改 刪除)
	public function exchangeSort($del = false){
		
		$owner = $this->getOwner();
		
		if ($del){ //刪除
			$this->forwardEx($owner->{$this->sortAttribute}, '', $owner->id, $del);
			
		} elseif ($owner->{$this->sortAttribute} < $this->sort_org){ //往前插入
			//往後挪
			$this->backwardEx($owner->{$this->sortAttribute}, $this->sort_org, $owner->id);
			
		} elseif ($owner->{$this->sortAttribute} > $this->sort_org){ //往後插入
			//往前挪
			$this->forwardEx($this->sort_org, $owner->{$this->sortAttribute}, $owner->id);
		}		
	}
	
	//全區往後移
	public function backwardEx($s, $e, $id){
		$tablename = $this->getOwner()->tableName();
		
		$sql = "UPDATE `{$tablename}` SET {$this->sortAttribute} = {$this->sortAttribute}+1 WHERE id != {$id} AND {$this->sortAttribute} >= {$s}  AND {$this->sortAttribute} < {$e}";		
		if ($this->statusMode){
			$sql .= " AND status = 'y'";
		}
		
		$this->getOwner()->dbConnection->createCommand($sql)->execute();
	}
	//全區往前移
	public function forwardEx($s, $e, $id, $del = false){
		$tablename = $this->getOwner()->tableName();
		$sql = "UPDATE `{$tablename}` SET {$this->sortAttribute} = {$this->sortAttribute}-1 WHERE id != {$id} AND {$this->sortAttribute} > {$s}";			
		
		if (!$del){	
			$sql .= " AND {$this->sortAttribute} <= {$e}";
		}	
		
		if ($this->statusMode){
			$sql .= " AND status = 'y'";
		}
		

		$this->getOwner()->dbConnection->createCommand($sql)->execute();
	}
	
	//修改排序
	public function saveSort(){
		$this->getOwner()->saveAttributes(array($this->sortAttribute));
		$this->exchangeSort();		
	}	

}
?>