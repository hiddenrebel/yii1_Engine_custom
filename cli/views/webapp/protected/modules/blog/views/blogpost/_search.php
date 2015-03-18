<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_post'); ?>
		<?php echo $form->textField($model,'id_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author_post'); ?>
		<?php echo $form->textField($model,'author_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_post'); ?>
		<?php echo $form->textField($model,'title_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content_post'); ?>
		<?php echo $form->textArea($model,'content_post',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_post'); ?>
		<?php echo $form->textArea($model,'img_post',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slug_post'); ?>
		<?php echo $form->textField($model,'slug_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'category_post'); ?>
		<?php echo $form->textField($model,'category_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_date_post'); ?>
		<?php echo $form->dateField($model,'created_date_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publish_post'); ?>
		<?php echo $form->textField($model,'publish_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->