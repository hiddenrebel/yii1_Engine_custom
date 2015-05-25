<?php

/**
 * This is the model class for table "terms".
 *
 * The followings are the available columns in table 'terms':
 * @property integer $id_term
 * @property string $name
 * @property string $slug
 * @property integer $group_term
 */
class Terms extends Model
{
	public $description, $taxonomy;
	public $datague = array();
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'terms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('slug', 'required'),
			array('group_term', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>255),
			array('description,taxonomy','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_term, name, slug, group_term, taxonomy, description', 'safe', 'on'=>'search'),
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
			'termTaxo'=>array(self::HAS_ONE,'TermTaxonomy','id_term'),
			'termsRelate'=>array(self::HAS_MANY,'TermRelationships',array('id_term_taxonomy'=>'id_term_taxonomy'),'through'=>'termTaxo'),
			'blogPost'=>array(self::HAS_MANY,'BlogPost',array('id_post'=>'id_post'),'through'=>'termsRelate'),

			'termsTaxoTag'=>array(self::HAS_ONE,'TermTaxonomy',array('id_term_taxonomy'=>'id_term_taxonomy'),'through'=>'termsRelate','condition'=>'termsTaxoTag.taxonomy="post_tag"'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_term' => 'Id Term',
			'name' => 'Name',
			'slug' => 'Slug',
			'group_term' => 'Group Term',
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
		$criteria->addSearchCondition("termTaxo.description_taxonomy",$this->description, true);
		$criteria->compare('id_term',$this->id_term);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('termTaxo.description_taxonomy',$this->description,true);
		$criteria->compare('group_term',$this->group_term);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'sort'=>array(
				        'attributes'=>array(
				            'description'=>array(
				                'asc'=>'termTaxo.description_taxonomy',
				                'desc'=>'termTaxo.description_taxonomy DESC',
				            ),
				            '*',
				        ),
			    ),
		));
	}

	public function beforeSave() {
		$this->datague = $this;
		if (empty($this->slug)) {
			$this->slug = $this->hyphenize($this->name); 
		}else{
			$this->slug = $this->hyphenize($this->slug); 
		}
		
        return parent::beforeSave();
	}

	protected function afterSave()
	{
		if ( $this->scenario == 'create') {
			$termTaxo = new TermTaxonomy;
			$termTaxo->id_term = $this->id_term;
			$termTaxo->taxonomy = $this->taxonomy;
			$termTaxo->description_taxonomy = $this->description;
			if(!$termTaxo->save()){
				print_r($termTaxo->getErrors());
				die();
			}

			$route = new BlogRoutes;
			$route->slug = $this->slug;
			$route->real_link = '/terms/view/id/'.$this->id_term;
			$route->save();

		}else{
			$routes = $this->loadModel_Routes($this->id_term);
			if ($routes !== null) {
				$routes->slug = $this->slug;
				$routes->save();
			}else{
				$route = new BlogRoutes;
				$route->slug = $this->slug;
				$route->real_link = '/terms/view/id/'.$this->id_term;
				$route->save();
			}

			$termTaxo = TermTaxonomy::model()->findByAttributes(array('id_term'=>$this->id_term));
			if ($termTaxo !== null) {
				$termTaxo->description_taxonomy = $this->description;
				$termTaxo->save();
			}

		}
	    parent::afterSave();
	}

	public function afterDelete()
	{
		parent::afterDelete();		

		$termTaxo = TermTaxonomy::model()->findByAttributes(array('id_term'=>$this->id_term));
		if ($termTaxo !== null) {
			$termTaxo->delete();
		}
	}

	public function loadModel_Routes($id)
	{
		// // $match = addcslashes("'category/view/',array('id'=>$id)", '%_'); // escape LIKE's special characters
		$match = '/terms/view/id/'.$id; // escape LIKE's special characters
		$q = new CDbCriteria( array(
		    'condition' => "real_link LIKE :match",         // no quotes around :match
		    'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
		) );
		 
		$model = BlogRoutes::model()->find( $q );     // works!
		// if($model===null)
			// throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Terms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
