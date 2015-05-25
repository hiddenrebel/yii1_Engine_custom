<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Front extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $tags=array();
	public $meta_keywords="";
	public $meta_desc="";
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $lastestPost=array();

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'search'=>array(
				'class'=>'ext.esearch.SearchAction',
				'model'=>'BlogPost',
				'urlAttribute'=>'slug_post',
				'showAttributes'=>array('content_post'),
				'attributes'=>array('title_post', 'content_post'),
				),
			'yiifilemanagerfilepicker'=>array(
    			'class'=>'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'
    		),
		);
	}

	public function wordBreak($kalimat,$limitWord=100)
	{
		$num_words = $limitWord;
		$words = array();
		$words = explode(" ", strip_tags($kalimat), $num_words);
		$shown_string = "";

		if(count($words) == $limitWord){
		   $words[$limitWord-1] = " ... ";
		}

		$shown_string = implode(" ", $words);
		return $shown_string;

	}

	public function init()
	{
		// foreach (Yii::app()->db->schema->getTables() as $table) {
		// }
			if (Yii::app()->db->schema->getTable("blog_category",true)===null) {
			    echo "Please Install DB";
			} else {
			    // table exists
			    $tags = Terms::model()->with('termsTaxoTag')->findAll();
				$blogCategory = BlogCategory::model()->findAll();
				$nav = array();
				foreach ($blogCategory as $bc) {
					array_push($this->menu,  array(
						'label'=>strtoupper($bc->name_cat).' ('.count($bc->blogRelatedPost).')',
						'url'=>Yii::App()->baseUrl.'/'.$bc->slug,
						// 'url'=>Yii::App()->baseUrl.'/category/view/'.$bc->id_cat,
						)
					);

				}

				$this->lastestPost = BlogPost::model()->findAll(array('order'=>'created_date_post DESC, id_post DESC'));
				$this->tags = $tags;
			}
			

	}
}