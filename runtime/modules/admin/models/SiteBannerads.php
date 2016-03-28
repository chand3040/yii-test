<?php


/**
 * This is the model class for table "{{site_bannerads}}".
 *
 * The followings are the available columns in table '{{site_bannerads}}':
 * @property integer $user_default_banner_id
 * @property integer $user_default_user_id
 * @property string $user_default_banner_path
 * @property string $user_default_banner_link
 * @property string $user_default_date_time
 * @property string $user_default_banner_status
 */
class SiteBannerads extends CActiveRecord

{

    /**
     * @return string the associated database table name
     */

    public function tableName()

    {

        return '{{site_bannerads}}';

    }


    /**
     * @return array validation rules for model attributes.
     */

    public function rules()

    {

        // NOTE: you should only define rules for those attributes that

        // will receive user inputs.

        return array(


            //array('user_default_banner_path, user_default_banner_link, user_default_date_time, user_default_banner_status', 'required'),
            array('user_default_date_time, user_default_banner_status', 'required'),

            //array('user_default_user_id', 'numerical', 'integerOnly'=>true),

            array('user_default_banner_path', 'length', 'max' => 350),

            array('user_default_banner_status', 'length', 'max' => 1),


            // The following rule is used by search().

            // @todo Please remove those attributes that should not be searched.

            array('user_default_banner_id, user_default_banner_path, user_default_banner_link, user_default_date_time, user_default_banner_status', 'safe', 'on' => 'search'),

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


            'user_default_banner_id' => 'User Default Banner',

            'user_default_banner_path' => 'User Default Banner Path',

            'user_default_banner_link' => 'User Default Banner Link',

            'user_default_date_time' => 'User Default Date Time',

            'user_default_banner_status' => 'User Default Banner Status',


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


        $criteria->compare('user_default_banner_id', $this->user_default_banner_id);
        $criteria->compare('user_default_banner_path', $this->user_default_banner_path, true);
        $criteria->compare('user_default_banner_link', $this->user_default_banner_link, true);
        $criteria->compare('user_default_date_time', $this->user_default_date_time, true);
        $criteria->compare('user_default_banner_status', $this->user_default_banner_status, true);


        return new CActiveDataProvider($this, array(

            'criteria' => $criteria,

        ));

    }


    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SiteBannerads the static model class
     */

    public static function model($className = __CLASS__)

    {

        return parent::model($className);

    }

}

