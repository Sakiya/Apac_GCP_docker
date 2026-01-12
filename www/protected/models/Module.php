<?php

/**
 * This is the model class for table "{{Module}}".
 *
 * The followings are the available columns in table '{{Module}}':
 * @property string $id
 * @property string $cat_id
 * @property string $name
 * @property string $controller
 * @property integer $option_search
 * @property string $sort
 */
class Module extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Module the static model class
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
		return '{{Module}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, controller', 'required'),
			array('cat_id, sort', 'length', 'max'=>10),
			array('name, controller', 'length', 'max'=>255),
			array('option_search', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cat_id, name, controller, option_search, sort', 'safe', 'on'=>'search'),
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
            'cat' => array(self::BELONGS_TO, 'ModuleCat', 'cat_id', 'condition' => ''),
            'permission' => array(self::HAS_MANY, 'Permission', 'module_id', 'condition' => ''),
            //role&user 權限列表
            'backpermission_excludeDeveloper'=> array(self::HAS_MANY, 'Permission', 'module_id', 'condition' => "backpermission_excludeDeveloper.showon = 'backend' AND backpermission_excludeDeveloper.developer != 1"),
			'frontpermission_excludeDeveloper'=> array(self::HAS_MANY, 'Permission', 'module_id', 'condition' => "frontpermission_excludeDeveloper.showon = 'frontend' AND frontpermission_excludeDeveloper.developer != 1"),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => '分類',
			'name' => '模組名稱',
			'controller' => 'Controller',
			'option_search' => '是否開啓快速搜尋',
			'sort' => '排序',
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
		$criteria->compare('cat_id',$this->cat_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('option_search',$this->option_search,true);
		$criteria->compare('sort',$this->sort,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	// 給 view 做 DropDownList
	public static function listData(){
		return CHtml::listData(self::model()->findAll(),'id','name');		
	}	
	
}