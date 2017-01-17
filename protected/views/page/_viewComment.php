<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    <br />
 
    <b><?php echo CHtml::encode($data->getAttributeLabel('guest')); ?>:</b>
    <?php echo CHtml::encode($data->guest); ?>
	 <br />

   <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode(date('Y-m-d H:i', $data->created)); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
    <?php echo CHtml::encode($data->content); ?>
    <br />

 



</div>