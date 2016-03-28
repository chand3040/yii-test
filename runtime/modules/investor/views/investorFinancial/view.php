
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */

$this->breadcrumbs=array(
	'Investor Financials'=>array('index'),
	$model->user_default_investment_transaction_id,
);


$this->menu=array(
	array('label'=>'List InvestorFinancial', 'url'=>array('index')),
	array('label'=>'Create InvestorFinancial', 'url'=>array('create')),
	array('label'=>'Update InvestorFinancial', 'url'=>array('update', 'id'=>$model->user_default_investment_transaction_id)),
	array('label'=>'Delete InvestorFinancial', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_default_investment_transaction_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvestorFinancial', 'url'=>array('admin')),
);
?>

<h1>View InvestorFinancial #<?php echo $model->user_default_investment_transaction_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_default_investment_transaction_id',
		'user_default_investment_transaction_sellequityid',
		'user_default_investment_transaction_type',
		'user_default_investment_transaction_details',
		'user_default_investment_transaction_bank',
		'user_default_investment_transaction_date',
		'user_default_investment_transaction_paid_out',
		'user_default_investment_transaction_paid_in',
		'user_default_investment_transaction_balance',
		'user_default_investment_transaction_paypal_transactionId',
		'user_default_investment_transaction_withdraw_status',
		'user_default_investment_transaction_currency_code',
		'user_default_investment_transaction_profiles_id',

	),
)); ?>
