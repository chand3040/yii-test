<?php


class Member extends CActiveRecord
{
    public $from_date, $to_date, $pos;
    public $userProfile;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Member the static model class
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
        return '{{profiles}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(

            array('user_default_first_name', 'required', 'message' => 'Enter Your Name'),

            array('user_default_surname', 'required', 'message' => 'Enter Your Surname'),

            array('user_default_email', 'required', 'message' => 'Enter Valid Email Address'),

            array('user_default_username', 'required', 'message' => 'Enter Your Username'),

            array('user_default_password', 'required', 'message' => 'Enter Your Password'),

            //array("drg_verifycode","required","message"=>'Please Enter The Security Code'),

            array("user_default_gender", "required", "message" => ''),

            array("user_default_dob", "required", "message" => ''),

            array('user_default_admin_notes', 'length', 'max' => 21845),

            array('user_default_first_name,user_default_surname,user_default_email,user_default_username,user_default_gender,user_default_dob,user_default_gender', 'required'),

            array('user_default_first_name,user_default_surname, user_default_username, user_default_password, user_default_type,user_default_dob', 'length', 'max' => 50),

            array('user_default_verifycode', 'length', 'max' => 150),

            array('user_default_ip , user_default_verifycode , user_default_profile_image , user_default_email , user_default_country', 'length', 'max' => 100),

            array('user_default_tel', 'length', 'max' => 30),

            array('user_default_currency', 'length', 'max' => 15),

            // The following rule is used by search().

            // Please remove those attributes that should not be searched.

            array('user_default_id, user_default_ip, user_default_first_name, user_default_surname, user_default_username, user_default_email, user_default_currency, user_default_profession, user_default_country, user_default_gender, user_default_dob, user_default_type, user_default_tel, user_default_profile_image, user_default_registration_date, user_default_admin_notes, user_default_verifycode, user_default_activate_link, user_default_account_status', 'safe', 'on' => 'search'),

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

            'user_default_id' => 'User ID',

            'user_default_ip' => 'User IP',

            'user_default_first_name' => 'First name',

            'user_default_surname' => 'Last name',

            'user_default_username' => 'Username',

            'user_default_email' => 'Email',

            'user_default_password' => 'Password',

            'user_default_currency' => 'Currency',

            'user_default_profession' => 'Title',

            'user_default_country' => 'Country',

            'user_default_gender' => 'Gender',

            'user_default_dob' => 'Date of birth',

            'user_default_type' => 'Type',

            'user_default_tel' => 'Telephone',

            'user_default_profile_image' => 'Profile Image',

            'user_default_registration_date' => 'Registration Date',

            'user_default_admin_notes' => 'Admin Notes',

            'user_default_verifycode' => 'Verify Code',

            'user_default_activate_link' => 'Activation Link',

