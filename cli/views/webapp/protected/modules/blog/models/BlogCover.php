<?php

/**
 * This is the model class for table "blog_cover".
 *
 * The followings are the available columns in table 'blog_cover':
 * @property integer $id_cover
 * @property string $id_cat
 * @property string $id_post
 * @property string $create_at
 */
class BlogCover extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blog_cover';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cat, id_post', 'length', 'max'=>255),
			array('create_at', 'safe'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cover, id_cat, id_post, create_at', 'safe', 'on'=>'search'),
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
			'id_cover' => 'Id Cover',
			'id_cat' => 'Id Cat',
			'id_post' => 'Id Blog',
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

		$criteria->compare('id_cover',$this->id_cover);
		$criteria->compare('id_cat',$this->id_cat,true);
		$criteria->compare('id_post',$this->id_post,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogCover the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
