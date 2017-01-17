<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	' '.$category->title,
);

 foreach ($models as $value) 
	{
		echo CHtml::link('<h3>'.$value->title.'</h3>', array('view', 'id'=>$value->id));
		
		echo '<div class="content">';
		echo substr($value->content, 0, 515).'...';
		echo CHtml::link('читать далее', array('view', 'id'=>$value->id));
		echo '</div><hr>';
	}
	if(!$models) echo 'В данной категории статей нет';
	
	
?>


