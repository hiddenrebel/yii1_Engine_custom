<?php
/* @var $this BlogPostController */
/* @var $model BlogPost */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title_post'); ?>
		<?php echo $form->textField($model,'title_post',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content_post'); ?>
		<?php 
			$this->widget(
			    'booster.widgets.TbCKEditor',
			    array(
			        'model' => $model,
			        'attribute' => 'content_post'
			    )
			);
		 ?>
		<?php echo $form->error($model,'content_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_post'); ?>
		<?php echo $form->fileField($model, 'img_post'); ?>
		<?php 
			if (!empty($model->img_post)) {
				echo "<img src=".Yii::App()->baseUrl.'/images/blog/'.$model->img_post.">";
			}
		 ?>
		<?php echo $form->error($model,'img_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug_post'); ?>
		<?php echo $form->textField($model,'slug_post',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug_post'); ?>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<input id="search" type="text" placeholder="Search Related">
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<select name="" multiple id='dataSearch'>
			</select>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<a id="btnRelated" href="#" class="btn btn-primary">Add Related</a>
		</div>

	</div>
	<div class="row">
		<label>Related <?=$this->module->params->name_alias;?></label>
	</div>
	<div class="row" id="newRelated">
		<?php if ($model->blogPostRelated): ?>
			<?php foreach ($model->blogPostRelated as $rp): ?>
				<div class="penutup">
					<input type="hidden" name="BlogPost[related][]" value="<?=$rp->id_post;?>"><label style="font-weight:normal;"><?=$rp->title_post;?></label>
					<a href="#" class="deleteRelate btn btn-danger">X</a>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>

	<script>
		
		$('#newRelated').on('click','.deleteRelate',function(e){
			e.preventDefault();
			$(this).parent().remove();
		});

		var dataPost=null;
		$(function () {
			ngajax(null);
		});
		$('input#search').keyup(function(){
			ngajax($(this).val());
		});

		function ngajax (input) {
			$.ajax({
					url: '<?=Yii::App()->baseUrl."/backend/blog/blogpost/search";?>',
					type: 'get',
					dataType: "json",
				    contentType: "application/json; charset=utf-8",
					data: {'search':input},
					success: function (data) {
							addNewRelated(data);
					}
				});
		}
		dataSearch = $("#dataSearch");
		function addNewRelated (data) {
			dataSearch.empty();
			$.each(data, function(key,value){
				dataSearch.append('<option value="'+value.id_post+'">'+value.title_post+'</option>')
			});
		}
		dataSearch.on('change',function(){
			$( "#dataSearch option:selected" ).each(function() {
			     textOption = $( this ).text();
			   });
			dataPost = {'id_post':$(this).val(),'title_post':textOption};
		});



		$('#btnRelated').on('click',function(e){
			e.preventDefault();
			if (dataPost != null) {
				$('#newRelated').append('<div class="penutup"><input type="hidden" name="BlogPost[related][]" value="'+dataPost.id_post+'"><label style="font-weight:normal;">'+dataPost.title_post+'</label><a href="#"  class="deleteRelate btn btn-danger">X</a></div>');
			};
		});


		
	</script>

	<div class="row">
		<?php echo $form->labelEx($model,'category_post'); ?>
		<?php $opts = CHtml::listData(BlogCategory::model()->findAll(),'id_cat','name_cat'); ?>
		<?php $selected_keys = array_keys(CHtml::listData( $model->relatedCategory, 'id_cat_related' , 'id_cat_related')); ?>
		<?php echo CHtml::checkBoxList('BlogPost[category_post][]', $selected_keys, $opts,array('template'=>'<div>{label}{input}</div>')); ?>
		<?php echo $form->error($model,'category_post'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'publish_post'); ?>
		<?php 
			echo $form->dropDownList($model,'publish_post',array('Publish'=>'Publish','Draft'=>'Draft'));
		 ?>
		<?php echo $form->error($model,'publish_post'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->