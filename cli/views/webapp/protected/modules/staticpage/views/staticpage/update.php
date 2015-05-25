<?php
/* @var $this StaticPageController */
/* @var $model StaticPage */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
	$model->id_page=>array('view','id'=>$model->id_page),
	'Update',
);

$this->menu=array(
	array('label'=>'List StaticPage', 'url'=>array('index')),
	array('label'=>'View StaticPage', 'url'=>array('view', 'id'=>$model->id_page)),
	// array('label'=>'Manage StaticPage', 'url'=>array('admin')),
);
?>

<h1>Update StaticPage <?php echo $model->id_page; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>