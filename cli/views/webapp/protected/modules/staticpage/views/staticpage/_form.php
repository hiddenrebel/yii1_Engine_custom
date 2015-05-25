<?php
/* @var $this StaticPageController */
/* @var $model StaticPage */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'static-page-form',
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
		<?php echo $form->labelEx($model,'title_page'); ?>
		<?php echo $form->textField($model,'title_page',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc_page'); ?>
		<?php 
			$this->widget(
			    'booster.widgets.TbCKEditor',
			    array(
			        'model' => $model,
			        'attribute' => 'desc_page',
			        'editorOptions'=>array(
			        	'fullpage' => 'js:true',
			        	'removeDialogTabs'=>'link:upload;image:Upload',
			        	'filebrowserImageBrowseUrl'=> Yii::App()->baseUrl.'/kcfinder/browse.php?opener=ckeditor&type=images',
			        )
			    )
			);
		 ?>
		<?php echo $form->error($model,'desc_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_page'); ?>
		<?php echo $form->fileField($model, 'img_page'); ?>
		<?php 
			if (!empty($model->img_page)) {
				echo "<img width='500px' src=".Yii::app()->request->baseUrl."/images/Static/".$model->img_page.">";
			}
		 ?>
		<?php echo $form->error($model,'img_page'); ?>
	</div>
<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'type_page'); ?>
		<?php echo $form->dropDownList($model, 'type_page', array('front'=>'Front','about'=>'About Page'),array('empty'=>'null')); ?>
		<?php echo $form->error($model,'type_page'); ?>
	</div>
 -->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->