
<?php

/* @var $this SellEquityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sell Equities',
);


$this->menu=array(
	array('label'=>'Create SellEquity', 'url'=>array('create')),
	array('label'=>'Manage SellEquity', 'url'=>array('admin')),
);
?>

<h1>Sell Equities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
