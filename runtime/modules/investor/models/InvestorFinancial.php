
<?php


/**
 * This is the model class for table "{{investor_financial}}".
 *
 * The followings are the available columns in table '{{investor_financial}}':

 * @property string $user_default_investment_transaction_id


 * @property integer $user_default_investment_transaction_sellequityid


 * @property string $user_default_investment_transaction_type


 * @property string $user_default_investment_transaction_details


 * @property string $user_default_investment_transaction_bank


 * @property string $user_default_investment_transaction_date


 * @property string $user_default_investment_transaction_paid_out


 * @property string $user_default_investment_transaction_paid_in


 * @property string $user_default_investment_transaction_balance


 * @property string $user_default_investment_transaction_paypal_transactionId


 * @property string $user_default_investment_transaction_withdraw_status


 * @property string $user_default_investment_transaction_currency_code


 * @property integer $user_default_investment_transaction_profiles_id



 */
class InvestorFinancial extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{investor_financial}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_investment_transaction_sellequityid, user_default_investment_transaction_type, user_default_investment_transaction_details, user_default_investment_transaction_bank, user_default_investment_transaction_date, user_default_investment_transaction_paid_out, user_default_investment_transaction_paid_in, user_default_investment_transaction_balance, user_default_investment_transaction_paypal_transactionId, user_default_investment_transaction_withdraw_status, user_default_investment_transaction_currency_code, user_default_investment_transaction_profiles_id', 'required'),


			array('user_default_investment_transaction_sellequityid, user_default_investment_transaction_profiles_id', 'numerical', 'integerOnly'=>true),


			array('user_default_investment_transaction_bank', 'length', 'max'=>50),


			array('user_default_investment_transaction_paid_out, user_default_investment_transaction_paid_in, user_default_investment_transaction_balance', 'length', 'max'=>10),


			array('user_default_investment_transaction_paypal_transactionId', 'length', 'max'=>150),


			array('user_default_investment_transaction_currency_code', 'length', 'max'=>3),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_investment_transaction_id, user_default_investment_transaction_sellequityid, user_default_investment_transaction_type, user_default_investment_transaction_details, user_default_investment_transaction_bank, user_default_investment_transaction_date, user_default_investment_transaction_paid_out, user_default_investment_transaction_paid_in, user_default_investment_transaction_balance, user_default_investment_transaction_paypal_transactionId, user_default_investment_transaction_withdraw_status, user_default_investment_transaction_currency_code, user_default_investment_transaction_profiles_id', 'safe', 'on'=>'search'),
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

			'user_default_investment_transaction_id' => 'User Default Investment Transaction',


			'user_default_investment_transaction_sellequityid' => 'User Default Investment Transaction Sellequityid',


			'user_default_investment_transaction_type' => 'User Default Investment Transaction Type',


			'user_default_investment_transaction_details' => 'User Default Investment Transaction Details',


			'user_default_investment_transaction_bank' => 'User Default Investment Transaction Bank',


			'user_default_investment_transaction_date' => 'User Default Investment Transaction Date',


			'user_default_investment_transaction_paid_out' => 'User Default Investment Transaction Paid Out',


			'user_default_investment_transaction_paid_in' => 'User Default Investment Transaction Paid In',


			'user_default_investment_transaction_balance' => 'User Default Investment Transaction Balance',


			'user_default_investment_transaction_paypal_transactionId' => 'User Default Investment Transaction Paypal Transaction',


			'user_default_investment_transaction_withdraw_status' => 'User Default Investment Transaction Withdraw Status',


			'user_default_investment_transaction_currency_code' => 'User Default Investment Transaction Currency Code',


			'user_default_investment_transaction_profiles_id' => 'User Default Investment Transaction Profiles',


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

		$criteria->compare('user_default_investment_transaction_id',$this->user_default_investment_transaction_id,true);
		$criteria->compare('user_default_investment_transaction_sellequityid',$this->user_default_investment_transaction_sellequityid);
		$criteria->compare('user_default_investment_transaction_type',$this->user_default_investment_transaction_type,true);
		$criteria->compare('user_default_investment_transaction_details',$this->user_default_investment_transaction_details,true);
		$criteria->compare('user_default_investment_transaction_bank',$this->user_default_investment_transaction_bank,true);
		$criteria->compare('user_default_investment_transaction_date',$this->user_default_investment_transaction_date,true);
		$criteria->compare('user_default_investment_transaction_paid_out',$this->user_default_investment_transaction_paid_out,true);
		$criteria->compare('user_default_investment_transaction_paid_in',$this->user_default_investment_transaction_paid_in,true);
		$criteria->compare('user_default_investment_transaction_balance',$this->user_default_investment_transaction_balance,true);
		$criteria->compare('user_default_investment_transaction_paypal_transactionId',$this->user_default_investment_transaction_paypal_transactionId,true);
		$criteria->compare('user_default_investment_transaction_withdraw_status',$this->user_default_investment_transaction_withdraw_status,true);
		$criteria->compare('user_default_investment_transaction_currency_code',$this->user_default_investment_transaction_currency_code,true);
		$criteria->compare('user_default_investment_transaction_profiles_id',$this->user_default_investment_transaction_profiles_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorFinancial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
