<?php

class AdminController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','change','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view'),
				'users'=>array('@'),
				// 'users'=>array('admin'),
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
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_user));
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
		$this->redirect(array('change'));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
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
		// $this->redirect(array('admin/admin'));
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->redirect(array('admin/index'));
		/*$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
	}

	public function actionChange()
	{
		$this->layout='column1';
		// $dataProvider=new CActiveDataProvider('Users');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));

		$model=$this->loadModel(Yii::app()->user->id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if ($filename = CUploadedFile::getInstance($model,'user_photo')) {
				$image = Yii::app()->params['images'].'/User/'.$model->user_photo;
				if (file_exists($image) && !is_dir($image))
	                unlink($image);
				$file_name_save = $this->changeNameFile($filename);
				$model->user_photo = $file_name_save;
				$filename->saveAs(Yii::app()->params['images'].'/User/'.$file_name_save);
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_user));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	private function changeNameFile($filename,$count=1,$realname = "")
	{
		if (!is_dir(Yii::app()->params['images'].'/User/')) {
			mkdir(Yii::app()->params['images'].'/User/',0777);
		}
		if (!empty($realname)) {
			if (file_exists(Yii::app()->params['images'].'/User/'.$realname)) {
				$filerealname = explode('.'.$filename->extensionName, $filename->name);
				$realname = $filerealname[0].$count.'.'.$filename->extensionName;
				$count++;
				$this->changeNameFile($filename,$count,$realname);
			}
			if (!empty($realname)) {
				return $realname;
			}else{
				return $filename->name;
			}
		}else{
			if (file_exists(Yii::app()->params['images'].'/User/'.$filename->name)) {
				$filerealname = explode('.'.$filename->extensionName, $filename->name);
				$realname = $filerealname[0].$count.'.'.$filename->extensionName;
				$this->changeNameFile($filename,$count++,$realname);
			}
			if (!empty($realname)) {
				return $realname;
			}else{
				return $filename->name;
			}
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
