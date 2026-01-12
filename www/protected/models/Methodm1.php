<?php

/**
 * This is the model class for table "Method_M1".
 *
 * The followings are the available columns in table 'Method_M1':
 * @property integer $MethodM1_no
 * @property integer $YearM1_no
 * @property string $MethodM1_title
 * @property string $MethodM1_title_en
 * @property string $MethodM1_script
 * @property string $MethodM1_script_en
 * @property integer $sort
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Methodm1 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Method_M1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('YearM1_no,MethodM1_title, MethodM1_title_en', 'required'),
			array('MethodM1_no, YearM1_no, sort', 'numerical', 'integerOnly'=>true),
			array('MethodM1_title, MethodM1_title_en,MethodM1_script, MethodM1_script_en', 'safe'),
			array('MethodM1_remarker, MethodM1_remarker_en', 'safe'),
			array('createDateTime, updateDateTime','safe'),
			array('updateuser', 'length', 'max'=>30),
			array('MethodM1_yearlimit','length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('MethodM1_no, YearM1_no, MethodM1_title, MethodM1_title_en, MethodM1_script, MethodM1_script_en, sort, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'Roomm1' => array(self::HAS_MANY, 'Roomm1', 'MethodM1_no', 'condition' => '', 'order'=>'sort ASC'),
			'Yearm1' => array(self::HAS_MANY, 'Yearm1', 'YearM1_no', 'condition' => '', 'order'=>'Yearm1_year ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MethodM1_no' => '序號',
			'YearM1_no' => '年度序號',
			'MethodM1_title' => '方案名稱(中)',
			'MethodM1_title_en' => '方案名稱(英)',
			'MethodM1_script' => '方案說明(中)',
			'MethodM1_script_en' => '方案說明(英)',
			'MethodM1_remarker' => '注意說明(中)',
			'MethodM1_remarker_en' => '注意說明(英)',
			'MethodM1_yearlimit' => '年齡限制(35歲以下)',
			'sort' => '排序',
			'createDateTime' => '新增日期',
			'updateDateTime' => '更新日期',
			'updateuser' => '修改人員'
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

		$criteria->compare('MethodM1_no',$this->MethodM1_no);
		$criteria->compare('YearM1_no',$this->YearM1_no);
		$criteria->compare('MethodM1_title',$this->MethodM1_title,true);
		$criteria->compare('MethodM1_title_en',$this->MethodM1_title_en,true);
		$criteria->compare('MethodM1_script',$this->MethodM1_script,true);
		$criteria->compare('MethodM1_script_en',$this->MethodM1_script_en,true);
		$criteria->compare('MethodM1_yearlimit',$this->MethodM1_yearlimit,true);
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
	 * @return Methodm1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	// 給 view 做 DropDownList
	public static function listData(){
	
		$criteria = new CDbCriteria;
		$criteria->condition = " YearM1_no = '" . Yii::app()->user->getState('bgYear') . "'";
		return CHtml::listData(self::model()->findAll($criteria),'MethodM1_no','MethodM1_title');		
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

	public function choose($Methodm1, $Gallery){
		$a = array();
		foreach ($Methodm1 as $k => $rows){
			$t = $rows->attributes;
			
			if ($rows->Roomm1){
				foreach ($rows->Roomm1 as $i => $row){
					$t['Roomm1'][$row->RoomM1_no] = $row->attributes;
				}
			}
			if ($Gallery->program){
			foreach (json_decode($Gallery->program) as $row){
				if ($row->program == $rows->MethodM1_no){
					$t['check'] = true;
					
					if ($row->value){
						foreach ($row->value as $j => $room){
							$t['Roomm1'][$row->room[$j]]['sort'] = $room;
						}
					}
				}
			}
			}
			array_push($a, $t);
		}

		return $a;
	}
}
