<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_comment'); ?>
		<?php echo $form->textField($model,'id_comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_post'); ?>
		<?php echo $form->textField($model,'id_post',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_comment'); ?>
		<?php echo $form->textField($model,'user_comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_comment'); ?>
		<?php echo $form->textField($model,'email_comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content_comment'); ?>
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
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_comment'); ?>
		<?php echo $form->textField($model,'status_comment'); ?>
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