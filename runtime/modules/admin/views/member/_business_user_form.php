<style type="text/css">

    .col-1 {
        width: 13.66% !important;
    }

    .col-3 {
        width: 42% !important;
    }

    .col-4 {
        width: 56.66% !important;
    }

    .chzn-container-single {
        padding: 0px 0px 0px 2px;
        margin: 0 0 0 -3px;
    }

    #chart_userActivityChart {
        margin-top: 15px;
        width: 100%;
        padding: 0;
    }

</style>

<?php

$baseUrl = Yii::app()->theme->baseUrl;
$js = Yii::app()->getClientScript();
$js->registerScriptFile($baseUrl . '/js/chosen.jquery.js');
$js->registerCssFile($baseUrl . '/css/chosen.css');

$userId = $model->user_default_business_id;

?>

<div class="form">
<?php
// $logtime = Logtransaction::totalLoggedTime($model->user_default_id);
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'member-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    //  'action'=>Yii::app()->createUrl("/admin/member/update",array("id"=>$model->user_default_id)),
)); ?>
<div class="member-form-container outline">
<div class="row">&nbsp;</div>
<div class="row">
    <div class="col-1">
        <label>Registered Date</label>
        <?php
        $maxYear = date('Y');
        $yearRange = "1970:$maxYear";
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Businessuser[user_default_business_rdate]',
            'model' => $model,
            'value' => CommonClass::convertDateAsDisplayFormat($model->user_default_business_rdate, 'd/m/Y'),
            'options' => array(
                'dateFormat' => 'mm/dd/yy',
                'showAnim' => 'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'changeMonth' => true,
                'changeYear' => true,
                'yearRange' => $yearRange,
                'beforeShowDay' => 'js:$.datepicker.noWeekends',
                'onSelect' => '',  // is this needeD?
            ),
            'htmlOptions' => array(
                'readonly' => 'readonly',
                'placeholder' => 'DD/MM/YY'
            ),
        ));
        ?>
        <?php echo $form->error($model, 'user_default_registration_date'); ?>
    </div>
    <div class="col-1">
        <label>User status</label>
        <?php
        $criteria = new CDbCriteria;
        $criteria->condition = "t.user_default_id = '" . $model->user_default_business_id . "' AND t.datetime > SUBTIME('" . date('Y-m-d H:i:s') . "', '00:30:00')";
        $criteria->order = "t.datetime DESC";
        $user_activity = ActivityLog::model()->find($criteria);
        if ($user_activity && $user_activity->log_id != 14) {
            if ($user_activity->log_id == 12)
                $status = 'Online but Idle';
            else
                $status = 'Onine';
        } else
            $status = 'Offline';
        ?>
        <input type="text" value="<?php echo $status; ?>"/>
    </div>
    <div class="col-1">
        <label>Account status</label>
        <?php echo $form->dropDownList($model, 'user_default_business_status', array(0 => 'Not Active', 1 => 'Active', 2 => 'Suspend'), array('class' => 'chzn-select')); ?>
        <?php echo $form->error($model, 'user_default_account_status'); ?>
    </div>
    <div class="col-1">
        <label>Member since</label>
        <?php echo $form->textField($model, '', array('value' => CommonClass::convertDateAsDisplayFormat($model->user_default_business_rdate, 'm/d/Y'), 'size' => 13)); ?>
        <?php echo $form->error($model, 'user_default_business_rdate'); ?>
    </div>
    <div class="col-1">
        <label>Member type</label>
        <?php echo $form->textField($model, '', array('value' => ucwords($model->user_default_business_user_type), 'size' => 13, 'maxlength' => 50)); ?>
        <?php echo $form->error($model, 'user_default_business_user_type'); ?>
    </div>
    <div class="col-1">
        <label>User reputation</label>
        <input type="text" size="13"/>
    </div>
    <div class="col-1" style="margin-top:-14px;">
        <label>Time logged this month</label>
        <input type="text" size="13"/>
    </div>
