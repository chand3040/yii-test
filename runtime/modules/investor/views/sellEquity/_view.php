
<?php

/* @var $this SellEquityController */
/* @var $data SellEquity */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('starting_bid')); ?>:</b>
	<?php echo CHtml::encode($data->starting_bid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('duration')); ?>:</b>
	<?php echo CHtml::encode($data->duration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insertion_fee')); ?>:</b>
	<?php echo CHtml::encode($data->insertion_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('final_valuation_fee')); ?>:</b>
	<?php echo CHtml::encode($data->final_valuation_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datetime')); ?>:</b>
	<?php echo CHtml::encode($data->datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profiles_id')); ?>:</b>
	<?php echo CHtml::encode($data->profiles_id); ?>
	<br />



</div>