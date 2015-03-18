<?php
/* @var $this BlogPostController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->params->name_alias,
);

$this->menu=array(
	array('label'=>'Create '.$this->module->params->name_alias, 'url'=>array('create')),
	// array('label'=>'Manage '.$this->module->params->name_alias, 'url'=>array('admin')),
);
?>

<h1><?=$this->module->params->name_alias;?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
