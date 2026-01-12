<?php

class Recordt1 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'Record_t1';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
		return array(
			array('Gallerym1_no, bankaccount, createdate', 'required'),
			array('Gallerym1_no, price', 'numerical', 'integerOnly'=>true),
			array('orderid, bankaccount, createdate, enddate, orderid', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Gallerym1_no, orderid, bankaccount, createdate, enddate', 'safe', 'on'=>'search'),
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
            'Recordt1_no' => '序號',
            'Gallerym1_no' => '會員ID',
            'orderid' => '訂單號',
            'price' => '金額',
            'bankaccount' => '虛擬帳號',
            'createdate' => '建立日期',
            'enddate' => '到期日期',
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

        $criteria->compare('Recordt1_no',$this->Recordt1_no,true);
        $criteria->compare('Gallerym1_no',$this->Gallerym1_no);
        $criteria->compare('orderid',$this->orderid,true);
        $criteria->compare('bankaccount',$this->bankaccount,true);
        $criteria->compare('price',$this->price,true);
        $criteria->compare('createdate',$this->createdate,true);
        $criteria->compare('enddate',$this->enddate,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Recordt1 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}