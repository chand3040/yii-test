
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */

$this->breadcrumbs=array(
	'Investor Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


$this->menu=array(
	array('label'=>'List InvestorMessages', 'url'=>array('index')),
	array('label'=>'Create InvestorMessages', 'url'=>array('create')),
	array('label'=>'View InvestorMessages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvestorMessages', 'url'=>array('admin')),
);
?>

<h1>Update InvestorMessages <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>