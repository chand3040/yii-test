
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */

$this->breadcrumbs=array(
	'Investor Financials'=>array('index'),
	'Manage',
);


$this->menu=array(
	array('label'=>'List InvestorFinancial', 'url'=>array('index')),
	array('label'=>'Create InvestorFinancial', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#investor-financial-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Investor Financials</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>

</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'investor-financial-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_default_investment_transaction_id',
		'user_default_investment_transaction_sellequityid',
		'user_default_investment_transaction_type',
		'user_default_investment_transaction_details',
		'user_default_investment_transaction_bank',
		'user_default_investment_transaction_date',
		/*
		'user_default_investment_transaction_paid_out',
		'user_default_investment_transaction_paid_in',
		'user_default_investment_transaction_balance',
		'user_default_investment_transaction_paypal_transactionId',
		'user_default_investment_transaction_withdraw_status',
		'user_default_investment_transaction_currency_code',
		'user_default_investment_transaction_profiles_id',
		*/

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
