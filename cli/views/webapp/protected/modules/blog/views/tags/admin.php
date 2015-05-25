<?php
/* @var $this BlogCategoryController */
/* @var $model BlogCategory */

$this->breadcrumbs=array(
	$this->module->params->name_alias.' Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias.' Category', 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias.' Category', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#blog-category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <?=$this->module->params->name_alias;?> Tags</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php/* $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->
<div class="row">
	
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<?php $this->renderPartial('create',array(
		'model'=>$model,
		)); ?>
</div>
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
	
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'blog-category-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'id_term',
			'name',
			array( 'name'=>'description', 'value'=>'$data->termTaxo->description_taxonomy' ),
			'slug',
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); ?>
</div>
</div>

