<?php

/**
 * This is the model class for table "{{Permission}}".
 *
 * The followings are the available columns in table '{{Permission}}':
 * @property string $id
 * @property string $module_id
 * @property string $name
 * @property string $action
 * @property integer $type
 * @property string $icon
 * @property string $sort
 * @property string $option
 * @property integer $necessary
 * @property string $showon
 * @property integer $developer
 */
class Permission extends CActiveRecord
{
	public function init(){
		parent::init();
		//初始值
        $this->developer = 0; //系統開發者專屬功能
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @return Permission the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return '{{Permission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_id, name, action, showon, developer', 'required'),
			array('type, necessary, developer', 'numerical', 'integerOnly'=>true),
			array('module_id, sort', 'length', 'max'=>10),
			array('name, action, option', 'length', 'max'=>255),
			array('icon', 'length', 'max'=>50),
			array('showon', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, module_id, name, action, type, icon, sort, option, necessary, showon, developer', 'safe', 'on'=>'search'),
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
            'module' => array(self::BELONGS_TO, 'Module', 'module_id', 'condition' => ''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'module_id' => '模組',
			'name' => '名稱',
			'action' => 'Action',
			'type' => '型態',
			'icon' => '圖示',
			'sort' => '排序',
			'option' => '選項',
			'necessary' => 'Necessary',
			'showon' => '執行環境',
			'developer' => '開發者專屬功能',
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
		$criteria->compare('module_id',$this->module_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('sort',$this->sort,true);
		$criteria->compare('option',$this->option,true);
		$criteria->compare('necessary',$this->necessary);
		$criteria->compare('showon',$this->showon,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}


    public function scopes(){
        $alias = self::getTableAlias();
        
        return array(
            'backend'=>array(
                'condition' => "{$alias}.showon = :showon",
                'params' => array(':showon' => 'backend'),
            ),
            'excludeDeveloper'=>array(
                'condition' => "{$alias}.developer != :developer",
                'params' => array(':developer' => 1),
            ),
        );
    }
    
    
    public function showonList(){
    	return array('frontend'=> '前台', 'backend'=> '後台');
    }
    
    public function typeList(){
    	//return array(1=>'模組列表', 2=>'功能列', 3=>'表格列表');
    	return array(1=>'模組列表', 2=>'功能列', 3=>'表格列表', 4=>'其他');
    }
    
    public function iconList(){
    	$iconArray = array();
    	$i = 0;
    	while($i < count(Yii::app()->params['backendIcon'])){
    		$iconArray[Yii::app()->params['backendIcon'][$i]] = CHtml::image(Html::adminImageUrl(Yii::app()->params['backendIcon'][$i]));
    		$i++;
    	}
    	return $iconArray;
    }


}