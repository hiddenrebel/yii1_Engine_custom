<?php

/**
 * This is the model class for table "photos".
 *
 * The followings are the available columns in table 'photos':
 * @property integer $id_photo
 * @property integer $id_album
 * @property string $title_photo
 * @property string $desc_photo
 * @property string $img_photo
 * @property string $alt_photo
 * @property string $create_at
 */
class Photos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_album', 'required'),
			array('id_album', 'numerical', 'integerOnly'=>true),
			array('title_photo, alt_photo', 'length', 'max'=>255),
			array('desc_photo, img_photo, create_at', 'safe'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_photo, id_album, title_photo, desc_photo, img_photo, alt_photo, create_at', 'safe', 'on'=>'search'),
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
			'id_photo' => 'Id Photo',
			'id_album' => 'Id Album',
			'title_photo' => 'Title Photo',
			'desc_photo' => 'Desc Photo',
			'img_photo' => 'Img Photo',
			'alt_photo' => 'Alt Photo',
			'create_at' => 'Create At',
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

		$criteria->compare('id_photo',$this->id_photo);
		$criteria->compare('id_album',$this->id_album);
		$criteria->compare('title_photo',$this->title_photo,true);
		$criteria->compare('desc_photo',$this->desc_photo,true);
		$criteria->compare('img_photo',$this->img_photo,true);
		$criteria->compare('alt_photo',$this->alt_photo,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
