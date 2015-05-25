<?php

/**
 * This is the model class for table "term_taxonomy".
 *
 * The followings are the available columns in table 'term_taxonomy':
 * @property integer $id_term_taxonomy
 * @property string $id_term
 * @property string $taxonomy
 * @property string $description_taxonomy
 * @property integer $parent_taxonomy
 * @property integer $count_taxonomy
 */
class TermTaxonomy extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'term_taxonomy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('parent_taxonomy, count_taxonomy', 'numerical', 'integerOnly'=>true),
			array('id_term, taxonomy', 'length', 'max'=>255),
			array('description_taxonomy', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_term_taxonomy, id_term, taxonomy, description_taxonomy, parent_taxonomy, count_taxonomy', 'safe', 'on'=>'search'),
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
			'termsKu'=>array(self::BELONGS_TO,'Terms','id_term'),

			'termRelate'=>array(self::HAS_MANY,'TermRelationships',array('id_term_taxonomy'=>'id_term_taxonomy')),
			'blogPost'=>array(self::HAS_MANY,'BlogPost',array('id_post'=>'id_post'),'through'=>'termRelate'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_term_taxonomy' => 'Id Term Taxonomy',
			'id_term' => 'Id Term',
			'taxonomy' => 'Taxonomy',
			'description_taxonomy' => 'Description Taxonomy',
			'parent_taxonomy' => 'Parent Taxonomy',
			'count_taxonomy' => 'Count Taxonomy',
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

		$criteria->compare('id_term_taxonomy',$this->id_term_taxonomy);
		$criteria->compare('id_term',$this->id_term,true);
		$criteria->compare('taxonomy',$this->taxonomy,true);
		$criteria->compare('description_taxonomy',$this->description_taxonomy,true);
		$criteria->compare('parent_taxonomy',$this->parent_taxonomy);
		$criteria->compare('count_taxonomy',$this->count_taxonomy);

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
	 * @return TermTaxonomy the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
