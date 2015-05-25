<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */
/* @var $form CActiveForm */
?>
<?php $this->renderPartial('media') ?>
<div class="form">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'blog-post-form',
	'type' => 'horizontal',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	

	<?php 
		$this->widget(
		    'booster.widgets.TbTabs',
		    array(
		        'type' => 'tabs', // 'tabs' or 'pills'
		        'tabs' => array(
		            array(
		                'label' => 'Post',
		                'content' => '<br>'.$this->renderPartial('_form-post', array('form'=>$form,'model'=>$model,'tags'=>$tags),true),
		                'active' => true
		            ),
		            array('label' => 'SEO', 'content' => '<br>'.$this->renderPartial('_form-seo', array('form'=>$form,'model'=>$model),true)),
		        ),
		    )
		);
	 ?>


		<div class="col-lg-offset-3 col-lg-5">
			
		<?php $this->widget(
					'booster.widgets.TbButton',
					array(
						'buttonType' => 'submit',
						'context' => 'primary',
						'label' => ($model->isNewRecord ? 'Create' : 'Save')
					)
				); ?>
		</div>

<?php $this->endWidget(); ?>

</div><!-- form -->