<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'Создание Пользователя', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление пользователями</h1>



<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?
	echo CHtml::form();
	echo CHtml::submitButton('Разбанить', array('name'=>'noban'));
	echo CHtml::submitButton('Забанить', array('name'=>'ban'));
	echo '<br />';
	echo CHtml::submitButton('Admin', array('name'=>'admin'));
	echo CHtml::submitButton('не админ', array('name'=>'noadmin'));
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'selectableRows'=>2, 
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array('name'=>'id', 'headerHtmlOptions'=>array('width'=>'25')),
		array('class'=>'CCheckBoxColumn',
			'id'=>'User_id'
				),
		'username',
		'email',
		'created'=>array(
						'name'=>'created', 
						'value'=>'date("j-m-Y H:i", $data->created)',
						'filter'=> false),
		'ban'=>array(
						'name'=>'ban', 
						'value'=> '($data->ban==1)?"":"бан"',
						'filter'=> array(0=>'да', 1=> 'нет')
						
						),
		
		'role'=>array(
						'name'=>'role', 
						'value'=> '($data->role==1)?"User":"Admin"',
						'filter'=> array(0=>'Admin', 1=> 'User')
						
						),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 


	echo CHtml::endForm();

?>
