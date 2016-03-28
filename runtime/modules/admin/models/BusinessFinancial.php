<?php


/**
 * This is the model class for table "{{business_financial}}".
 *
 * The followings are the available columns in table '{{business_financial}}':
 * @property string $business_user_transaction_id
 * @property string $business_user_transaction_type
 * @property string $business_user_transaction_details
 * @property string $business_user_transaction_bank
 * @property string $business_user_transaction_date
 * @property string $business_user_transaction_paid_out
 * @property string $business_user_transaction_paid_in
 * @property string $business_user_transaction_balance
 * @property string $business_user_financial_transaction_withdraw_status
 * @property string $business_user_financial_transaction_currency_code
 * @property integer $business_user_transaction_profile_id
 */
class BusinessFinancial extends CActiveRecord

{

    /**
     * @return string the associated database table name
     */

    public function tableName()

    {

        return '{{business_financial}}';

    }


    /**
     * @return array validation rules for model attributes.
     */

    public function rules()

    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(


            array('business_user_transaction_type, business_user_transaction_details, business_user_transaction_bank, business_user_transaction_date, business_user_transaction_paid_out, business_user_transaction_paid_in, business_user_transaction_balance, business_user_financial_transaction_withdraw_status, business_user_financial_transaction_currency_code, business_user_transaction_profile_id', 'required'),


            array('business_user_transaction_profile_id', 'numerical', 'integerOnly' => true),


            array('business_user_transaction_bank', 'length', 'max' => 50),


            array('business_user_transaction_paid_out, business_user_transaction_paid_in, business_user_transaction_balance', 'length', 'max' => 10),


            array('business_user_financial_transaction_currency_code', 'length', 'max' => 3),


            // The following rule is used by search().

            // @todo Please remove those attributes that should not be searched.

            array('business_user_transaction_id, business_user_transaction_type, business_user_transaction_details, business_user_transaction_bank, business_user_transaction_date, business_user_transaction_paid_out, business_user_transaction_paid_in, business_user_transaction_balance, business_user_financial_transaction_withdraw_status, business_user_financial_transaction_currency_code, business_user_transaction_profile_id', 'safe', 'on' => 'search'),

        );

    }


    /**
     * @return array relational rules.
     */

    public function relations()

    {

        // NOTE: you may need to adjust the relation name and the related

        // class name for the relations automatically generated below.

        return array();

    }


    /**
     * @return array customized attribute labels (name=>label)
     */

    public function attributeLabels()

    {

        return array(


            'business_user_transaction_id' => 'Business User Transaction',


            'business_user_transaction_type' => 'Business User Transaction Type',


            'business_user_transaction_details' => 'Business User Transaction Details',


            'business_user_transaction_bank' => 'Business User Transaction Bank',


            'business_user_transaction_date' => 'Business User Transaction Date',


            'business_user_transaction_paid_out' => 'Business User Transaction Paid Out',


            'business_user_transaction_paid_in' => 'Business User Transaction Paid In',


            'business_user_transaction_balance' => 'Business User Transaction Balance',


            'business_user_financial_transaction_withdraw_status' => 'Business User Financial Transaction Withdraw Status',


            'business_user_financial_transaction_currency_code' => 'Business User Financial Transaction Currency Code',


            'business_user_transaction_profile_id' => 'Business User Transaction Profile',


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


        $criteria = new CDbCriteria;


        $criteria->compare('business_user_transaction_id', $this->business_user_transaction_id, true);
        $criteria->compare('business_user_transaction_type', $this->business_user_transaction_type, true);
        $criteria->compare('business_user_transaction_details', $this->business_user_transaction_details, true);
        $criteria->compare('business_user_transaction_bank', $this->business_user_transaction_bank, true);
        $criteria->compare('business_user_transaction_date', $this->business_user_transaction_date, true);
        $criteria->compare('business_user_transaction_paid_out', $this->business_user_transaction_paid_out, true);
        $criteria->compare('business_user_transaction_paid_in', $this->business_user_transaction_paid_in, true);
        $criteria->compare('business_user_transaction_balance', $this->business_user_transaction_balance, true);
        $criteria->compare('business_user_financial_transaction_withdraw_status', $this->business_user_financial_transaction_withdraw_status, true);
        $criteria->compare('business_user_financial_transaction_currency_code', $this->business_user_financial_transaction_currency_code, true);
        $criteria->compare('business_user_transaction_profile_id', $this->business_user_transaction_profile_id);


        return new CActiveDataProvider($this, array(

            'criteria' => $criteria,

        ));

    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return BusinessFinancial the static model class
     */

    public static function model($className = __CLASS__)

    {

        return parent::model($className);

    }

}

