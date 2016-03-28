
<?php

/* @var $this SellEquityController */
/* @var $model SellEquity */

$this->breadcrumbs=array(
	'Sell Equities'=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>'List SellEquity', 'url'=>array('index')),
	array('label'=>'Create SellEquity', 'url'=>array('create')),
	array('label'=>'Update SellEquity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SellEquity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SellEquity', 'url'=>array('admin')),
);
?>

<h1>View SellEquity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'starting_bid',
		'duration',
		'insertion_fee',
		'final_valuation_fee',
		'datetime',
		'profiles_id',

	),
)); ?>
