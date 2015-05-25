<?php

class PhotosController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
		$model=new Photos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Photos']))
		{
			$model->attributes=$_POST['Photos'];
			if ($filename = CUploadedFile::getInstance($model,'img_photo')) {
					$file_name_save= md5(date('Y-m-d h:i:s')).'-'.$filename->getName();
					$model->img_photo = $file_name_save;
					if (!is_dir(Yii::app()->params['images'].'/Photos/')) {
						mkdir(Yii::app()->params['images'].'/Photos/',0777);
					}
					$filename->saveAs(Yii::app()->params['images'].'/Photos/'.$file_name_save);
				}
			if($model->save())
				$this->redirect(array('/photos/galleryalbum/view','id'=>$model->id_album));
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

		if(isset($_POST['Photos']))
		{
			$model->attributes=$_POST['Photos'];
			if ($filename = CUploadedFile::getInstance($model,'img_photo')) {
				$image = Yii::app()->params['images'].'/Photos/'.$model->img_photo;
				if (!is_dir(Yii::app()->params['images'].'/Photos/')) {
					mkdir(Yii::app()->params['images'].'/Photos/',0777);
				}
				if (file_exists($image) && !is_dir($image))
	                unlink($image);
				$file_name_save= md5(date('Y-m-d h:i:s')).'-'.$filename->getName();
				$model->img_photo = $file_name_save;
				$filename->saveAs(Yii::app()->params['images'].'/Photos/'.$file_name_save);
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_photo));
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
		$model = $this->loadModel($id);
		$image = Yii::app()->params['uploadPhotos'].$model->img_photo;
		if (file_exists($image) && !is_dir($image))
            unlink($image);
        $model->delete();
		// $this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Photos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Photos']))
			$model->attributes=$_GET['Photos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('Photos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Photos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Photos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Photos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}