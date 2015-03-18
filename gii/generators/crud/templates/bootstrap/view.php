<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn},
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
	array('label'=>'Update <?php echo $this->modelClass; ?>', 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>'Delete <?php echo $this->modelClass; ?>', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage <?php echo $this->modelClass; ?>', 'url'=>array('admin')),
);
?>

<h1>View <?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	if (preg_match('/^(img|img_|image|image_)/i',$column->name)) {
		echo "\t\tarray(        
		'name'=>'{$column->name}',
		'value'=>(!empty(\$model->{$column->name}))?CHtml::image(Yii::app()->request->baseUrl.'/images/{$this->modelClass}/'.\$model->{$column->name}, '', array('width'=>100, 'height'=>100)):'',
		'type'=>'raw',
		),\n";
		
	}else{
		echo "\t\t'".$column->name."',\n";
	}
	
?>
	),
)); ?>
