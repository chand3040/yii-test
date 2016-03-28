
<?php

/* @var $this InvestorMessagesController */
/* @var $data InvestorMessages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_listing_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_listing_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject')); ?>:</b>
	<?php echo CHtml::encode($data->subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_user_type')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_user_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attachement')); ?>:</b>
	<?php echo CHtml::encode($data->attachement); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('is_spam')); ?>:</b>
	<?php echo CHtml::encode($data->is_spam); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_message')); ?>:</b>
	<?php echo CHtml::encode($data->first_message); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notice_flag')); ?>:</b>
	<?php echo CHtml::encode($data->notice_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('close_msg_flag')); ?>:</b>
	<?php echo CHtml::encode($data->close_msg_flag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_message_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_message_id); ?>
	<br />

	*/ ?>


</div>