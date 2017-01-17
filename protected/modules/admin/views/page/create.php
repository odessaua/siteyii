<?php
/* @var $this PageController */
/* @var $model Page */

$this->menu=array(
	array('label'=>'Журнал страниц', 'url'=>array('index')),
);
?>

<h1>Создать страницу</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>