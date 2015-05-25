<?php
/* @var $this CommentsController */
/* @var $data Comments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_comment')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_comment), array('view', 'id'=>$data->id_comment)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_post')); ?>:</b>
	<?php echo CHtml::encode($data->id_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_comment')); ?>:</b>
	<?php echo CHtml::encode($data->user_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_comment')); ?>:</b>
	<?php echo CHtml::encode($data->email_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_comment')); ?>:</b>
	<?php echo CHtml::encode($data->content_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_comment')); ?>:</b>
	<?php echo CHtml::encode($data->status_comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>