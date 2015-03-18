<?php
/* @var $this BlogCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->params->name_alias.' Categories',
);

$this->menu=array(
	array('label'=>$this->module->params->name_alias.' BlogCategory', 'url'=>array('create')),
	array('label'=>'Manage '.$this->module->params->name_alias.' Category', 'url'=>array('admin')),
);
?>

<h1><?=$this->module->params->name_alias;?> Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
