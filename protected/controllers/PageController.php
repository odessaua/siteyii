<?php

class PageController extends Controller
{
	public function actionIndex($id)
	{
		$models = Page::model()->findAllByAttributes(array('category_id'=>$id));
		$category = Category::model()->findByPk($id);
	
		$this->render('index', array('models'=>$models, 'category'=>$category));
	}
	
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
	
	
		public function actionView($id)
	{
		$modelpage = Page::model()->findByPk($id);
		$setting = Setting::model()->findByPk('1');
		$newComment = new Comment;
		

		if(Yii::app()->user->isGuest) {	$newComment->scenario = 'guest2'; }
		
		
		      if(isset($_POST['Comment']))
        {
			
            $newComment->attributes = $_POST['Comment'];

			if(!Yii::app()->user->isGuest)
 { $newComment->guest = Yii::app()->user->name;}

			$newComment->page_id = $modelpage->id;
			
			if ($setting->defaultStatusComment==0)
						{ $newComment->status=0;}
				else 	{ $newComment->status=1;}
			
			
			
			if($newComment->save()) 
				{		
					if ($setting->defaultStatusComment==0)
					{
					Yii::app()->user->setFlash('comment', 'Уважаемый '.$newComment->guest.'! Ждите подтверждение комментария!');
					} else {
					Yii::app()->user->setFlash('comment','Уважаемый '.$newComment->guest.'! Ваш комментарий опубликован');
					}
					$this->refresh();
				}
			
        }

		

		
		
		$this->render('view', array('models'=>$modelpage, 'model'=>$newComment));
		
	}


}