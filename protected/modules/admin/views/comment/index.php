<?php
/* @var $this CommentController */
/* @var $model Comment */



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление комментариями</h1>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?
	echo CHtml::form();
	echo CHtml::submitButton('Показать', array('name'=>'noban'));
	echo CHtml::submitButton('Скрыть', array('name'=>'ban'));

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'selectableRows'=>2, 
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array('name'=>'id', 'headerHtmlOptions'=>array('width'=>'25')),
				array('class'=>'CCheckBoxColumn',
		'id'=>'post_id'
				),
		array('name'=>'content', 'value'=> 'mb_substr("$data->content", 0, 156, "UTF8")',),
		'page_id'=>array(
						'name'=>'page_id',
						'value'=>'$data->page->title',
						'filter'=> Page::all()
						),
		'created'=>array(
						'name'=>'created', 
						'value'=>'date("j-m-Y H:i", $data->created)',
						'filter'=> false),
		'user_id'=>array(
						'name'=>'user_id',
						'value'=>'$data->users->username',
						'filter'=> Users::all()
						),
		'status'=> array (
			'name'=> 'status',
			'value'=> '($data->status)==1?"доступно":"скрыто"',
			'filter'=> array(0=>'скрыто', 1=> 'доступно')),
		'guest',
		array(
			'class'=>'CButtonColumn',
			'updateButtonOptions'=>array('style'=> 'display:none')
		),
	),
)); 
	echo CHtml::endForm();
?>
