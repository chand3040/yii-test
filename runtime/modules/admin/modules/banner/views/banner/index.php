<style>
    .col-1 {
        width: 12%;
    }

    .col-2 {
        width: 20%;
    }

    .col-3 {
        width: 33%;
    }

    table.dataTable tr td {
        padding: 8px !important;
        color: #000 !important;
    }
</style>
<?php

Yii::app()->clientScript->registerScript('search', "
$('#search-form form').submit(function() {
    $.fn.yiiGridView.update('banner-grid', {
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

    $('#search-form form').trigger('submit');
    return false;
});
");
?>
<div class="content-container">
    <div style="margin:0 375px">
        <h2 class="Blue">New submissions</h2>
    </div>
    <div class="inner-content-container">
        <div class="grid-container">
            <table class="gernal_table listing-table"
                   cellspacing="2" cellpadding="1">

                <tr>

                    <th title="User">User</th>

                    <th title="Date">Date</th>

                    <th title="Banner Title">Banner Title</th>

                    <th title="Email">Email</th>

                    <th title="Duration">Duration<br/>(Days)</th>

                    <th title="Amount">Amount ($)</th>

                </tr>
                <?php if ($newBannerSubmission) {
                    foreach ($newBannerSubmission as $data):?>
                        <tr onclick="window.location.href='<?php echo $this->createUrl("update", array("id" => $data['user_default_listing_banner_id'])) ?>'">
                            <td><?php echo $data['user_default_username']; ?></td>
                            <td><?php echo $data['user_default_listing_banner_submission_date']; ?></td>
                            <td><?php echo $data['user_default_listing_title']; ?></td>
                            <td><?php echo $data['user_default_email']; ?></td>
                            <td><?php echo $data['user_default_listing_banner_duration']; ?></td>
                            <td><?php echo SharedFunctions::_get_banner_cost_indoller($data['user_default_id'], $data['user_default_listing_banner_cost']); ?></td>
                        </tr>
                    <?php endforeach;
                } else {
                    echo '<tr><td colspan="6">No records to display</td></tr>';
                }?>

            </table>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="content-container">
    <div id="search-form"> <!--class="searchbar_container"-->
        <div style="margin:0 375px"><h2 class="Blue">search for a banner</h2>
        </div>
        <?php
        // Search Form
        $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl("/admin/banner/banner/index"),
        ));
        ?>

        <div class="row">
            <div class="col-1">
                <label>Date</label>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Banner[user_default_listing_banner_submission_date]',
                    'model' => $model->user_default_listing_banner_submission_date,
                    'flat' => false,//remove to hide the datepicker
                    'value' => CommonClass::convertDateAsDisplayFormat($model->user_default_listing_banner_submission_date, 'd-m-Y'),
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                        'showAnim' => 'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth' => true,
                        'changeYear' => true,
                    ),
                    'htmlOptions' => array(
                        'style' => 'width:120px;color:#a54686;',
                        'placeholder' => 'dd-mm-yyyy'
                    ),
                ));
                ?>
            </div>
            <div class="col-1">
                <label>Username</label>
                <?php echo $form->textField($model, 'user_name_search', array('maxlength' => 50, 'style' => 'width:120px')); ?>
            </div>
            <div class="col-3">
                <label>Details</label>
                <?php echo $form->textField($model, 'listing_title_search', array('maxlength' => 50, 'style' => 'width:316px')); ?>
            </div>
            <div class="col-2">
                <label>User Email Address</label>
                <?php echo $form->textField($model, 'user_email_search', array('maxlength' => 50, 'style' => 'width:195px')); ?>
            </div>
            <div class="col-1">
                <label>Amount</label>
                <?php echo $form->textField($model, 'user_default_listing_banner_cost', array('maxlength' => 50, 'style' => 'width:135px')); ?>
            </div>
        </div>
        <div style="clear:both">&nbsp;</div>
        <div class="row" style="text-align: center;margin-left: 260px">

            <div class="col-2"><input type="button" name="btnclear" value="Clear" title="Clear" class="button blue"/>
            </div>

            <div class="col-2"><input type="submit" name="btnsubmit" value="Search" title="Search"
                                      class="button dark-green "/>
            </div>
            <div class="col-2">
                <input type="button" name="btnsubmit" value="Return" title="Return" class="button black black-btn "/>
            </div>
        </div>


        <?php $this->endWidget(); ?>
        <div class="clear">&nbsp;</div>
        <div class="user_listing_search">

            <!--<div class=""><a href="<?php /*echo $this->createUrl('/admin_new/member/create'); */ ?>" class="button blue">+Add</a></div>-->
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(

                'id' => 'banner-grid',

                'dataProvider' => $model->search(),

                //'filter' => $model,
                'summaryText' => '',
                'itemsCssClass' => 'table-class display dataTable',

                'columns' => array(

                    array(
                        'header' => 'User',
                        'name' => 'user_name_search',
                        'value' => 'CHtml::link($data->userDefault->user_default_username,Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type' => 'raw',
                    ),

                    array(
                        'header' => 'Date',
                        'name' => 'user_default_listing_banner_submission_date',
                        'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_listing_banner_submission_date,"d/m/Y"),Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                        'type' => 'raw',
                    ),
                    array(
                        'header' => 'Banner Title',
                        'name' => 'user_default_listing_title',
                        'type' => 'raw',
                        'value' => 'CHtml::link($data->userDefaultListing->user_default_listing_title,Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    ),
                    array(
                        'header' => 'Email',
                        'name' => 'user_default_email',
                        'type' => 'raw',
                        'value' => 'CHtml::link($data->userDefault->user_default_email,Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    ),
                    array(
                        'header' => 'Duration (Days)',
                        'name' => 'user_default_listing_banner_duration',
                        'type' => 'raw',
                        'value' => 'CHtml::link($data->user_default_listing_banner_duration,Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    ),
                    array(
                        'header' => 'Amount ($)',
                        'name' => 'user_default_listing_banner_cost',
                        'type' => 'raw',
                        'value' => 'CHtml::link(SharedFunctions::_get_banner_cost_indoller($data->user_default_id,$data->user_default_listing_banner_cost),Yii::app()->createUrl("/admin/banner/banner/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    ),
                ),

            ));
            e
            ?>

            <form action='' method='post' id='showMoreRecordForm'>

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

                <div align="center"><a class="button  black-btn"
                                       href="<?php echo $this->createUrl('exportBannerGrid') ?>" title="Download CSV">Download
                        CSV</a></div>
                <div class="clearfix">&nbsp;</div>

            </form>

        </div>
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
