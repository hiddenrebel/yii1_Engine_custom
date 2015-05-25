<?php

/**
 * This is the model class for table "gallery_album".
 *
 * The followings are the available columns in table 'gallery_album':
 * @property integer $id_album
 * @property string $title_album
 * @property string $desc_album
 * @property string $slug_album
 * @property string $cover_album
 * @property string $create_at
 */
class GalleryAlbumku extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gallery_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title_album, slug_album, cover_album', 'length', 'max'=>255),
			array('desc_album, create_at', 'safe'),
			array('create_at', 'default', 'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_album, title_album, desc_album, slug_album, cover_album, create_at', 'safe', 'on'=>'search'),
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
			'id_album' => 'Id Album',
			'title_album' => 'Title Album',
			'desc_album' => 'Desc Album',
			'slug_album' => 'Slug Album',
			'cover_album' => 'Cover Album',
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

		$criteria->compare('id_album',$this->id_album);
		$criteria->compare('title_album',$this->title_album,true);
		$criteria->compare('desc_album',$this->desc_album,true);
		$criteria->compare('slug_album',$this->slug_album,true);
		$criteria->compare('cover_album',$this->cover_album,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		if (empty($this->slug_album)) {
			$this->slug_album = str_replace(" ", "-", $this->title_album);
		}else{
			$this->slug_album = str_replace(" ", "-", $this->slug_album);
		}
	
        return parent::beforeSave();
	 }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GalleryAlbumku the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
