<?php
/* @var $this SliderController */
/* @var $model Slider */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'slider-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title_slider'); ?>
		<?php echo $form->textField($model,'title_slider',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title_slider'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_slider'); ?>
		<?php echo $form->textArea($model,'desc_slider',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'desc_slider'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_slider'); ?>
		<?php echo $form->fileField($model, 'img_slider'); ?>
		<?php 
			if (!empty($model->img_slider)) {
				echo "<img width='300px' src=".Yii::App()->baseUrl.'/images/slider/'.$model->img_slider.">";
			}
		 ?>
		<?php echo $form->error($model,'img_slider'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->