<?php 
	$baseUrl = Yii::app()->baseUrl; 
	Yii::app()->booster->cs->registerCssFile($baseUrl  . '/css/jquery.tagsinput.css');
	Yii::app()->booster->cs->registerScriptFile($baseUrl.'/js/jquery.tagsinput.js');
 ?>
<div class="col-xs-9">
	
	<?php echo $form->textFieldGroup(
				$model,
				'title_post',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions' => array(
										'htmlOptions' => array()
									),
		)
	); ?>
		<?php echo $form->error($model,'title_post'); ?>



		<?php echo $form->ckEditorGroup(
			$model,
			'content_post',
			array(
		   		'wrapperHtmlOptions' => array(
					 'class' => 'col-sm-8', 
				),
				'widgetOptions' => array(
					'editorOptions' => array(
						'filebrowserImageBrowseUrl'=> Yii::App()->baseUrl.'/kcfinder/browse.php?opener=ckeditor&type=images',
						'removeDialogTabs'=>'link:upload;image:Upload',
						'fullpage' => 'js:true',
						"stylesSet"=>array(
			            			array('name'=> 'Title 1', 'element'=> 'p', 'attributes'=>array('class'=> 'title1')),
			            			array('name'=> 'Title 2', 'element'=> 'p', 'attributes'=>array('class'=> 'title2'))
			            		),
			        	'contentsCss'=>Yii::App()->baseUrl.'/css/cacing.css'
					)
				)
			)
		); ?>
		<?php echo $form->error($model,'content_post'); ?>
		
		<a href='#' id='file-picker' class="btn btn-primary">Search Image</a>
		<script>$("#file-picker").on('click', function(event) {event.preventDefault(); });</script>

		<?php echo $form->hiddenField($model, 'img_post'); ?>
		<?php /*echo $form->fileFieldGroup($model, 'img_post',
					array(
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
						),
					)
				);*/ ?>
		<div class="form-group">
			<div class='col-sm-offset-3 col-sm-5' id='logger'>
				
			<?php 
				if (!empty($model->img_post)) {
					echo "<img width='100%' src=".$model->img_post.">";
				}
			 ?>
			<?php echo $form->error($model,'img_post'); ?>
			</div>
		</div>
	
		<?php echo $form->textFieldGroup(
					$model,
					'slug_post',
					array(
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
							),
						
			)
		); ?>
		<?php echo $form->error($model,'slug_post'); ?>

		<div class="form-group row">
			<div class="col-sm-offset-3 col-xs-4">
				<input id="search" type="text" class='form-control' placeholder="Search Related">
				<select name="" multiple class='form-control' id='dataSearch'>
				</select>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<a id="btnRelated" href="#" class="btn btn-primary">Add Related</a>
			</div>

		</div>

	<div class="form-group row">
		<label class='col-sm-3 control-label'>Related <?=$this->module->params->name_alias;?></label>
		<div class="col-xs-9" id="newRelated">
			<?php if ($model->blogPostRelated): ?>
				<?php foreach ($model->blogPostRelated as $rp): ?>
					<div class="penutup">
						<input type="hidden" name="BlogPost[related][]" value="<?=$rp->id_post;?>"><label style="font-weight:normal;"><?=$rp->title_post;?></label>
						<a href="#" class="deleteRelate btn btn-danger">X</a>
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
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

		

		<?php echo $form->dropDownListGroup(
					$model,
					'publish_post',
					array(
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
							'data' => array('Publish'=>'Publish','Draft'=>'Draft'),
						)
					)
				); ?>
		<?php echo $form->error($model,'publish_post'); ?>
</div>
<div class="col-xs-3">
	<div class="form-tags">
		<h1>Tags</h1>
		<?php 
		$taging =array();
		foreach ($tags as $t) {
			array_push($taging, $t->name);
		}
		?>
		<p>
		<?php echo $form->textField($model,'post_tag',array('class'=>'tags')); ?>
			
		</p>
		<script>
			var data=<?=CJSON::encode($taging);?>;
			var nginput;
			function onAddTag(tag) {
				data.push(tag);
				var isi =  data.join(',');
				$(nginput).attr('value',isi);
			}
			function onRemoveTag(tag) {
				var itemtoRemove = tag;
				console.log('hapus '+tag);
				data.splice($.inArray(itemtoRemove, data),1);
				var isi =  data.join(',');
				$(nginput).attr('value',isi);

			}
			function onChangeTag(input,tag) {
				nginput = input;
				var isi =  data.join(',');
				$(input).attr('value',isi);
			}
			$('#BlogPost_post_tag').importTags(data.join(','));
		    $(function() {
		      $('#BlogPost_post_tag').tagsInput({
		      	width:'auto',
		      	'delimiter': [','],
		      	'autocomplete_url': function(request, response) {
		      		url = "<?=Yii::app()->createUrl('blog/blogpost/autocomplete');?>";
		      		$.get(url+'?search='+request.term, function(data){
		      			data = JSON.parse(data);
		      			response(data);
		      		});
		      	},
		      	'onChange': onChangeTag,
		      	'onRemoveTag':onRemoveTag,
		      	'onAddTag':onAddTag
		      });
		    });
		</script>
	</div>
	<?php $opts = CHtml::listData(BlogCategory::model()->findAll(),'id_cat','name_cat'); ?>
		<?php $selected_keys = array_keys(CHtml::listData( $model->relatedCategory, 'id_cat_related' , 'id_cat_related')); ?>
		<?php $model->category_post = $selected_keys; ?>

		<h1>Category</h1>
		<?php echo CHtml::textField('BlogCategory[name_cat]',"",array('id'=>'create_category')); ?>
		<?php echo CHtml::ajaxButton('Add New Category', Yii::app()->createUrl('/blog/category/index'), 
				array(
					'type'=>'POST',
					'data'=> 'js:{"BlogCategory[name_cat]": $("#create_category").val()}',                        
					'success'=>'js:function(string){
						category_post = $("#BlogPost_category_post");
						var jmlInput = category_post.children("input").length;
						var untukValue = jmlInput+1;
						$("#BlogPost_category_post").append("<br><input id=BlogPost_category_post_"+jmlInput+" value="+untukValue+" name=BlogPost[category_post][] type=checkbox> <label for=BlogPost_category_post_"+jmlInput+">"+$("#create_category").val()+"</label>");
					}'           
					),
				array('update'=>'#BlogPost_category_post',)); ?><br>
		<?php echo $form->checkBoxList(
				$model,
				'category_post',
				$opts
			); ?>
</div>
