<?php

class BlogpostController extends Controller
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
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','search','Cover_Post'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$blog = $this->loadModel($id);

		$this->render('view',array(
			'model'=>$blog,
		));
	}

	public function actionCover_Post()
	{
		if (isset($_POST['CP'])) {
			if (!empty($_POST['CP']['id_post']) && !empty($_POST['CP']['cover_post'])) {
				BlogCover::model()->deleteAllByAttributes(array(),'id_post = :id_post',array(
								    ':id_post'=>$_POST['CP']['id_post'],
								));
				BlogCover::model()->deleteAllByAttributes(array(),'id_cat = :id_cat',array(
								    ':id_cat'=>$_POST['CP']['cover_post'],
								));
				$blogCover = BlogCover::model()->findAllByAttributes(array('id_cat'=>$_POST['CP']['cover_post']));
				if (empty($blogCover)) {
					$bc = new BlogCover;
					$bc->id_cat = $_POST['CP']['cover_post'];
					$bc->id_post = $_POST['CP']['id_post'];
					if ($bc->save()) {
						$this->redirect(array('blogpost/view','id'=>$_POST['CP']['id_post']));	
					}
				}else{
					$blogCover->id_post = $_POST['CP']['id_post'];
					if ($blogCover->save()) {
						$this->redirect(array('blogpost/view','id'=>$_POST['CP']['id_post']));	
					}
				}
			}
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BlogPost;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogPost']))
		{
			$model->attributes=$_POST['BlogPost'];
			if ($filename = CUploadedFile::getInstance($model,'img_post')) {

				$file_name_save= md5(date("Y-m-d h:i:s")).'-'.$filename->getName();
				$model->img_post = $file_name_save;
				$filename->saveAs(Yii::app()->params['uploadBlog'].$file_name_save);
			}
			if($model->save()){
				
				if (count($_POST['BlogPost']['category_post'])>0) {
					foreach ($_POST['BlogPost']['category_post'] as $cp) {
						$cat_post = new BlogRelatedCategory;
						$cat_post->id_post = $model->id_post;
						$cat_post->id_cat_related = $cp;
						if (!$cat_post->save()) {
							echo "Error Related Category";
							print_r($model->getErrors());
							die();
						}
					}
				}
				if (isset($_POST['BlogPost']['related']) && count($_POST['BlogPost']['related'])>0) {
					foreach ($_POST['BlogPost']['related'] as $r) {
						$related = new BlogRelatedPost;
						$related->id_post = $model->id_post;
						$related->id_post_related = $r;
						if (!$related->save()) {
							echo "Error Related Post";
							die();
						}
					}

				}
				$routes = new BlogRoutes;
				$routes->real_link = '/product/view/id/'.$model->id_post;
				$routes->slug = $model->slug_post;
				$routes->save();

				$this->redirect(array('view','id'=>$model->id_post));
			
			}else{
				print_r($model->getErrors());
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
		$routes = $this->loadModel_Routes($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BlogPost']))
		{
			$model->attributes=$_POST['BlogPost'];
			if ($filename = CUploadedFile::getInstance($model,'img_post')) {
				$image = Yii::app()->params['uploadBlog'].$model->img_post;
				if (file_exists($image) && !is_dir($image))
	                unlink($image);
				$file_name_save= md5(date("Y-m-d h:i:s")).'-'.$filename->getName();
				$model->img_post = $file_name_save;
				$filename->saveAs(Yii::app()->params['uploadBlog'].$file_name_save);
			}
			if($model->save()){
				if (!empty($routes)) {
					if ($routes->slug != $model->slug_post) {
						$routes->delete();

						$modelRoutes = new BlogRoutes;
						$modelRoutes->slug = $model->slug_post;
						$modelRoutes->real_link = '/product/view/id/'.$model->id_post;
						$modelRoutes->save();
					}
				}else{
					$modelRoutes = new BlogRoutes;
					$modelRoutes->slug = $model->slug_post;
					$modelRoutes->real_link = '/product/view/id/'.$model->id_post;
					$modelRoutes->save();
				}


				if (isset($_POST['BlogPost']['related']) && count($_POST['BlogPost']['related'])>0) {
					BlogRelatedPost::model()->deleteAllByAttributes(array(),'id_post = :id_post',array(
									    ':id_post'=>$model->id_post,
									));

						foreach ($_POST['BlogPost']['related'] as $r) {
							$related = new BlogRelatedPost;
							$related->id_post = $model->id_post;
							$related->id_post_related = $r;
							if (!$related->save()) {
								echo "Error Related Post";
								die();
							}
						}

				}else{
					BlogRelatedPost::model()->deleteAllByAttributes(array(),'id_post = :id_post',array(
									    ':id_post'=>$model->id_post,
									));
				}


				if (isset($_POST['BlogPost']['category_post']) && count($_POST['BlogPost']['category_post'])>0) {
					BlogRelatedCategory::model()->deleteAllByAttributes(array(),'id_post = :id_post',array(
					    ':id_post'=>$model->id_post,
					));
						foreach ($_POST['BlogPost']['category_post'] as $cp) {
							$cat_post = new BlogRelatedCategory;
							$cat_post->id_post = $model->id_post;
							$cat_post->id_cat_related = $cp;
							if (!$cat_post->save()) {
								echo "Error Related Category";
								die();
							}
						}
				}else{
					BlogRelatedCategory::model()->deleteAllByAttributes(array(),'id_post = :id_post',array(
					    ':id_post'=>$model->id_post,
					));
				}
				$this->redirect(array('view','id'=>$model->id_post));
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
		$post = $this->loadModel($id);
		$image = Yii::app()->params['uploadBlog'].$post->img_post;
		if (file_exists($image) && !is_dir($image))
            unlink($image);
        $post->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new BlogPost('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BlogPost']))
			$model->attributes=$_GET['BlogPost'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('BlogPost');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionSearch($search)
	{

		$match = addcslashes($search, '%_'); // escape LIKE's special characters
		$q = new CDbCriteria( array(
		    'condition' => "title_post LIKE :match",         // no quotes around :match
		    'params'    => array(':match' => "%$match%")  // Aha! Wildcards go here
		) );
		 
		$Post = BlogPost::model()->findAll( $q );     // works!


		echo CJSON::encode($Post);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BlogPost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
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
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel_Routes($id)
	{
		// // $match = addcslashes("'category/view/',array('id'=>$id)", '%_'); // escape LIKE's special characters
		$match = '/product/view/id/'.$id; // escape LIKE's special characters
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
	 * @param BlogPost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