            'user_default_account_status' => 'Account Status',

        );

    }

    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        // Search by country, so it should get the user_default_country_id of the selected country
        /*   $sql = "SELECT user_default_country_id";
           $sql .= " FROM {{country}} ";
           $sql .= " WHERE country LIKE '%{$this->user_default_country}%'";

           $countryResult = Yii::app()->db->createCommand($sql)->queryAll();
           $countryToSearch = array();

           if( $countryResult ){
               // Put the country found in temporary array
               foreach ($countryResult as $country) {
                   array_push($countryToSearch, $country['user_default_country_id']);
               }

           }else{
               // Default value is zero, no result for the selected contry
               array_push($countryToSearch, 0);
           }
           */
        // Get date as mysql format before search
        $rDate = CommonClass::getMySqlDate($this->user_default_registration_date);

        $criteria = new CDbCriteria;

        $criteria->select = 't.*';

        $criteria->join = 'LEFT JOIN user_default_addresses AS addr ON ( addr.user_default_profile_id = t.user_default_id)';
        $criteria->join .= ' LEFT JOIN user_default_country AS country ON ( country.user_default_country_id = addr.user_default_country)';

        $criteria->compare('user_default_id', $this->user_default_id);

        $criteria->compare('user_default_ip', $this->user_default_ip, true);

        $criteria->compare('user_default_first_name', $this->user_default_first_name, true);

        $criteria->compare('user_default_surname', $this->user_default_surname, true);

        $criteria->compare('user_default_username', $this->user_default_username, true);

        $criteria->compare('user_default_email', $this->user_default_email, true);

        $criteria->compare('user_default_password', $this->user_default_password, true);

        $criteria->compare('user_default_currency', $this->user_default_currency, true);

        $criteria->compare('user_default_profession', $this->user_default_profession, true);

        //$criteria->compare('user_default_country', $this->user_default_country, true);

        $criteria->compare('user_default_gender', $this->user_default_gender, true);

        //$criteria->compare('user_default_dob', $this->user_default_dob, true);

        $criteria->compare('user_default_type', $this->user_default_type, true);

        $criteria->compare('user_default_tel', $this->user_default_tel, true);

        $criteria->compare('user_default_profile_image', $this->user_default_profile_image, true);

        $criteria->compare('user_default_registration_date', $this->user_default_registration_date, true);

        $criteria->compare('user_default_admin_notes', $this->user_default_admin_notes, true);

        $criteria->compare('user_default_verifycode', $this->user_default_verifycode, true);

        $criteria->compare('user_default_activate_link', $this->user_default_activate_link, true);

        //$criteria->compare('user_default_account_status', $this->user_default_account_status, true);


        if (!empty($this->from_date) && empty($this->to_date)) {
            $criteria->condition = "user_default_registration_date >= '$this->from_date'";  // date is database date column field

        } elseif (!empty($this->to_date) && empty($this->from_date)) {
            $criteria->condition = "user_default_registration_date <= '$this->to_date'";

        } elseif (!empty($this->to_date) && !empty($this->from_date)) {
            $criteria->condition = "user_default_registration_date  >= '$this->from_date' and user_default_registration_date <= '$this->to_date'";
        }

        // if DOB selected
        if ($this->user_default_dob) {
            $user_default_dob = CommonClass::convertDateAsMySQLFormat($this->user_default_dob);
            $criteria->addCondition('user_default_dob="' . $user_default_dob . '"');
        }

        // if User Account type
        if ($this->user_default_account_status != '') {
            $criteria->addCondition('user_default_account_status="' . $this->user_default_account_status . '"');
        }

        // if User Country
        if ($this->user_default_country) {
            $criteria->addCondition('country.user_default_country_id ="' . $this->user_default_country . '"');
        }

        $criteria->group = 't.user_default_id';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->user->getState('pageSize'),
            ),
        ));
    }

    public function search2()

    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.


        $criteria = new CDbCriteria;

        $criteria->compare('user_default_username', $this->user_default_username, true);
        $criteria->compare('user_default_account_status', $this->user_default_account_status, true);
        $criteria->compare('user_default_type', $this->user_default_type, true);
        $criteria->compare('user_default_registration_date', $this->user_default_registration_date, true);

        // get records of this month
        $criteria->addCondition('MONTH(t.user_default_registration_date)=' . date('m') . ' AND Year(t.user_default_registration_date)=' . date('Y'));

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function prev_member($member_id)
    {
        $criteria = new CDbCriteria;

        $criteria->select = array('user_default_id');

        $criteria->addCondition('user_default_id <' . $member_id);

        $criteria->order = 'user_default_id DESC';

        $criteria->limit = 1;

        $member = Member::model()->find($criteria);

        if ($member)

            return $member;

        else

            return false;

    }

    public static function next_member($member_id)
    {
        $criteria = new CDbCriteria;

        $criteria->select = array('user_default_id');

        $criteria->addCondition('user_default_id >' . $member_id);

        $criteria->order = 'user_default_id ASC';

        $criteria->limit = 1;

        $member = Member::model()->find($criteria);

        if ($member)

            return $member;

        else

            return false;
    }

    public static function getRowPosition($id)
    {
        //SELECT COUNT(user_default_id) AS pos FROM drg_user WHERE user_default_id <= 298
        $criteria = new CDbCriteria();

        $criteria = array(

            'select' => 'count(user_default_id) as pos',

            'condition' => 'user_default_id <= ' . $id,

        );

        return self::model()->count($criteria);
    }

}