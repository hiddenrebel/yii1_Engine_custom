<?php 
/**
* 
*/
class BlogModule extends CWebModule
{
	private $_assetsUrl;
	public $OpenERP;
	public $baseUrl;
	public $subNav;
	public $name_alias='Blog';
	public $glyphicon='list-alt';
	/**
	 * Initializes the gii module.
	 */
	public function init()
	{
		parent::init();
		Yii::setPathOfAlias('blog',dirname(__FILE__));
		/*$this->setComponents(array(
		              'errorHandler' => array(
		                      'errorAction' => 'module/default/error'),
		              'defaultController' => 'default',
		              'user' => array(
		                      'class' => 'ModuleWebUser',
		                      'allowAutoLogin'=>true,
		                      'loginUrl' => Yii::app()->createUrl('module/default/login'),
		              )
		          ));*/
      // import the module-level models and components or any other components..
		$this->setImport(array(
			'blog.models.*',
			'blog.components.*',
			));
		$this->setParams(array(
				'name_alias'=>$this->name_alias,

			));
		$this->baseUrl = Yii::App()->baseUrl.'/backend/blog/';
	}
	/**
	 * @return string the base URL that contains all published asset files of gii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('blog.assets'));
		return $this->_assetsUrl;
	}
	/**
	 * @param string $value the base URL that contains all published asset files of gii.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}



}