
<?php


/**
 * This is the model class for table "{{listing_marketing}}".
 *
 * The followings are the available columns in table '{{listing_marketing}}':

 * @property integer $user_default_listing_marketing_id


 * @property integer $user_default_listing_id


 * @property string $user_default_listing_marketing_question


 * @property string $user_default_listing_marketing_question_submission_date


 * @property string $user_default_listing_marketing_question_end_date


 * @property integer $user_default_listing_marketing_question_access_days


 * @property string $user_default_listing_marketing_question_access_cost



 *
 * The followings are the available model relations:

 * @property ListingMarketingConnection[] $listingMarketingConnections



 */
class Marketing extends CActiveRecord

{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{listing_marketing}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('user_default_listing_id, user_default_listing_marketing_question, user_default_listing_marketing_question_submission_date', 'required'),




            array('user_default_listing_marketing_question_access_cost', 'length', 'max'=>10),


            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_default_listing_marketing_id, user_default_listing_id, user_default_listing_marketing_question, user_default_listing_marketing_question_submission_date, user_default_listing_marketing_question_end_date, user_default_listing_marketing_question_access_cost', 'safe', 'on'=>'search'),
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

            'listingMarketingConnections' => array(self::HAS_MANY, 'ListingMarketingConnection', 'user_default_listing_marketing_question_id'),


        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(

            'user_default_listing_marketing_id' => 'User Default Listing Marketing',


            'user_default_listing_id' => 'User Default Listing',


            'user_default_listing_marketing_question' => 'User Default Listing Marketing Question',


            'user_default_listing_marketing_question_submission_date' => 'User Default Listing Marketing Question Submission Date',


            'user_default_listing_marketing_question_end_date' => 'User Default Listing Marketing Question End Date',


            'user_default_listing_marketing_question_access_cost' => 'User Default Listing Marketing Question Access Cost',


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

        $criteria->compare('user_default_listing_marketing_id',$this->user_default_listing_marketing_id);
        $criteria->compare('user_default_listing_id',$this->user_default_listing_id);
        $criteria->compare('user_default_listing_marketing_question',$this->user_default_listing_marketing_question,true);
        $criteria->compare('user_default_listing_marketing_question_submission_date',$this->user_default_listing_marketing_question_submission_date,true);
        $criteria->compare('user_default_listing_marketing_question_end_date',$this->user_default_listing_marketing_question_end_date,true);
        $criteria->compare('user_default_listing_marketing_question_access_cost',$this->user_default_listing_marketing_question_access_cost,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Marketing the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
