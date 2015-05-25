<?php
/* @var $this BlogCategoryController */
/* @var $model BlogCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'name_cat'); ?>
		<?php echo $form->textField($model,'name_cat',array('size'=>60,'maxlength'=>255,'class'=>'maul')); ?>
		<?php echo $form->error($model,'name_cat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_cat'); ?>
		<?php echo $form->textArea($model, 'desc_cat'); ?>
		<?php echo $form->error($model,'desc_cat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_cat'); ?>
		<?php $opts = CHtml::listData(BlogCategory::model()->findAll(),'id_cat','name_cat'); ?>
		<?php echo $form->dropDownList($model, 'parent_cat', $opts,array('empty'=>'select parent')); ?>
		<?php echo $form->error($model,'parent_cat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->