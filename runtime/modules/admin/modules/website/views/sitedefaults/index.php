<?php

/* @var $this SiteDefaultsController */

?>
<div class="content-container">

    <!--secondary Top Menu-->
    <?php $this->renderPartial('../layouts/_top_menu'); ?>

</div>

<div class="heading">
    <h3>Site Defaults</h3>
</div>

<div class="website-container">
    <div class="row">
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>Assets folder</h2></div>
                <?php
                $site_default1 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Assets'));
                if (!$site_default1)
                    $site_default1 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default1->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default1->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default1->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'Assets');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>Admin log files</h2></div>
                <?php
                $site_default2 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'AdminLogs'));
                if (!$site_default2)
                    $site_default2 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default2->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default2->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default2->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'AdminLogs');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>Apache2 log files</h2></div>
                <?php
                $site_default3 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Apache2Logs'));
                if (!$site_default3)
                    $site_default3 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default3->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default3->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default3->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'Apache2Logs');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>User log files</h2></div>
                <?php
                $site_default4 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'UserLogs'));
                if (!$site_default4)
                    $site_default4 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default4->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default4->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default4->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'UserLogs');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>Runtime log files</h2></div>
                <?php
                $site_default5 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'RuntimeLogs'));
                if (!$site_default5)
                    $site_default5 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default5->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default5->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default5->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'RuntimeLogs');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-3">
            <div class="content-container box-area">
                <div class="sub-heading"><h2>Log files</h2></div>
                <?php
                $site_default6 = SiteDefaults::model()->findByAttributes(array('user_default_site_default_type' => 'Logs'));
                if (!$site_default6)
                    $site_default6 = new SiteDefaults;
                ?>
                <table width="100%" align="center">
                    <tr>
                        <td valign="middle" style="width: 70%;text-align: left;">Delete all entries older than
                            &nbsp;<input
                                type="text" name="user_default_site_default_days"
                                value="<?php echo $site_default6->user_default_site_default_days; ?>" title="N days"
                                placeholder="N days"
                                style="width: 22%; text-align: center;"/>
                            <input type="hidden" value="<?php echo $site_default6->user_default_site_default_id; ?>"
                                   name="user_default_site_default_id"/>
                            <input type="hidden" value="<?php echo $site_default6->user_default_site_default_type; ?>"
                                   name="user_default_site_default_type"/>
                        </td>
                        <td valign="middle"><input type="button" name="btnupdate" value="Update"
                                                   class="button black black-btn"
                                                   onclick="return deleteSiteDefaults(this, 'Logs');"><span
                                class="statusControl">&nbsp;</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

    function deleteSiteDefaults(_this, type) {

        var SiteDefaults = {};
        var parentControl = jQuery(_this).closest('table');
        var inputControl = parentControl.find('input[name="user_default_site_default_days"]');
        inputControl.css({'border': 'none'});
        if (inputControl.val() === '') {
            inputControl.css({'border': '2px solid red'});
            return false;
        } else {
            // post values
            var SiteDefaults = {
                user_default_site_default_id: parentControl.find('input[name="user_default_site_default_id"]').val(),
                user_default_site_default_type: type,
                user_default_site_default_days: inputControl.val()
            };
        }

        console.log(SiteDefaults);

        jQuery.ajax({

            url: "<?php echo Yii::app()->baseUrl?>/admin/website/sitedefaults/update",
            type: 'POST',
            data: {SiteDefaults: SiteDefaults},
            //async: true,
            success: function (resp) {
                var returnedData = JSON.parse(resp);
                if (returnedData.status === 0) {
                    alert(resp.message);
                } else {
                    window.location.reload('<?php echo Yii::app()->createUrl("admin/website/sitedefaults");?>');
                }
            },
            error: function (xhr, tStatus, e) {

                if (xhr.status == 302) {
                    // User in not loggued in
                    alert("You must be logged in.");

                } else {

                    if (!xhr) {
                        console.log(" We have an error ");
                        console.log(tStatus + " " + e.message);
                    } else {
                        console.log("else: " + e.message); // the great unknown
                    }
                }
            },
            complete: function () {
                return true;
            }

        });

    }

</script>