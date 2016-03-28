<?php

/* @var $this UsersController */

?>

<style>
    .col-1 {
        width: 14.66% !important;
    }

    .col-2 {
        width: 20.33% !important;
    }

</style>

<div class="content-container">
    <!--secondary Top Menu-->
    <?php $this->renderPartial('_top_menu'); ?>
</div>
<div class="heading">
    <h3>New registrations</h3>
</div>
<div class="content-container">

    <div class="grid-dataTable">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'member-grid',
            'dataProvider' => $model->search2(),
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
                    'header' => 'Date',
                    'name' => 'user_default_registration_date',
                    'type' => 'raw',
                    //'value' => 'CHtml::link(CommonClass::getUkDate($data->user_default_registration_date), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_registration_date,"d-m-Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                /*array(
                    'header' => 'Name',
                    'name' => 'user_default_first_name',
                    'value' => 'CHtml::link($data->user_default_first_name, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'type' => 'raw',
                ),*/
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
                /*array(
                    'header' => 'DOB',
                    'name' => 'user_default_dob',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_dob,"d/m/Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),*/
                array(
                    'header' => 'Country',
                    //'name' => 'user_default_country',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::getCountryNameByDefaultUser($data->user_default_id), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'User Status',
                    'name' => 'user_default_account_status',
                    'type' => 'raw',
                    'value' => 'CHtml::link( CommonClass::getUserStatusLabel($data->user_default_account_status), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'User Type',
                    'name' => 'user_default_type',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->user_default_type, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                ),
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
    </div>
</div>

