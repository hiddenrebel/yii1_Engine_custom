<?php
/* @var $this GalleryalbumController */
/* @var $data GalleryAlbum */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_album')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_album), array('view', 'id'=>$data->id_album)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_album')); ?>:</b>
	<?php echo CHtml::encode($data->title_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_album')); ?>:</b>
	<?php echo CHtml::encode($data->desc_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug_album')); ?>:</b>
	<?php echo CHtml::encode($data->slug_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_album')); ?>:</b>
	<?php echo CHtml::encode($data->cover_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>