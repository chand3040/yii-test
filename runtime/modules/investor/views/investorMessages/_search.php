
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>




	<div class="row">
		<?php echo $form->label($model,'id'); ?>

		<?php echo $form->textField($model,'id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_listing_id'); ?>

		<?php echo $form->textField($model,'user_default_listing_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'subject'); ?>

		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>250)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'message'); ?>

		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_id'); ?>

		<?php echo $form->textField($model,'user_default_investor_id'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'user_default_investor_user_type'); ?>

		<?php echo $form->textField($model,'user_default_investor_user_type',array('size'=>9,'maxlength'=>9)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'attachement'); ?>

		<?php echo $form->textField($model,'attachement',array('size'=>60,'maxlength'=>255)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'is_spam'); ?>

		<?php echo $form->textField($model,'is_spam',array('size'=>1,'maxlength'=>1)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'first_message'); ?>

		<?php echo $form->textField($model,'first_message',array('size'=>1,'maxlength'=>1)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'notice_flag'); ?>

		<?php echo $form->textField($model,'notice_flag',array('size'=>1,'maxlength'=>1)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'close_msg_flag'); ?>

		<?php echo $form->textField($model,'close_msg_flag',array('size'=>1,'maxlength'=>1)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'created_date'); ?>

		<?php echo $form->textField($model,'created_date'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'parent_message_id'); ?>

		<?php echo $form->textField($model,'parent_message_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->