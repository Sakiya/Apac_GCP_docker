<?php

/**
 * This is the model class for table "Year_M1".
 *
 * The followings are the available columns in table 'Year_M1':
 * @property integer $Yearm1_no
 * @property string $Yearm1_year
 * @property string $Yearm1_pic
 * @property string $Yearm1_script
 * @property string $Yearm1_script_en
 * @property string $Yearm1_open1st
 * @property string $Yearm1_open1ed
 * @property string $Yearm1_open2st
 * @property string $Yearm1_open2ed
 * @property string $createDateTime
 * @property string $updateDateTime
 */
class Yearm1 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Year_M1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Yearm1_year, Yearm1_open1st, Yearm1_open1ed', 'required'),
			array('Yearm1_year', 'length', 'max'=>4),
			array('Yearm1_pic,Yearm1_picmb,updateuser', 'length', 'max'=>30),
			array('Yearm1_usernumber', 'length', 'max'=>10),
			array('Yearm1_open1st, Yearm1_open1ed, Yearm1_open2st, Yearm1_open2ed', 'length', 'max'=>8),
			array('Yearm1_script, Yearm1_script_en', 'safe'),
			array('Yearm1_open2st, Yearm1_open2ed, Yearm1_payed2', 'safe'),
			array('createDateTime, updateDateTime', 'safe'),
			array('Yearm1_pic', 'file','types'=>'jpg,jpeg,png','maxSize'=>1024 * 1024 * 1 ,'safe'=>false,'allowEmpty'=>true),
			array('Yearm1_script2, Yearm1_script2_en','safe'),
			array('Yearm1_open1ed', 'validateDate_open1ed'),
			array('Yearm1_open2ed', 'validateDate_open2ed'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Yearm1_no, Yearm1_year, Yearm1_pic, Yearm1_script, Yearm1_script_en, Yearm1_open1st, Yearm1_open1ed, Yearm1_open2st, Yearm1_open2ed, createDateTime, updateDateTime', 'safe', 'on'=>'search'),
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
			'Gallerym1' => array(self::HAS_MANY, 'Gallerym1', 'Yearm1_no'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Yearm1_no' => '年度序號',
			'Yearm1_year' => '年份',
			'Yearm1_pic' => '圖片',
			'Yearm1_picmb' => 'Email圖片',
			'Yearm1_script' => '簡章內容 (中)',
			'Yearm1_script_en' => '簡章內容 (英)',
			'Yearm1_script2' => '二階簡章內容 (中)',
			'Yearm1_script2_en' => '二階簡章內容 (英)',
			'Yearm1_open1st' => '第一階段開放時間',
			'Yearm1_open1ed' => '第一階段結束時間',
			'Yearm1_open2st' => '第二階段開放時間',
			'Yearm1_open2ed' => '第二階段開放時間',
			'Yearm1_payed2' => '第二階段繳費截止日',
			'Yearm1_usernumber' => '使用者編號',
			'createDateTime' => '新增日期',
			'updateDateTime' => '更新日期',
			'updateuser'=>'修改人員'
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

		$criteria->compare('Yearm1_no',$this->Yearm1_no);
		$criteria->compare('Yearm1_year',$this->Yearm1_year,true);
		$criteria->compare('Yearm1_pic',$this->Yearm1_pic,true);
		$criteria->compare('Yearm1_script',$this->Yearm1_script,true);
		$criteria->compare('Yearm1_script_en',$this->Yearm1_script_en,true);
		$criteria->compare('Yearm1_script2',$this->Yearm1_script,true);
		$criteria->compare('Yearm1_script2_en',$this->Yearm1_script_en,true);
		$criteria->compare('Yearm1_open1st',$this->Yearm1_open1st,true);
		$criteria->compare('Yearm1_open1ed',$this->Yearm1_open1ed,true);
		$criteria->compare('Yearm1_open2st',$this->Yearm1_open2st,true);
		$criteria->compare('Yearm1_open2ed',$this->Yearm1_open2ed,true);
		$criteria->compare('Yearm1_payed2',$this->Yearm1_payed2,true);
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
	 * @return Yearm1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function listData(){

		$criteria=new CDbCriteria;
		$criteria->order = " Yearm1_year ";
		return CHtml::listData(self::model()->findAll($criteria),'Yearm1_no','Yearm1_year');
	}
	
  protected function beforeSave(){
		//客戶編號
    if ($this->isNewRecord){
			$this->Yearm1_usernumber = '1';
			$this->createDateTime = date('Y:m:d H:i:s');
		}
		//更新資料
		$this->updateuser = Yii::app()->user->model->name;
		$this->updateDateTime = date('Y:m:d H:i:s');
		return parent::beforeSave();
	}
    protected function afterSave(){
        $ary = array('experience', 'art', 'award', 'print', 'usd300');
    //建立資料夾
        $file_path = '.' . Yii::app()->params['folder']['def'] . $this->Yearm1_no . '/';
        if(!file_exists($file_path)){
            mkdir($file_path, 0755, true);
            chmod($file_path, 0755);
        }
        foreach ($ary as $item){
            $file_path = '.' . Yii::app()->params['folder']['def'] . $this->Yearm1_no . Yii::app()->params['sub_folder'][$item];
            if(!file_exists($file_path)){
                mkdir($file_path, 0777, true);
            }
        }

		return parent::afterSave();
    }

	public function validateDate_open1ed($attribute, $params){
		if ($this->Yearm1_open1ed < $this->Yearm1_open1st){
			$this->addError($attribute, '第一階段結束時間不可以大於開始時間');
		}
	}

	public function validateDate_open2ed($attribute, $params){
		if ($this->Yearm1_open2ed < $this->Yearm1_open2st){
			$this->addError($attribute, '第二階段結束時間不可以大於開始時間');
		}	
	}
	
}
