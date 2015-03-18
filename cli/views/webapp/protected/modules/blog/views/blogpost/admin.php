<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */

$this->breadcrumbs=array(
	$this->module->params->name_alias=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias, 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#blog-post-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <?=$this->module->params->name_alias;?></h1>

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
	'id'=>'blog-post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_post',
		'author_post',
		'title_post',
		array(
				'name'=>'content_post',
				'value'=>'substr($data->content_post, 0,100)',
				'type'=>'raw',
			),
		array(        
				'name'=>'img_post',
				'value'=>'(!empty($data->img_post))?CHtml::image(Yii::app()->request->baseUrl."/images/blog/".$data->img_post,
					"",
					array(\'width\'=>100, \'height\'=>100)):""',
			'type'=>'raw',
			),
		'slug_post',
		/*
		'category_post',
		'created_date_post',
		'publish_post',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
