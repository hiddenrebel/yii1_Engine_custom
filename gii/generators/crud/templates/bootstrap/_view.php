<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $data <?php echo $this->getModelClass(); ?> */
?>

<div class="view">

<?php
echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?>:</b>\n";
echo "\t<?php echo CHtml::link(CHtml::encode(\$data->{$this->tableSchema->primaryKey}), array('view', 'id'=>\$data->{$this->tableSchema->primaryKey})); ?>\n\t<br />\n\n";
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if($column->isPrimaryKey)
		continue;
	if(++$count==7)
		echo "\t<?php /*\n";
	
	echo "\t<b><?php echo CHtml::encode(\$data->getAttributeLabel('{$column->name}')); ?>:</b>\n";

	if (preg_match('/^(img|img_|image|image_)/i',$column->name)) {
		echo "\t\t<?php if (!empty(\$data->{$column->name})) {
				echo CHtml::image(Yii::app()->request->baseUrl.\"/images/{$this->modelClass}/\".\$data->{$column->name},
									\"\",
									array(\"width\"=>100, \"height\"=>100));
			}?>\n\t<br />\n\n";
		
	}else{
		echo "\t<?php echo CHtml::encode(\$data->{$column->name}); ?>\n\t<br />\n\n";
	}
}
if($count>=7)
	echo "\t*/ ?>\n";
?>

</div>