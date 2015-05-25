<?php
/* @var $this StaticPageController */
/* @var $model StaticPage */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
	$model->id_page,
);

$this->menu=array(
	array('label'=>'List StaticPage', 'url'=>array('index')),
	array('label'=>'Update StaticPage', 'url'=>array('update', 'id'=>$model->id_page)),
	// array('label'=>'Delete StaticPage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_page),'confirm'=>'Are you sure you want to delete this item?')),
	// array('label'=>'Manage StaticPage', 'url'=>array('admin')),
);
?>

<h1>View StaticPage #<?php echo $model->id_page; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_page',
		'title_page',
		array(
				'type'=>'raw',
				'name'=>'desc_page',
				'value'=>substr($model->desc_page,0,300).'...'
			),
		'type_page',
		'create_at',
	),
)); ?>
