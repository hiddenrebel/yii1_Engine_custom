<?php
/* @var $this SliderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sliders',
);

$this->menu=array(
	array('label'=>'Create Slider', 'url'=>array('create')),
	array('label'=>'Manage Slider', 'url'=>array('admin')),
);
?>

<h1>Sliders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
