<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */

$this->breadcrumbs=array(
	$this->module->params->name_alias=>array('index'),
	$model->id_post,
);

$this->menu=array(
	array('label'=>'List '.$this->module->params->name_alias, 'url'=>array('index')),
	array('label'=>'Create '.$this->module->params->name_alias, 'url'=>array('create')),
	array('label'=>'Update '.$this->module->params->name_alias, 'url'=>array('update', 'id'=>$model->id_post)),
	array('label'=>'Delete '.$this->module->params->name_alias, 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_post),'confirm'=>'Are you sure you want to delete this item?')),
	// array('label'=>'Manage '.$this->module->params->name_alias, 'url'=>array('admin')),
);
?>

<h1>View <?=$this->module->params->name_alias;?> #<?php echo $model->id_post; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_post',
		'author_post',
		'title_post',
		array(        
			'name'=>'content_post',
			'value'=>strip_tags($model->content_post),
			),

		array(        
			'name'=>'img_post',
			'value'=>(!empty($model->img_post))?CHtml::image($model->img_post, "", array('width'=>100, 'height'=>100)):"",
			'type'=>'raw',
			),
		'slug_post',
		'category_post',
		'created_date_post',
		'publish_post',
	),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'action' => Yii::App()->baseUrl.'/backend/blog/blogPost/cover_post',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php /*echo CHtml::errorSummary('cover_post');*/ ?>

	<?php echo CHtml::hiddenField('CP[id_post]',$model->id_post,array('size'=>60,'maxlength'=>255)); ?>

	<div class="row">
		<?php echo CHtml::label('Cover Post','cover_post'); ?>


		<?php 
			$selected_keys = "";
			foreach ($model->blogCover as $rc) {

				if ($rc->id_post == $model->id_post) {
					$selected_keys = $rc->id_cat;
				}
			}
		 ?>
		<?php $opts = CHtml::listData($model->blogCatRelated,'id_cat','name_cat'); ?>
		<?php 
			echo CHtml::dropDownList('CP[cover_post]',$selected_keys,$opts,array('empty'=>'null'));
		 ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>
