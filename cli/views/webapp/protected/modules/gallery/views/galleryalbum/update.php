<?php
/* @var $this GalleryalbumController */
/* @var $model GalleryAlbum */

$this->breadcrumbs=array(
	'Gallery Albums'=>array('index'),
	$model->id_album=>array('view','id'=>$model->id_album),
	'Update',
);

$this->menu=array(
	array('label'=>'List GalleryAlbum', 'url'=>array('index')),
	array('label'=>'Create GalleryAlbum', 'url'=>array('create')),
	array('label'=>'View GalleryAlbum', 'url'=>array('view', 'id'=>$model->id_album)),
	array('label'=>'Manage GalleryAlbum', 'url'=>array('admin')),
);
?>

<h1>Update GalleryAlbum <?php echo $model->id_album; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>