
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */

$this->breadcrumbs=array(
	'Investor Financials'=>array('index'),
	$model->user_default_investment_transaction_id=>array('view','id'=>$model->user_default_investment_transaction_id),
	'Update',
);


$this->menu=array(
	array('label'=>'List InvestorFinancial', 'url'=>array('index')),
	array('label'=>'Create InvestorFinancial', 'url'=>array('create')),
	array('label'=>'View InvestorFinancial', 'url'=>array('view', 'id'=>$model->user_default_investment_transaction_id)),
	array('label'=>'Manage InvestorFinancial', 'url'=>array('admin')),
);
?>

<h1>Update InvestorFinancial <?php echo $model->user_default_investment_transaction_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>