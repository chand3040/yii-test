
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>




	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_voting_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_question'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_question',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_answer1'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_answer1',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_answer2'); ?>

		<?php echo $form->textArea($model,'user_default_investor_voting_answer2',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_nodays_open'); ?>

		<?php echo $form->textField($model,'user_default_investor_voting_nodays_open'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_voting_listing_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_voting_listing_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_admin_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_admin_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->