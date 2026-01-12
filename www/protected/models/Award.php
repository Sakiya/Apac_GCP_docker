<?php

/**
 * This is the model class for table "Award".
 *
 * The followings are the available columns in table 'Award':
 * @property integer $Award_no
 * @property integer $Gallerym1_no
 * @property integer $Galleryt1_no
 * @property string $workname
 * @property string $workname_en
 * @property string $media
 * @property string $media_en
 * @property string $datasize
 * @property string $year
 * @property string $pic1
 * @property string $content1
 * @property string $pic2
 * @property string $content2
 */
class Award extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Award';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Gallerym1_no, datasize, year', 'required'),
			array('Gallerym1_no, Galleryt1_no', 'numerical', 'integerOnly'=>true),
			array('workname, workname_en, media, media_en, datasize, year', 'length', 'max'=>100),
			array('pic1, pic2, workpic1', 'length', 'max'=>50),
			array('content1, content2','safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Award_no, Gallerym1_no, Galleryt1_no, workname, workname_en, media, media_en, datasize, year, pic1, content1, pic2, content2', 'safe', 'on'=>'search'),
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
			'Award_no' => '序號',
			'Gallerym1_no' => '畫廊',
			'Galleryt1_no' => '新賞講藝術家',
			'workname' => '作品＿中',
			'workname_en' => '作品＿英',
			'media' => '創作媒材_中',
			'media_en' => '創作媒材_英',
			'datasize' => '作品尺寸',
			'year' => '作品年份',
			'pic1' => '補助說明圖1',
			'content1' => '補助文字說明1',
			'pic2' => '補助說明圖2',
			'content2' => '補助文字說明2',
			'workpic1' => '作品圖片',
			'description' => '創作理念說明'
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

		$criteria->compare('Award_no',$this->Award_no);
		$criteria->compare('Gallerym1_no',$this->Gallerym1_no);
		$criteria->compare('Galleryt1_no',$this->Galleryt1_no);
		$criteria->compare('workname',$this->workname,true);
		$criteria->compare('workname_en',$this->workname_en,true);
		$criteria->compare('media',$this->media,true);
		$criteria->compare('media_en',$this->media_en,true);
		$criteria->compare('datasize',$this->datasize,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('pic1',$this->pic1,true);
		$criteria->compare('content1',$this->content1,true);
		$criteria->compare('pic2',$this->pic2,true);
		$criteria->compare('content2',$this->content2,true);
		$criteria->compare('workpic1',$this->workpic1,true);
		$criteria->compare('description',$this->description,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Award the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
