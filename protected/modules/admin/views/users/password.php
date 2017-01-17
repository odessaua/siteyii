<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'Журнал Пользователей', 'url'=>array('index')),
	array('label'=>'Просмотр Пользователей', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Изменить пользователя', 'url'=>array('update', 'id'=>$model->id)),

);
?>


<h1>Изменение пароля <?php echo $model->id; ?></h1>

<?php 
	
	echo CHtml::form();
	echo CHtml::textField('password');
	echo CHtml::submitButton('Изменить');
	echo CHtml::endform();


 ?>