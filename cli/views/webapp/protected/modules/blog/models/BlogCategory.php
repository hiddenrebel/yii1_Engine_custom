<?php

/**
 * This is the model class for table "blog_category".
 *
 * The followings are the available columns in table 'blog_category':
 * @property integer $id_cat
 * @property string $name_cat
 * @property string $parent_cat
 * @property string $slug
 * @property string $create_at
 */
class BlogCategory extends CActiveRecord
{
	public $cover_post;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'blog_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name_cat', 'required'),
			array('name_cat, parent_cat, slug', 'length', 'max'=>255),
			array('create_at, desc_cat', 'safe'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_cat, name_cat, parent_cat, slug, desc_cat, create_at', 'safe', 'on'=>'search'),
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
			'blogRelatedCategory'=>array(self::HAS_MANY,'BlogRelatedCategory','id_cat_related'),
			'blogRelatedPost'=>array(self::HAS_MANY,'BlogPost',array('id_post'=>'id_post'),'through'=>'blogRelatedCategory'),
			'blogRelatedPostComment'=>array(self::HAS_MANY,'Comments',array('id_post'=>'id_post'),'through'=>'blogRelatedPost'),

			'blogCover'=>array(self::HAS_MANY,'BlogCover','id_cat'),
			'blogCoverPost'=>array(self::HAS_MANY,'BlogPost',array('id_post'=>'id_post'),'through'=>'blogCover'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_cat' => 'Id Cat',
			'name_cat' => 'Name Cat',
			'parent_cat' => 'Parent Cat',
			'desc_cat' => 'Description Cat',
			'slug' => 'Slug',
			'cover_post' => 'Cover Post',
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

		$criteria->compare('id_cat',$this->id_cat);
		$criteria->compare('name_cat',$this->name_cat,true);
		$criteria->compare('desc_cat',$this->desc_cat,true);
		$criteria->compare('parent_cat',$this->parent_cat,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->together = true;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				                'pageSize' => 20,
				            ),
		));
	}

	private function hyphenize($string) {
	    $dict = array(
	        "I'm"      => "I am",
	        "thier"    => "their",
	    );
	    return strtolower(
	        preg_replace(
	          array( '#[\\s-]+#', '#[^A-Za-z0-9\. -]+#' ),
	          array( '-', '' ),
	          // the full cleanString() can be download from http://www.unexpectedit.com/php/php-clean-string-of-utf8-chars-convert-to-similar-ascii-char
	          $this->cleanString(
	              str_replace( // preg_replace to support more complicated replacements
	                  array_keys($dict),
	                  array_values($dict),
	                  urldecode($string)
	              )
	          )
	        )
	    );
	}

	private function cleanString($text) {
	    $utf8 = array(
	        '/[áàâãªä]/u'   =>   'a',
	        '/[ÁÀÂÃÄ]/u'    =>   'A',
	        '/[ÍÌÎÏ]/u'     =>   'I',
	        '/[íìîï]/u'     =>   'i',
	        '/[éèêë]/u'     =>   'e',
	        '/[ÉÈÊË]/u'     =>   'E',
	        '/[óòôõºö]/u'   =>   'o',
	        '/[ÓÒÔÕÖ]/u'    =>   'O',
	        '/[úùûü]/u'     =>   'u',
	        '/[ÚÙÛÜ]/u'     =>   'U',
	        '/ç/'           =>   'c',
	        '/Ç/'           =>   'C',
	        '/ñ/'           =>   'n',
	        '/Ñ/'           =>   'N',
	        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
	        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
	        '/[“”«»„]/u'    =>   ' ', // Double quote
	        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
	    );
	    return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}

	public function beforeSave() {
		if (empty($this->slug)) {
			$this->slug = $this->hyphenize($this->name_cat); 
		}else{
			$this->slug = $this->hyphenize($this->slug); 
		}
        return parent::beforeSave();
	 }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
