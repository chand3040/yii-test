
<?php

/* @var $this InvestorVotingInterfaceController */
/* @var $model InvestorVotingInterface */

$this->breadcrumbs=array(
	'Investor Voting Interfaces'=>array('index'),
	'Manage',
);


$this->menu=array(
	array('label'=>'List InvestorVotingInterface', 'url'=>array('index')),
	array('label'=>'Create InvestorVotingInterface', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#investor-voting-interface-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Investor Voting Interfaces</h1>

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
	'id'=>'investor-voting-interface-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_default_investor_voting_id',
		'user_default_investor_voting_question',
		'user_default_investor_voting_answer1',
		'user_default_investor_voting_answer2',
		'user_default_investor_voting_nodays_open',
		'user_default_investor_voting_listing_id',
		/*
		'user_default_investor_admin_id',
		*/

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
