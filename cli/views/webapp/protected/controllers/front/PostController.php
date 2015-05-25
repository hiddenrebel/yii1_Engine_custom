<?php

class PostController extends Front
{
	public $layout='//layouts/column2';

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	public function actionSearch()
	{
		$result= Yii::app()->userSearch->get('name:tom',0,20);
		echo "Results number is ".$result->response->numFound;
		foreach($result->response->docs as $doc){
		   echo "{$doc->name} <br>";
		}
		// $q = new CDbCriteria();
		// $q->addSearchCondition('title_post', $_GET['BlogPost']['title_post']);
		 
		// $model = BlogPost::model()->findAll( $q );

		// $model = new BlogPost('search');
		// $model->unsetAttributes(); // clear any default values
		// if (isset($_GET['BlogPost']))
		// 	$model->attributes = $_GET['BlogPost'];

		// echo "<pre>";
		// print_r($model);
		/*$this->render('view', array(
			'model' => $model,
		));*/
	}

	public function actionView($id)
	{
		$commentData=Comments::model()->findAllByAttributes(array('id_post'=>$id),array(
	        'condition'=>'status_comment=:status', 
	        'params'=>array(':status'=>1)
	    ));
		$comment=new Comments;

		if(isset($_POST['Comments']))
		{
			$comment->attributes=$_POST['Comments'];
			$comment->id_post=$id;
			if($comment->save())
			{
				$this->redirect(Yii::app()->getRequest()->urlReferrer);
			}
		}

		$post = $this->loadModel_Post($id);
		$category = $this->loadModel_Category(Yii::app()->session['cat_page']);

		// print_r($category);
		
		$this->render('view', array('model'=>$post,'category'=>$category,'comment'=>$comment, 'commentData'=>$commentData));
	}

	public function loadModel_Post($id)
	{
		$model=BlogPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel_Category($id)
	{
		$model=BlogCategory::model()->findByPk($id);
		if($model===null)
			return false;
			// throw new CHttpException(404,'The requested page does not exist.');
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