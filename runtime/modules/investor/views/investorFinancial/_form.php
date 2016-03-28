
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'investor-financial-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_sellequityid'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_sellequityid'); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_sellequityid'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_type'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_type',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_type'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_details'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_details',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_details'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_bank'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_bank',array('size'=>50,'maxlength'=>50)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_bank'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_date'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_date'); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_date'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_paid_out'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paid_out',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_paid_out'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_paid_in'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paid_in',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_paid_in'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_balance'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_balance',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_balance'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_paypal_transactionId'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_paypal_transactionId',array('size'=>60,'maxlength'=>150)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_paypal_transactionId'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_withdraw_status'); ?>

		<?php echo $form->textArea($model,'user_default_investment_transaction_withdraw_status',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_withdraw_status'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_currency_code'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_currency_code',array('size'=>3,'maxlength'=>3)); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_currency_code'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investment_transaction_profiles_id'); ?>

		<?php echo $form->textField($model,'user_default_investment_transaction_profiles_id'); ?>

		<?php echo $form->error($model,'user_default_investment_transaction_profiles_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->