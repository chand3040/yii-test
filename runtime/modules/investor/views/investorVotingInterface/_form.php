
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'investor-voting-interface-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_voting_question'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_question',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investor_voting_question'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_voting_answer1'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_answer1',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investor_voting_answer1'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_voting_answer2'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_answer2',array('rows'=>6, 'cols'=>50)); ?>

		<?php echo $form->error($model,'user_default_investor_voting_answer2'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_voting_nodays_open'); ?>

		<?php echo $form->textField($model,'user_default_investor_voting_nodays_open'); ?>

		<?php echo $form->error($model,'user_default_investor_voting_nodays_open'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_voting_listing_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_voting_listing_id'); ?>

		<?php echo $form->error($model,'user_default_investor_voting_listing_id'); ?>

	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'user_default_investor_admin_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_admin_id'); ?>

		<?php echo $form->error($model,'user_default_investor_admin_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- form -->