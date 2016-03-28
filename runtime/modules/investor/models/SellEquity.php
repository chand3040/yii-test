
<?php


/**
 * This is the model class for table "{{sell_equity}}".
 *
 * The followings are the available columns in table '{{sell_equity}}':

 * @property integer $id


 * @property string $starting_bid


 * @property integer $duration


 * @property string $insertion_fee


 * @property string $final_valuation_fee


 * @property string $datetime


 * @property integer $profiles_id



 */
class SellEquity extends CActiveRecord

{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sell_equity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			array('starting_bid, duration, insertion_fee, final_valuation_fee, datetime, profiles_id', 'required'),


			array('duration, profiles_id', 'numerical', 'integerOnly'=>true),


			array('starting_bid, insertion_fee, final_valuation_fee', 'length', 'max'=>10),


			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, starting_bid, duration, insertion_fee, final_valuation_fee, datetime, profiles_id', 'safe', 'on'=>'search'),
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


			'starting_bid' => 'Starting Bid',


			'duration' => 'Duration',


			'insertion_fee' => 'Insertion Fee',


			'final_valuation_fee' => 'Final Valuation Fee',


			'datetime' => 'Datetime',


			'profiles_id' => 'Profiles',


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
		$criteria->compare('starting_bid',$this->starting_bid,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('insertion_fee',$this->insertion_fee,true);
		$criteria->compare('final_valuation_fee',$this->final_valuation_fee,true);
		$criteria->compare('datetime',$this->datetime,true);
		$criteria->compare('profiles_id',$this->profiles_id);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SellEquity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
