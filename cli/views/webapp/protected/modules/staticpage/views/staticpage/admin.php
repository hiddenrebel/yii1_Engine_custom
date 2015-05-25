<?php
/* @var $this StaticPageController */
/* @var $model StaticPage */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List StaticPage', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#static-page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Static Pages</h1>

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

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'static-page-grid',
	'type' => 'striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_page',
		'title_page',
		array(
				'type'=>'raw',
				'name'=>'desc_page',
				'value'=>'substr($data->desc_page,0,300)." ..."'
			),
		array(        
				'name'=>'img_page',
				'value'=>'(!empty($data->img_page))?CHtml::image(Yii::app()->request->baseUrl."/images/Static/".$data->img_page,
					"",
					array(\'width\'=>100, \'height\'=>100)):""',
			'type'=>'raw',
			),
		'type_page',
		'create_at',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{view}{delete}',
                    'buttons'=>array(
                    	'update'=>array(
                    			'visible'=>'true'
                    			                    			
                    		),
	                    'view'=>array(
	                            'visible'=>'true',
	                    ),
	                    'delete'=>array(
	                            'visible'=>'false',
	                    )
                    )
		),
	),
)); ?>
