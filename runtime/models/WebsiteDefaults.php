
<?php



/**

 * This is the model class for table "{{website_defaults}}".

 *

 * The followings are the available columns in table '{{website_defaults}}':


 * @property integer $id


 * @property string $module


 * @property integer $unit


 * @property string $uom


 * @property string $cost


 * @property integer $currency_id



 *

 * The followings are the available model relations:


 * @property Currency $currency



 */

class WebsiteDefaults extends CActiveRecord

{

	/**

	 * @return string the associated database table name

	 */

	public function tableName()

	{

		return '{{website_defaults}}';

	}



	/**

	 * @return array validation rules for model attributes.

	 */

	public function rules()

	{

		// NOTE: you should only define rules for those attributes that

		// will receive user inputs.

		return array(


			array('module, unit, uom, cost, currency_id', 'required'),
			array('category, currency_id', 'numerical', 'integerOnly'=>true),
			array('module', 'length', 'max'=>255),
			array('unit, uom', 'length', 'max'=>50),
			array('cost', 'length', 'max'=>10),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, module, category, unit, uom, cost, currency_id', 'safe', 'on'=>'search'),

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
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
		);

	}



	/**

	 * @return array customized attribute labels (name=>label)

	 */

	public function attributeLabels()

	{

		return array(

			'id' => 'ID',
			'module' => 'Module',
            'category' => 'Category',
			'unit' => 'Unit',
			'uom' => 'Uom',
			'cost' => 'Cost',
			'currency_id' => 'Currency',

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



		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('module',$this->module,true);
        $criteria->compare('category',$this->category,true);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('uom',$this->uom,true);
		$criteria->compare('cost',$this->cost,true);
		$criteria->compare('currency_id',$this->currency_id);


		return new CActiveDataProvider($this, array(

			'criteria'=>$criteria,

		));

	}




	/**

	 * Returns the static model of the specified AR class.

	 * Please note that you should have this exact method in all your CActiveRecord descendants!

	 * @param string $className active record class name.

	 * @return WebsiteDefaults the static model class

	 */

	public static function model($className=__CLASS__)

	{

		return parent::model($className);

	}

}

