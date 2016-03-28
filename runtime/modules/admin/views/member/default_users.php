<style type="text/css" xmlns="http://www.w3.org/1999/html">

    .col-1 {
        width: 16.66% !important;
    }

    .col-2 {
        width: 24.33% !important; /* 33.33%*/
    }

</style>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

?>

<?php

Yii::app()->clientScript->registerScript('search', "
$('#search-form form').submit(function() {
    $.fn.yiiGridView.update('member-grid', {
        data: $(this).serialize()
    });
    return false;
});
$('input[name=\"btnclear\"]').click(function() {
    $(':input','#search-form')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');

    $('.chzn-select').val('').trigger('liszt:updated');

    $('#search-form form').trigger('submit');
    return false;
});

");
?>

<div class="content-container">
    <!--secondary Top Menu-->
    <?php $this->renderPartial('_top_menu'); ?>
</div>
<div class="heading">
    <h3>Default Users</h3>
</div>

<div class="content-container" id="search-form">
    <?php
    // Search Form
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl("defaultUsers"),
    ));
    ?>
    <div class="member-form-container outline">

        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-1">
                <label>Username</label>
                <?php echo $form->textField($model, 'user_default_username', array('maxlength' => 50)); ?>
            </div>
            <div class="col-2">
                <label>Email</label>
                <?php echo $form->textField($model, 'user_default_email', array('maxlength' => 100)); ?>
            </div>
            <div class="col-2">
                <label>Name</label>
                <?php echo $form->textField($model, 'user_default_first_name', array('maxlength' => 50)); ?>
            </div>
            <div class="col-1">
                <label>Surname</label>
                <?php echo $form->textField($model, 'user_default_surname', array('size' => 12, 'maxlength' => 50)); ?>
            </div>
            <div class="col-1">
                <label>DOB</label>
                <?php
                $maxYear = date('Y') - 18;
                $yearRange = "1900:$maxYear";
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Member[user_default_dob]',
                    'model' => $model->user_default_dob,
                    'flat' => false,//remove to hide the datepicker
                    'value' => CommonClass::convertDateAsDisplayFormat($model->user_default_dob, 'd/m/Y'),
                    'options' => array(
                        'dateFormat' => 'dd/mm/yy',
                        'showAnim' => 'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => $yearRange,
                        'minDate' => '01/01/1900',
                        'maxDate' => date('t/') . '12/' . $maxYear,
                        //'onSelect' => 'js: function(dateText, inst) {myaccountdod()}',
                    ),
                    'htmlOptions' => array(
                        //'readonly' => 'readonly',
                        'placeholder' => 'DD/MM/YY'
                    ),
                ));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <label>Location</label>
                <?php
                echo $form->dropDownList($model, 'user_default_country',
                    CHtml::listData(Country::model()->findAll(array('order' => 'user_default_country_name')), 'user_default_country_id', 'user_default_country_name'),
                    array('prompt' => '-All-', 'class' => "chzn-select")
                );
                ?>
            </div>
            <div class="col-2">
                <label>User Type</label>
                <?php echo $form->dropDownList($model, 'user_default_profession',
                    CHtml::listData(Profession::model()->findAll(array('order' => 'profession_name')), 'profession_id', 'profession_name'),
                    array('prompt' => '-All-', 'class' => "chzn-select"));
                ?>
            </div>
            <div class="col-2">
                <label>Account Status</label>
                <?php echo $form->dropDownList($model, 'user_default_account_status',
                    array(
                        'Online' => 'Online',
                        '1' => 'Active',
                        '2' => 'Suspended',
                        '0' => 'Pending Activation',
                    ),
                    array('prompt' => '-All-', 'class' => "chzn-select")
                );
                ?>
            </div>
        </div>

        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div style="text-align:center; padding-bottom: 12px;">
                <input type="reset" name="btnclear" value="Clear" class="button black black-btn"/>&nbsp;&nbsp;
                <input type="submit" name="btnsubmit" value="Submit" class="button dark-green "/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<div style="clear: both">&nbsp;</div>
<div class="content-container">

    <div class="grid-dataTable">

        <?php
        $this->widget('zii.widgets.grid.CGridView', array(

            'id' => 'member-grid',
            'dataProvider' => $model->search(),
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
            //'filter' => $model,
            /*'htmlOptions'=>array('style'=>'cursor: pointer;'),
            'selectionChanged'=>"function(id) {
                window.location='" . Yii::app()->urlManager->createUrl('member/update', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);
            }",*/
            'itemsCssClass' => 'table-class display dataTable',
            'columns' => array(

                array(
                    'header' => 'Name',
                    'name' => 'user_default_first_name',
                    'value' => 'CHtml::link($data->user_default_first_name, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Username',
                    'name' => 'user_default_username',
                    'value' => 'CHtml::link($data->user_default_username, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Email',
                    'name' => 'user_default_email',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->user_default_email, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'DOB',
                    'name' => 'user_default_dob',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_dob,"d/m/Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'Country',
                    //'name' => 'user_default_country',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::getCountryNameByDefaultUser($data->user_default_id), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'Account status',
                    'name' => 'user_default_account_status',
                    'type' => 'raw',
                    'value' => 'CHtml::link( CommonClass::getUserStatusLabel($data->user_default_account_status), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                /*array(
                    'header' => 'Date',
                    'name' => 'user_default_registration_date',
                    'type' => 'raw',
                    //'value' => 'CHtml::link(CommonClass::getUkDate($data->user_default_registration_date), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'value' => 'CHtml::link(Member::convertDateAsDisplayFormat($data->user_default_registration_date,"d-m-Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),*/
                /* array(
                     'class'=>'CButtonColumn',
                     'header' => 'Action',
                     'template' => '{update}{delete}',
                 ),*/

            ),

        ));

        ?>

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
        <div class="download-csv"><a href="<?php echo $this->createUrl('exportUserGrid') ?>"
                                     class="button black-btn"
                                     title="Download CSV" target="_blank">Download CSV</a></div>

    </div>
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

