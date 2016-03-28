<?php

/**
 * This is the model class for table "{{listing_images}}".
 *
 * The followings are the available columns in table '{{listing_images}}':
 * @property integer $user_default_listing_image_id
 * @property string $user_default_listing_image
 * @property string $user_default_listing_image_text
 * @property string $user_default_listing_image_link1
 * @property string $user_default_listing_image_link2
 * @property integer $user_default_listing_id
 * @property integer $order_id
 */
class Userlistingmarketing extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Userlistingimages the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

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
            array('user_default_listing_marketing_question, user_default_listing_id,', 'required'),
            array('user_default_listing_id, user_default_listing_marketing_question_business_user_votes, user_default_listing_marketing_question_consumer_votes, user_default_listing_marketing_question_entrepreneur_votes, 	user_default_listing_marketing_question_investor_votes', 'numerical', 'integerOnly' => true),
            array('user_default_listing_marketing_question', 'length', 'max' => 500),
            array('user_default_listing_marketing_question_submission_date, user_default_listing_marketing_question_end_date', 'length', 'max' => 50),
            array('	user_default_listing_marketing_question_access_cost', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_default_listing_marketing_id, user_default_listing_id, user_default_listing_marketing_question, user_default_listing_marketing_question_business_user_votes, user_default_listing_marketing_question_consumer_votes, user_default_listing_marketing_question_entrepreneur_votes, user_default_listing_marketing_question_investor_votes, user_default_listing_marketing_question_submission_date, user_default_listing_marketing_question_end_date, user_default_listing_marketing_question_access_cost', 'safe', 'on' => 'search'),
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
            'user_default_listing_marketing_id' => 'ID',
            'user_default_listing_id' => 'Listing ID',
            'user_default_listing_marketing_question' => 'Marketing Question',
            'user_default_listing_marketing_question_business_user_votes' => 'User Votes',
            'user_default_listing_marketing_question_consumer_votes' => 'Consumer Votes',
            'user_default_listing_marketing_question_entrepreneur_votes' => 'Entrepreneur Votes',
            'user_default_listing_marketing_question_investor_votes' => 'Investor Votes',
            'user_default_listing_marketing_question_submission_date' => 'Submission Date',
            'user_default_listing_marketing_question_end_date' => 'End Date',
            'user_default_listing_marketing_question_access_cost' => 'Access Cost',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('user_default_listing_marketing_id', $this->user_default_listing_marketing_id);
        $criteria->compare('user_default_listing_id', $this->user_default_listing_id, true);
        $criteria->compare('user_default_listing_marketing_question', $this->user_default_listing_marketing_question, true);
        $criteria->compare('user_default_listing_marketing_question_business_user_votes', $this->user_default_listing_marketing_question_business_user_votes, true);
        $criteria->compare('user_default_listing_marketing_question_consumer_votes', $this->user_default_listing_marketing_question_consumer_votes, true);
        $criteria->compare('user_default_listing_marketing_question_entrepreneur_votes', $this->user_default_listing_marketing_question_entrepreneur_votes);
        $criteria->compare('user_default_listing_marketing_question_investor_votes', $this->user_default_listing_marketing_question_investor_votes, true);
        $criteria->compare('user_default_listing_marketing_question_submission_date', $this->user_default_listing_marketing_question_submission_date, true);
        $criteria->compare('user_default_listing_marketing_question_end_date', $this->user_default_listing_marketing_question_end_date, true);
        $criteria->compare('user_default_listing_marketing_question_access_cost', $this->user_default_listing_marketing_question_access_cost, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
}