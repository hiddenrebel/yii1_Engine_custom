<?php

class TermsController extends Front
{
	public $layout='//layouts/column2';

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionView($id)
	{
		$pageSize=12; 
		$criteria=new CDbCriteria();

		$criteria->condition = 'termTaxo.id_term = '.$id;
		$terms = Terms::model()->with('blogPost')->find($criteria); //returns AR objects

		Yii::app()->session['term_page'] = $terms->id_term;
		$count = count($terms->blogPost);

		$sort = new CSort();

		// One attribute for each column of data
		$sort->attributes = array(
			'blogPost.created_date_post',
			);
		// Set the default order
		$sort->defaultOrder = array(
			'blogPost.created_date_post'=>CSort::SORT_ASC,
			);
		$dataProvider= new CArrayDataProvider($terms->blogPost, array(
			'pagination'=>array('pageSize'=>$pageSize),
			'sort'=>$sort
			));

        $models = $dataProvider->getData();          
		$this->render('terms',array('terms'=>$terms,'blogPost'=>$models, 'pages' => $dataProvider->pagination));
	}

	public function loadModel_Category($id)
	{
		$model=BlogCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}