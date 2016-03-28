
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'investor-messages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'user_default_listing_id'); ?>

		<?php echo $form->textField($model,'user_default_listing_id'); ?>

		<?php echo $form->error($model,'user_default_listing_id'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>

		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>250)); ?>

		<?php echo $form->error($model,'subject'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>

		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'message'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_id'); ?>

		<?php echo $form->error($model,'user_default_investor_id'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_user_type'); ?>

		<?php echo $form->textField($model,'user_default_investor_user_type',array('size'=>9,'maxlength'=>9)); ?>

		<?php echo $form->error($model,'user_default_investor_user_type'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'attachement'); ?>

		<?php echo $form->textField($model,'attachement',array('size'=>60,'maxlength'=>255)); ?>

		<?php echo $form->error($model,'attachement'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'is_spam'); ?>

		<?php echo $form->textField($model,'is_spam',array('size'=>1,'maxlength'=>1)); ?>

		<?php echo $form->error($model,'is_spam'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'first_message'); ?>

		<?php echo $form->textField($model,'first_message',array('size'=>1,'maxlength'=>1)); ?>

		<?php echo $form->error($model,'first_message'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'notice_flag'); ?>

		<?php echo $form->textField($model,'notice_flag',array('size'=>1,'maxlength'=>1)); ?>

		<?php echo $form->error($model,'notice_flag'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'close_msg_flag'); ?>

		<?php echo $form->textField($model,'close_msg_flag',array('size'=>1,'maxlength'=>1)); ?>

		<?php echo $form->error($model,'close_msg_flag'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'created_date'); ?>

		<?php echo $form->textField($model,'created_date'); ?>

		<?php echo $form->error($model,'created_date'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'parent_message_id'); ?>

		<?php echo $form->textField($model,'parent_message_id'); ?>

		<?php echo $form->error($model,'parent_message_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->