<?php

class TagsController extends Controller
{

	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		$model=new Terms('search');
		// $model->unsetAttributes();  // clear any default values
		// if(isset($_GET['Terms']))
		// 	$model->attributes=$_GET['Terms'];

		$terms=new Terms;
		if(isset($_POST['Terms']))
		{
			$terms->scenario = 'create';
			$terms->attributes=$_POST['Terms'];

			if($terms->save()){
				$route = new BlogRoutes;
				$route->slug = $terms->slug;
				$route->real_link = '/terms/view/id/'.$terms->id_term;
				if ($route->save()) {
					$this->redirect(array('index'));
				}
			}
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$routes = $this->loadModel_Routes($id);
		if (!empty($routes)) {
			$routes->delete();
		}
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function loadModel_Routes($id)
	{
		// // $match = addcslashes("'category/view/',array('id'=>$id)", '%_'); // escape LIKE's special characters
		$match = Yii::app()->createUrl('terms/view/',array('id'=>$id)); // escape LIKE's special characters
		$q = new CDbCriteria( array(
		    'condition' => "real_link LIKE :match",         // no quotes around :match
		    'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
		) );
		 
		$model = BlogRoutes::model()->find( $q );     // works!
		// if($model===null)
			// throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel($id)
	{
		$model=Terms::model()->findByPk($id);
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