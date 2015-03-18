<?php
/* @var $this BlogCategoryController */
/* @var $model BlogCategory */

$this->breadcrumbs=array(
	$this->module->params->name_alias.' Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BlogCategory', 'url'=>array('index')),
	array('label'=>'Manage BlogCategory', 'url'=>array('admin')),
);
?>

<h1>Create <?=$this->module->params->name_alias;?>Category</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>