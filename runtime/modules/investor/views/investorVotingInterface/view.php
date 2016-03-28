
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */

$this->breadcrumbs=array(
	'Investor Voting Interfaces'=>array('index'),
	$model->user_default_investor_voting_id,
);


$this->menu=array(
	array('label'=>'List InvestorVotingInterface', 'url'=>array('index')),
	array('label'=>'Create InvestorVotingInterface', 'url'=>array('create')),
	array('label'=>'Update InvestorVotingInterface', 'url'=>array('update', 'id'=>$model->user_default_investor_voting_id)),
	array('label'=>'Delete InvestorVotingInterface', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_default_investor_voting_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvestorVotingInterface', 'url'=>array('admin')),
);
?>

<h1>View InvestorVotingInterface #<?php echo $model->user_default_investor_voting_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_default_investor_voting_id',
		'user_default_investor_voting_question',
		'user_default_investor_voting_answer1',
		'user_default_investor_voting_answer2',
		'user_default_investor_voting_nodays_open',
		'user_default_investor_voting_listing_id',
		'user_default_investor_admin_id',

	),
)); ?>
