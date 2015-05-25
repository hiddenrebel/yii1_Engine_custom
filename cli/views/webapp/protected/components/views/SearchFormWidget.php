<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-form',
	'method'=>'get',
	'action' => array('post/search'),
)); ?>


		<?php echo $form->textField($model,'title_post',array('class'=>"form-control lobster", 'id'=>"title_post", 'placeholder'=>"Enter title post")); ?>
		<?php echo $form->error($model,'title_post'); ?>

<?php $this->endWidget(); ?>