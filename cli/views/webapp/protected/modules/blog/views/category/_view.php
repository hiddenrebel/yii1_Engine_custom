<?php
/* @var $this BlogCategoryController */
/* @var $data BlogCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cat')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_cat), array('view', 'id'=>$data->id_cat)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_cat')); ?>:</b>
	<?php echo CHtml::encode($data->name_cat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_cat')); ?>:</b>
	<?php echo CHtml::encode($data->parent_cat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>