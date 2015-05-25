<?php

class CategoryController extends Front
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

		$criteria->condition = 'id_cat = '.$id;
         $news = BlogCategory::model()->with('blogRelatedPost')->with('blogRelatedPostComment')->findAll($criteria); //returns AR objects
         Yii::app()->session['cat_page'] = $news[0]->id_cat;
         $count = count($news[0]->blogRelatedPost);

         $sort = new CSort();
                 
                 // One attribute for each column of data
         $sort->attributes = array(
         	'title_post',
         	);
                 // Set the default order
         $sort->defaultOrder = array(
         	'title_post'=>CSort::SORT_ASC,
         	);
         $dataProvider= new CArrayDataProvider($news[0]->blogRelatedPost, array(
               'pagination'=>array('pageSize'=>$pageSize),
               'sort'=>$sort
               ));

        $models = $dataProvider->getData();          
		$this->render('category',array('blogCat'=>$news[0],'blogPost'=>$models, 'pages' => $dataProvider->pagination));
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