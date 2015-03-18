<?php 
Yii::import('application.modules.blog.BlogModule');

class Model extends CActiveRecord
{
	public $name_alias;
	public function init()
	{
		// parent::__construct($this->scenario);
		$blogModule = new BlogModule('blog','BlogModule');

		if (isset(Yii::app()->modules['blog']['name_alias'])) {
			$this->name_alias = Yii::app()->modules['blog']['name_alias'];
		}else{
			$this->name_alias = $blogModule->name_alias;
		}
	}
}