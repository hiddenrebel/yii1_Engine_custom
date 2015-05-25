<?php
/* @var $this PhotosController */
/* @var $model Photos */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_photo'); ?>
		<?php echo $form->textField($model,'id_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_album'); ?>
		<?php echo $form->textField($model,'id_album'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_photo'); ?>
		<?php echo $form->textField($model,'title_photo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_photo'); ?>
		<?php $this->widget(
						    'booster.widgets.TbCKEditor',
						    array(
						        'model' => $model,
						        'attribute' => 'desc_photo'
						    )
						); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_photo'); ?>
		<?php echo $form->fileField($model,'img_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alt_photo'); ?>
		<?php echo $form->textField($model,'alt_photo',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->