
<?php


/**
 * This is the model class for table "{{investor_admin}}".
 *
 * The followings are the available columns in table '{{investor_admin}}':

 * @property integer $user_default_investor_admin_id


 * @property integer $user_default_investor_admin_profiles_id


 * @property string $user_default_investor_admin_status


 * @property string $user_default_investor_admin_created_date



 *
 * The followings are the available model relations:

 * @property Profiles $userDefaultInvestorAdminProfiles


 * @property InvestorVotingInterface[] $investorVotingInterfaces



 */
class InvestorAdmin extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{investor_admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_investor_admin_profiles_id, user_default_investor_admin_status, user_default_investor_admin_created_date', 'required'),


			array('user_default_investor_admin_profiles_id', 'numerical', 'integerOnly'=>true),


			array('user_default_investor_admin_status', 'length', 'max'=>1),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_investor_admin_id, user_default_investor_admin_profiles_id, user_default_investor_admin_status, user_default_investor_admin_created_date', 'safe', 'on'=>'search'),
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

			'userDefaultInvestorAdminProfiles' => array(self::BELONGS_TO, 'Profiles', 'user_default_investor_admin_profiles_id'),


			'investorVotingInterfaces' => array(self::HAS_MANY, 'InvestorVotingInterface', 'user_default_investor_admin_id'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(

			'user_default_investor_admin_id' => 'User Default Investor Admin',


			'user_default_investor_admin_profiles_id' => 'User Default Investor Admin Profiles',


			'user_default_investor_admin_status' => 'User Default Investor Admin Status',


			'user_default_investor_admin_created_date' => 'User Default Investor Admin Created Date',


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

		$criteria->compare('user_default_investor_admin_id',$this->user_default_investor_admin_id);
		$criteria->compare('user_default_investor_admin_profiles_id',$this->user_default_investor_admin_profiles_id);
		$criteria->compare('user_default_investor_admin_status',$this->user_default_investor_admin_status,true);
		$criteria->compare('user_default_investor_admin_created_date',$this->user_default_investor_admin_created_date,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorAdmin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
