
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */

$this->breadcrumbs=array(
	'Investor Voting Interfaces'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'List InvestorVotingInterface', 'url'=>array('index')),
	array('label'=>'Manage InvestorVotingInterface', 'url'=>array('admin')),
);
?>

<h1>Create InvestorVotingInterface</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
