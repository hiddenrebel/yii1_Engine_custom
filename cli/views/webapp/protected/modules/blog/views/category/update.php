<?php
/* @var $this BlogCategoryController */
/* @var $model BlogCategory */

$this->breadcrumbs=array(
	$this->module->params->name_alias.' Categories'=>array('index'),
	$model->id_cat=>array('view','id'=>$model->id_cat),
	'Update',
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias.' Category', 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias.' Category', 'url'=>array('create')),
	array('label'=>'View '.$this->module->params->name_alias.' Category', 'url'=>array('view', 'id'=>$model->id_cat)),
	array('label'=>'Manage '.$this->module->params->name_alias.' Category', 'url'=>array('admin')),
);
?>

<h1>Update <?=$this->module->params->name_alias;?> <?php echo $model->id_cat; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>