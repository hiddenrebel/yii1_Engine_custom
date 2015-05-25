<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'myModal')
); ?>
    
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Modal header</h4>
    </div>
 
    <div class="modal-body">
    	<?php $photos->id_album = $model->id_album; ?>
        <?php $this->renderPartial('../photos/_form',array('model'=>$photos)); ?>
    </div>
 
    <div class="modal-footer">
        <?php /*$this->widget(
            'booster.widgets.TbButton',
            array(
                'context' => 'primary',
                'label' => 'Save changes',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        );*/ ?>
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Close',
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget(); ?>
<?php
/* @var $this GalleryalbumController */
/* @var $model GalleryAlbum */

$this->breadcrumbs=array(
	'Gallery Albums'=>array('index'),
	$model->id_album,
);

$this->menu=array(
	array('label'=>'List GalleryAlbum', 'url'=>array('index')),
	array('label'=>'Create GalleryAlbum', 'url'=>array('create')),
	array('label'=>'Update GalleryAlbum', 'url'=>array('update', 'id'=>$model->id_album)),
	array('label'=>'Delete GalleryAlbum', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_album),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GalleryAlbum', 'url'=>array('admin')),
);
?>

<h1>View GalleryAlbum #<?php echo $model->id_album; ?></h1>

<div style='display:none;' class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success!</strong> Make Cover success
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_album',
		'title_album',
		'desc_album',
		'slug_album',
		'cover_album',
		'create_at',
	),
)); ?>
Total Photos <?=count($model->photos);?><br>
<?php echo CHtml::link('Add Photo', '#', array('class'=>'btn btn-primary','data-toggle'=>'modal', 'data-target'=>'#myModal')); ?>
<hr>
<div id="photos">
    
<?php foreach ($model->photos as $p): ?>
    <div class="col-xs-3">
        
    <?php echo CHtml::image(Yii::App()->baseUrl.'/images/Photos/'.$p->img_photo, 'alt', array('class'=>'img-rounded','width'=>'100%')); ?><br>
    <?php echo CHtml::ajaxButton('Make Cover Album', Yii::app()->createUrl('/photos/galleryalbum/makecover'), array(
                                'data' => array('cover'=> $p->img_photo,'id_album'=>$model->id_album),
                                'type'=>'POST',
                                // 'update' => '.modal-body','replace'=>'#gallery-album-form',
                                'success' => 'function(e) {
                                    $(".alert").show();
                                }'  
                                )); ?>
    <?php echo CHtml::ajaxButton('Delete Photo', Yii::app()->createUrl('/photos/galleryalbum/deletephoto'), array(
                                'data' => array('id_photo'=> $p->id_photo,'id_album'=>$model->id_album),
                                'type'=>'POST',
                                // 'update' => '.modal-body','replace'=>'#gallery-album-form',
                                'success' => 'function(e) {
                                   window.location.reload(); 
                                }'  
                                )); ?>
    </div>
<?php endforeach ?>
</div>
