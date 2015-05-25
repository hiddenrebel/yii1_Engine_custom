<?php if(count($dataProvider->getData())>0): ?>
	<div class="summary">
		<?php echo Yii::t('app', 'Displaying results for "{query}"', array('{query}'=>CHtml::encode($query))) ?>
	</div>
	<?php $this->widget($widget, CMap::mergeArray(array(
		'dataProvider'=>$dataProvider,
		'itemView'=>$this->action->getResultView(),
	), $widgetParams)); ?>
<?php else: ?>
	<!-- <?php /*echo Yii::t('app', 'No results found.');*/ ?> -->
	<div id="main" class="site-main">


		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">


				<header class="page-header">
					<h1 class="page-title">Nothing Found</h1>
				</header>

				<div class="page-content">

					<p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>
							<span class="screen-reader-text">Search for:</span>
					<?php $this->widget('ext.esearch.SearchBoxPortlet',array('htmlOptions'=>array('class'=>'search-form')));?>
					<!-- <form role="search" method="get" class="search-form" action="http://ibenerin.com/">
						<label>
							<input type="search" class="search-field" placeholder="Search …" value="king" name="s" title="Search for:">
						</label>
						<input type="submit" class="search-submit" value="Search">
						<span class="searchico genericon genericon-search"></span></form>
					</div> --><!-- .page-content -->

				</div>
				</div><!-- #content -->
			</div><!-- #primary -->



		</div><!-- #main -->
<?php endif ?>