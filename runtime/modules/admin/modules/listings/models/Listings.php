<?php

/**
 * This is the model class for table "{{listing}}".
 *
 * The followings are the available columns in table '{{listing}}':
 * @property integer $drg_lid
 * @property string $drg_uid
 * @property string $drg_category
 * @property string $drg_profession
 * @property string $drg_viewlimit
 * @property string $drg_logo
 * @property string $drg_title
 * @property string $drg_desc
 * @property string $drg_explanation
 * @property string $drg_businessidea
 * @property string $drg_fprojections
 * @property string $drg_favailable
 * @property string $drg_famount
 * @property integer $drg_financial_data
 * @property string $drg_want
 * @property string $drg_keyword
 * @property string $drg_video1
 * @property string $drg_video2
 * @property string $drg_mktquestion
 * @property string $drg_mktqstatus
 * @property string $drg_reporttime
 * @property string $drg_date
 * @property string $drg_datetime
 * @property string $drg_status
 * @property string $drg_lstatus
 * @property string $drg_listtype
 * @property string $drg_company_name
 * @property string $drg_company_address1
 * @property string $drg_company_address2
 * @property string $drg_company_address3
 * @property string $drg_company_town
 * @property string $drg_company_county
 * @property string $drg_company_zip_code
 * @property string $drg_company_country
 * @property string $drg_company_tel_no
 * @property string $drg_company_fax_no
 * @property integer $drg_listingstatus
 * @property string $drg_approvedate
 * @property integer $reject_list
 */
