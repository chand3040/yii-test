
<?php

/* @var $this InvestorFinancialController */
/* @var $model InvestorFinancial */

$this->breadcrumbs=array(
	'Investor Financials'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'List InvestorFinancial', 'url'=>array('index')),
	array('label'=>'Manage InvestorFinancial', 'url'=>array('admin')),
);
?>

<h1>Create InvestorFinancial</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
