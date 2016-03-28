
<?php


/**
 * This is the model class for table "{{investor_messages}}".
 *
 * The followings are the available columns in table '{{investor_messages}}':

 * @property integer $id


 * @property integer $user_default_listing_id


 * @property string $subject


 * @property string $message


 * @property integer $user_default_investor_id


 * @property string $user_default_investor_user_type


 * @property string $attachement


 * @property string $is_spam


 * @property string $first_message


 * @property string $notice_flag


 * @property string $close_msg_flag


 * @property string $created_date


 * @property integer $parent_message_id



 */
class InvestorMessages extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{investor_messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('user_default_listing_id, subject, message, user_default_investor_id, user_default_investor_user_type, notice_flag, created_date, parent_message_id', 'required'),


			array('user_default_listing_id, user_default_investor_id, parent_message_id', 'numerical', 'integerOnly'=>true),


			array('subject', 'length', 'max'=>250),


			array('user_default_investor_user_type', 'length', 'max'=>9),


			array('attachement', 'length', 'max'=>255),


			array('is_spam, first_message, notice_flag, close_msg_flag', 'length', 'max'=>1),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_default_listing_id, subject, message, user_default_investor_id, user_default_investor_user_type, attachement, is_spam, first_message, notice_flag, close_msg_flag, created_date, parent_message_id', 'safe', 'on'=>'search'),
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

			'id' => 'ID',


			'user_default_listing_id' => 'User Default Listing',


			'subject' => 'Subject',


			'message' => 'Message',


			'user_default_investor_id' => 'User Default Investor',


			'user_default_investor_user_type' => 'User Default Investor User Type',


			'attachement' => 'Attachement',


			'is_spam' => 'Is Spam',


			'first_message' => 'First Message',


			'notice_flag' => 'Notice Flag',


			'close_msg_flag' => 'Close Msg Flag',


			'created_date' => 'Created Date',


			'parent_message_id' => 'Parent Message',


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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('user_default_investor_id',$this->user_default_investor_id);
		$criteria->compare('user_default_investor_user_type',$this->user_default_investor_user_type,true);
		$criteria->compare('attachement',$this->attachement,true);
		$criteria->compare('is_spam',$this->is_spam,true);
		$criteria->compare('first_message',$this->first_message,true);
		$criteria->compare('notice_flag',$this->notice_flag,true);
		$criteria->compare('close_msg_flag',$this->close_msg_flag,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('parent_message_id',$this->parent_message_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
