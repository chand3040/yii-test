<div class="breadcrumb">
    <a href="<?php echo $this->createUrl('/admin'); ?>">Module Details</a> | <a
        href="<?php echo $this->createUrl('/admin/pages/pages'); ?>">Slider Pages</a> | <a
        href="<?php echo $this->createUrl('/admin/slider/slider/index'); ?>">Slider Module</a> | <a
        href="<?php echo $this->createUrl('/admin/banner/banner/index'); ?>">Default Banners</a> | <a
        href="<?php echo $this->createUrl('/admin/mailtemplate'); ?>" class="navactive">Emails</a>
</div>

<h2 class="module_title"> Site Emails </h2>

<?php

$modelnew = new Department('search');
$criteria = new CDbCriteria;
$criteria->order = 'dept_id desc';
$total = Department::model()->count($criteria);

if (isset($_REQUEST['rows'])) {
    $count = $_REQUEST['rows'];
} else {
    $count = 20;
}


$pages = new CPagination($total);
$pages->setPageSize($count);
$pages->applyLimit($criteria);
$posts = Department::model()->findAll($criteria);

$this->renderPartial('../department/index', array('model' => $modelnew,
    'list' => $posts,
    'pages' => $pages,
    'item_count' => $total,
    'page_size' => Yii::app()->params['listPerPage'],
));

?>
<br>
<div class="user_listing_search"><br>

    <h2 align="center" class="Blue" style="margin:15px 0;">Email Templates</h2>
    <span class="red"
          style="display:none">Note : Default template(1-5) are not deletable. That is required by system.</span>

    <div style="height: 39px;"><a href="<?php echo $this->createUrl('/admin/mailtemplate/create'); ?>"
                                  class="button blue" style="float:right">+Add</a></div>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'mailtemplate-grid',
        'dataProvider' => $model->search(),
        //'filter'=>$model, 
        'itemsCssClass' => 'table-class display dataTable',
        'columns' => array(
            array(
                'header' => 'Template',
                'name' => 'template_id',
                'value' => 'CHtml::link($data->template_id, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
                'htmlOptions' => array('style' => 'width:30px')
            ),
            array(
                'header' => 'Template Name',
                'name' => 'template_module',
                'value' => 'CHtml::link($data->template_module, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
            ),
            array(
                'header' => 'Template Subject',
                'name' => 'template_subject',
                'value' => 'CHtml::link($data->template_subject, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
            ),
            /*array(
                'header'=>'Template Status',
                'name'=>'template_status',
                'value'=>'CHtml::link($data->template_status, Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type'=>'raw',
            ),*/
            array(
                'header' => 'Created Date',
                'name' => 'template_create',
                'value' => 'CHtml::link(date("d- m- Y",strtotime($data->template_create)), Yii::app()->createUrl("admin/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
                'htmlOptions' => array('style' => 'width:110px')
            ),
            /*   array(
                   'class'=>'CButtonColumn',
                   'header'=>'Action',
                   'template'=>'{update}{delete}',
               ),
            */

        ),

    )); ?>


</div>
