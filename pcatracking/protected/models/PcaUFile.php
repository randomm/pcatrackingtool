
<?php

/**
 * This is the model class for table "tbl_target_progress".
 *
 * The followings are the available columns in table 'tbl_target_progress':
 * @property integer $target_id
 * @property integer $unit_id
 * @property integer $total
 * @property integer $programmed
 * @property integer $shortfall
 *
 * The followings are the available model relations:
 * @property PcaTargetProgress[] $pcaTargetProgresses
 * @property PcaTargetProgress[] $pcaTargetProgresses1
 * @property TargetProgressPcaReport[] $targetProgressPcaReports
 * @property TargetProgressPcaReport[] $targetProgressPcaReports1
 */
class PcaUFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TargetProgress the static model class
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
		return 'tbl_pca_ufile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id,pca_id', 'required'),
			
		);
	}

	public function primaryKey()
	{
		return array('file_id');
		# code...
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
			'UploadedFile' => array(self::BELONGS_TO, 'UploadedFile', 'file_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	
}