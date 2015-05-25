<?php

/**
 * This is the model class for table "term_relationships".
 *
 * The followings are the available columns in table 'term_relationships':
 * @property integer $id_post
 * @property string $id_term_taxonomy
 * @property integer $term_order
 */
class TermRelationships extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'term_relationships';
	}
	public function primaryKey(){
       return array('id_post', 'id_term_taxonomy');
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('term_order', 'numerical', 'integerOnly'=>true),
			array('id_term_taxonomy', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_post, id_term_taxonomy, term_order', 'safe', 'on'=>'search'),
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
			'termTaxo'=>array(self::BELONGS_TO,'TermTaxonomy','id_term_taxonomy'),
			'blogPost'=>array(self::BELONGS_TO,'BlogPost',array('id_post'=>'id_post')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_post' => 'Id Post',
			'id_term_taxonomy' => 'Id Term Taxonomy',
			'term_order' => 'Term Order',
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

		$criteria->with = array('termTaxo');
		$criteria->compare('id_post',$this->id_post);
		$criteria->compare('id_term_taxonomy',$this->id_term_taxonomy,true);
		$criteria->compare('term_order',$this->term_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
	
        return parent::beforeSave();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TermRelationships the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
