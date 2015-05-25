<?php
/* @var $this StaticPageController */
/* @var $data StaticPage */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_page')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_page), array('view', 'id'=>$data->id_page)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_page')); ?>:</b>
	<?php echo CHtml::encode($data->title_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_page')); ?>:</b>
	<?php echo CHtml::encode($data->desc_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_page')); ?>:</b>
	<?php echo CHtml::encode($data->type_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_page')); ?>:</b>
	<?php 
			if (!empty($data->img_page)) {
				echo "<img width='200px' src=".Yii::App()->baseUrl.'/images/blog/'.$data->img_page.">";
			}
		 ?><br>

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>