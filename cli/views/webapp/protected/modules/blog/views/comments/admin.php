<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Comments', 'url'=>array('index')),
	array('label'=>'Create Comments', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comments-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>

<h1>Manage Comments</h1>

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
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_comment',
		'id_post',
		'user_comment',
		'email_comment',
		'content_comment',
		array(
				'name'=>'status_comment',
				'value'=>'CHtml::checkBox("status_comment",$data->status_comment,array("data-toggle"=>"toggle","data-comment"=>$data->id_comment,"class"=>"statusCheck"))',
			    'type'=>'raw',
			    'htmlOptions'=>array('width'=>5),
			),
		/*
		'create_at',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<script>
$(function() {
	$('.statusCheck').change(function() {
		statusnya = $(this).prop('checked');
		if (statusnya==true) {
			statusku = 1;
		}else{
			statusku = 0;
		};
		$.ajax({
			url: '<?=Yii::app()->createUrl("blog/comments/changestatus");?>',
			type: 'POST',
			data: {id_comment: $(this).data('comment'),status_comment: statusku},
		})
		.fail(function(e) {
			console.log(e);
		});

	})
})
</script>
