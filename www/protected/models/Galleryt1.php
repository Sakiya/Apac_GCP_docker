<?php

/**
 * This is the model class for table "Gallery_T1".
 *
 * The followings are the available columns in table 'Gallery_T1':
 * @property integer $Galleryt1_no
 * @property integer $Yearm1_no
 * @property integer $Gallerym1_no
 * @property string $name
 * @property string $name_en
 * @property string $country
 * @property string $media
 * @property string $jointex
 * @property string $personalex
 * @property string $prize
 * @property string $datafile1
 * @property string $dataname1
 * @property string $dataname_en1
 * @property string $datayear1
 * @property string $datamedia1
 * @property string $datasize1
 * @property string $datafile2
 * @property string $dataname2
 * @property string $dataname_en2
 * @property string $datayear2
 * @property string $datamedia2
 * @property string $datasize2
 * @property string $datafile3
 * @property string $dataname3
 * @property string $dataname_en3
 * @property string $datayear3
 * @property string $datamedia3
 * @property string $datasize3
 */
class Galleryt1 extends CActiveRecord
{
	public $aaa;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Gallery_T1';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		switch (Yii::app()->language){
			case 'en':
				return array(
					array('Yearm1_no, Gallerym1_no, name_en, country, dataname_en1', 'required'),
					array('dataname_en1,datayear1, datamedia1, datasize1', 'required'),//dataname_en1
					array('dataname_en2,datayear2, datamedia2, datasize2', 'required'),//dataname_en2
					array('dataname_en3,datayear3, datamedia3, datasize3', 'required'),//dataname_en3
					array('Yearm1_no, Gallerym1_no', 'numerical', 'integerOnly'=>true),
					array('country, datafile1, datafile2, datafile3', 'length', 'max'=>50),
					array('media, dataname1, dataname_en1, datamedia1, datasize1, dataname2, dataname_en2, datamedia2, datasize2, dataname3, dataname_en3, datamedia3, datasize3', 'length', 'max'=>255),
                    array('datayear1, datayear2, datayear3, birthyear', 'length', 'max'=>4),
                    array('Galleryt1_finish', 'length', 'max'=>10),
					array('name_en,name,jointex, personalex, prize','safe'),
					array('datafile2, dataname2, dataname_en2, datayear2, datamedia2, datasize2, datafile3, dataname3, dataname_en3, datayear3, datamedia3, datasize3','safe'),
					array('datafile1, datafile2, datafile3', 'file','types'=>'jpg,jpeg,png,svg','maxSize'=>1024 * 1024 * 1 ,'safe'=>false,'allowEmpty'=>true),
					// The following rule is used by search().
					// @todo Please remove those attributes that should not be searched.
					array('Galleryt1_no, Yearm1_no, Gallerym1_no, name, name_en, country, media, jointex, personalex, prize, datafile1, dataname1, dataname_en1, datayear1, datamedia1, datasize1, datafile2, dataname2, dataname_en2, datayear2, datamedia2, datasize2, datafile3, dataname3, dataname_en3, datayear3, datamedia3, datasize3', 'safe', 'on'=>'search'),
				);
				break;
			default:
				return array(
					array('Yearm1_no, Gallerym1_no, name, country, dataname1, datayear1, datamedia1, datasize1', 'required'),
					array('dataname2, datayear2, datamedia2, datasize2', 'required'),
					array('dataname3, datayear3, datamedia3, datasize3', 'required'),
					array('Yearm1_no, Gallerym1_no', 'numerical', 'integerOnly'=>true),
					array('country, datafile1, datafile2, datafile3', 'length', 'max'=>50),
					array('media, dataname1, dataname_en1, datamedia1, datasize1, dataname2, dataname_en2, datamedia2, datasize2, dataname3, dataname_en3, datamedia3, datasize3', 'length', 'max'=>255),
                    array('datayear1, datayear2, datayear3, birthyear', 'length', 'max'=>4),
                    array('Galleryt1_finish', 'length', 'max'=>10),
					array('name_en,jointex, personalex, prize','safe'),
					array('datafile2, dataname2, dataname_en2, datayear2, datamedia2, datasize2, datafile3, dataname3, dataname_en3, datayear3, datamedia3, datasize3','safe'),
					array('datafile1, datafile2, datafile3', 'file','types'=>'jpg,jpeg,png,svg','maxSize'=>1024 * 1024 * 1 ,'safe'=>false,'allowEmpty'=>true),
					// The following rule is used by search().
					// @todo Please remove those attributes that should not be searched.
					array('Galleryt1_no, Yearm1_no, Gallerym1_no, name, name_en, country, media, jointex, personalex, prize, datafile1, dataname1, dataname_en1, datayear1, datamedia1, datasize1, datafile2, dataname2, dataname_en2, datayear2, datamedia2, datasize2, datafile3, dataname3, dataname_en3, datayear3, datamedia3, datasize3', 'safe', 'on'=>'search'),
				);

