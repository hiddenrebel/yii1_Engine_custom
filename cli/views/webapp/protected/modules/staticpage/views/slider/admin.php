<?php
/* @var $this SliderController */
/* @var $model Slider */

$this->breadcrumbs=array(
	'Sliders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Slider', 'url'=>array('index')),
	array('label'=>'Create Slider', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#slider-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Sliders</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'slider-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_slider',
		'title_slider',
		'desc_slider',
		array(        
				'name'=>'img_slider',
				'value'=>'(!empty($data->img_slider))?CHtml::image(Yii::app()->request->baseUrl."/images/slider/".$data->img_slider,
					"",
					array(\'width\'=>100, \'height\'=>100)):""',
			'type'=>'raw',
			),
		'create_at',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