</div>

<div class="row">&nbsp;</div>
<div class="row">
<div class="col-3" style="margin-left: -10px; margin-top: -12px;">

    <table style="border-spacing: 5px; padding: 0px;">

        <tr>
            <td class="profile-label"></td>
            <td class="spacer-colon"></td>
            <td><label>User Details</label></td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_first_name', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($model, 'user_default_business_first_name', array('size' => 40, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'user_default_business_first_name'); ?>
            </td>
        </tr>

        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_surname', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($model, 'user_default_business_surname', array('size' => 40, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'user_default_business_surname'); ?>
            </td>
        </tr>

        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_gender', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->dropDownList($model, 'user_default_business_gender', array('m' => 'Male', 'f' => 'Female'), array('class' => 'chzn-select', 'style' => 'width:100px;')); ?>
                <?php echo $form->error($model, 'user_default_business_gender'); ?>
            </td>
        </tr>

        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_dob', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php
                $maxYear = date('Y') - 18;
                $yearRange = "1900:$maxYear";
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Member[user_default_business_dob]',
                    'model' => $model->user_default_business_dob,
                    'flat' => false,//remove to hide the datepicker
                    'value' => CommonClass::convertDateAsDisplayFormat($model->user_default_business_dob, 'd/m/Y'),
                    'options' => array(
                        'dateFormat' => 'dd-mm-yy',
                        'showAnim' => 'slideDown',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                        'changeMonth' => true,
                        'changeYear' => true,
                        'yearRange' => $yearRange,
                        'minDate' => '01-01-1900',
                        'maxDate' => date('t/') . '12/' . $maxYear,
                        //'onSelect' => 'js: function(dateText, inst) {myaccountdod()}',
                    ),
                    'htmlOptions' => array(
                        'readonly' => 'readonly',
                        'style' => 'width:100px'
                    ),
                ));
                ?>
                <?php echo $form->error($model, 'user_default_business_dob'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_username', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($model, 'user_default_business_username', array('size' => 40, 'maxlength' => 50)); ?>
                <?php echo $form->error($model, 'user_default_business_username'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_email', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($model, 'user_default_business_email', array('size' => 40, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'user_default_business_email'); ?>
            </td>
        </tr>
        <?php

        // User Address
        $useraddress = Businessaddress::model()->find(array(
            'condition' => 'user_default_business_id= "' . $model->user_default_business_id . '" ',
            'order' => 'user_default_business_addr_id DESC'
        ));
        if (!$useraddress) {
            $useraddress = new Businessaddress;
        }
        ?>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_addr1', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_addr1', array('size' => 40, 'maxlength' => 500)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_addr1'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_addr2', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_addr2', array('size' => 40, 'maxlength' => 500)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_addr2'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_addr3', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_addr3', array('size' => 40, 'maxlength' => 500)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_addr3'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_town', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_town', array('size' => 40, 'maxlength' => 100)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_town'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_county', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_county', array('size' => 40, 'maxlength' => 200)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_county'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($useraddress, 'user_default_business_zip', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php echo $form->textField($useraddress, 'user_default_business_zip', array('size' => 40, 'maxlength' => 50)); ?>
                <?php echo $form->error($useraddress, 'user_default_business_zip'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><?php echo $form->labelEx($model, 'user_default_business_country', array('class' => 'field')); ?></td>
            <td class="spacer-colon">:</td>
            <td>
                <?php
                $data = CHtml::listData(Country::model()->findAll(), 'user_default_country_id', 'user_default_country_name');
                ?>
                <?php echo $form->dropDownList($useraddress, 'user_default_business_country', $data, array('prompt' => 'Please Select', 'class' => 'chzn-select', 'style' => 'width:224px')); ?>
                <?php echo $form->error($useraddress, 'user_default_business_country'); ?>
            </td>
        </tr>
        <tr>
            <td class="profile-label"><label>Phone</label></td>
            <td class="spacer-colon">:</td>
            <td><input type="text" size="40"/></td>
        </tr>

    </table>

</div>
<div class="col-4" style="margin-left: -10px;">

    <div class="row">

        <?php

        ?>
        <div class="inner-col-1">
            <label>Total won</label>
            <input type="text"/>
        </div>
        <div class="inner-col-1">
            <label>Total won</label>
            <input type="text"/>
        </div>
        <div class="inner-col-1">
            <label>Points purchased</label>
            <input type="text"/>
        </div>
        <div class="inner-col-1">
            <label>Points this month</label>
            <input type="text"/>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <?php
        $criteria7 = new CDbCriteria;
        $criteria7->compare('user_default_business_id', $model->user_default_business_id, true);
        $listingsCount = count(Businesslisting::model()->findAll($criteria7));
        ?>
        <div class="inner-col-1" style="text-align: center">
            <label>Total listing submissions</label>
            <input type="text" value="<?php echo $listingsCount ? $listingsCount : ''; ?>"/>
        </div>
        <div class="inner-col-1" style="text-align: center">
            <label>Total banner submissions</label>
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="text-align: center">
            <label>Total sample submissions</label>
            <input type="text" value=""/>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <center>Listing history</center>
    <?php

    $criteria10 = new CDbCriteria;

    // $criteria1->compare('approved',1,true);
    $criteria10->compare('user_default_business_id', $model->user_default_business_id, true);
    $criteria10->order = 'user_default_business_status asc,user_default_business_id desc';

    $count = Businesslisting::model()->count($criteria10);
    $pages = new CPagination($count);

    $pages->pageSize = 5;
    $pages->applyLimit($criteria);

    $listings = Businesslisting::model()->findAll($criteria10);
    if ($listings) {
        foreach ($listings as $index => $listing) {
            ?>
            <div class="row">
                <div class="inner-col-1">
                    <?php if ($index == 0) { ?> <label>Date</label> <?php } ?>
                    <input type="text" name="Businesslisting[user_default_business_bdeletedate]"
                           value="<?php echo CommonClass::convertDateAsDisplayFormat($listing->user_default_business_bdeletedate, 'm/d/Y'); ?>"/>
                </div>
                <div class="inner-col-1" style="width: 45%">
                    <?php if ($index == 0) { ?> <label>Title</label> <?php } ?>
                    <input type="text" name="Businesslisting[user_default_business_title]"
                           value="<?php echo $listing->user_default_business_title; ?>"/>
                </div>
                <div class="inner-col-1" style="width:30%">
                    <?php if ($index == 0) { ?> <label>Status</label> <?php } ?>
                    <?php
                    if ($listing->user_default_business_status == "2") {
                        $listing_status = "Rejected";
                    } else if ($listing->user_default_business_status == "1") {
                        $listing_status = "Approved";
                    } else {
                        $listing_status = "Waiting for publication";
                    } ?>
                    <input type="text" name="Businesslisting[user_default_business_status]"
                           value="<?php echo $listing_status; ?>"/>
                    <a href="#" title=""><img class="icon-arrow-right" alt=""
                                              src="<?php echo Yii::app()->theme->baseUrl . '/images/arrr.png'; ?>"/></a>
                </div>
            </div>

        <?php
        }
        ?>
        <div class="row">
            <div class="inner-col-1" style=" text-align: right; width: 100%;">
                <?php $this->widget('CLinkPager', array(
                    'pages' => $pages,
                ));?>
            </div>
        </div>
    <?php
    } else {
        ?>
        <div class="row">
            <div class="inner-col-1" style="text-align: center; width: 100%;">No listings by the user.</div>
        </div>
    <?php
    }
    ?>

    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <center>Banner Advertisements</center>
    <div class="row">
        <div class="inner-col-1">
            <label>Date</label>
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width: 45%">
            <label>Title</label>
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width:30%">
            <label>Status</label>
            <input type="text" value=""/>
            <a href="#" title=""><img class="icon-arrow-right" alt=""
                                      src="<?php echo Yii::app()->theme->baseUrl . '/images/arrr.png'; ?>"/></a>
        </div>

    </div>
    <div class="row">
        <div class="inner-col-1">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width: 45%">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width:30%">
            <input type="text" value=""/>
            <a href="#" title=""><img class="icon-arrow-right" alt=""
                                      src="<?php echo Yii::app()->theme->baseUrl . '/images/arrr.png'; ?>"/></a>
        </div>
    </div>
    <div class="row">
        <div class="inner-col-1">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width: 45%">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width:30%">
            <input type="text" value=""/>
            <a href="#" title=""><img class="icon-arrow-right" alt=""
                                      src="<?php echo Yii::app()->theme->baseUrl . '/images/arrr.png'; ?>"/></a>
        </div>
    </div>
    <div class="row">
        <div class="inner-col-1">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width: 45%">
            <input type="text" value=""/>
        </div>
        <div class="inner-col-1" style="width:30%">
            <input type="text" value=""/>
            <a href="#" title=""><img class="icon-arrow-right" alt=""
                                      src="<?php echo Yii::app()->theme->baseUrl . '/images/arrr.png'; ?>"/></a>
        </div>
    </div>

</div>

</div>

<div class="row">
    <div class="col-6">
        <?php

        /*
            Add Charts in User Profile page

        */
        if (!$model->isNewRecord) {
            /*
             ?>
             <div class="clearboth"></div>
             <div class="chart">
                 <h1>User data graph</h1>
                 <div id="chartcontainer">Please wait.....</div>
                 <script type="text/javascript">
                     var myData = new Array(['unit', 20], ['unit two', 10], ['unit three', 30],['other unit', 10], ['last unit', 30]);
                     var myChart = new JSChart('chartcontainer', 'bar');
                     myChart.setDataArray(myData);
                     myChart.draw();
                 </script>
             </div>*/
            ?>

            <?php
            $this->widget('ext.fusioncharts.fusionChartsWidget', array(
                'chartNoCache' => true, // disabling chart cache
                'registerWithJS' => true,
                'chartType' => 'MSColumn2D',
                'chartWidth' => '970',
                // 'chartAction'=>Yii::app()->createUrl('/admin/member/generateChart'), // the chart action that we just generated the xml data at
                'chartAction' => Yii::app()->createUrl('/admin/member/userActivityChart/user_id/' . $model->user_default_business_id),
                'chartId' => 'userActivityChart')); // If you display more then one chart on a single page then make sure you specify and id
            ?>
            <script type="text/javascript">
                function updateChart(factoryIndex) {
                    //DataURL for the chart
                    var strURL = "FactoryData.php?factoryId=" + factoryIndex;
                    //Sometimes, the above Url and XML data gets cached by the browser.
                    //If you want your charts to get new XML data on each request,
                    //you can add the following line:
                    //strURL = strURL + "&currTime=" + getTimeForURL();
                    //getTimeForURL method is defined below and needs to be included
                    //This basically adds a ever-changing parameter which bluffs
                    //the browser and forces it to re-load the XML data every time.
                    //Get reference to chart object using Dom ID "FactoryDetailed"
                    //Send request for XML
                    FusionCharts("userActivityChart").setXMLUrl(strURL);
                }

            </script>

        <?php
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <label style="color: #a0688b !important;">Admin Note</label>
        <?php echo $form->textArea($model, 'user_default_business_notes', array('rows' => 8, 'cols' => 158, 'style' => 'width:100%;')); ?>
        <?php echo $form->error($model, 'user_default_business_notes'); ?>
    </div>
</div>
</div>

<div class="notification-popup">&nbsp;</div>

<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    jQuery(".chzn-select").chosen();
</script>