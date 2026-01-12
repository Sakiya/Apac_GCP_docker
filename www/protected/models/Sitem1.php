<?php

/**
 * This is the model class for table "site_m1".
 *
 * The followings are the available columns in table 'site_m1':
 * @property string $sitem1_no
 * @property string $sitem1_nm
 * @property string $sitem1_mintitle
 * @property string $sitem1_content
 */
class Sitem1 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_m1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sitem1_nm', 'required'),
			array('sitem1_nm', 'length', 'max'=>10),
			array('sitem1_mintitle', 'length', 'max'=>20),
			array('sitem1_content','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sitem1_no, sitem1_nm, sitem1_mintitle, sitem1_content', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sitem1_no' => '序號',
			'sitem1_nm' => '據點標題',
			'sitem1_mintitle' => '小標',
			'sitem1_content' => '內容',
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

		$criteria->compare('sitem1_no',$this->sitem1_no,true);
		$criteria->compare('sitem1_nm',$this->sitem1_nm,true);
		$criteria->compare('sitem1_mintitle',$this->sitem1_mintitle,true);
		$criteria->compare('sitem1_content',$this->sitem1_content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sitem1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
