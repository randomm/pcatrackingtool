<?php

/**
 * This is the model class for table "tbl_auth_group".
 *
 * The followings are the available columns in table 'tbl_auth_group':
 * @property integer $group_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property AuthPermission[] $tblAuthPermissions
 * @property AuthUser[] $tblAuthUsers
 */
class AuthGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuthGroup the static model class
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
		return 'tbl_auth_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('group_id, name', 'safe', 'on'=>'search'),
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
			'tblAuthPermissions' => array(self::MANY_MANY, 'AuthPermission', 'tbl_auth_group_permission(group_id, permission_id)'),
			'tblAuthUsers' => array(self::MANY_MANY, 'AuthUser', 'tbl_auth_user_group(group_id, user_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_id' => 'Group',
			'name' => 'Name',
		);
	}

	// CAdvancedArBehaviour extension for many-to-many relations
	public function behaviors(){
          return array( 'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
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

		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}