<?php

/*$this->breadcrumbs = array(

    'Mail Templates' => 'index',

);*/

?>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

?>

<div class="user_listing_search content-container">


    <div align="center">
        <h2 class="Blue" style="margin:5px 0;">Email Templates</h2>
    </div>

    <!--<span class="red">Note : Default template(1-5) are not deletable. That is required by system.</span>-->

    <?php $this->widget('zii.widgets.grid.CGridView', array(

        'id' => 'mailtemplate-grid',
        'dataProvider' => $model->search(),
        //'filter'=>$model,
        'summaryText' => FALSE,
        'pager' => array(
            'maxButtonCount' => 5,
            'firstPageLabel' => '',
            'lastPageLabel' => '',
            'prevPageLabel' => '< Previous',
            'nextPageLabel' => 'Next >',
            'header' => '',
            'htmlOptions' => array('id' => 'navlist', 'class' => 'pager')
        ),
        'itemsCssClass' => 'table-class display dataTable',
        'columns' => array(

            array(

                'header' => 'Template',
                'name' => 'template_id',
                'value' => 'CHtml::link($data->template_id, Yii::app()->createUrl("admin/website/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
                'htmlOptions' => array('style' => 'width:30px')
            ),

            array(

                'header' => 'Template Name',
                'name' => 'template_module',
                'value' => 'CHtml::link($data->template_module, Yii::app()->createUrl("admin/website/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                'type' => 'raw',
            ),

            array(

                'header' => 'Template Subject',
                'name' => 'template_subject',
                'value' => 'CHtml::link($data->template_subject, Yii::app()->createUrl("admin/website/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
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
                'value' => 'CHtml::link(date("d- m- Y",strtotime($data->template_create)), Yii::app()->createUrl("admin/website/mailtemplate/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
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

    <form method='post' id='showMoreRecordForm'>

        <?php

        $moreRecord = isset($_REQUEST['more_record']) ? $_REQUEST['more_record'] : Yii::app()->user->getState('pageSize');

        ?>

        <span id='more_record_label' class='more_record_label'>View</span>

        <?php

        echo CHtml::dropDownList('more_record', $moreRecord,
            array('10' => '10', '20' => '20', '50' => '50', '100' => '100'),
            array(
                'class' => 'chzn-select',
                'style' => 'width:75px;',
                'data-placeholder' => 'Please select',
                'name' => 'more_record',
                'title' => 'Show more record',
                'onchange' => "jQuery('#showMoreRecordForm').submit();"
            )
        );

        ?>


        <div class="clearfix">&nbsp;</div>

    </form>
    <div class="download-csv" style="margin-left: 47%"><a
            href="<?php echo $this->createUrl('/admin/website/mailtemplate/create'); ?>" class="button black">+Add</a>
    </div>
    <div class="clear"> &nbsp;</div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery(".chzn-select").chosen();

        // Add necessary style while there's a pagination
        if (jQuery('.yiiPager').is(":visible")) {

            jQuery('#more_record_label').addClass('more_record_label_pagination');
            jQuery('#more_record_chzn').addClass('more_record_chzn_pagination');

        }

    });

</script>

