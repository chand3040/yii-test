
<?php

/* @var $this SellEquityController */

/* @var $model SellEquity */

/* @var $form CActiveForm */

?>



<div class="form">



<?php /*$form=$this->beginWidget('CActiveForm', array(

	'id'=>'sell-equity-form',

	// Please note: When you enable ajax validation, make sure the corresponding

	// controller action is handling ajax validation correctly.

	// There is a call to performAjaxValidation() commented in generated controller code.

	// See class documentation of CActiveForm for details on this.

	'enableAjaxValidation'=>false,
        'action' => Yii::app()->createUrl("investor/sellEquity/create/")
));*/ ?>

    <div id="sell_equity_box_form">
        <!--<form name="sellEquity" id="sellEquity">-->
            <table>

                <tr>
                    <td><label>Starting bid</label></td>
                    <td><label>Duration (days)</label></td>
                    <td><label>Insertion fee</label></td>
                    <td><label>Final Valuation Fee</label></td>
                    <td  style="font-size: 9px;text-align: center"><label>I have read and agree to the terms & conditions</label></td>
                </tr>
                <tr>
                    <td width="20%"><input type="text" value="0.00" name="startingbid" class="grnt-btn input_normal">
                        <a class="tooltip" style="background:none;" href="#;">
                            <b>?</b>
                            <span class="classic" style="text-align: left;">Starting bid</span>
                        </a>
                    </td>
                    <td> <select class="chzn-select" style="width: 113px !important;">
                            <option value="">Please Select</option>
                        </select></td>
                    <td width="15%"> <input type="text" value="" class="grnt-btn input_small"><a class="tooltip"
                                                                                     style="background:none;"
                                                                                     href="#;">
                            <b>?</b>
                            <span class="classic" style="text-align: left;">Insertion fee</span>
                        </a> </td>

                    <td width="15%"> <input type="text" value="" class="grnt-btn input_small"><a class="tooltip"
                                                                                     style="background:none;"
                                                                                     href="#;">
                            <b>?</b>
                            <span class="classic" style="text-align: left;">Final Valuation Fee</span>
                        </a> </td>
                    <td class="checkbox" align="center">

                        <input id="check1" type="checkbox" name="check" value="check1">
                        <label for="check1"></label></td>
                    <td rowspan="1"><input type="button" class="button black" value="Submit"></td>
                </tr>
            </table>

       <!-- </form>-->
    </div>

	<?php /*<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($sellEquityModel);
    echo CHtml::errorSummary($sellEquityModel);?>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'starting_bid'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'starting_bid',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo CHtml::error($sellEquityModel,'starting_bid'); ?>

	</div>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'duration'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'duration'); ?>

		<?php echo CHtml::error($sellEquityModel,'duration'); ?>

	</div>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'insertion_fee'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'insertion_fee',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo CHtml::error($sellEquityModel,'insertion_fee'); ?>

	</div>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'final_valuation_fee'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'final_valuation_fee',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo CHtml::error($sellEquityModel,'final_valuation_fee'); ?>

	</div>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'datetime'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'datetime'); ?>

		<?php echo CHtml::error($sellEquityModel,'datetime'); ?>

	</div>




	<div class="row">

		<?php echo CHtml::activeLabelEx($sellEquityModel,'profiles_id'); ?>

		<?php echo CHtml::activeTextField($sellEquityModel,'profiles_id'); ?>

		<?php echo CHtml::error($sellEquityModel,'profiles_id'); ?>

	</div>




	<div class="row buttons">

		<?php echo CHtml::submitButton($sellEquityModel->isNewRecord ? 'Create' : 'Save'); ?>

	</div>


<?php $this->endWidget(); ?> */ ?>



</div><!-- form -->