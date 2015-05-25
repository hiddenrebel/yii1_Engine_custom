<?php
/* @var $this GalleryalbumController */
/* @var $model GalleryAlbum */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_album'); ?>
		<?php echo $form->textField($model,'id_album'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_album'); ?>
		<?php echo $form->textField($model,'title_album',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'desc_album'); ?>
		<?php echo $this->widget(
						    'booster.widgets.TbCKEditor',
						    array(
						        'model' => $model,
						        'attribute' => 'desc_album'
						    )
						); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slug_album'); ?>
		<?php echo $form->textField($model,'slug_album',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cover_album'); ?>
		<?php echo $form->textField($model,'cover_album',array('size'=>60,'maxlength'=>255)); ?>
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