<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->id_comment=>array('view','id'=>$model->id_comment),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'Create Comments', 'url'=>array('create')),
	array('label'=>'View Comments', 'url'=>array('view', 'id'=>$model->id_comment)),
	array('label'=>'Manage Comments', 'url'=>array('admin')),
);
?>

<h1>Update Comments <?php echo $model->id_comment; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>