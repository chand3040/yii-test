<?php


/**
 * This is the model class for table "{{listing_marketing_connection}}".
 *
 * The followings are the available columns in table '{{listing_marketing_connection}}':
 * @property integer $user_default_listing_marketing_connection_id
 * @property integer $user_default_listing_marketing_question_id
 * @property string $user_default_listing_marketing_vote_status
 * @property string $user_default_listing_marketing_question_vote_value
 * @property string $user_default_listing_marketing_question_access_date
 * @property integer $user_default_listing_marketing_user_id
 *
 * The followings are the available model relations:
 * @property ListingMarketing $userDefaultListingMarketingQuestion
 * @property Profiles $userDefaultListingMarketingUser
 */
class ListingMarketingConnection extends CActiveRecord
{

    public $userAddressInfo;
    public $userAddress1;


    /**
     * @return string the associated database table name
     */

    public function tableName()

    {

        return '{{listing_marketing_connection}}';

    }


    /**
     * @return array validation rules for model attributes.
     */

    public function rules()

    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(


            array('user_default_listing_marketing_question_id, user_default_listing_marketing_user_id', 'required'),


            array('user_default_listing_marketing_question_id, user_default_listing_marketing_user_id', 'numerical', 'integerOnly' => true),


            array('user_default_listing_marketing_vote_status, user_default_listing_marketing_question_vote_value', 'length', 'max' => 1),


            array('user_default_listing_marketing_question_access_date', 'safe'),


            // The following rule is used by search().

            // @todo Please remove those attributes that should not be searched.

            array('user_default_listing_marketing_connection_id, user_default_listing_marketing_question_id, user_default_listing_marketing_vote_status, user_default_listing_marketing_question_vote_value, user_default_listing_marketing_question_access_date, user_default_listing_marketing_user_id, userAddressInfo, userAddress1', 'safe', 'on' => 'search'),

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


            'userDefaultListingMarketingQuestion' => array(self::BELONGS_TO, 'ListingMarketing', 'user_default_listing_marketing_question_id'),


            'userDefaultListingMarketingUser' => array(self::BELONGS_TO, 'Profiles', 'user_default_listing_marketing_user_id'),


        );

    }


    /**
     * @return array customized attribute labels (name=>label)
     */

    public function attributeLabels()

    {

        return array(


            'user_default_listing_marketing_connection_id' => 'User Default Listing Marketing Connection',


            'user_default_listing_marketing_question_id' => 'User Default Listing Marketing Question',


            'user_default_listing_marketing_vote_status' => 'User Default Listing Marketing Vote Status',


            'user_default_listing_marketing_question_vote_value' => 'User Default Listing Marketing Question Vote Value',


            'user_default_listing_marketing_question_access_date' => 'User Default Listing Marketing Question Access Date',


            'user_default_listing_marketing_user_id' => 'User Default Listing Marketing User',


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


        $criteria->compare('user_default_listing_marketing_connection_id', $this->user_default_listing_marketing_connection_id);
        $criteria->compare('user_default_listing_marketing_question_id', $this->user_default_listing_marketing_question_id);
        $criteria->compare('user_default_listing_marketing_vote_status', $this->user_default_listing_marketing_vote_status, true);
        $criteria->compare('user_default_listing_marketing_question_vote_value', $this->user_default_listing_marketing_question_vote_value, true);
        $criteria->compare('user_default_listing_marketing_question_access_date', $this->user_default_listing_marketing_question_access_date, true);
        $criteria->compare('user_default_listing_marketing_user_id', $this->user_default_listing_marketing_user_id);


        return new CActiveDataProvider($this, array(

            'criteria' => $criteria,

        ));

    }

    // get Total Votes
    public static function getTotalVotes($question_id, $start_date, $end_date, $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        if ($userType) {
            $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }
        $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date)';
        $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date);

        // result count
        $result = self::model()->count($criteria);

        return $result ? (int)$result : 0;
    }

    // get Yes Votes
    public static function getYesVotes($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }

        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'y');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'y');
        }

        // result count
        $result = self::model()->count($criteria);

        return $result ? (int)$result : 0;
    }

    // get Yes Vote Users Info
    public static function getYesVoteUsersAddressInfo($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->select = 'CONCAT(address.user_default_address1, address.user_default_address2, address.user_default_address3, address.user_default_town, address.user_default_county, address.user_default_zip) AS userAddressInfo, address.user_default_address1 AS userAddress1';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        $criteria->join .= " INNER JOIN user_default_addresses AS address ON(address.user_default_profile_id = profile.user_default_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }

        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'y');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'y');
        }

        $criteria->group = 'address.user_default_profile_id';

        // result
        $result = self::model()->findAll($criteria);

        return $result ? $result : '';
    }

    // get Maybe Votes
    public static function getMaybeVotes($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }
        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'm');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'm');
        }
        // result count
        $result = self::model()->count($criteria);

        return $result ? (int)$result : 0;
    }

    // get Maybe Vote Users
    public static function getMaybeVoteUsersAddressInfo($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->select = 'CONCAT(address.user_default_address1, address.user_default_address2, address.user_default_address3, address.user_default_town, address.user_default_county, address.user_default_zip) AS userAddressInfo, address.user_default_address1 AS userAddress1';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        $criteria->join .= " INNER JOIN user_default_addresses AS address ON(address.user_default_profile_id = profile.user_default_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }
        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'm');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'm');
        }

        $criteria->group = 'address.user_default_profile_id';

        // result
        $result = self::model()->findAll($criteria);

        return $result ? $result : '';
    }

    // get Maybe Votes
    public static function getNoVotes($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }
        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'n');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'n');
        }
        // result count
        $result = self::model()->count($criteria);

        return $result ? (int)$result : 0;
    }

    // get Maybe Vote Users
    public static function getNoVoteUsersAddressInfo($question_id, $start_date = '', $end_date = '', $actual_date = '', $userType = '')
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '';
        $criteria->select = 'CONCAT(address.user_default_address1, address.user_default_address2, address.user_default_address3, address.user_default_town, address.user_default_county, address.user_default_zip) AS userAddressInfo, address.user_default_address1 AS userAddress1';
        $criteria->join = "INNER JOIN user_default_profiles AS profile ON (profile.user_default_id = t.user_default_listing_marketing_user_id)";
        $criteria->join .= " INNER JOIN user_default_addresses AS address ON(address.user_default_profile_id = profile.user_default_id)";
        if ($userType) {
            $criteria->join .= " INNER JOIN user_default_profession AS profession ON (profession.profession_id = profile.user_default_profession)";
            $criteria->condition .= 'profession.profession_id =' . $userType . " AND ";
        }
        if ($actual_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND user_default_listing_marketing_question_access_date =:access_date AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'access_date' => $actual_date, 'vote_value' => 'n');
        } else if ($start_date && $end_date) {
            $criteria->condition .= 'user_default_listing_marketing_question_id=:question_id AND (user_default_listing_marketing_question_access_date >=:start_date AND user_default_listing_marketing_question_access_date <=:end_date) AND user_default_listing_marketing_question_vote_value=:vote_value';
            $criteria->params = array(':question_id' => $question_id, 'start_date' => $start_date, 'end_date' => $end_date, 'vote_value' => 'n');
        }

        $criteria->group = 'address.user_default_profile_id';

        // result
        $result = self::model()->findAll($criteria);

        return $result ? $result : '';
    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ListingMarketingConnection the static model class
     */

    public static function model($className = __CLASS__)

    {

        return parent::model($className);

    }

}

