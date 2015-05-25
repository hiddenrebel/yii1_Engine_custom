<?php
/* @var $this GalleryalbumController */
/* @var $model GalleryAlbum */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'gallery-album-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of TbActiveForm for details on this.
	// 'action'=>Yii::app()->createUrl('photos/galleryalbum/create'),
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title_album'); ?>
		<?php echo $form->textField($model,'title_album',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title_album'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'desc_album'); ?>
		<?php $this->widget(
						    'booster.widgets.TbCKEditor',
						    array(
						        'model' => $model,
						        'attribute' => 'desc_album'
						    )
						); ?>
		<?php echo $form->error($model,'desc_album'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slug_album'); ?>
		<?php echo $form->textField($model,'slug_album',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug_album'); ?>
	</div>

	   <!--  <?php /*$this->widget('booster.widgets.TbFileUpload', array(
	    'url' => $this->createUrl("/blog/blogpost/upload"),
	    'model' => $model,
	    'attribute' => 'picture', // see the attribute?
	    'multiple' => true,
	    'callbacks' => array(
	                'done' => new CJavaScriptExpression(
	                    'function(e, data) { alert(\'done!\'); }'
	                ),
	                'fail' => new CJavaScriptExpression(
	                    'function(e, data) { alert(\'fail!\'); }'
	                ),
	        ),
	    'options' => array(
			    'maxFileSize' => 2000000,
			    'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
			)
		));*/ ?>   -->

	<!-- <div class="form-group">
		<?php echo $form->labelEx($model,'cover_album'); ?>
		<?php echo $form->textField($model,'cover_album',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cover_album'); ?>
	</div> -->

	<?php $this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'submit',
				'context' => 'primary',
				// 'htmlOptions' => array('data-dismiss' => 'modal'),
				'label' => $model->isNewRecord ? 'Create' : 'Save'
			)
		); ?>
<?php $this->endWidget(); ?>

</div><!-- form -->