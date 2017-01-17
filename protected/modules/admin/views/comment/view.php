<?php
/* @var $this CommentController */
/* @var $model Comment */



$this->menu=array(
	array('label'=>'Список', 'url'=>array('index')),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены?')),
);
?>

<h1>Просмотр комментария #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'content',
		'page_id'=> array('name'=>'page_id', 
						   'value'=>$model->page->title),
		'created'=>array(
						'name'=>'created', 
						'value'=>date("j-m-Y H:i", $model->created),
						'filter'=> false),
		'user_id' => array('name'=>'user_id', 
						   'value'=>$model->users->username),
		'guest',
	),
)); ?>
