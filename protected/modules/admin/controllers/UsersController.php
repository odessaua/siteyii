<?php

class UsersController extends Controller
{

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
				'actions'=>array('index', 'view','update', 'delete', 'password'),
				'roles'=>array('2'),
			),
			array('deny', 
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
	
	public function beforeSave() 
	{
	$this->password = md5($this->password);
	return parent::beforeSave();  // îáÿçàòåëüíî âîçâğàùàòü ğîäèòåëüñêóş ôóíêöèş
	}
	
	
	
	 public function hash($password)
    {
        return base64_encode(pack('H*', sha1((trim($password)))));
    } 
	
	
		public function actionPassword($id)
	{
		$model= $this->loadModel($id);
		$model->password = $_POST['password'];
		if($model->save())
			$this->redirect(array('view', 'id'=>$model->id));
		$this->render('password',array(
			'model'=>$model,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{

		if(isset($_POST['noban'])) { $model=Users::model()->updateByPk($_POST['User_id'], array('ban'=>1));}
			else if (isset($_POST['ban'])){ $model=Users::model()->updateByPk($_POST['User_id'], array('ban'=>0));}
		if(isset($_POST['noadmin'])) { $model=Users::model()->updateByPk($_POST['User_id'], array('role'=>1), array('condition'=>'id<>'.Yii::app()->user->id));}
			else if (isset($_POST['admin'])){ $model=Users::model()->updateByPk($_POST['User_id'], array('role'=>2));}	
			
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('index',array(
			'model'=>$model,
		));
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
