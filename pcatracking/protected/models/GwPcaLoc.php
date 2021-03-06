<?php

/**
 * This is the model class for table "tbl_pca_location".
 *
 * The followings are the available columns in table 'tbl_pca_location':
 * @property integer $pca_id
 * @property integer $location_id
 */
class GwPcaLoc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PcaLocation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function defaultScope()
	{	
		
		return array(
            'alias' => $this->tableName(),
            'order' => $this->tableName().'.location_id ASC',
        );  

	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_gw_pca_loc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pca_id, location_id', 'required'),
			array('pca_id, location_id, gateway_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pca_id, location_id', 'safe', 'on'=>'search'),
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
			'Pca' => array(self::BELONGS_TO, 'Pca', 'pca_id'),
			'Gateway' => array(self::BELONGS_TO, 'Gateway', 'gateway_id'),
			'Location' => array(self::BELONGS_TO, 'Location', 'location_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pca_id' => 'Pca',
			'location_id' => 'Location',
			'gateway_id' => 'Gateway',

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

		$criteria->compare('pca_id',$this->pca_id);
		$criteria->compare('location_id',$this->location_id);
		$criteria->compare('gateway_id',$this->gateway_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}