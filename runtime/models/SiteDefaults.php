<?php

/**
 * This is the model class for table "{{site_defaults}}".
 *
 * The followings are the available columns in table '{{site_defaults}}':
 * @property integer $user_default_site_default_id
 * @property string $user_default_site_default_type
 * @property integer $user_default_site_default_days
 * @property string $user_default_site_default_updated_on
 */
class SiteDefaults extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{site_defaults}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_default_site_default_type, user_default_site_default_days', 'required'),
            array('user_default_site_default_days', 'numerical', 'integerOnly' => true),
            array('user_default_site_default_type', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_default_site_default_id, user_default_site_default_type, user_default_site_default_days, user_default_site_default_updated_on', 'safe', 'on' => 'search'),
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
            'user_default_site_default_id' => 'User Default Site Default',
            'user_default_site_default_type' => 'User Default Site Default Type',
            'user_default_site_default_days' => 'User Default Site Default Days',
            'user_default_site_default_updated_on' => 'User Default Site Default Updated On',
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

        $criteria->compare('user_default_site_default_id', $this->user_default_site_default_id);
        $criteria->compare('user_default_site_default_type', $this->user_default_site_default_type, true);
        $criteria->compare('user_default_site_default_days', $this->user_default_site_default_days);
        $criteria->compare('user_default_site_default_updated_on', $this->user_default_site_default_updated_on, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SiteDefaults the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
