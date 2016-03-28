
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>




	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_id'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_id',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_sellequityid'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_sellequityid'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_type'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_type',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_details'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_details',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_bank'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_bank',array('size'=>50,'maxlength'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_date'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_date'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_paid_out'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paid_out',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_paid_in'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paid_in',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_balance'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_balance',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_paypal_transactionId'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paypal_transactionId',array('size'=>60,'maxlength'=>150)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_withdraw_status'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_withdraw_status',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_currency_code'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_currency_code',array('size'=>3,'maxlength'=>3)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investment_transaction_profiles_id'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_profiles_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->