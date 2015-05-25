<?php
class SiteController extends Front
{
	public $layout='//layouts/column2';


	/**
	 * Declares class-based actions.
	 */
	// public function actions()
	// {
	// 	return array(
	// 		// captcha action renders the CAPTCHA image displayed on the contact page
	// 		'captcha'=>array(
	// 			'class'=>'CCaptchaAction',
	// 			'backColor'=>0xFFFFFF,
	// 		),
	// 		// page action renders "static" pages stored under 'protected/views/site/pages'
	// 		// They can be accessed via: index.php?r=site/page&view=FileName
	// 		'page'=>array(
	// 			'class'=>'CViewAction',
	// 		),
	// 	);
	// }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout='main_home';
		$pageSize=10; 

		$tags = Terms::model()->with('termsTaxoTag')->findAll(array('order'=>'termsTaxoTag.count_taxonomy DESC'));

		$post = BlogPost::model()->findAll(); //returns AR objects
		$count = count($post);

		$sort = new CSort();

		// One attribute for each column of data
		$sort->attributes = array(
			'created_date_post',
			'id_post',
			);
		// Set the default order
		$sort->defaultOrder = array(
			'created_date_post'=>CSort::SORT_DESC,
			'id_post'=>CSort::SORT_DESC,
			);
		$dataProvider= new CArrayDataProvider($post, array(
			'pagination'=>array('pageSize'=>$pageSize),
			'sort'=>$sort
			));

		$models = $dataProvider->getData();          

		$this->render('mainpage',array('blogpost'=>$models, 'pages' => $dataProvider->pagination,'tags'=>$tags));

	}

	

	public function actionRead($id)
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

		$this->render('read',array(
			'model'=>$this->loadModel_Blogpost($id),
			'comment'=>$comment,
			'commentData'=>$commentData,
		));
	}

	public function actionAbout()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$static = StaticPage::model()->findByAttributes(array('type_page'=>'about'));
		$this->render('static',array('static'=>$static));

	}
	public function actionVisionmission()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$static = StaticPage::model()->findByAttributes(array('type_page'=>'vimis'));
		$this->render('static',array('static'=>$static));

	}
	public function actionProgram()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$pageSize=1; 
		$criteria=new CDbCriteria();

		$criteria->condition = 'id_cat = 1';
		$news = BlogCategory::model()->with('blogRelatedPost')->findAll($criteria); //returns AR objects
		if (!empty($news)) {
			Yii::app()->session['cat_page'] = $news[0]->id_cat;
			$count = count($news[0]->blogRelatedPost);

			$dataProvider= new CArrayDataProvider($news[0]->blogRelatedPost, array(
				'pagination'=>array('pageSize'=>$pageSize),
				));

			$models = $dataProvider->getData();          
			$this->render('program',array('blogCat'=>$news[0],'blogPost'=>$models, 'pages' => $dataProvider->pagination));
		}
	}
	public function actionForm()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$static = StaticPage::model()->findByAttributes(array('type_page'=>'form'));
		$this->render('form',array('static'=>$static));

	}

	private function runMigrationTool() {
	    $commandPath = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . 'commands';
	    $runner = new CConsoleCommandRunner();
	    $runner->addCommands($commandPath);
	    $commandPath = Yii::getFrameworkPath() . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'commands';
	    $runner->addCommands($commandPath);
	    $args = array('yiic', 'migrate', '--interactive=0');
	    ob_start();
	    $runner->run($args);
	    echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
	}
	
	public function actionInstall()
	{
		$this->runMigrationTool();
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		/*$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
		*/
		$static = StaticPage::model()->findByAttributes(array('type_page'=>'contact'));
		$this->render('static',array('static'=>$static));
	}

	public function loadModel_Blogpost($id)
	{
		$model=BlogPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}


	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}