<?php


/**
 * This is the model class for table "{{listing_addresses}}".
 *
 * The followings are the available columns in table '{{listing_addresses}}':
 * @property integer $user_default_listing_address_id
 * @property string $user_default_listing_company_name
 * @property string $user_default_listing_address1
 * @property string $user_default_listing_address2
 * @property string $user_default_listing_address3
 * @property string $user_default_listing_town
 * @property string $user_default_listing_county
 * @property string $user_default_listing_country
 * @property string $user_default_listing_zip_code
 * @property string $user_default_listing_tel
 * @property integer $user_default_listing_id
 *
 * The followings are the available model relations:
 * @property Listing $userDefaultListing
 */
class ListingAddresses extends CActiveRecord

{

    /**
     * @return string the associated database table name
     */

    public function tableName()

    {

        return '{{listing_addresses}}';

    }


    /**
     * @return array validation rules for model attributes.
     */

    public function rules()

    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(


            array('user_default_listing_company_name, user_default_listing_address1, user_default_listing_address2, user_default_listing_address3, user_default_listing_town, user_default_listing_county, user_default_listing_country, user_default_listing_zip_code, user_default_listing_tel, user_default_listing_id', 'required'),


            array('user_default_listing_id', 'numerical', 'integerOnly' => true),


            array('user_default_listing_company_name, user_default_listing_address1, user_default_listing_address2, user_default_listing_address3, user_default_listing_town, user_default_listing_county, user_default_listing_country', 'length', 'max' => 100),


            array('user_default_listing_zip_code', 'length', 'max' => 15),


            array('user_default_listing_tel', 'length', 'max' => 30),


            // The following rule is used by search().

            // @todo Please remove those attributes that should not be searched.

            array('user_default_listing_address_id, user_default_listing_company_name, user_default_listing_address1, user_default_listing_address2, user_default_listing_address3, user_default_listing_town, user_default_listing_county, user_default_listing_country, user_default_listing_zip_code, user_default_listing_tel, user_default_listing_id', 'safe', 'on' => 'search'),

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


        );

    }


    /**
     * @return array customized attribute labels (name=>label)
     */

    public function attributeLabels()

    {

        return array(


            'user_default_listing_address_id' => 'User Default Listing Address',


            'user_default_listing_company_name' => 'User Default Listing Company Name',


            'user_default_listing_address1' => 'User Default Listing Address1',


            'user_default_listing_address2' => 'User Default Listing Address2',


            'user_default_listing_address3' => 'User Default Listing Address3',


            'user_default_listing_town' => 'User Default Listing Town',


            'user_default_listing_county' => 'User Default Listing County',


            'user_default_listing_country' => 'User Default Listing Country',


            'user_default_listing_zip_code' => 'User Default Listing Zip Code',


            'user_default_listing_tel' => 'User Default Listing Tel',


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


        $criteria = new CDbCriteria;


        $criteria->compare('user_default_listing_address_id', $this->user_default_listing_address_id);
        $criteria->compare('user_default_listing_company_name', $this->user_default_listing_company_name, true);
        $criteria->compare('user_default_listing_address1', $this->user_default_listing_address1, true);
        $criteria->compare('user_default_listing_address2', $this->user_default_listing_address2, true);
        $criteria->compare('user_default_listing_address3', $this->user_default_listing_address3, true);
        $criteria->compare('user_default_listing_town', $this->user_default_listing_town, true);
        $criteria->compare('user_default_listing_county', $this->user_default_listing_county, true);
        $criteria->compare('user_default_listing_country', $this->user_default_listing_country, true);
        $criteria->compare('user_default_listing_zip_code', $this->user_default_listing_zip_code, true);
        $criteria->compare('user_default_listing_tel', $this->user_default_listing_tel, true);
        $criteria->compare('user_default_listing_id', $this->user_default_listing_id);


        return new CActiveDataProvider($this, array(

            'criteria' => $criteria,

        ));

    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ListingAddresses the static model class
     */

    public static function model($className = __CLASS__)

    {

        return parent::model($className);

    }

}

