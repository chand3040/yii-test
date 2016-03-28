<style>
    .your-class {
        /* border: 1px solid red;*/
    }
</style>
<div class="content-container">
    <div class="close_caform">

        <a class="button white smallrounded" title="Close" href="<?php echo $this->createUrl('index'); ?>">X</a>

    </div>
    <div style="margin:0 295px"><h2> Banner adverts waiting for publication</h2></div>


    <div id='loadingmessage' style='display:none'>
        <img src='<?php echo Yii::app()->theme->baseUrl ?>/images/ajax-loader.gif' alt="Loading image"/>
    </div>
    <?php if (count($list) > 0) { ?>
        <form action="<?php echo Yii::app()->createUrl('admin/banner/banner/publish'); ?>" method="post"
              name="frmbanner" id="frmbanner">


            <div style="width:100%;">
                <?php
                $addIndex = (count($list) % 2 == 0) ? '0' : '1';
                for ($i = 0; ($i) < count($list) + $addIndex; $i++) {
                    if ($i % 2 == 0) {
                        $class = "banneradvert-left";
                    } else {
                        $class = 'banneradvert-right';
                    }
                    $userProfile = User::model()->findByPk($list[$i]['user_default_id']);
                    $Currency = Currency::model()->findByPk($userProfile['user_default_currency']);
                    ?>

                    <div
                        class="<?php echo $class; ?>"> <?php /*style="height: <?php echo (!empty($list[$i]['user_default_listing_banner_id']))?'auto':'308px'?>" */ ?>
                        <?php if (!empty($list[$i]['user_default_listing_banner_id'])) { ?>
                            <div class="row">
                                <div class="col-1">

                                </div>
                                <div class="col-3">
                                    <span style="color: #999;font-style: italic;"> Click on the banner to enlarge</span>
                                </div>
                                <div class="col-1">
                                    <input type="checkbox" name="reject[]" class="rejectBanner"
                                           id="reject_<?php echo $list[$i]['user_default_listing_banner_id']; ?>"
                                           value="<?php echo $list[$i]['user_default_listing_banner_id']; ?>"/><span
                                        style="color: #ed1c35;font-weight: bold;"> REJECT</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                    <label style="color: #BC6B9B;font-size: 5px;font-size: 11px;">Select</label>
                                    <input type="checkbox" name="selectBanner[]"
                                           id="selectBanner_<?php echo $list[$i]['user_default_listing_banner_id']; ?>"
                                           class="selectBanner"
                                           value="<?php echo $list[$i]['user_default_listing_banner_id']; ?>"
                                           style="margin-left: 12px;"/>
                                </div>
                                <div class="col-3">

                                    <?php
                                    if ($list[$i]['user_default_listing_banner_path'] != "" && file_exists('upload/' . $list[$i]['user_default_listing_banner_path'])) {
                                        $bannerimage = Yii::app()->baseUrl . '/upload/' . $list[$i]['user_default_listing_banner_path'];
                                        ?>
                                        <a class="single_image" href="<?php echo $bannerimage; ?>"> <img
                                                src="<?php echo $bannerimage; ?>"
                                                alt="<?php echo $list[$i]['user_default_listing_banner_link']; ?>"
                                                class="dragonMain"/>
                                        </a>
                                    <?php
                                    } else {
                                        $bannerimage = Yii::app()->baseUrl . '/upload/banner-images/blank.png';
                                        ?>
                                        <img src="<?php echo $bannerimage; ?>"
                                             alt="<?php echo $list[$i]['user_default_listing_banner_link']; ?>"
                                             class="dragonMain"/>
                                    <?php
                                    }
                                    ?></div>
                            </div>
                            <div class="row" style="margin-top: 8px">
                                <div class="col-1">
                                </div>
                                <div class="col-3">
                    <span><input type="text" id="txtupdate_<?php echo $list[$i]['user_default_listing_banner_id']; ?>"
                                 name="txtupdate[]"
                                 style="width: 282px;height: 25px;border: 1px solid #BC6B9B;"
                                 value="<?php echo $list[$i]['user_default_listing_banner_link']; ?>"/></span><span
                                        style="float: right;margin-right: -89px;"><input type="button"
                                                                                         id="btnUpdateLink_<?php echo $list[$i]['user_default_listing_banner_id']; ?>"
                                                                                         class="button black black-btn updateLink"
                                                                                         value="Update"/></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 4px">


                                <div class="col-1">
                                </div>
                                <div class="col-3">
                                    <table style="border-spacing: 5px;width:100%">
                                        <tr>
                                            <td><span class="bannerAdvertLabel">Insertion date</span></td>
                                            <td><span class="bannerAdvertLabel">User</span></td>
                                            <td><span class="bannerAdvertLabel">Duration</span></td>
                                            <td><span class="bannerAdvertLabel">Cost</span></td>
                                        </tr>
                                        <tr>
                                            <td><span
                                                    class="bannerAdvertValue"><?php echo CommonClass::convertDateAsDisplayFormat($list[$i]['user_default_listing_banner_submission_date'], 'd-m-Y'); ?></span>
                                            </td>
                                            <td><span
                                                    class="bannerAdvertValue"><?php echo $userProfile['user_default_username']; ?></span>
                                            </td>
                                            <td><span
                                                    class="bannerAdvertValue"><?php echo $list[$i]['user_default_listing_banner_duration']; ?></span>
                                            </td>
                                            <td><span
                                                    class="bannerAdvertValue"><?php echo SharedFunctions::_get_banner_cost_indoller($list[$i]['user_default_id'], $list[$i]['user_default_listing_banner_cost']); ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1">
                                </div>
                                <div class="col-3">
                                    <label style="color: #BC6B9B;font-size: 5px;font-size: 11px;"
                                           id="messageLabel_<?php echo $list[$i]['user_default_listing_banner_id']; ?>">Message</label>
                                    <textarea cols="42" rows="3" name="message[]"
                                              id="message_<?php echo $list[$i]['user_default_listing_banner_id']; ?>"></textarea>

                                    <div style="clear: both;">&nbsp;</div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>


            <div class="clear">&nbsp;</div>

            <?php
            $count = ($_REQUEST['rows'] ? $_REQUEST['rows'] : 6);
            ?>
            <select name="drg_category" data-placeholder="12" class="chzn-select" style="width: 50px" tabindex="2"
                    onchange="window.location = '?rows='+jQuery(this).val();">
                <option value=""></option>
                <option <?php echo ($count == 6) ? 'selected=selected' : ''; ?> value="6">6</option>
                <option <?php echo ($count == 10) ? 'selected=selected' : ''; ?> value="10">10</option>
                <option <?php echo ($count == 20) ? 'selected=selected' : ''; ?> value="20">20</option>
                <option <?php echo ($count == 50) ? 'selected=selected' : ''; ?> value="50">50</option>
                <option <?php echo ($count == 100) ? 'selected=selected' : ''; ?> value="100">100</option>
            </select>

            <!-- Bottom navigation menu -->
            <?php $this->widget('CLinkPager', array('pages' => $pages, 'header' => '',
                    'firstPageLabel' => '<',
                    'prevPageLabel' => 'previous',
                    'nextPageLabel' => 'next',
                    'maxButtonCount' => 5,
                    'lastPageLabel' => '>', 'htmlOptions' => array('name' => 'test', 'id' => 'navlist', 'class' => 'pager'))
            ); ?>
            <!-- /Bottom navigation menu -->
            <div class="row bannerAdvertButton">
                <div class="col-1">
                    <input type="button" class="button blue" value="Clear Data" id="clearAllData">
                </div>
                <div class="col-1">
                    <input type="button" class="button white" id="selecctall" value="Select All">
                </div>
                <div class="col-1">

                    <input type="button" class="button update-green" name="publish" id="publish" value="Publish">
                </div>
                <!--    <div class="col-1">
                        <input type="button" class="button red" name="reject" id="reject" value="Reject" >
                    </div>
    -->
                <div class="col-1">
                    <input type="button" class="button black black-btn" value="Return"
                           onclick="window.location.href = '<?php echo $this->createUrl('index'); ?>'">
                </div>
            </div>

        </form>

    <?php
    } else {
        echo '<div class="emptybannermsg">No Banner Advert records waiting for publication!</div>';
    }?>
</div>

<script type="text/javascript">
    $
    jQuery(".chzn-select").chosen();
    jQuery(".chzn-select-deselect").chosen({allow_single_deselect: true});
    jQuery(".single_image").fancybox();

    function close_delete_form() {
        jQuery(".show_delete_form").fadeOut();
    }

    jQuery(document).ready(function () {

        jQuery('#publish').click(function (event) {
            jQuery('.selectBanner').each(function () { //loop through each checkbox
                var publishbannerId = jQuery(this).attr('id');
                var bannerId = publishbannerId.split('_')[1];
                /*if(jQuery(this).is(":checked")) {
                 jQuery('#reject_'+bannerId).attr("checked",false);
                 jQuery("#message_"+bannerId).val('');
                 jQuery("#message_"+bannerId).attr('readonly',true);
                 jQuery("#message_"+bannerId).removeAttr("placeholder");
                 jQuery("#message_"+bannerId).removeClass('your-class');
                 }*/
            });
            jQuery('#frmbanner').submit();
        });

        jQuery('#selecctall').click(function (event) {  //on click
            jQuery('.selectBanner').each(function () { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
                var rejectbannerId = jQuery(this).attr('id');
                var bannerId = rejectbannerId.split('_')[1];
                jQuery("#message_" + bannerId).val('');
                jQuery("#message_" + bannerId).attr('readonly', true);
                jQuery("#message_" + bannerId).removeAttr("placeholder");
                jQuery("#message_" + bannerId).removeClass('your-class');
                /* jQuery('.rejectBanner').attr("checked",true);*/
            });
        });

        jQuery('.rejectBanner').click(function (event) {  //on click
            var rejectbannerId = jQuery(this).attr('id');
            var bannerId = rejectbannerId.split('_')[1];

            if (jQuery('#' + rejectbannerId).is(":checked")) {
                jQuery('#selectBanner_' + bannerId).attr("checked", true);
                jQuery("#message_" + bannerId).attr("placeholder", "Enter rejection message");
                jQuery("#message_" + bannerId).addClass('your-class');
                jQuery("#message_" + bannerId).removeAttr('readonly');
            }
            else {
                jQuery("#message_" + bannerId).val('');
                jQuery('#selectBanner_' + bannerId).attr("checked", false);
                jQuery("#message_" + bannerId).attr('readonly', true);
                jQuery("#message_" + bannerId).removeAttr("placeholder");
                jQuery("#message_" + bannerId).removeClass('your-class');
            }

        });

        jQuery('#clearAllData').click(function (event) {  //on click
            jQuery('.selectBanner').each(function () { //loop through each checkbox
                jQuery(this).attr("checked", false);
                jQuery('.rejectBanner').attr("checked", false);
                var rejectbannerId = jQuery(this).attr('id');
                var bannerId = rejectbannerId.split('_')[1];
                jQuery("#message_" + bannerId).val('');
                jQuery("#message_" + bannerId).attr('readonly', true);
                jQuery("#message_" + bannerId).removeAttr("placeholder");
                jQuery("#message_" + bannerId).removeClass('your-class');
            });
        });

        jQuery('.updateLink').click(function (event) {
            var updateLinkID = jQuery(this).attr("id");
            var bannerId = updateLinkID.split('_')[1];

            jQuery('#reject_' + bannerId).attr("checked", false);
            jQuery("#message_" + bannerId).attr("placeholder", "Enter message");
            jQuery("#message_" + bannerId).addClass('your-class');
            jQuery("#message_" + bannerId).removeAttr('readonly');
            jQuery("#selectBanner_" + bannerId).attr("checked", true);
            var updateBannerLink = jQuery("#txtupdate_" + bannerId).val();
            var message = jQuery("#message_" + bannerId).val();

            if (message == '' || updateBannerLink == '') {
                return;
            }
            jQuery('#loadingmessage').show();
            jQuery('body').css({'opacity': '0.12', width: '100%', height: '100%'});
            var data = 'bannerid=' + bannerId + '&bannerlink=' + updateBannerLink + '&bannermessage=' + message;
            var url = "<?php echo $this->createUrl('updatelink');?>";
            jQuery.ajax({
                type: "POST",
                url: url,
                data: data, // serializes the form's elements.
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.success === true) {
                        alert('Banner Link is updated');
                        location.reload();
                        jQuery('#loadingmessage').hide();
                        jQuery('body').removeAttr('style');
                    }
                }
            });

            return false; // avoid to execute the actual submit of the form.
        });

        jQuery('#reject').click(function (event) {
            jQuery('#loadingmessage').show();
            jQuery('body').css({'opacity': '0.12', width: '100%', height: '100%'});

            if (validation() == true) {
                jQuery('.rejectBanner').each(function () {
                    var rejectbannerId = jQuery(this).attr('id');

                    if (jQuery('#' + rejectbannerId).is(":checked")) {
                        var bannerId = rejectbannerId.split('_')[1];
                        var bannermessage = jQuery("#message_" + bannerId).val();

                        var data = 'bannerid=' + bannerId + '&admincomment=' + bannermessage;
                        var url = "<?php echo $this->createUrl('reject');?>";
                        jQuery.ajax({
                            type: "POST",
                            url: url,
                            data: data, // serializes the form's elements.
                            success: function (data) {
                                if (data == 'success') {
                                    alert('Banner rejected and message is sent');
                                    jQuery("#message_" + bannerId).val('');
                                    jQuery("#message_" + bannerId).attr('readonly', true);
                                    jQuery("#message_" + bannerId).removeAttr("placeholder");
                                    jQuery("#message_" + bannerId).removeClass('your-class');
                                    jQuery('.rejectBanner').attr("checked", false);
                                    jQuery('#selectBanner_' + bannerId).attr("checked", false);
                                    jQuery('#loadingmessage').hide();
                                    jQuery('body').removeAttr('style');
                                } else {
                                    alert('Banner rejected but message could not be sent');
                                }
                            }
                        });
                    }


                });
            }
        });
    });

    function validation() {
        var isFormValid = true;
        jQuery('.rejectBanner').each(function () {

            var rejectbannerId = jQuery(this).attr('id');
            var bannerId = rejectbannerId.split('_')[1];
            var message = jQuery("#message_" + bannerId).val();

            if (jQuery('#' + rejectbannerId).is(":checked")) {
                if (message.length == 0) {
                    isFormValid = false;
                    if (!isFormValid)
                        alert("Please fill in all the required fields");
                    return isFormValid;
                }
                return isFormValid;
            }

        });
        return isFormValid;
    }
    jQuery(window).load(function () {
        var bannerAdvertLeftHeight = jQuery(".banneradvert-left").height();
        jQuery(".banneradvert-right").css("height", bannerAdvertLeftHeight);
    });

</script>
