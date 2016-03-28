
<?php


/**
 * This is the model class for table "{{investor_messages_sent}}".
 *
 * The followings are the available columns in table '{{investor_messages_sent}}':

 * @property integer $id


 * @property integer $msg_id


 * @property integer $sender_investor_id


 * @property integer $receiver_investor_id



 */
class InvestorMessagesSent extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{investor_messages_sent}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('msg_id, sender_investor_id, receiver_investor_id', 'required'),


			array('msg_id, sender_investor_id, receiver_investor_id', 'numerical', 'integerOnly'=>true),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, msg_id, sender_investor_id, receiver_investor_id', 'safe', 'on'=>'search'),
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


			'msg_id' => 'Msg',


			'sender_investor_id' => 'Sender Investor',


			'receiver_investor_id' => 'Receiver Investor',


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
		$criteria->compare('msg_id',$this->msg_id);
		$criteria->compare('sender_investor_id',$this->sender_investor_id);
		$criteria->compare('receiver_investor_id',$this->receiver_investor_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorMessagesSent the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
