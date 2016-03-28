
<?php

/* @var $this InvestorFinancialController */
/* @var $data InvestorFinancial */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user_default_investment_transaction_id), array('view', 'id'=>$data->user_default_investment_transaction_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_sellequityid')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_sellequityid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_type')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_details')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_details); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_bank')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_bank); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_date')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_paid_out')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_paid_out); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_paid_in')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_paid_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_balance')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_paypal_transactionId')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_paypal_transactionId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_withdraw_status')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_withdraw_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_currency_code')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_currency_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_default_investment_transaction_profiles_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_default_investment_transaction_profiles_id); ?>
	<br />

	*/ ?>


</div>