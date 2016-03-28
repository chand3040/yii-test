
<?php



/**

 * This is the model class for table "{{financial}}".

 *

 * The followings are the available columns in table '{{financial}}':


 * @property string $user_default_transaction_id


 * @property string $user_default_transaction_type


 * @property string $user_default_transaction_details


 * @property string $user_default_transaction_bank


 * @property string $user_default_transaction_date


 * @property string $user_default_transaction_paid_out


 * @property string $user_default_transaction_paid_in


 * @property string $user_default_transaction_balance


 * @property string $user_default_transaction_paypal_transactionId


 * @property string $user_default_financial_transaction_withdraw_status


 * @property string $user_default_financial_transaction_currency_code


 * @property integer $user_default_transaction_profile_id



 *

 * The followings are the available model relations:


 * @property Profiles $userDefaultTransactionProfile



 */

class UserFinancialTransaction extends CActiveRecord

{

	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return '{{financial}}';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(


			array('user_default_transaction_type, user_default_transaction_details, user_default_transaction_bank, user_default_transaction_date, user_default_transaction_paid_out, user_default_transaction_paid_in, user_default_transaction_balance, user_default_transaction_paypal_transactionId, user_default_financial_transaction_withdraw_status, user_default_financial_transaction_currency_code, user_default_transaction_profile_id', 'required'),


			array('user_default_transaction_profile_id', 'numerical', 'integerOnly'=>true),


			array('user_default_transaction_bank', 'length', 'max'=>50),


			array('user_default_transaction_paid_out, user_default_transaction_paid_in, user_default_transaction_balance', 'length', 'max'=>10),


			array('user_default_transaction_paypal_transactionId', 'length', 'max'=>150),


			array('user_default_financial_transaction_currency_code', 'length', 'max'=>3),


			// The following rule is used by search().

			// @todo Please remove those attributes that should not be searched.

			array('user_default_transaction_id, user_default_transaction_type, user_default_transaction_details, user_default_transaction_bank, user_default_transaction_date, user_default_transaction_paid_out, user_default_transaction_paid_in, user_default_transaction_balance, user_default_transaction_paypal_transactionId, user_default_financial_transaction_withdraw_status, user_default_financial_transaction_currency_code, user_default_transaction_profile_id', 'safe', 'on'=>'search'),

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


			'userDefaultTransactionProfile' => array(self::BELONGS_TO, 'Profiles', 'user_default_transaction_profile_id'),


		);

	}



	/**

	 * @return array customized attribute labels (name=>label)

	 */

	public function attributeLabels()

	{

		return array(


			'user_default_transaction_id' => 'User Default Transaction',


			'user_default_transaction_type' => 'User Default Transaction Type',


			'user_default_transaction_details' => 'User Default Transaction Details',


			'user_default_transaction_bank' => 'User Default Transaction Bank',


			'user_default_transaction_date' => 'User Default Transaction Date',


			'user_default_transaction_paid_out' => 'User Default Transaction Paid Out',


			'user_default_transaction_paid_in' => 'User Default Transaction Paid In',


			'user_default_transaction_balance' => 'User Default Transaction Balance',


			'user_default_transaction_paypal_transactionId' => 'User Default Transaction Paypal Transaction',


			'user_default_financial_transaction_withdraw_status' => 'User Default Financial Transaction Withdraw Status',


			'user_default_financial_transaction_currency_code' => 'User Default Financial Transaction Currency Code',


			'user_default_transaction_profile_id' => 'User Default Transaction Profile',


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



		$criteria->compare('user_default_transaction_id',$this->user_default_transaction_id,true);
		$criteria->compare('user_default_transaction_type',$this->user_default_transaction_type,true);
		$criteria->compare('user_default_transaction_details',$this->user_default_transaction_details,true);
		$criteria->compare('user_default_transaction_bank',$this->user_default_transaction_bank,true);
		$criteria->compare('user_default_transaction_date',$this->user_default_transaction_date,true);
		$criteria->compare('user_default_transaction_paid_out',$this->user_default_transaction_paid_out,true);
		$criteria->compare('user_default_transaction_paid_in',$this->user_default_transaction_paid_in,true);
		$criteria->compare('user_default_transaction_balance',$this->user_default_transaction_balance,true);
		$criteria->compare('user_default_transaction_paypal_transactionId',$this->user_default_transaction_paypal_transactionId,true);
		$criteria->compare('user_default_financial_transaction_withdraw_status',$this->user_default_financial_transaction_withdraw_status,true);
		$criteria->compare('user_default_financial_transaction_currency_code',$this->user_default_financial_transaction_currency_code,true);
		$criteria->compare('user_default_transaction_profile_id',$this->user_default_transaction_profile_id);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}




	/**

	 * Returns the static model of the specified AR class.

	 * Please note that you should have this exact method in all your CActiveRecord descendants!

	 * @param string $className active record class name.

	 * @return UserFinancialTransaction the static model class

	 */

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}

    public static function lastTransactionCode()
    {
        $lastTransaction = UserFinancialTransaction::model()->findAll("user_id=:userid", array(":userid" => Yii::app()->user->id));

        return ($lastTransaction) ? $lastTransaction[0]['trans_currency_code'] : '';
    }

}

