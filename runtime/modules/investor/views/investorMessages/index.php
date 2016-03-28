
<?php

/* @var $this InvestorMessagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Investor Messages',
);


$this->menu=array(
	array('label'=>'Create InvestorMessages', 'url'=>array('create')),
	array('label'=>'Manage InvestorMessages', 'url'=>array('admin')),
);
?>

<h1>Investor Messages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
