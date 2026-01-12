<?php

/**
 * This is the model class for table "Work".
 *
 * The followings are the available columns in table 'Work':
 * @property integer $Work_no
 * @property integer $Gallerym1_no
 * @property integer $Galleryt1_no
 * @property string $type
 * @property string $pic
 * @property string $link
 * @property string $workname
 * @property string $workname_en
 * @property string $media
 * @property string $media_en
 * @property string $datasize
 * @property string $year
 */
class Work extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Work';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Galleryt1_no, type, link', 'required'),
			array('Gallerym1_no, Galleryt1_no', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>1),
			array('pic', 'length', 'max'=>50),
			array('workname, workname_en, media, media_en, datasize', 'length', 'max'=>100),
			array('year', 'length', 'max'=>10),
			array('media, media_en, datasize, year, updateDateTime, content1' ,'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Work_no, Gallerym1_no, Galleryt1_no, type, pic, link, workname, workname_en, media, media_en, datasize, year', 'safe', 'on'=>'search'),
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
			'Galleryt1' => array(self::BELONGS_TO, 'Galleryt1', 'Galleryt1_no'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Work_no' => '序號',
			'Gallerym1_no' => '畫廊',
			'Galleryt1_no' => '藝術家序號',
			'type' => '類別',
			'pic' => '藝術家作品',
			'link' => '連結',
			'workname' => '作品中文名',
			'workname_en' => '作品英文名',
			'media' => '創作媒材',
			'media_en' => '創作媒材英',
			'datasize' => '作品尺寸',
			'year' => '作品年份',
			'content1' => '特別說明',
			'updateDateTime' => '日期'
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

		$criteria->compare('Work_no',$this->Work_no);
		$criteria->compare('Gallerym1_no',$this->Gallerym1_no);
		$criteria->compare('Galleryt1_no',$this->Galleryt1_no);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('workname',$this->workname,true);
		$criteria->compare('workname_en',$this->workname_en,true);
		$criteria->compare('media',$this->media,true);
		$criteria->compare('media_en',$this->media_en,true);
		$criteria->compare('datasize',$this->datasize,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('content1',$this->content1,true);
		$criteria->compare('updateDateTime',$this->updateDateTime,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Work the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
