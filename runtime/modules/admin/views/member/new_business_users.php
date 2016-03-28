<?php

/* @var $this UsersController */

?>

<style type="text/css">
    .col-1 {
        width: 16.66% !important;
    }

    .col-2 {
        width: 24.66% !important;
    }

    .col-3 {
        width: 40.33% !important;
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
            'itemsCssClass' => 'table-class display dataTable',
            'columns' => array(

                array(
                    'header' => 'Date',
                    'name' => 'user_default_business_rdate',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_business_rdate,"d-m-Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                ),
                /*array(
                    'header' => 'Name',
                    'name' => 'user_default_business_first_name',
                    'value' => 'CHtml::link($data->user_default_business_first_name, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                    'type' => 'raw',
                ),*/
                array(
                    'header' => 'Username',
                    'name' => 'user_default_business_username',
                    'value' => 'CHtml::link($data->user_default_business_username, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                    'type' => 'raw',
                ),
                array(
                    'header' => 'Email',
                    'name' => 'user_default_business_email',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->user_default_business_email, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                ),
                /*array(
                    'header' => 'DOB',
                    'name' => 'user_default_business_dob',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CommonClass::convertDateAsDisplayFormat($data->user_default_business_dob,"d/m/Y"), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                ),*/
                array(
                    'header' => 'Country',
                    //'name' => 'user_default_country',
                    'type' => 'raw',
                    //'value' => 'CHtml::link(CommonClass::getCountryNameByBusinessUser($data->user_default_business_id), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey)),array("class"=>"full-link"))',
                    'value' => '',
                ),
                array(
                    'header' => 'Account Status',
                    'name' => 'user_default_business_status',
                    'type' => 'raw',
                    'value' => 'CHtml::link( CommonClass::getUserStatusLabel($data->user_default_business_status), Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
                ),
                array(
                    'header' => 'User Type',
                    'name' => 'user_default_business_user_type',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->user_default_business_user_type, Yii::app()->createUrl("/admin/member/update",array("id"=>$data->primaryKey, "userType"=>"business")),array("class"=>"full-link"))',
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
        <div class="download-csv"><a href="<?php echo $this->createUrl('exportUserGrid') ?>"
                                     class="button black-btn"
                                     title="Download CSV" target="_blank">Download CSV</a></div>

    </div>

</div>

<div style="clear: both">&nbsp;</div>
<div class="content-container">

    <div class="user_statistics">

        <?php
        $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Num', '12' => 'Dec');

        // Business User Professions
        $resultProfessions = BusinessProfession::model()->findAll(array('order' => 'list_profession_name'));

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

                    $professionId = $profession->list_profession_id;
                    $totalProfessions = 0;
                    $totalToDates = 0;
                    $professionUsersCountOnline = 0;
                    ?>
                    <tr class="<?php echo $key % 2 == 0 ? 'row-even' : 'row-odd'; ?>">
                        <td class="bold" style="text-align: left;"><?php echo $profession->list_profession_name; ?></td>
                        <?php if ($months) {
                            $i = 0; ?>
                            <?php foreach ($months as $index => $month) {
                                $monthIndex = $index;
                                $professionUsersCount = CommonClass::getBusinessProfessionUsersCount($professionId, $monthIndex);
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
                            $toDateProfessions = CommonClass::getToDateBusinessProfessionUsersCount($professionId);
                            $totalToDates = $totalProfessions + $toDateProfessions;
                            $totalToDatesAll += $totalToDates;
                            echo $totalToDates ? $totalToDates : '';
                            ?>
                        </td>
                        <td class="max-width countAllOnline column-even">
                            <?php
                            $professionUsersCountOnline = CommonClass::getBusinessProfessionUsersCountOnline($professionId);
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
        <div style="text-align:center"><a
                href="<?php echo $this->createUrl('exportNewBusinessUsers') ?>"
                class="button  black-btn" title="Download CSV"
                target="_blank">Download CSV</a></div>

    </div>

</div>
<div style="clear: both">&nbsp;</div>
<div class="content-container">

    <?php
    // Search Form
    $form = $this->beginWidget('CActiveForm', array(
        'action' => $this->createUrl("businessUsers"),
    ));
    ?>

    <div class="sub-heading"><h2>Business user search bar</h2></div>
    <div class="member-form-container outline">

        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-1">
                <label>Username</label>
                <?php echo $form->textField($model, 'user_default_business_username', array('size' => 16, 'maxlength' => 50)); ?>
            </div>
            <div class="col-2">
                <label>Email</label>
                <?php echo $form->textField($model, 'user_default_business_email', array('size' => 44, 'maxlength' => 100)); ?>
            </div>
            <div class="col-2">
                <label>Company name</label>
                <input type="text"/>
            </div>
            <div class="col-1">
                <label>Surname</label>
                <?php echo $form->textField($model, 'user_default_business_surname', array('maxlength' => 100)); ?>
            </div>
            <div class="col-1">
                <label>DOB</label>
                <?php
                $maxYear = date('Y') - 18;
                $yearRange = "1900:$maxYear";
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Businessuser[user_default_business_dob]',
                    'model' => $model->user_default_business_dob,
                    'flat' => false,//remove to hide the datepicker
                    'value' => CommonClass::convertDateAsDisplayFormat($model->user_default_business_dob, 'd/m/Y'),
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
                echo $form->dropDownList($model, 'user_country_id',
                    CHtml::listData(Country::model()->findAll(array('order' => 'user_default_country_name')), 'user_default_country_id', 'user_default_country_name'),
                    array('prompt' => '-All-', 'class' => "chzn-select")
                );
                ?>
            </div>

            <div class="col-2">
                <label>Business sector</label>
                <?php echo $form->dropDownList($model, 'user_default_business_sector',
                    CHtml::listData(BusinessProfession::model()->findAll(array('order' => 'list_profession_name')), 'list_profession_id', 'list_profession_name'),
                    array('prompt' => '-All-', 'class' => "chzn-select"));
                ?>
            </div>

            <div class="col-2">
                <label>Account status</label>
                <?php echo $form->dropDownList($model, 'user_default_business_status',
                    array(
                        'Online' => 'Online',
                        '1' => 'Active',
                        '2' => 'Suspended',
                        '0' => 'Pending Activation',
                    ),
                    array('prompt' => '-All-', 'style' => 'width:100%;', 'class' => "chzn-select"));
                ?>

            </div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="" style="text-align:center; padding-bottom: 12px;">
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

        jQuery('input[type="reset"], button[type="reset"]').click(function () {
            jQuery('.member-form-container .chzn-select').val('').trigger('liszt:updated');
        });

    });
</script>