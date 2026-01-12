<?php

/**
 * This is the model class for table "Room_M1".
 *
 * The followings are the available columns in table 'Room_M1':
 * @property integer $RoomM1_no
 * @property integer $YearM1_no
 * @property integer $MethodM1_no
 * @property string $RoomM1_nm
 * @property string $RoomM1_nm_en
 * @property string $RoomM1_size
 * @property string $RoomM1_price
 * @property integer $sort
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Roomm1 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Room_M1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MethodM1_no, RoomM1_nm, RoomM1_nm_en, RoomM1_size, RoomM1_price', 'required'),
			array('YearM1_no, MethodM1_no, sort', 'numerical', 'integerOnly'=>true),
			array('RoomM1_size,RoomM1_size_en', 'length', 'max'=>50),
			array('RoomM1_price,RoomM1_price_en', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('RoomM1_no, YearM1_no, MethodM1_no, RoomM1_nm, RoomM1_nm_en, RoomM1_size, RoomM1_price, sort, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'Methodm1' => array(self::BELONGS_TO, 'Methodm1', 'MethodM1_no', 'condition' => '', 'order'=>'Methodm1.sort '),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RoomM1_no' => '序號',
			'YearM1_no' => '年度序號',
			'MethodM1_no' => '方案序號',
			'RoomM1_nm' => '客房名稱',
			'RoomM1_nm_en' => '客房名稱(英)',
			'RoomM1_size' => '坪數',
			'RoomM1_price' => '價格',
			'RoomM1_size_en' => '坪數(英)',
			'RoomM1_price_en' => '價格(英)',
			'sort' => '排序',
			'createDateTime' => '新增日期',
			'updateDateTime' => '更新日期',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('RoomM1_no',$this->RoomM1_no);
		$criteria->compare('YearM1_no',$this->YearM1_no);
		$criteria->compare('MethodM1_no',$this->MethodM1_no);
		$criteria->compare('RoomM1_nm',$this->RoomM1_nm,true);
		$criteria->compare('RoomM1_nm_en',$this->RoomM1_nm_en,true);
		$criteria->compare('RoomM1_size',$this->RoomM1_size,true);
		$criteria->compare('RoomM1_price',$this->RoomM1_price,true);
		$criteria->compare('RoomM1_size_en',$this->RoomM1_size_en,true);
		$criteria->compare('RoomM1_price_en',$this->RoomM1_price_en,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('createDateTime',$this->createDateTime,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roomm1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	// 給 view 做 DropDownList
	public static function listData(){	
		$criteria = new CDbCriteria;
		$criteria->condition = " YearM1_no = '" . Yii::app()->user->getState('bgYear') . "'";
		$criteria->order = " sort ";
		return CHtml::listData(self::model()->findAll($criteria),'RoomM1_no','RoomM1_nm','Methodm1.MethodM1_title');		
	}
    protected function beforeSave(){
		//客戶編號
        if ($this->isNewRecord){
			$this->createDateTime = date('Y:m:d H:i:s');
			if ($this->sort == null){
				$this->sort = 2;
			}			
		}
		//更新資料
		$this->updateuser = Yii::app()->user->model->name;
		$this->updateDateTime = date('Y:m:d H:i:s');		
		return parent::beforeSave();
	}
}
