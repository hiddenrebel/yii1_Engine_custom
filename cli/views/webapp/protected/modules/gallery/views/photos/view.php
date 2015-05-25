<?php
/* @var $this PhotosController */
/* @var $model Photos */

$this->breadcrumbs=array(
	'Photoses'=>array('index'),
	$model->id_photo,
);

$this->menu=array(
	array('label'=>'List Photos', 'url'=>array('index')),
	array('label'=>'Create Photos', 'url'=>array('create')),
	array('label'=>'Update Photos', 'url'=>array('update', 'id'=>$model->id_photo)),
	array('label'=>'Delete Photos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_photo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Photos', 'url'=>array('admin')),
);
?>

<h1>View Photos #<?php echo $model->id_photo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_photo',
		'id_album',
		'title_photo',
		'desc_photo',
		array(        
		'name'=>'img_photo',
		'value'=>(!empty($model->img_photo))?CHtml::image(Yii::app()->request->baseUrl.'/images/Photos/'.$model->img_photo, '', array('width'=>100, 'height'=>100)):'',
		'type'=>'raw',
		),
		'alt_photo',
		'create_at',
	),
)); ?>
