<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>

<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'login-form',
				'enableClientValidation'=>true,
				'htmlOptions'=>array('class'=>'form-signin'),
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>

	            <span id="reauth-email" class="reauth-email"></span>


				<?php echo $form->textField($model,'username',array('id'=>'inputEmail','class'=>'form-control','placeholder'=>'Username')); ?>
				<?php echo $form->error($model,'username'); ?>

				<?php echo $form->passwordField($model,'password',array('id'=>'inputPassword','class'=>'form-control','placeholder'=>'Password')); ?>
				<?php echo $form->error($model,'password'); ?>
				
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>


				<?php echo CHtml::submitButton('Sign In',array('class'=>'btn btn-lg btn-primary btn-block btn-signin')); ?>

		<?php $this->endWidget(); ?>
		<!-- <a href="#" class="forgot-password">
            Forgot the password?
        </a> -->
    </div><!-- /card-container -->
</div><!-- /container -->