<div style="clear: both">&nbsp;</div>
<div class="content-container">
    <div class="user_statistics">
        <?php
        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');

        // Default User Professions
        $resultProfessions = Profession::model()->findAll(array('order' => 'profession_name'));

        $totalProfessionsForMonth = array();
        $totalProfessionsForYearAll = 0;
        $totalToDatesAll = 0;
        $totalOnlineAll = 0;
        ?>
        <table style="width:100%; padding:8px; border-spacing:5px; border-collapse: collapse;" border="0">
            <tr class="first-row">
                <td width="10%" class="column-odd">&nbsp;</td>
                <?php if ($months) {
                    $i = 0; ?>
                    <?php foreach ($months as $index => $month) { ?>
                        <td valign="bottom"
                            class="min-width bold <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $month; ?></td>
                        <?php
                        $i++;
                    } ?>
                <?php } ?>
                <td valign="bottom" class="max-width bold column-even">Total for year</td>
                <td valign="bottom" class="max-width bold column-odd">Total to date</td>
                <td valign="bottom" class="max-width bold column-even">Users online</td>
            </tr>

            <?php if ($resultProfessions) { ?>
                <?php foreach ($resultProfessions as $key => $profession) {

                    $professionId = $profession->profession_id;
                    $totalProfessions = 0;
                    $totalToDates = 0;
                    $professionUsersCountOnline = 0;
                    ?>
                    <tr class="<?php echo $key % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                        <td class="bold" style="text-align: left;"><?php echo $profession->profession_name; ?></td>
                        <?php if ($months) {
                            $i = 0; ?>
                            <?php foreach ($months as $index => $month) {
                                $monthIndex = $index;
                                $professionUsersCount = CommonClass::getProfessionUsersCount($professionId, $monthIndex);
                                $totalProfessions += $professionUsersCount;
                                $totalProfessionsForMonth[$index] += $professionUsersCount;
                                ?>
                                <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $professionUsersCount ? $professionUsersCount : ''; ?></td>
                                <?php
                                $i++;
                            } ?>
                        <?php } ?>
                        <td class="max-width countAll column-even">
                            <?php
                            $totalProfessionsForYearAll += $totalProfessions;
                            echo $totalProfessions ? $totalProfessions : '';
                            ?>
                        </td>
                        <td class="max-width countAllToDates column-odd">
                            <?php
                            $toDateProfessions = CommonClass::getToDateProfessionUsersCount($professionId);
                            $totalToDates = $totalProfessions + $toDateProfessions;
                            $totalToDatesAll += $totalToDates;
                            echo $totalToDates ? $totalToDates : '';
                            ?>
                        </td>
                        <td class="max-width countAllOnline column-even">
                            <?php
                            $professionUsersCountOnline = CommonClass::getProfessionUsersCountOnline($professionId);
                            $totalOnlineAll += $professionUsersCountOnline;
                            echo $professionUsersCountOnline ? $professionUsersCountOnline : '';
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="<?php echo count($resultProfessions) % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                    <td class="bold" style="text-align: left;">Total for month</td>
                    <?php if ($months) {
                        $i = 0;
                        ?>
                        <?php foreach ($months as $index => $month) { ?>
                            <td class="min-width count <?php echo $i % 2 == 0 ? ' column-even' : ' column-odd'; ?>"><?php echo $totalProfessionsForMonth[$index] ? $totalProfessionsForMonth[$index] : '' ?></td>
                            <?php
                            $i++;
                        } ?>
                    <?php } ?>
                    <td class="max-width countAll column-even"><?php echo $totalProfessionsForYearAll ? $totalProfessionsForYearAll : ''; ?></td>
                    <td class="max-width countAllToDates column-odd"><?php echo $totalToDatesAll ? $totalToDatesAll : ''; ?></td>
                    <td class="max-width countAllOnline column-even"><?php echo $totalOnlineAll ? $totalOnlineAll : ''; ?></td>
                </tr>
            <?php } else { ?>
                <tr class="row-even">
                    <td style="text-align: center;" colspan="16">No user professions found.</td>
                </tr>
            <?php } ?>
        </table>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div style="text-align:center"><a href="<?php echo $this->createUrl('exportNewUsers') ?>"
                                          class="button  black-btn" title="Download CSV"
                                          target="_blank">Download CSV</a></div>
    </div>
</div>
<div style="clear: both">&nbsp;</div>
<div class="content-container">

    <?php
    // Search Form
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl("defaultUsers"),
    ));
    ?>
    <div class="sub-heading"><h2>Default user search bar</h2></div>
    <div class="member-form-container outline">

        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-1">
                <label class="label">Name</label>
                <?php echo $form->textField($model, 'user_default_first_name', array('maxlength' => 50)); ?>
            </div>
            <div class="col-1">
                <label class="label">Surname</label>
                <?php echo $form->textField($model, 'user_default_surname', array('maxlength' => 50)); ?>
            </div>
            <div class="col-1">
                <label class="label">Username</label>
                <?php echo $form->textField($model, 'user_default_username', array('maxlength' => 50)); ?>
            </div>
            <div class="col-1">
                <label class="label">DOB</label>
                <?php
                $maxYear = date('Y') - 18;
                $yearRange = "1900:$maxYear";
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Member[user_default_dob]',
                    'flat' => false,//remove to hide the datepicker
                    'options' => array(
                        'dateFormat' => 'dd/mm/yy',
                        'showAnim' => 'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => $yearRange,
                        'minDate' => '01/01/1900',
                        'maxDate' => date('t/') . '12/' . $maxYear,
                    ),
                    'htmlOptions' => array(
                        //'readonly' => 'readonly',
                        'placeholder' => 'DD/MM/YY'
                    ),
                ));
                ?>
            </div>
            <div class="col-2">
                <label class="label">Email</label>
                <?php echo $form->textField($model, 'user_default_email', array('maxlength' => 100)); ?>
            </div>


            <div class="col-2">
                <label class="label">Location</label>
                <?php
                echo $form->dropDownList($model, 'user_default_country',
                    CHtml::listData(Country::model()->findAll(array('order' => 'user_default_country_name')), 'user_default_country_id', 'user_default_country_name'),
                    array('prompt' => '-All-', 'class' => "chzn-select")
                );
                ?>
            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div style="text-align:center; padding-bottom: 12px;">
                <input type="reset" name="btnclear" value="Clear" class="button black black-btn"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" name="btnsubmit" value="Submit" class="button dark-green "/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        jQuery(".chzn-select").chosen();

        // Add necessary style while there's a pagination
        if (jQuery('.yiiPager').is(":visible")) {

            jQuery('#more_record_label').addClass('more_record_label_pagination');
            jQuery('#more_record_chzn').addClass('more_record_chzn_pagination');

        }

        jQuery('input[type="reset"], button[type="reset"]').click(function () {
            jQuery('.member-form-container .chzn-select').val('').trigger('liszt:updated');
        });

    });

</script>
