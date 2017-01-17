<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'Журнал Пользователей', 'url'=>array('index')),
	array('label'=>'Просмотр Пользователей', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Изменить пароль', 'url'=>array('password', 'id'=>$model->id)),

);
?>

<h1>Редактор Пользователей <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>