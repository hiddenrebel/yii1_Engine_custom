<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */

$this->breadcrumbs=array(
	$this->module->params->name_alias=>array('index'),
	$model->id_post=>array('view','id'=>$model->id_post),
	'Update',
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias, 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias, 'url'=>array('create')),
	array('label'=>'View '.$this->module->params->name_alias, 'url'=>array('view', 'id'=>$model->id_post)),
	// array('label'=>'Manage '.$this->module->params->name_alias, 'url'=>array('admin')),
);
?>

<h1>Update <?=$this->module->params->name_alias;?> <?php echo $model->id_post; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>