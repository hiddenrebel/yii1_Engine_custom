<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<?php 
	      $baseUrl = Yii::app()->baseUrl; 
	      // Yii::app()->booster->cs->registerCssFile($baseUrl  . '/css/lomoto.css');
	      // Yii::app()->booster->cs->registerScriptFile($baseUrl.'/js/plugins/morris/raphael.min.js',CClientScript::POS_END);
	 ?>

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<?php 
				$items = array(
					array('label'=>'Home', 'url'=>array('/site/index')),
					array('label'=>Yii::app()->user->name, 'url'=>array('/'),'items'=>array(
							array(
								'label'=>"Change Password",
								'url'=>Yii::App()->baseUrl.'/backend/admin/change',
								),
							array(
								'label'=>"Manage User",
								'url'=>Yii::App()->baseUrl.'/backend/admin',
								),
							  '---',
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
						)),
					array('label'=>'Login', 'url'=>array('/backend/site/login'), 'visible'=>Yii::app()->user->isGuest),
				);
				$navku = array();
				$subNav = array();
				foreach (Yii::App()->modules as $key => $value) {
					if ($key!='gii') {
						$label = $key;
						if (isset($value['name_alias'])) {
							$label = $value['name_alias'];
						}

						if (isset($value['subNav'])) {
							array_push($subNav, array(
									'label'=>ucwords($label),
									'url'=>Yii::App()->baseUrl.'/backend/'.$key,
									)
								);
							foreach ($value['subNav'] as $isi) {
								array_push($subNav, array(
											'label'=>ucwords($isi),
											'url'=>Yii::App()->baseUrl.'/backend/'.$key.'/'.$isi,
									));
							}
							
						}
						array_push($navku, array(
								'label'=>ucwords($label),
								'url'=>Yii::App()->baseUrl.'/backend/'.$key,
								'items'=>$subNav
								)
							);
							$subNav = array();
						
					}
					$label="";
				}
				
				array_splice($items, 1, 0, $navku);

			 ?>
			
	 <?php 
		 $this->widget(
		 	'booster.widgets.TbNavbar',
		 	array(
		 		'brand' => '',
		 		'brandOptions'=>array('style'=>'display:none;'),
					// 'brandUrl' => Yii::App()->baseUrl.'/backend/',
		 		'fixed' => false,
		 		'fluid' => true,
		 		'items' => array(
		 			array(
		 				'class' => 'booster.widgets.TbMenu',
		 				'type' => 'navbar',
		 				'items' => $items
		 				)
		 			)
		 		)
		 	);
	 	?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'homeLink'=>CHtml::link('Main page', Yii::app()->homeUrl.'backend'), 
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Crowlabs.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
