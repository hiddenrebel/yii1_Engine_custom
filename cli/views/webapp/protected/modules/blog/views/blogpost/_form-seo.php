
	<?php echo $form->textFieldGroup(
				$model,
				'meta_keywords',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
						),
					'widgetOptions' => array(
										'htmlOptions' => array()
									),
		)
	); ?>
	<?php echo $form->error($model,'meta_keywords'); ?>



	<?php echo $form->textAreaGroup(
				$model,
				'meta_desc',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'htmlOptions' => array('rows' => 5),
					)
				)
			); ?>
