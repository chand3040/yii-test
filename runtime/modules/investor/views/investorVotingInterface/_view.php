
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $data InvestorVotingInterface */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_default_investor_voting_id), array('view', 'id'=>$data->user_default_investor_voting_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_question')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_voting_question); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_answer1')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_voting_answer1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_answer2')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_voting_answer2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_nodays_open')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_voting_nodays_open); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_voting_listing_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_voting_listing_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investor_admin_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investor_admin_id); ?>
	<br />



</div>