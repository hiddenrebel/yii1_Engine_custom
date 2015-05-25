<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'comments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of TbActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'id_post'); ?>
		<?php echo $form->textField($model,'id_post',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'id_post'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'user_comment'); ?>
		<?php echo $form->textField($model,'user_comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'user_comment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email_comment'); ?>
		<?php echo $form->textField($model,'email_comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email_comment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content_comment'); ?>
		<?php $this->widget(
						    'booster.widgets.TbCKEditor',
						    array(
						        'model' => $model,
						        'attribute' => 'content_comment',
						        'editorOptions'=>array(
						        	'filebrowserImageBrowseUrl'=> Yii::App()->baseUrl.'/kcfinder/browse.php?opener=ckeditor&type=images',
						        )
						    )
						); ?>
		<?php echo $form->error($model,'content_comment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status_comment'); ?>
		<?php echo $form->textField($model,'status_comment'); ?>
		<?php echo $form->error($model,'status_comment'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'create_at'); ?>
		<?php echo $form->textField($model,'create_at'); ?>
		<?php echo $form->error($model,'create_at'); ?>
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