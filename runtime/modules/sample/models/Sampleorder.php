<?php

class Sampleorder extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Createuserlisting the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{sample_listing_orders}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_default_sample_listing_id', 'required'),
            array('user_default_sample_listing_id,user_default_sample_listing_order_id,user_default_profiles_id', 'numerical', 'integerOnly'=>true),
            array('user_default_sample_listing_order_instruction', 'length', 'max'=>21845),
            array('user_default_sample_listing_order_cost,user_default_sample_listing_order_quantity', 'length', 'max'=>100),
            array('user_default_sample_listing_order_id,user_default_sample_listing_id, user_default_profiles_id, user_default_sample_listing_order_quantity, user_default_sample_listing_order_cost, user_default_sample_listing_order_instruction, user_default_sample_listing_order_date,user_default_sample_listing_order_status', 'safe', 'on'=>'search'),
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
            'user_default_sample_listing_order_id' => 'Lid',
            'user_default_sample_listing_id' => ' Lid',
            'user_default_profiles_id' => ' User id',
            'user_default_sample_listing_order_quantity' => ' Quantity',
            'user_default_sample_listing_order_cost' => ' Amount',
            'user_default_sample_listing_order_instruction' => ' instructions',
            'user_default_sample_listing_order_date' => ' date',
            'user_default_sample_listing_order_status' => ' status',

        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria= new CDbCriteria;

        $criteria->compare('user_default_sample_listing_order_id',$this->user_default_sample_listing_order_id);
        $criteria->compare('user_default_sample_listing_id',$this->user_default_sample_listing_id,true);
        $criteria->compare('user_default_profiles_id',$this->user_default_profiles_id,true);
        $criteria->compare('user_default_sample_listing_order_quantity',$this->user_default_sample_listing_order_quantity,true);
        $criteria->compare('user_default_sample_listing_order_cost',$this->user_default_sample_listing_order_cost,true);
        $criteria->compare('user_default_sample_listing_order_instruction',$this->user_default_sample_listing_order_instruction,true);
        $criteria->compare('user_default_sample_listing_order_date',$this->user_default_sample_listing_order_date,true);
        $criteria->compare('user_default_sample_listing_order_status',$this->user_default_sample_listing_order_status,true);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

}