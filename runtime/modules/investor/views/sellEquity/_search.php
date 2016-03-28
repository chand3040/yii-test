
<?php

/* @var $this SellEquityController */
/* @var $model SellEquity */
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
		<?php echo $form->label($model,'starting_bid'); ?>

		<?php echo $form->textField($model,'starting_bid',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'duration'); ?>

		<?php echo $form->textField($model,'duration'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'insertion_fee'); ?>

		<?php echo $form->textField($model,'insertion_fee',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'final_valuation_fee'); ?>

		<?php echo $form->textField($model,'final_valuation_fee',array('size'=>10,'maxlength'=>10)); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'datetime'); ?>

		<?php echo $form->textField($model,'datetime'); ?>

	</div>



	<div class="row">
		<?php echo $form->label($model,'profiles_id'); ?>

		<?php echo $form->textField($model,'profiles_id'); ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>


</div><!-- search-form -->