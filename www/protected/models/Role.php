<?php

/**
 * This is the model class for table "{{Role}}".
 *
 * The followings are the available columns in table '{{Role}}':
 * @property string $id
 * @property string $name
 * @property integer $superpower
 * @property integer $bulitin
 */
class Role extends CActiveRecord
{
	public $permAry;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Role the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{Role}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, bulitin', 'required', 'message'=>'{attribute} required'),
			array('superpower, bulitin', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, superpower, bulitin', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'user' => array(self::HAS_MANY, 'User', 'role_id', 'condition' => '', 'together'=>true),
			'permission'=>array(self::MANY_MANY, 'Permission', YII::app()->db->tablePrefix.'Role_Permission(role_id, permission_id)'),
			'backend_permission'=>array(
				self::MANY_MANY, 'Permission', YII::app()->db->tablePrefix.'Role_Permission(role_id, permission_id)',
				'condition'=>"backend_permission.showon='backend'",
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名稱',
			'superpower' => '權限',
			'bulitin' => '內建角色',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('superpower',$this->superpower);
		$criteria->compare('bulitin',$this->bulitin);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	//取角色勾選權限
	public function getRolePermission()
	{
		if($this->permission){
			foreach ($this->permission as $perm){
				$perms[] = $perm->id;
			}			
		}
		return 	$perms;
	}
	
	protected function afterSave() 
	{
		if($this->scenario == "admin"){
			if(!$this->isNewRecord) {
				$this->dbConnection->createCommand("DELETE FROM zx_Role_Permission WHERE role_id={$this->id}")->execute();
			}
		
			if($this->permAry){
				foreach($this->permAry as $perm){
					$this->dbConnection->createCommand("INSERT INTO zx_Role_Permission (role_id, permission_id) VALUES ({$this->id},{$perm})")->execute();
				}
			}
		}
	}
	
	// 給 view 做 DropDownList
	public static function listData(){
	
		$criteria = new CDbCriteria;
		
		if(Yii::app()->user->model->role->superpower <> 1){
			$criteria->addCondition("superpower <> '1'");
		} 
		return CHtml::listData(self::model()->findAll($criteria),'id','name');		
	}	
    
    public function powerList(){
    	return array('依設定', '有全部權限');
    }
	
	
}