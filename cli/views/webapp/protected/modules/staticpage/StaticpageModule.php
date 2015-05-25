<?php 
/**
* 
*/
class StaticpageModule extends CWebModule
{
	private $_assetsUrl;
	public $baseUrl;
	public $subNav;
	public $glyphicon='file';
	/**
	 * Initializes the gii module.
	 */
	public function init()
	{
		parent::init();
		Yii::setPathOfAlias('staticpage',dirname(__FILE__));
		$this->baseUrl = Yii::App()->baseUrl.'/backend/staticpage/';
	}
	/**
	 * @return string the base URL that contains all published asset files of gii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('staticpage.assets'));
		return $this->_assetsUrl;
	}
	/**
	 * @param string $value the base URL that contains all published asset files of gii.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}

	public function registerImage($file)
	{
		return $this->getAssetsUrl().'/images/'.$file;
	}



}