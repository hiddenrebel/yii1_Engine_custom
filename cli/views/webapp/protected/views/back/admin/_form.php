<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php if ($model->scenario == 'update'): ?>
			<?php echo $form->textFieldGroup(
						$model,
						'username',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							'widgetOptions' => array(
								'htmlOptions' => array('disabled' => true)
							)
						)
					); ?>
		<?php else: ?>
			<?php echo $form->textFieldGroup($model,'username'); ?>
		<?php endif ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->passwordFieldGroup($model,'password_user',array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'value' => ''
					)
				)
			)); ?>
		<?php echo $form->error($model,'password_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->passwordFieldGroup($model,'password_repeat',array(
				'widgetOptions' => array(
					'htmlOptions' => array(
						'value' => ''
					)
				)
			)); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row">
		<?php if ($model->scenario == 'update'): ?>
			<?php echo $form->textFieldGroup(
						$model,
						'role_user',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							'widgetOptions' => array(
								'htmlOptions' => array('disabled' => true)
							)
						)
					); ?>
		<?php else: ?>
			<?php echo $form->dropDownListGroup(
						$model,
						'role_user',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							'widgetOptions' => array(
								'data' => array('user'=>'User'),
								'htmlOptions' => array('empty'=>'Choose'),
							)
						)
					); ?>
		<?php endif ?>
		<?php echo $form->error($model,'role_user'); ?>
	</div>

		<?php $this->widget(
					'booster.widgets.TbButton',
					array(
						'buttonType' => 'submit',
						'context' => 'primary',
						'label' => 'Submit'
					)
				); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->