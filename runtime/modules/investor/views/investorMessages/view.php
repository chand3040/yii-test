
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */

$this->breadcrumbs=array(
	'Investor Messages'=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>'List InvestorMessages', 'url'=>array('index')),
	array('label'=>'Create InvestorMessages', 'url'=>array('create')),
	array('label'=>'Update InvestorMessages', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InvestorMessages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvestorMessages', 'url'=>array('admin')),
);
?>

<h1>View InvestorMessages #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_default_listing_id',
		'subject',
		'message',
		'user_default_investor_id',
		'user_default_investor_user_type',
		'attachement',
		'is_spam',
		'first_message',
		'notice_flag',
		'close_msg_flag',
		'created_date',
		'parent_message_id',

	),
)); ?>
