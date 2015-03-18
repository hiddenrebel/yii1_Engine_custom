<?php 
/**
* 
*/
class SliderModule extends CWebModule
{
	private $_assetsUrl;
	public $baseUrl;
	public $subNav;
	/**
	 * Initializes the gii module.
	 */
	public function init()
	{
		parent::init();
		Yii::setPathOfAlias('slider',dirname(__FILE__));
		$this->baseUrl = Yii::App()->baseUrl.'/backend/slider/';
	}
	/**
	 * @return string the base URL that contains all published asset files of gii.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('slider.assets'));
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