<?php

/**
 * This is the model class for table "{{blisting_images}}".
 *
 * The followings are the available columns in table '{{blisting_images}}':
 * @property integer $user_default_business_image_id
 * @property string $user_default_business_listing_image
 * @property string $user_default_business_imgdesc
 * @property integer $user_default_business_blid
 * @property integer $order_id
 */
class Businesslistingimages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Businesslistingimages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{business_listing_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_business_listing_image, user_default_business_imgdesc, user_default_business_blid', 'required'),
			array('user_default_business_blid, order_id', 'numerical', 'integerOnly'=>true),
			array('user_default_business_listing_image', 'length', 'max'=>250),
			array('user_default_business_imgdesc', 'length', 'max'=>500),
			array('user_default_business_listing_link1, user_default_business_listing_link2', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_default_business_image_id, user_default_business_listing_image, user_default_business_imgdesc, user_default_business_listing_link1, user_default_business_listing_link2, user_default_business_blid, order_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_default_business_image_id' => 'Drg Image',
			'user_default_business_listing_image' => 'Drg Listing Image',
			'user_default_business_imgdesc' => 'Drg Imgdesc',			
			'user_default_business_listing_link1' => 'Page Link',
			'user_default_business_listing_link2' => 'Video Link',
			'user_default_business_blid' => 'Drg Blid',
			'order_id' => 'Order',
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

		$criteria=new CDbCriteria;

		$criteria->compare('user_default_business_image_id',$this->user_default_business_image_id);
		$criteria->compare('user_default_business_listing_image',$this->user_default_business_listing_image,true);
		$criteria->compare('user_default_business_imgdesc',$this->user_default_business_imgdesc,true);
		$criteria->compare('user_default_business_listing_link1',$this->user_default_business_listing_link1,true);
		$criteria->compare('user_default_business_listing_link2',$this->user_default_business_listing_link2,true);
		$criteria->compare('user_default_business_blid',$this->user_default_business_blid);
		$criteria->compare('order_id',$this->order_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}