
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Investor Voting Interfaces',
);


$this->menu=array(
	array('label'=>'Create InvestorVotingInterface', 'url'=>array('create')),
	array('label'=>'Manage InvestorVotingInterface', 'url'=>array('admin')),
);
?>

<h1>Investor Voting Interfaces</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
