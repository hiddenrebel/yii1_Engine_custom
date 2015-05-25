<?php
/* @var $this PhotosController */
/* @var $data Photos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_photo')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_photo), array('view', 'id'=>$data->id_photo)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_album')); ?>:</b>
	<?php echo CHtml::encode($data->id_album); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title_photo')); ?>:</b>
	<?php echo CHtml::encode($data->title_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc_photo')); ?>:</b>
	<?php echo CHtml::encode($data->desc_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('img_photo')); ?>:</b>
		<?php if (!empty($data->img_photo)) {
				echo CHtml::image(Yii::app()->request->baseUrl."/images/Photos/".$data->img_photo,
									"",
									array("width"=>100, "height"=>100));
			}?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_photo')); ?>:</b>
	<?php echo CHtml::encode($data->alt_photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_at')); ?>:</b>
	<?php echo CHtml::encode($data->create_at); ?>
	<br />


</div>