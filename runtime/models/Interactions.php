<?php


/**
 * This is the model class for table "{{interactions}}".
 *
 * The followings are the available columns in table '{{interactions}}':
 * @property integer $user_default_interaction_id
 * @property string $user_default_interaction_message
 * @property integer $user_default_reputation
 * @property string $user_default_favourites
 * @property integer $user_default_profile_id
 * @property integer $user_default_listing_id
 * @property string $user_default_attachment
 * @property string $user_default_thumb_attachment
 * @property string $user_default_interactions_message
 * @property integer $user_default_likes_total
 * @property integer $user_default_dislikes_total
 * @property string $user_default_is_spam
 * @property string $user_default_date_create
 * @property string $user_default_first_interations
 *
 * The followings are the available model relations:
 * @property Listing $userDefaultListing
 * @property Profiles $userDefaultProfile
 * @property InteractionsMessages[] $interactionsMessages
 */
class Interactions extends CActiveRecord

{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{interactions}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            array('user_default_interaction_message, user_default_profile_id, user_default_listing_id, user_default_interactions_message, user_default_date_create', 'required'),


            array('user_default_reputation, user_default_profile_id, user_default_listing_id, user_default_likes_total, user_default_dislikes_total', 'numerical', 'integerOnly' => true),


            array('user_default_favourites, user_default_is_spam, user_default_first_interations', 'length', 'max' => 1),


            array('user_default_attachment', 'length', 'max' => 350),


            array('user_default_thumb_attachment', 'length', 'max' => 360),


            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_default_interaction_id, user_default_interaction_message, user_default_reputation, user_default_favourites, user_default_profile_id, user_default_listing_id, user_default_attachment, user_default_thumb_attachment, user_default_interactions_message, user_default_likes_total, user_default_dislikes_total, user_default_is_spam, user_default_date_create, user_default_first_interations', 'safe', 'on' => 'search'),
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


            'userDefaultProfile' => array(self::BELONGS_TO, 'Profiles', 'user_default_profile_id'),


            'interactionsMessages' => array(self::HAS_MANY, 'InteractionsMessages', 'user_default_interaction_id'),


        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(

            'user_default_interaction_id' => 'User Default Interaction',


            'user_default_interaction_message' => 'User Default Interaction Message',


            'user_default_reputation' => 'User Default Reputation',


            'user_default_favourites' => 'User Default Favourites',


            'user_default_profile_id' => 'User Default Profile',


            'user_default_listing_id' => 'User Default Listing',


            'user_default_attachment' => 'User Default Attachment',


            'user_default_thumb_attachment' => 'User Default Thumb Attachment',


            'user_default_interactions_message' => 'User Default Interactions Message',


            'user_default_likes_total' => 'User Default Likes Total',


            'user_default_dislikes_total' => 'User Default Dislikes Total',


            'user_default_is_spam' => 'User Default Is Spam',


            'user_default_date_create' => 'User Default Date Create',


            'user_default_first_interations' => 'User Default First Interations',


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

        $criteria = new CDbCriteria;

        $criteria->compare('user_default_interaction_id', $this->user_default_interaction_id);
        $criteria->compare('user_default_interaction_message', $this->user_default_interaction_message, true);
        $criteria->compare('user_default_reputation', $this->user_default_reputation);
        $criteria->compare('user_default_favourites', $this->user_default_favourites, true);
        $criteria->compare('user_default_profile_id', $this->user_default_profile_id);
        $criteria->compare('user_default_listing_id', $this->user_default_listing_id);
        $criteria->compare('user_default_attachment', $this->user_default_attachment, true);
        $criteria->compare('user_default_thumb_attachment', $this->user_default_thumb_attachment, true);
        $criteria->compare('user_default_interactions_message', $this->user_default_interactions_message, true);
        $criteria->compare('user_default_likes_total', $this->user_default_likes_total);
        $criteria->compare('user_default_dislikes_total', $this->user_default_dislikes_total);
        $criteria->compare('user_default_is_spam', $this->user_default_is_spam, true);
        $criteria->compare('user_default_date_create', $this->user_default_date_create, true);
        $criteria->compare('user_default_first_interations', $this->user_default_first_interations, true);


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Interactions the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
