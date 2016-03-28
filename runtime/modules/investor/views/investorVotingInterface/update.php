
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */

$this->breadcrumbs=array(
	'Investor Voting Interfaces'=>array('index'),
	$model->user_default_investor_voting_id=>array('view','id'=>$model->user_default_investor_voting_id),
	'Update',
);


$this->menu=array(
	array('label'=>'List InvestorVotingInterface', 'url'=>array('index')),
	array('label'=>'Create InvestorVotingInterface', 'url'=>array('create')),
	array('label'=>'View InvestorVotingInterface', 'url'=>array('view', 'id'=>$model->user_default_investor_voting_id)),
	array('label'=>'Manage InvestorVotingInterface', 'url'=>array('admin')),
);
?>

<h1>Update InvestorVotingInterface <?php echo $model->user_default_investor_voting_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>