<?php

/**
 * This is the model class for table "pro_t2".
 *
 * The followings are the available columns in table 'pro_t2':
 * @property string $prot2_no
 * @property integer $prom1_no
 * @property string $prot2_img
 * @property string $prot2_imgalt
 */
class Prot2 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pro_t2';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            
            array('prom1_no', 'numerical', 'integerOnly'=>true),
            array('prot2_img, prot2_imgalt', 'length', 'max'=>30),
            array('prot2_img', 'file','types'=>'jpg,jpeg,png','maxSize'=>1024 * 1024 * 2 ,'safe'=>false,'allowEmpty'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('prot2_no, prom1_no, prot2_img, prot2_imgalt', 'safe', 'on'=>'search'),
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
            'prot2_no' => '序號',
            'prom1_no' => '主序號',
            'prot2_img' => '圖片',
            'prot2_imgalt' => '圖片alt',
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

        $criteria->compare('prot2_no',$this->prot2_no,true);
        $criteria->compare('prom1_no',$this->prom1_no);
        $criteria->compare('prot2_img',$this->prot2_img,true);
        $criteria->compare('prot2_imgalt',$this->prot2_imgalt,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Prot2 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}