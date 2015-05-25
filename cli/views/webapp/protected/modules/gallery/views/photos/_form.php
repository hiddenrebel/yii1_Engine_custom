<?php
/* @var $this PhotosController */
/* @var $model Photos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'photos-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of TbActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'action'=>Yii::app()->createUrl('photos/photos/create'),
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->hiddenField($model,'id_album'); ?>
		<?php echo $form->error($model,'id_album'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title_photo'); ?>
		<?php echo $form->textField($model,'title_photo',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'title_photo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'desc_photo'); ?>
		<?php $this->widget(
						    'booster.widgets.TbCKEditor',
						    array(
						        'model' => $model,
						        'attribute' => 'desc_photo',
						        'editorOptions'=>array(
						        	'toolbar'=>array(
						        		array('name'=>'insert','items'=>array('image')),
						        	)
						        )
						    )
						); ?>
				<?php echo $form->error($model,'desc_photo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'img_photo'); ?>
		<?php echo $form->fileField($model,'img_photo'); ?>
		<?php if (!empty($model->img_photo)) {
			echo CHtml::image(Yii::app()->request->baseUrl."/images/Photos/".$model->img_photo,$model->img_photo,array('width'=>100,'height'=>100)); 
		}?>
		<?php echo $form->error($model,'img_photo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alt_photo'); ?>
		<?php echo $form->textField($model,'alt_photo',array('size'=>60,'maxlength'=>255)); ?>
				<?php echo $form->error($model,'alt_photo'); ?>
	</div>

	<?php $this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'submit',
				'context' => 'primary',
				'label' => $model->isNewRecord ? 'Create' : 'Save'
			)
		); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->