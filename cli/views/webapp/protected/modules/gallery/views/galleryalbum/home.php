<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'myModal')
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Album</h4>
    </div>
 
    <div class="modal-body">
       <?php/* $this->renderPartial('_form', array('model'=>$model));*/ ?>
    </div>
 
    <div class="modal-footer">
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
<?php Booster::getBooster()->cs->registerPackage('ckeditor'); ?>
 <div class="container">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Hendry Gallery</h1>
        </div>
    </div>
    <!-- /.row -->

    <!-- Projects Row -->
    <div class="row">
        <div class="col-md-3 portfolio-item">
            <?php echo CHtml::ajaxLink (CHtml::image($this->module->assetsUrl.'/images/buat-album.jpg','',array('class'=>'img-responsive')),
                  Controller::createUrl('/photos/galleryalbum/create'), 
                  array('update' => '.modal-body','replace'=>'#gallery-album-form',
                    'complete' => 'function() {
                        $("#myModal").modal("show");
                        CKEDITOR.replace( "GalleryAlbum_desc_album", {});
                    }'  
                    ),array('data-toggle'=>"modal", 'data-target'=>"#myModal",'class'=>'pull-right'));?>

        </div>
        <?php foreach ($data as $album): ?>
        <article class="col-xs-12 col-sm-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="<?=Yii::app()->createUrl('photos/galleryalbum/view',array('id'=>$album->id_album));?>">
                        <?php if (empty($album->cover_album) || !file_exists(Yii::app()->params['images'].'/Photos/'.$album->cover_album)): ?>
                            <?php echo CHtml::image($this->module->assetsUrl.'/images/gallery.png','',array('class'=>'img-responsive')); ?>
                        <?php else: ?>
                            <img width='100%' src="<?=Yii::App()->baseUrl.'/images/Photos/'.$album->cover_album;?>" data-toggle="modal" data-target=".coba" alt="Food Portfolio" />
                        <?php endif ?>
                        <span class="overlay"></span>
                    </a>
                </div>
                <div class="panel-footer">
                    <h4>
                        <a href="<?=Yii::app()->createUrl('photos/galleryalbum/view',array('id'=>$album->id_album));?>" title="Food Portfolio"><?=$album->title_album;?></a>
                        
                        <?php echo CHtml::ajaxLink ("<span class='glyphicon glyphicon-pencil'></span>",
                              Controller::createUrl('/photos/galleryalbum/update',array('id'=>$album->id_album)), 
                              array('update' => '.modal-body','replace'=>'#gallery-album-form',
                                'complete' => 'function() {
                                    $("#myModal").modal("show");
                                    CKEDITOR.replace( "GalleryAlbum_desc_album", {});
                                }'  
                                ),array('data-toggle'=>"modal", 'data-target'=>"#myModal", 'data-idalbum'=>"$album->id_album",'class'=>'pull-right'));?>
                    </h4>
                </div>
            </div>
        </article>
        <?php endforeach ?>
    </div>
    <!-- /.row -->

    <hr>


</div>
<!-- /.container -->