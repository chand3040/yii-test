<?php

class Samplelisting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Createuserlisting the static model class
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
		return '{{sample_listing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_default_listing_id', 'required'),
			array('user_default_sample_listing_id,user_default_listing_id', 'numerical', 'integerOnly'=>true),
		    array('user_default_sample_listing_details,user_default_sample_listing_feedback,user_default_sample_listing_obtain,user_default_sample_listing_instructions', 'length', 'max'=>21845),
			array('user_default_sample_listing_company_address1,user_default_sample_listing_company_address2,user_default_sample_listing_company_address3,user_default_sample_listing_company_town,user_default_sample_listing_company_county,user_default_sample_listing_company_postal,user_default_sample_listing_company_tel,user_default_sample_listing_cost,user_default_sample_listing_packaging', 'length', 'max'=>100),
            array('user_default_sample_listing_company_image,user_default_sample_listing_att_specs,user_default_sample_listing_att_instruction,user_default_sample_listing_att_safety,user_default_sample_listing_image', 'length', 'max'=>500 ),
            array('user_default_sample_listing_currency', 'length', 'max'=>25 ),
 			array('user_default_sample_listing_id,user_default_listing_id, user_default_sample_listing_details, user_default_sample_listing_feedback, user_default_sample_listing_obtain, user_default_sample_listing_instructions, user_default_sample_listing_company_image,user_default_sample_listing_company_address1, user_default_sample_listing_company_address2,user_default_sample_listing_company_address3,user_default_sample_listing_company_town,user_default_sample_listing_company_county,user_default_sample_listing_company_postal,user_default_sample_listing_company_tel,user_default_sample_listing_att_specs, user_default_sample_listing_att_instruction,user_default_sample_listing_att_safety,user_default_sample_listing_image,user_default_sample_listing_cost,user_default_sample_listing_packaging,user_default_sample_listing_currency,user_default_sample_listing_terms,user_default_sample_listing_date,user_default_sample_listing_status', 'safe', 'on'=>'search'),
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
			'user_default_sample_listing_id' => 'Lid',
			'user_default_listing_id' => ' Lid',
			'user_default_sample_listing_details' => ' Details of sample available',
			'user_default_sample_listing_feedback' => ' What feedback the user wants',
			'user_default_sample_listing_obtain' => ' How to obtain sample',
			'user_default_sample_listing_instructions' => ' Special instructions',
			'user_default_sample_listing_company_image' => ' Sample picture',
			'user_default_sample_listing_company_address1' => ' Address1',
			'user_default_sample_listing_company_address2' => ' Address2',
			'user_default_sample_listing_company_address3' => ' Address3',
            'user_default_sample_listing_company_town' => ' town',
			'user_default_sample_listing_company_county' => ' county',
			'user_default_sample_listing_company_postal' => ' zip',
			'user_default_sample_listing_company_tel' => ' tel no',
			'user_default_sample_listing_att_specs' => ' Upload information & specifications',
			'user_default_sample_listing_att_instruction' => 'Upload instruction of how to use the sample',
			'user_default_sample_listing_att_safety' => ' Any known safety issues',
			'user_default_sample_listing_image' => ' Upload an image of your sample',
			'user_default_sample_listing_cost' => ' Cost of sample',			
			'user_default_sample_listing_packaging' => ' Postage & packing',
			'user_default_sample_listing_currency' => ' Please select your currency',
			'user_default_sample_listing_terms' => 'Terms',
			'user_default_sample_listing_date' => ' Date',
			'user_default_sample_listing_status' => ' Status',
			
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

		$criteria= new CDbCriteria;

		$criteria->compare('user_default_sample_listing_id',$this->user_default_sample_listing_id);
		$criteria->compare('user_default_listing_id',$this->user_default_listing_id,true);
		$criteria->compare('user_default_sample_listing_details',$this->user_default_sample_listing_details,true);
		$criteria->compare('user_default_sample_listing_feedback',$this->user_default_sample_listing_feedback,true);
		$criteria->compare('user_default_sample_listing_obtain',$this->user_default_sample_listing_obtain,true);
		$criteria->compare('user_default_sample_listing_instructions',$this->user_default_sample_listing_instructions,true);
		$criteria->compare('user_default_sample_listing_company_image',$this->user_default_sample_listing_company_image,true);
		$criteria->compare('user_default_sample_listing_company_address1',$this->user_default_sample_listing_company_address1,true);
		$criteria->compare('user_default_sample_listing_company_address2',$this->user_default_sample_listing_company_address2,true);
		$criteria->compare('user_default_sample_listing_company_address3',$this->user_default_sample_listing_company_address3,true);
		$criteria->compare('user_default_sample_listing_company_town',$this->user_default_sample_listing_company_town,true);
		$criteria->compare('user_default_sample_listing_company_county',$this->user_default_sample_listing_company_county,true);
		$criteria->compare('user_default_sample_listing_company_postal',$this->user_default_sample_listing_company_postal);
		$criteria->compare('user_default_sample_listing_company_tel',$this->user_default_sample_listing_company_tel,true);
		$criteria->compare('user_default_sample_listing_att_specs',$this->user_default_sample_listing_att_specs,true);
		$criteria->compare('user_default_sample_listing_att_instruction',$this->user_default_sample_listing_att_instruction,true);
		$criteria->compare('user_default_sample_listing_att_safety',$this->user_default_sample_listing_att_safety,true);
		$criteria->compare('user_default_sample_listing_image',$this->user_default_sample_listing_image,true);		
		$criteria->compare('user_default_sample_listing_cost',$this->user_default_sample_listing_cost,true);
		$criteria->compare('user_default_sample_listing_packaging',$this->user_default_sample_listing_packaging,true);
		$criteria->compare('user_default_sample_listing_currency',$this->user_default_sample_listing_currency,true);
		$criteria->compare('user_default_sample_listing_terms',$this->user_default_sample_listing_terms,true);
		$criteria->compare('user_default_sample_listing_date',$this->user_default_sample_listing_date,true); 
        $criteria->compare('user_default_sample_listing_status',$this->user_default_sample_listing_status,true); 		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}