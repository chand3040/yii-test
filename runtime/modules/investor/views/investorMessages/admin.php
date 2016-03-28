
<?php

/* @var $this InvestorMessagesController */
/* @var $model InvestorMessages */

$this->breadcrumbs=array(
	'Investor Messages'=>array('index'),
	'Manage',
);


$this->menu=array(
	array('label'=>'List InvestorMessages', 'url'=>array('index')),
	array('label'=>'Create InvestorMessages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#investor-messages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Investor Messages</h1>

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
	'id'=>'investor-messages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_default_listing_id',
		'subject',
		'message',
		'user_default_investor_id',
		'user_default_investor_user_type',
		/*
		'attachement',
		'is_spam',
		'first_message',
		'notice_flag',
		'close_msg_flag',
		'created_date',
		'parent_message_id',
		*/

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
