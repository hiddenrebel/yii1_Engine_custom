<?php
/* @var $this BlogPostController */
/* @var $data BlogPost */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_post')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_post), array('view', 'id'=>$data->id_post)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_post')); ?>:</b>
	<?php echo CHtml::encode($data->author_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_post')); ?>:</b>
	<?php echo CHtml::encode($data->title_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_post')); ?>:</b>
	<?php echo CHtml::encode($data->content_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_post')); ?>:</b>
	<?php 
			if (!empty($data->img_post)) {
				echo "<img width='200px' src=".Yii::App()->baseUrl.'/images/blog/'.$data->img_post.">";
			}
		 ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug_post')); ?>:</b>
	<?php echo CHtml::encode($data->slug_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_post')); ?>:</b>
	<?php echo CHtml::encode($data->category_post); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date_post')); ?>:</b>
	<?php echo CHtml::encode($data->created_date_post); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish_post')); ?>:</b>
	<?php echo CHtml::encode($data->publish_post); ?>
	<br />

	*/ ?>

</div>