
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */

$this->breadcrumbs=array(
	'Investor Messages'=>array('index'),
	'Create',
);


$this->menu=array(
	array('label'=>'List InvestorMessages', 'url'=>array('index')),
	array('label'=>'Manage InvestorMessages', 'url'=>array('admin')),
);
?>

<h1>Create InvestorMessages</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
