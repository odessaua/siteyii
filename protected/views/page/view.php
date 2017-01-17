<?php
/* @var $this PageController */
$this->breadcrumbs = array($models->category->title=>array('index', 'id'=>$models->category_id), $models->title
);

		echo CHtml::link('<h3>'.$models->title.'</h3>', array('view', 'id'=>$value->id));
		echo date('j-m-Y H:i', $models->created);
		echo '<div class="content">';
		echo $models->content;
	
		echo '</div><hr>';

	
if(Yii::app()->user->hasFlash('comment')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('comment'); ?>
</div>

<?php else: ?>
	


<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'comment-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>



	
<?php 

//VarDumper::dump($model->errors);

echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'content'); ?>
        <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'content'); ?>
    </div>
<? if (Yii::app()->user->isGuest):?>

    <div class="row">
        <?php echo $form->labelEx($model,'guest'); ?>
        <?php echo $form->textField($model,'guest',array('size'=>10,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'guest'); ?>
    </div>
<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>

		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	
<? endif;?>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Отправить'); ?>
    </div>

<?


$this->endWidget();?>

</div><!-- form -->

<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider'=>Comment::getComments($model->id),
    'itemView'=>'_viewComment',
)); ?>