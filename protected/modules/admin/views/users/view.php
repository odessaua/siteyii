<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'Журнал пользователей', 'url'=>array('index')),
	array('label'=>'Редактор пользователей', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),

);
?>

<h1>Просмотр пользователя #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'password',
		'created'=>array(
						'name'=>'created', 
						'value'=>date("j-m-Y H:i", $data->created)),
		'ban'=>array(
						'name'=>'ban', 
						'value'=> ($data->ban==1)?"":"бан",
						
						
						),
		
		'role'=>array(
						'name'=>'role', 
						'value'=> ($data->role==1)?"User":"Admin",
						
						
						),
		'status',

	),
)); ?>
