<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of TbActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<div class="form-group">
		<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
		<?php 
			if(stripos($column->dbType,'text')!==false){
				echo "<?php ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; 
			}else{
				echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; 
			}
		?>
<?php 
	if (preg_match('/^(img|img_|image|image_)/i',$column->name)) {
		echo "<?php if (!empty(\$model->{$column->name})) {
	echo CHtml::image(Yii::app()->request->baseUrl.\"/images/{$this->modelClass}/\".\$model->{$column->name},\$model->{$column->name},array('width'=>100,'height'=>100)); 
}?>\n";
	}
 ?>
		<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
	</div>

<?php
}
?>
	<?php echo "<?php \$this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'submit',
				'context' => 'primary',
				'label' => \$model->isNewRecord ? 'Create' : 'Save'
			)
		); ?>";  ?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->