<?php

class Samplefeedback extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Createuserlisting the static model class
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
        return '{{sample_listing_feedbacks}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_default_sample_listing_id', 'required'),
            array('user_default_sample_listing_feedback_id,user_default_sample_listing_id,user_default_profiles_id,user_default_feedback_likes_total,user_default_feedback_dislikes_total', 'numerical', 'integerOnly' => true),
            array('user_default_sample_listing_feedback_message', 'length', 'max' => 21845),
            array('user_default_sample_listing_feedback_id,user_default_sample_listing_id, user_default_profiles_id, user_default_sample_listing_feedback_message, user_default_sample_listing_feedback_rating,user_default_feedback_likes_total, user_default_feedback_dislikes_total,user_default_first_feedback, user_default_parent_id, user_default_sample_listing_feedback_date', 'safe', 'on' => 'search'),
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
            'user_default_sample_listing_feedback_id' => 'Lid',
            'user_default_sample_listing_id' => ' Lid',
            'user_default_profiles_id' => ' User id',
            'user_default_sample_listing_feedback_message' => ' Message',
            'user_default_sample_listing_feedback_rating' => ' Rating',
            'user_default_feedback_likes_total' => ' likes',
            'user_default_feedback_dislikes_total' => ' dislikes',
            'user_default_first_feedback' => ' first feedback',
            'user_default_parent_id' => ' Parent',
            'user_default_sample_listing_feedback_date' => ' date',

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

        $criteria->compare('user_default_sample_listing_feedback_id', $this->user_default_sample_listing_feedback_id);
        $criteria->compare('user_default_sample_listing_id', $this->user_default_sample_listing_id, true);
        $criteria->compare('user_default_profiles_id', $this->user_default_profiles_id, true);
        $criteria->compare('user_default_sample_listing_feedback_message', $this->user_default_sample_listing_feedback_message, true);
        $criteria->compare('user_default_sample_listing_feedback_rating', $this->user_default_sample_listing_feedback_rating, true);
        $criteria->compare('user_default_feedback_likes_total', $this->user_default_feedback_likes_total, true);
        $criteria->compare('user_default_feedback_dislikes_total', $this->user_default_feedback_dislikes_total, true);
        $criteria->compare('user_default_first_feedback', $this->user_default_first_feedback, true);
        $criteria->compare('user_default_parent_id', $this->user_default_parent_id, true);
        $criteria->compare('user_default_sample_listing_feedback_date', $this->user_default_sample_listing_feedback_date, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}