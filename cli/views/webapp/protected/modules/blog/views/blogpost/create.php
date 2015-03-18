<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */

$this->breadcrumbs=array(
	$this->module->params->name_alias=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias, 'url'=>array('index')),
	// array('label'=>'Manage '.$this->module->params->name_alias, 'url'=>array('admin')),
);
?>

<h1>Create <?=$this->module->params->name_alias;?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>