				break;
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Gallerym1' => array(self::BELONGS_TO, 'Gallerym1', 'Gallerym1_no','order'=>'Galleryt1_no ','on' => ''),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		switch (Yii::app()->language){
			case 'en':
				return array(
					'Galleryt1_no' => '序號',
					'Yearm1_no' => '年度序號',
					'Gallerym1_no' => '畫廊序號',
					'Program' => '選擇參展方案',
					'name' => '藝術家名字(中)',
					'name_en' => '藝術家名字(英)',
					'birthyear' => '藝術家名字(英)',
					'country' => '國家',
					'media' => '創作媒材',
					'jointex' => '學歷',
					'personalex' => '聯展/個展簡歷',
					'prize' => '典藏/獲獎經歷',
					'datafile1' => 'Work Name',
					'dataname1' => 'Work Name',
					'dataname_en1' => 'Work English Name',
					'datayear1' => 'Year',
					'datamedia1' => 'Medium',
					'datasize1' => 'Size ( L x W x H cm)',
					'datafile2' => 'Work Name',
					'dataname2' => 'Work Name',
					'dataname_en2' => 'Work English Name',
					'datayear2' => 'Year',
					'datamedia2' => 'Medium',
					'datasize2' => 'Size ( L x W x H cm)',
					'datafile3' => 'Work Name',
					'dataname3' => 'Work Name',
					'dataname_en3' => 'Work English Name',
					'datayear3' => 'Year',
					'datamedia3' => 'Medium',
                    'datasize3' => 'Size ( L x W x H cm)',
                    'Galleryt1_finish'=>'finish'
				);
				break;
			default:
				return array(
					'Galleryt1_no' => '序號',
					'Yearm1_no' => '年度序號',
					'Gallerym1_no' => '畫廊序號',
					'Program' => '選擇參展方案',
					'name' => '藝術家名字(中)',
					'name_en' => '藝術家名字(英)',
					'birthyear' => '藝術家名字(英)',
					'country' => '國家',
					'media' => '創作媒材',
					'jointex' => '學歷',
					'personalex' => '聯展/個展簡歷',
					'prize' => '典藏/獲獎經歷',
					'datafile1' => '作品檔案',
					'dataname1' => '作品名稱',
					'dataname_en1' => 'Work English Name',
					'datayear1' => '作品年份',
					'datamedia1' => '創作媒材',
					'datasize1' => '作品尺寸（L x W x H cm）',
					'datafile2' => '作品檔案',
					'dataname2' => '作品名稱',
					'dataname_en2' => 'Work English Name',
					'datayear2' => '作品年份',
					'datamedia2' => '創作媒材',
					'datasize2' => '作品尺寸（L x W x H cm）',
					'datafile3' => '作品檔案',
					'dataname3' => '作品名稱',
					'dataname_en3' => 'Work English Name',
					'datayear3' => '作品年份',
					'datamedia3' => '創作媒材',
                    'datasize3' => '作品尺寸（L x W x H cm）',
                    'Galleryt1_finish'=>'finish',
				);

				break;
		}
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

		$criteria->compare('Galleryt1_no',$this->Galleryt1_no);
		$criteria->compare('Yearm1_no',$this->Yearm1_no);
		$criteria->compare('Gallerym1_no',$this->Gallerym1_no);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('media',$this->media,true);
		$criteria->compare('jointex',$this->jointex,true);
		$criteria->compare('personalex',$this->personalex,true);
		$criteria->compare('prize',$this->prize,true);
		$criteria->compare('datafile1',$this->datafile1,true);
		$criteria->compare('dataname1',$this->dataname1,true);
		$criteria->compare('dataname_en1',$this->dataname_en1,true);
		$criteria->compare('datayear1',$this->datayear1,true);
		$criteria->compare('datamedia1',$this->datamedia1,true);
		$criteria->compare('datasize1',$this->datasize1,true);
		$criteria->compare('datafile2',$this->datafile2,true);
		$criteria->compare('dataname2',$this->dataname2,true);
		$criteria->compare('dataname_en2',$this->dataname_en2,true);
		$criteria->compare('datayear2',$this->datayear2,true);
		$criteria->compare('datamedia2',$this->datamedia2,true);
		$criteria->compare('datasize2',$this->datasize2,true);
		$criteria->compare('datafile3',$this->datafile3,true);
		$criteria->compare('dataname3',$this->dataname3,true);
		$criteria->compare('dataname_en3',$this->dataname_en3,true);
		$criteria->compare('datayear3',$this->datayear3,true);
		$criteria->compare('datamedia3',$this->datamedia3,true);
		$criteria->compare('datasize3',$this->datasize3,true);
		
		$criteria->compare('aaa',$this->aaa,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Galleryt1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
