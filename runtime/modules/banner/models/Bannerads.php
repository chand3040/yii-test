
<?php



/**

 * This is the model class for table "{{banner_ads}}".

 *

 * The followings are the available columns in table '{{banner_ads}}':


 * @property integer $user_default_listing_banner_id


 * @property integer $user_default_id


 * @property string $user_default_listing_banner_submission_date


 * @property string $user_default_listing_banner_path


 * @property integer $user_default_listing_banner_duration


 * @property string $user_default_listing_banner_cost


 * @property string $user_default_listing_banner_status


 * @property string $user_default_listing_banner_link


 * @property integer $user_default_listing_banner_clicks


 * @property integer $user_default_listing_id


 *

 * The followings are the available model relations:


 * @property Listing $userDefaultListing


 * @property Profiles $userDefault



 */

class Bannerads extends CActiveRecord

{

	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return '{{banner_ads}}';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(


			array('user_default_id, user_default_listing_banner_submission_date, user_default_listing_banner_path, user_default_listing_banner_duration, user_default_listing_banner_cost, user_default_listing_banner_clicks, user_default_listing_id', 'required'),


			array('user_default_id, user_default_listing_banner_clicks, user_default_listing_id', 'numerical', 'integerOnly'=>true),


			array('user_default_listing_banner_path, user_default_listing_banner_link', 'length', 'max'=>100),


			array('user_default_listing_banner_cost', 'length', 'max'=>10),


			array('user_default_listing_banner_status', 'length', 'max'=>1),


			// The following rule is used by search().

			// @todo Please remove those attributes that should not be searched.

			array('user_default_listing_banner_id, user_default_id, user_default_listing_banner_submission_date, user_default_listing_banner_path, user_default_listing_banner_duration, user_default_listing_banner_cost, user_default_listing_banner_status, user_default_listing_banner_link, user_default_listing_banner_clicks, user_default_listing_id', 'safe', 'on'=>'search'),

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


			'userDefaultListing' => array(self::BELONGS_TO, 'Listing', 'user_default_listing_id'),


			'userDefault' => array(self::BELONGS_TO, 'Profiles', 'user_default_id'),


		);

	}



	/**

	 * @return array customized attribute labels (name=>label)

	 */

	public function attributeLabels()

	{

		return array(


			'user_default_listing_banner_id' => 'User Default Listing Banner',


			'user_default_id' => 'User Default',


			'user_default_listing_banner_submission_date' => 'User Default Listing Banner Submission Date',


			'user_default_listing_banner_path' => 'User Default Listing Banner Path',


			'user_default_listing_banner_duration' => 'User Default Listing Banner Duration',


			'user_default_listing_banner_cost' => 'User Default Listing Banner Cost',


			'user_default_listing_banner_status' => 'User Default Listing Banner Status',


			'user_default_listing_banner_link' => 'User Default Listing Banner Link',


			'user_default_listing_banner_clicks' => 'User Default Listing Banner Clicks',


			'user_default_listing_id' => 'User Default Listing',


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



		$criteria->compare('user_default_listing_banner_id',$this->user_default_listing_banner_id);
		$criteria->compare('user_default_id',$this->user_default_id);
		$criteria->compare('user_default_listing_banner_submission_date',$this->user_default_listing_banner_submission_date,true);
		$criteria->compare('user_default_listing_banner_path',$this->user_default_listing_banner_path,true);
		$criteria->compare('user_default_listing_banner_duration',$this->user_default_listing_banner_duration);
		$criteria->compare('user_default_listing_banner_cost',$this->user_default_listing_banner_cost,true);
		$criteria->compare('user_default_listing_banner_status',$this->user_default_listing_banner_status,true);
		$criteria->compare('user_default_listing_banner_link',$this->user_default_listing_banner_link,true);
		$criteria->compare('user_default_listing_banner_clicks',$this->user_default_listing_banner_clicks);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id);



		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}




	/**

	 * Returns the static model of the specified AR class.

	 * Please note that you should have this exact method in all your CActiveRecord descendants!

	 * @param string $className active record class name.

	 * @return Bannerads the static model class

	 */

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}

}

