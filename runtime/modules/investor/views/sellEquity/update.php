
<?php

/* @var $this SellEquityController */
/* @var $model SellEquity */

$this->breadcrumbs=array(
	'Sell Equities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


$this->menu=array(
	array('label'=>'List SellEquity', 'url'=>array('index')),
	array('label'=>'Create SellEquity', 'url'=>array('create')),
	array('label'=>'View SellEquity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SellEquity', 'url'=>array('admin')),
);
?>

<h1>Update SellEquity <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>