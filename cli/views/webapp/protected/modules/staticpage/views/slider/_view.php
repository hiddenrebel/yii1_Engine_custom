<?php
/* @var $this SliderController */
/* @var $data Slider */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_slider')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_slider), array('view', 'id'=>$data->id_slider)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_slider')); ?>:</b>
	<?php echo CHtml::encode($data->title_slider); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_slider')); ?>:</b>
	<?php echo CHtml::encode($data->desc_slider); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_slider')); ?>:</b>
	<?php 
			if (!empty($data->img_slider)) {
				echo "<img width='200px' src=".Yii::App()->baseUrl.'/images/slider/'.$data->img_slider.">";
			}
		 ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>