<?php

/**
 * This is the model class for table "blog_post".
 *
 * The followings are the available columns in table 'blog_post':
 * @property integer $id_post
 * @property string $author_post
 * @property string $title_post
 * @property string $content_post
 * @property string $img_post
 * @property string $slug_post
 * @property string $created_date_post
 * @property string $publish_post
 */
class BlogPost extends Model
{
	public $picture;
	public $id;
	public $username;
	public $category_post;
	public $post_tag;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blog_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('picture', 'length', 'max' => 255, 'tooLong' => '{attribute} is too long (max {max} chars).', 'on' => 'upload'),
		    array('picture', 'file', 'types' => 'jpg,jpeg,gif,png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'Size should be less then 2MB !!!', 'on' => 'upload'),
			array('title_post', 'required'),
			array('author_post, title_post, slug_post, publish_post', 'length', 'max'=>255),
			array('content_post, img_post, meta_keywords, meta_desc, created_date_post,post_tag', 'safe'),
			array('created_date_post','default', 'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_post, author_post, title_post, content_post, img_post, slug_post, created_date_post, publish_post, meta_keywords, meta_desc, username', 'safe', 'on'=>'search'),
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
			'authorPost'=>array(self::BELONGS_TO,'Users','author_post'),

			'termRelation'=>array(self::HAS_MANY,'TermRelationships','id_post'),
			'termsTaxoTag'=>array(self::HAS_MANY,'TermTaxonomy',array('id_term_taxonomy'=>'id_term_taxonomy'),'through'=>'termRelation','condition'=>'termsTaxoTag.taxonomy="post_tag"'),
			'termsTag'=>array(self::HAS_MANY,'Terms',array('id_term'=>'id_term'),'through'=>'termsTaxoTag'),

			'commentPost'=>array(self::HAS_MANY,'Comments','id_post'),

			'relatedPost'=>array(self::HAS_MANY,'BlogRelatedPost','id_post'),
			'blogPostRelated'=>array(self::HAS_MANY,'BlogPost',array('id_post_related'=>'id_post'),'through'=>'relatedPost'),

			'relatedCategory'=>array(self::HAS_MANY,'BlogRelatedCategory','id_post'),
			'blogCatRelated'=>array(self::HAS_MANY,'BlogCategory',array('id_cat_related'=>'id_cat'),'through'=>'relatedCategory'),

			'blogCover'=>array(self::HAS_MANY,'BlogCover','id_post'),
			'blogCover_Cat'=>array(self::HAS_MANY,'BlogCategory',array('id_cat'=>'id_cat'),'through'=>'blogCover'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_post' => 'Id '.$this->name_alias,
			'author_post' => 'Author '.$this->name_alias,
			'title_post' => 'Title '.$this->name_alias,
			'content_post' => 'Content '.$this->name_alias,
			'category_post' => 'Category '.$this->name_alias,
			'img_post' => 'Img '.$this->name_alias,
			'slug_post' => 'Slug '.$this->name_alias,
			'meta_keywords' => 'Meta Keywords '.$this->name_alias,
			'meta_desc' => 'Meta Description '.$this->name_alias,
			'created_date_post' => 'Created Date '.$this->name_alias,
			'publish_post' => 'Publish '.$this->name_alias,
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

		$criteria->with = array('authorPost');
		$criteria->addSearchCondition("authorPost.username",$this->username, true);
		
		$criteria->compare('id_post',$this->id_post,true);
		$criteria->compare('author_post',$this->author_post,true);
		// $criteria->compare('title_post',$this->title_post,true,"OR");
		$criteria->addSearchCondition("title_post",$this->title_post, 'true',"OR",'LIKE');
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('content_post',$this->content_post,true);
		$criteria->compare('img_post',$this->img_post,true);
		$criteria->compare('slug_post',$this->slug_post,true);
		$criteria->compare('created_date_post',$this->created_date_post,true);
		$criteria->compare('publish_post',$this->publish_post,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
			        'attributes'=>array(
			            'username'=>array(
			                'asc'=>'authorPost.username',
			                'desc'=>'authorPost.username DESC',
			            ),
			            '*',
			        ),
		    ),
		));
	}


	public function beforeSave() {
		if (empty($this->slug_post)) {
			$this->slug_post = $this->hyphenize($this->title_post); 
		}else{
			$this->slug_post = $this->hyphenize($this->slug_post); 
		}
		if ( $this->scenario == 'update') {
			if (empty($this->img_post) || $this->img_post == "") {
				$this->img_post = $this->findByPk($this->id_post)->img_post;
			}else{
				$this->img_post = $this->img_post;
			}
			
			$this->author_post = $this->findByPk($this->id_post)->author_post;
			if (empty($this->author_post)) {
				$this->author_post = Yii::app()->user->id;
			}
		}else{
			$this->author_post = Yii::app()->user->id;
			
		}
        return parent::beforeSave();
	 }

	protected function afterSave()
	{
		$routes = $this->loadModel_Routes($this->id_post);
		if (!empty($routes)) {
			if ($routes->slug != $this->slug_post) {
				$routes->slug = $this->slug_post;
				$routes->real_link = '/post/view/id/'.$this->id_post;
				$routes->save();
			}
		}else{
			$modelRoutes = new BlogRoutes;
			$modelRoutes->slug = $this->slug_post;
			$modelRoutes->real_link = '/post/view/id/'.$this->id_post;
			$modelRoutes->save();
		}

	    parent::afterSave();
	}

	public function loadModel_Routes($id)
	{
		// // $match = addcslashes("'category/view/',array('id'=>$id)", '%_'); // escape LIKE's special characters
		$match = '/post/view/id/'.$id; // escape LIKE's special characters
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
	 * @return BlogPost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
