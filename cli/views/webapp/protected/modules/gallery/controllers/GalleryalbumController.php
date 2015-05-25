<?php

class GalleryalbumController extends Controller
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

	public function actions()
    {
    	return array(
    		'captcha'=>array(
    			'class'=>'CCaptchaAction','backColor'=>0xFFFFFF,
    			),
    		'page'=>array('class'=>'CViewAction'),
    		'yiifilemanagerfilepicker'=>array(
    			'class'=>'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'
    		),
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('yiifilemanagerfilepicker'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','Makecover','Deletephoto'),
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
		$model = $this->loadModel($id);
		$photos=new Photos;
		$this->render('view',array(
			'model'=> $model,
			'photos'=> $photos,
		));
	}

	public function actionUpload()
	{
	    header('Vary: Accept');
	    if (isset($_SERVER['HTTP_ACCEPT']) && 
	        (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))
	    {
	        header('Content-type: application/json');
	    } else {
	        header('Content-type: text/html');
	    }
	    $data = array();
	 
	    $model = new BlogPost('upload');
	    $model->picture = CUploadedFile::getInstance($model, 'picture');
	    if ($model->picture !== null  && $model->validate(array('picture')))
	    {
	        $model->picture->saveAs(Yii::getPathOfAlias('images').'/'.$model->picture->name);
	        $model->img_post = $model->picture->name;
	        // save picture name
	        if( $model->save())
	        {
	            // return data to the fileuploader
	            $data[] = array(
	                'name' => $model->picture->name,
	                'type' => $model->picture->type,
	                'size' => $model->picture->size,
	                // we need to return the place where our image has been saved
	                'url' => $model->getImageUrl(), // Should we add a helper method?
	                // we need to provide a thumbnail url to display on the list
	                // after upload. Again, the helper method now getting thumbnail.
	                'thumbnail_url' => $model->getImageUrl(BlogPost::IMG_THUMBNAIL),
	                // we need to include the action that is going to delete the picture
	                // if we want to after loading 
	                'delete_url' => $this->createUrl('my/delete', 
	                    array('id' => $model->id, 'method' => 'uploader')),
	                'delete_type' => 'POST');
	        } else {
	            $data[] = array('error' => 'Unable to save model after saving picture');
	        }
            $data[] = array('error' => 'Unable to save model after saving picture');
	    } else {
	        if ($model->hasErrors('picture'))
	        {
	            $data[] = array('error', $model->getErrors('picture'));
	        } else {
	            $data[] = array('error', 'gembel');
	            // throw new CHttpException(500, "Could not upload file ".     CHtml::errorSummary($model));
	        }
	    }

	    // JQuery File Upload expects JSON data
	    echo json_encode($data);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GalleryAlbum;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GalleryAlbum']))
		{
			$model->attributes=$_POST['GalleryAlbum'];
			if($model->save())
				$this->redirect(array('galleryalbum/index'));
		}

		if (Yii::app()->request->isAjaxRequest) {
			$this->renderPartial('_form', array('model' => $model));
		}else{
			$this->render('create',array(
				'model'=>$model,
				));
		}
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

		if(isset($_POST['GalleryAlbum']))
		{
			$model->attributes=$_POST['GalleryAlbum'];
			if($model->save())
				$this->redirect(array('index'));
				// $this->redirect(array('view','id'=>$model->id_album));
		}

		if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('_form', array('model' => $model));
        } else {
			$this->render('update',array(
				'model'=>$model,
			));
        }
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if ($photos = $this->loadModel_Photos($id)) {
			foreach ($photos as $p) {
				$p->delete();
			}
		}
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionDeletephoto()
	{
		if (isset($_POST['id_photo']) && isset($_POST['id_album'])) {
			$photo = $this->loadModel_Photo($_POST['id_photo']);

			$image = Yii::app()->params['images'].'/Photos/'.$photo->img_photo;
			if (file_exists($image) && !is_dir($image))
				unlink($image);

			if ($photo->delete()) {
				return true;
			}
		}
		return false;
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->render('index');
		/*$model=new GalleryAlbum;
		$dataProvider=GalleryAlbum::model()->findAll();

		$this->render('home',array(
					'model'=>$model,
					'data'=>$dataProvider,
				));*/
		/*$model=new GalleryAlbum('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GalleryAlbum']))
			$model->attributes=$_GET['GalleryAlbum'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
	}

	public function actionMakecover()
	{
		if (isset($_POST['cover']) && isset($_POST['id_album'])) {
			$album = $this->loadModel($_POST['id_album']);
			$album->cover_album = $_POST['cover'];
			if ($album->save()) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$dataProvider=new CActiveDataProvider('GalleryAlbum');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return GalleryAlbum the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=GalleryAlbum::model()->with('photos')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModel_Photos($id)
	{
		$model=Photos::model()->findAllByAttributes(array('id_album'=>$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	public function loadModel_Photo($id)
	{
		$model=Photos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param GalleryAlbum $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