class Listings extends CActiveRecord
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
        return '{{listing}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_default_profiles_id', 'required'),
            array('user_default_listing_notification_frequency,user_default_listing_id,user_default_listing_category_id,user_default_listing_lookingfor_id,user_default_listing_limit_viewing_id,user_default_listing_days_active,user_default_listing_days_inactive,user_default_listing_page_hits,user_default_profiles_id,user_default_listing_likes,user_default_listing_dislikes,user_default_listing_total_votes', 'numerical', 'integerOnly' => true),
            array('user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail,user_default_listing_access_period', 'length', 'max' => 50),
            array('user_default_listing_summary,user_default_listing_fprojections', 'length', 'max' => 21845),
            array('user_default_listing_title,user_default_listing_approvedate,user_default_listing_date', 'length', 'max' => 100),
            array('user_default_listing_details', 'length', 'max' => 5592415),
            array('user_default_listing_want,user_default_listing_keywords', 'length', 'max' => 255),
            array('user_default_listing_what_is_it', 'length', 'max' => 85),
            array('user_default_listing_table_currency_code', 'length', 'max' => 3),
            /*
            array('user_default_listing_title, user_default_listing_desc, user_default_listing_company_town, user_default_listing_company_country, user_default_listing_approvedate', 'length', 'max'=>100),


                        array('user_default_listing_summary, user_default_listing_want, user_default_listing_company_address1, user_default_listing_company_address2, user_default_listing_company_address3', 'length', 'max'=>500),
                        array('user_default_listing_details, user_default_listing_listtype', 'length', 'max'=>1),
                        array('user_default_listing_table_currency_code, user_default_listing_reporttime', 'length', 'max'=>10),
                        array('user_default_listing_company_tel_no', 'length', 'max'=>30),
                        */
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('user_default_listing_id, user_default_listing_category_id, user_default_listing_lookingfor_id, user_default_listing_limit_viewing_id, user_default_listing_thumbnail, user_default_listing_title,user_default_listing_what_is_it, user_default_listing_summary,user_default_listing_details,user_default_listing_financial_table_status,user_default_listing_fprojections,user_default_listing_table_currency_code,user_default_listing_want,user_default_listing_keywords, user_default_listing_notification_frequency,user_default_listing_submission_status,user_default_listing_days_active,user_default_listing_days_inactive,user_default_listing_page_hits,user_default_profiles_id,user_default_listing_likes,user_default_listing_dislikes,user_default_listing_total_votes,user_default_listing_access_period,user_default_listing_approvedate,user_default_listing_date', 'safe', 'on' => 'search'),
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
            'user_default_listing_id' => 'Lid',
            'user_default_listing_category_id' => ' Category',
            'user_default_listing_lookingfor_id' => ' Looking For',
            'user_default_listing_limit_viewing_id' => ' Viewlimit',
            'user_default_listing_thumbnail' => ' Logo',
            'user_default_listing_title' => ' Title',
            'user_default_listing_what_is_it' => ' What is it',
            'user_default_listing_summary' => ' Explanation',
            'user_default_listing_details' => ' Details',
            'user_default_listing_financial_table_status' => ' Financial table',
            'user_default_listing_fprojections' => ' Financial Projections',
            'user_default_listing_table_currency_code' => ' Currency',
            'user_default_listing_want' => ' Want',
            'user_default_listing_keywords' => ' Keyword',
            'user_default_listing_notification_frequency' => ' Frequency',
            'user_default_listing_submission_status' => ' status',
            'user_default_listing_days_active' => ' DA',
            'user_default_listing_days_inactive' => ' DIA',
            'user_default_listing_page_hits' => ' Page Hits',
            'user_default_profiles_id' => ' Uid',
            'user_default_listing_dislikes' => ' dislikes',
            'user_default_listing_total_votes' => ' votes',
            'user_default_listing_access_period' => ' access period',
            'user_default_listing_approvedate' => ' approve date',
            'user_default_listing_date' => ' Date',

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

        $criteria->compare('user_default_listing_id', $this->user_default_listing_id);
        //$criteria->compare('user_default_listing_category_id',$this->user_default_listing_category_id,true);
        $criteria->compare('user_default_listing_lookingfor_id', $this->user_default_listing_lookingfor_id, true);
        $criteria->compare('user_default_listing_limit_viewing_id', $this->user_default_listing_limit_viewing_id, true);
        $criteria->compare('user_default_listing_thumbnail', $this->user_default_listing_thumbnail, true);
        $criteria->compare('user_default_listing_title', $this->user_default_listing_title, true);
        $criteria->compare('user_default_listing_what_is_it', $this->user_default_listing_what_is_it, true);
        $criteria->compare('user_default_listing_summary', $this->user_default_listing_summary, true);
        $criteria->compare('user_default_listing_details', $this->user_default_listing_details, true);
        $criteria->compare('user_default_listing_financial_table_status', $this->user_default_listing_financial_table_status, true);
        $criteria->compare('user_default_listing_fprojections', $this->user_default_listing_fprojections, true);
        $criteria->compare('user_default_listing_table_currency_code', $this->user_default_listing_table_currency_code, true);
        $criteria->compare('user_default_listing_want', $this->user_default_listing_want, true);
        $criteria->compare('user_default_listing_keywords', $this->user_default_listing_keywords);
        $criteria->compare('user_default_listing_notification_frequency', $this->user_default_listing_notification_frequency, true);
        $criteria->compare('user_default_listing_submission_status', $this->user_default_listing_submission_status, true);
        $criteria->compare('user_default_listing_days_active', $this->user_default_listing_days_active, true);
        $criteria->compare('user_default_listing_days_inactive', $this->user_default_listing_days_inactive, true);
        $criteria->compare('user_default_listing_page_hits', $this->user_default_listing_page_hits, true);
        $criteria->compare('user_default_profiles_id', $this->user_default_profiles_id, true);
        $criteria->compare('user_default_listing_likes', $this->user_default_listing_likes, true);
        $criteria->compare('user_default_listing_dislikes', $this->user_default_listing_dislikes, true);
        $criteria->compare('user_default_listing_total_votes', $this->user_default_listing_total_votes, true);
        $criteria->compare('user_default_listing_access_period', $this->user_default_listing_access_period, true);
        $criteria->compare('user_default_listing_approvedate', $this->user_default_listing_approvedate, true);
        $criteria->compare('user_default_listing_date', $this->user_default_listing_date, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getProfessionUserListingCount($professionId, $month)
    {

        $criteria = new CDbCriteria;
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_profession = t.profession_id)";
        $criteria->join .= "INNER JOIN user_default_listing AS listing ON (listing.user_default_profiles_id = profile.user_default_id)";
        $criteria->addCondition('t.profession_id=' . $professionId . ' AND MONTH(listing.user_default_listing_date)=' . $month . ' AND Year(listing.user_default_listing_date)=' . date('Y'));

        $resultProfessionUsers = Profession::model()->count($criteria);
        return $resultProfessionUsers;
    }

    public static function getProfessionUserListingCountOnline($professionId)
    {
        $criteria = new CDbCriteria;

        $criteria->select = 't.log_id';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_id)";
        $criteria->join .= "INNER JOIN user_default_listing AS listing ON (listing.user_default_profiles_id = profile.user_default_id)";
        $criteria->condition = "profile.user_default_profession = '" . $professionId . "' AND t.datetime > SUBTIME('" . date('Y-m-d H:i:s') . "', '00:30:00') AND t.log_id <> 14";
        $criteria->group = "profile.user_default_id";

        $user_activity = ActivityLog::model()->findAll($criteria);
        if ($user_activity) {
            return count($user_activity);
        } else
            return 0;
    }

    public static function getToDateProfessionUsersListingCount($professionId)
    {
        $criteria = new CDbCriteria;

        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_profession = t.profession_id)";
        $criteria->join .= "INNER JOIN user_default_listing AS listing ON (listing.user_default_profiles_id = profile.user_default_id)";
        $criteria->addCondition('t.profession_id=' . $professionId . ' AND Year(profile.user_default_registration_date) < ' . date('Y'));

        $resultProfessionUsers = Profession::model()->count($criteria);
        return $resultProfessionUsers;
    }
}