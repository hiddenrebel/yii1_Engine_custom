<?php

class CategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BlogCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogCategory']))
		{
			$model->attributes=$_POST['BlogCategory'];

			if($model->save())
				$route = new BlogRoutes;
				$route->slug = $model->slug;
				$route->real_link = '/category/view/id/'.$model->id_cat;
				if ($route->save()) {
					$this->redirect(array('view','id'=>$model->id_cat));
				}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogCategory']))
		{
			$model->attributes=$_POST['BlogCategory'];
			$routes = $this->loadModel_Routes($id);
			if($model->save()){

				if (!empty($routes)) {
					if ($routes->slug != $model->slug) {
						$routes->delete();

						$modelRoutes = new BlogRoutes;
						$modelRoutes->slug = $model->slug;
						$modelRoutes->real_link = '/category/view/id/'.$model->id_cat;
						$modelRoutes->save();
					}
				}else{
					$modelRoutes = new BlogRoutes;
					$modelRoutes->slug = $model->slug;
					$modelRoutes->real_link = '/category/view/id/'.$model->id_cat;
					$modelRoutes->save();
				}
				$this->redirect(array('view','id'=>$model->id_cat));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new BlogCategory('search');
		// $model->unsetAttributes();  // clear any default values
		// if(isset($_GET['BlogCategory']))
		// 	$model->attributes=$_GET['BlogCategory'];

		$bc=new BlogCategory;
		if(isset($_POST['BlogCategory']))
		{
			$bc->attributes=$_POST['BlogCategory'];

			if($bc->save()){
				$route = new BlogRoutes;
				$route->slug = $bc->slug;
				$route->real_link = '/category/view/id/'.$bc->id_cat;
				if ($route->save()) {
					$this->redirect(array('index'));
				}
			}
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('BlogCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BlogCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BlogCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel_Routes($id)
	{
		// // $match = addcslashes("'category/view/',array('id'=>$id)", '%_'); // escape LIKE's special characters
		$match = Yii::app()->createUrl('category/view/',array('id'=>$id)); // escape LIKE's special characters
		$q = new CDbCriteria( array(
		    'condition' => "real_link LIKE :match",         // no quotes around :match
		    'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
		) );
		 
		$model = BlogRoutes::model()->find( $q );     // works!
		// if($model===null)
			// throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BlogCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
