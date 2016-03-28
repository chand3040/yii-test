
<?php


/**
 * This is the model class for table "{{investor_voting_interface}}".
 *
 * The followings are the available columns in table '{{investor_voting_interface}}':

 * @property integer $user_default_investor_voting_id


 * @property string $user_default_investor_voting_question


 * @property string $user_default_investor_voting_answer1


 * @property string $user_default_investor_voting_answer2


 * @property integer $user_default_investor_voting_nodays_open


 * @property integer $user_default_investor_voting_listing_id


 * @property integer $user_default_investor_admin_id



 *
 * The followings are the available model relations:

 * @property Listing $userDefaultInvestorVotingListing


 * @property InvestorAdmin $userDefaultInvestorAdmin



 */
class InvestorVotingInterface extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{investor_voting_interface}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_investor_voting_question, user_default_investor_voting_answer1, user_default_investor_voting_answer2, user_default_investor_voting_nodays_open, user_default_investor_voting_listing_id, user_default_investor_admin_id', 'required'),


			array('user_default_investor_voting_nodays_open, user_default_investor_voting_listing_id, user_default_investor_admin_id', 'numerical', 'integerOnly'=>true),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_default_investor_voting_id, user_default_investor_voting_question, user_default_investor_voting_answer1, user_default_investor_voting_answer2, user_default_investor_voting_nodays_open, user_default_investor_voting_listing_id, user_default_investor_admin_id', 'safe', 'on'=>'search'),
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

			'userDefaultInvestorVotingListing' => array(self::BELONGS_TO, 'Listing', 'user_default_investor_voting_listing_id'),


			'userDefaultInvestorAdmin' => array(self::BELONGS_TO, 'InvestorAdmin', 'user_default_investor_admin_id'),


		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(

			'user_default_investor_voting_id' => 'User Default Investor Voting',


			'user_default_investor_voting_question' => 'User Default Investor Voting Question',


			'user_default_investor_voting_answer1' => 'User Default Investor Voting Answer1',


			'user_default_investor_voting_answer2' => 'User Default Investor Voting Answer2',


			'user_default_investor_voting_nodays_open' => 'User Default Investor Voting Nodays Open',


			'user_default_investor_voting_listing_id' => 'User Default Investor Voting Listing',


			'user_default_investor_admin_id' => 'User Default Investor Admin',


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

		$criteria->compare('user_default_investor_voting_id',$this->user_default_investor_voting_id);
		$criteria->compare('user_default_investor_voting_question',$this->user_default_investor_voting_question,true);
		$criteria->compare('user_default_investor_voting_answer1',$this->user_default_investor_voting_answer1,true);
		$criteria->compare('user_default_investor_voting_answer2',$this->user_default_investor_voting_answer2,true);
		$criteria->compare('user_default_investor_voting_nodays_open',$this->user_default_investor_voting_nodays_open);
		$criteria->compare('user_default_investor_voting_listing_id',$this->user_default_investor_voting_listing_id);
		$criteria->compare('user_default_investor_admin_id',$this->user_default_investor_admin_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorVotingInterface the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
