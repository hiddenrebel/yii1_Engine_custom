<?php
/* @var $this SliderController */
/* @var $model Slider */

$this->breadcrumbs=array(
	'Sliders'=>array('index'),
	$model->id_slider,
);

$this->menu=array(
	array('label'=>'List Slider', 'url'=>array('index')),
	array('label'=>'Create Slider', 'url'=>array('create')),
	array('label'=>'Update Slider', 'url'=>array('update', 'id'=>$model->id_slider)),
	array('label'=>'Delete Slider', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_slider),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Slider', 'url'=>array('admin')),
);
?>

<h1>View Slider #<?php echo $model->id_slider; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_slider',
		'title_slider',
		'desc_slider',
		'img_slider',
		'create_at',
	),
)); ?>
