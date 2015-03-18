<?php
/* @var $this BlogCategoryController */
/* @var $model BlogCategory */

$this->breadcrumbs=array(
	$this->module->params->name_alias.' Categories'=>array('index'),
	$model->id_cat,
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias.' Category', 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias.' Category', 'url'=>array('create')),
	array('label'=>'Update '.$this->module->params->name_alias.' Category', 'url'=>array('update', 'id'=>$model->id_cat)),
	array('label'=>'Delete '.$this->module->params->name_alias.' Category', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_cat),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage '.$this->module->params->name_alias.' Category', 'url'=>array('admin')),
);
?>

<h1>View <?=$this->module->params->name_alias;?> Category #<?php echo $model->id_cat; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_cat',
		'name_cat',
		'parent_cat',
		'slug',
		'create_at',
	),
)); ?>
