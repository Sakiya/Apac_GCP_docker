<?php

/**
 * This is the model class for table "vipcard".
 *
 * The followings are the available columns in table 'vipcard':
 * @property integer $card_no
 * @property integer $Gallerym1_no
 * @property string $type
 * @property string $company
 * @property string $name
 * @property string $tel
 * @property string $address
 */
class Vipcard extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vipcard';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Gallerym1_no, type', 'required'),
			array('Gallerym1_no', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>1),
			array('company', 'length', 'max'=>50),
			array('name', 'length', 'max'=>20),
			array('tel', 'length', 'max'=>30),
			array('company, name, tel, address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('card_no, Gallerym1_no, type, company, name, tel, address', 'safe', 'on'=>'search'),
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
			'Gallerym1' => array(self::BELONGS_TO, 'Gallerym1', 'Gallerym1_no'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'card_no' => '序號',
			'Gallerym1_no' => '畫廊序號',
			'type' => '類別',
			'company' => '公司職稱',
			'name' => '貴賓姓名',
			'tel' => '行動電話',
			'address' => '地址',
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

		$criteria->compare('card_no',$this->card_no);
		$criteria->compare('Gallerym1_no',$this->Gallerym1_no);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vipcard the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
